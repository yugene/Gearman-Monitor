<?php

/**
 * Main class handling Gearman servers interaction
 */
class GA_ServerList
{
    /**
     * Server list
     *
     * @var array
     */
    protected $_servers = array();

    /**
     * Filter: server IDs
     *
     * @var array
     */
    protected $_filterServers = array();

    /**
     * Filter: server name substring
     *
     * @var string
     */
    protected $_filterName = '';

    /**
     * Sort column name
     *
     * @var string
     */
    protected $_sort = '';

    /**
     * Group column name
     *
     * @var string
     */
    protected $_groupby = self::GROUP_NONE;

    /**
     * Error messages
     *
     * @var array
     */
    protected $_errors = array();

    const SORT_SERVER = 'server';
    const SORT_NAME = 'name';
    const SORT_JOBS_IN_QUEUE = 'in_queue';
    const SORT_JOBS_RUNNING = 'jobs_running';
    const SORT_WORKERS = 'capable_workers';
    const SORT_IP = 'ip';
    const SORT_FD = 'fd';
    const SORT_ID = 'id';

    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

    const GROUP_NONE = 'none';
    const GROUP_SERVER = 'server';
    const GROUP_NAME = 'name';

    /**
     * Class constructor
     *
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->setOptions($options);
    }

    /**
     * Set class options
     *
     * @param array $options
     */
    public function setOptions(array $options)
    {
        if (isset($options['filterServers']) && is_array($options['filterServers']))
        {
            $this->_filterServers = $options['filterServers'];
        }
        if (isset($options['filterName']) && strlen($options['filterName']) > 0)
        {
            $this->_filterName = (string) $options['filterName'];
        }
        if (isset($options['sort']))
        {
            $this->_sort = (string) $options['sort'];
        }
        if (isset($options['groupby']) && in_array($options['groupby'], $this->_getGroupAvailableFunctions()))
        {
            $this->_groupby = (string) $options['groupby'];
        }
    }

    /**
     * Clear server list
     *
     * @return GA_ServerList
     */
    public function clearServers()
    {
        $this->_servers = array();

        return $this;
    }

    /**
     * Add a server to the list
     *
     * @param int $serverIndex
     * @param array $serverValues
     * @return GA_ServerList
     */
    public function addServer($serverIndex, $serverValues)
    {
        $this->_servers[$serverIndex] = (array) $serverValues;

        return $this;
    }

    /**
     * Add several servers to the list
     *
     * @param array $servers
     * @return GA_ServerList
     */
    public function addServers(array $servers)
    {
        foreach ($servers as $key => $value)
        {
            $this->addServer($key, $value);
        }

        return $this;
    }

    /**
     * Set server list
     *
     * @param array $servers
     * @return GA_ServerList
     */
    public function setServers($servers)
    {
        return $this->clearServers()->addServers($servers);
    }

    /**
     * Returns server list
     *
     * @return array
     */
    public function getServers()
    {
        return $this->_servers;
    }

    /**
     * Return error messages
     *
     * @param boolean $duplicates Fetch duplicate messages
     * @return array
     */
    public function getErrors($duplicates = false)
    {
        if ($duplicates)
        {
            return $this->_errors;
        }
        else
        {
            return array_unique($this->_errors);
        }
    }

    /**
     * Add error message to error list
     *
     * @param string $message
     * @return GA_ServerList
     */
    protected function _addError($message)
    {
        $this->_errors[] = $message;

        return $this;
    }

    /**
     * Returns information about Gearman server versions
     *
     * @return array
     */
    public function getVersionData()
    {
        $data = array();

        foreach ($this->_servers as $serverIndex => $server)
        {
            if (! empty($this->_filterServers) && ! in_array($serverIndex, $this->_filterServers))
            {
                continue;
            }

            try
            {
                $gearmanManager = new Net_Gearman_Manager($server['address']);

                $data[$serverIndex] = array(
                    'version' => $gearmanManager->version(),
                    'address' => $server['address']
                );

                $gearmanManager->disconnect();
                unset($gearmanManager);
            }
            catch (Exception $e)
            {
                $this->_addError($e->getMessage());
            }
        }

        return $data;
    }

    /**
     * Returns information about Gearman registered functions
     *
     * @return array
     */
    public function getFunctionData()
    {
        $data = array();
        $i = 0;
        $groupDataTmp = array();

        foreach ($this->_servers as $serverIndex => $server)
        {
            if (! empty($this->_filterServers) && ! in_array($serverIndex, $this->_filterServers))
            {
                continue;
            }

            try
            {
                $gearmanManager = new Net_Gearman_Manager($server['address']);

                $status = $gearmanManager->status();

                $gearmanManager->disconnect();
                unset($gearmanManager);

                foreach ($status as $workerName => $workerStatus)
                {
                    if (strlen($this->_filterName) == 0 || stripos($workerName, $this->_filterName) !== false)
                    {
                        $workerStatus['name'] = ($this->_groupby == self::GROUP_SERVER) ? '+' : $workerName ;
                        $workerStatus['server'] = ($this->_groupby == self::GROUP_NAME) ? '+' : $server['name'];

                        if ($this->_groupby != self::GROUP_NONE)
                        {
                            if (isset($groupDataTmp[$workerStatus[$this->_groupby]]))
                            {
                                $k = $groupDataTmp[$workerStatus[$this->_groupby]];
                                foreach (array('in_queue', 'jobs_running', 'capable_workers') as $key)
                                {
                                    $data[$k][$key] += $workerStatus[$key];
                                }
                            }
                            else
                            {
                                $groupDataTmp[$workerStatus[$this->_groupby]] = $i;

                                $data[] = $workerStatus;
                                $i ++;
                            }
                        }
                        else
                        {
                            $data[] = $workerStatus;
                            $i ++;
                        }
                    }
                }
            }
            catch (Exception $e)
            {
                $this->_addError($e->getMessage());
            }
        }

        $data = $this->_sortData($data, $this->_getSortAvailableFunctions());

        return $data;
    }

    /**
     * Returns information about workers connected to Gearman server
     *
     * @return array
     */
    public function getWorkersData()
    {
        $data = array();

        foreach ($this->_servers as $serverIndex => $server)
        {
            if (! empty($this->_filterServers) && ! in_array($serverIndex, $this->_filterServers))
            {
                continue;
            }

            try
            {
                $gearmanManager = new Net_Gearman_Manager($server['address']);

                $workers = $gearmanManager->workers();

                $gearmanManager->disconnect();
                unset($gearmanManager);

                foreach ($workers as $worker)
                {
                    if (strlen($this->_filterName) == 0 ||
                        stripos($worker['ip'], $this->_filterName) !== false ||
                        stripos(join('$#!', $worker['abilities']), $this->_filterName) !== false)
                    {
                        sort($worker['abilities'], SORT_STRING);
                        $worker['server'] = $server['name'];
                        $data[] = $worker;
                    }
                }
            }
            catch (Exception $e)
            {
                $this->_addError($e->getMessage());
            }
        }

        $data = $this->_sortData($data, $this->_getSortAvailableWorkers());

        return $data;
    }

    /**
     * Returns available sort column
     *
     * @return array
     */
    protected function _getSortAvailableFunctions()
    {
        return array(
            self::SORT_SERVER,
            self::SORT_NAME,
            self::SORT_JOBS_IN_QUEUE,
            self::SORT_JOBS_RUNNING,
            self::SORT_WORKERS
        );
    }

    /**
     * Returns available sort column
     *
     * @return array
     */
    protected function _getSortAvailableWorkers()
    {
        return array(
            self::SORT_SERVER,
            self::SORT_IP,
            self::SORT_FD,
            self::SORT_ID
        );
    }

    protected function _getGroupAvailableFunctions()
    {
        return array(
            self::GROUP_SERVER,
            self::GROUP_NAME
        );
    }

    /**
     * Sort Gearman functions data
     *
     * @param array $data
     * @return array
     */
    protected function _sortData(array $data, $colsAvailable)
    {
        if (in_array($this->_sort, $colsAvailable))
        {
            $sortCol = array();

            foreach ($data as $key => $values)
            {
                $sortCol[$key] = $values[$this->_sort];
            }

            array_multisort($sortCol, $this->_getCurrentSortDir(), $data);
        }

        return $data;
    }

    /**
     * Returns requested sort direction
     *
     * @return string
     */
    protected function _getCurrentSortDir()
    {
        $result = SORT_ASC;

        if (isset($_REQUEST['dir']) && $_REQUEST['dir'] == self::SORT_DESC)
        {
            $result = SORT_DESC;
        }

        return $result;
    }
}
