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

    const SORT_ASC = 'asc';
    const SORT_DESC = 'desc';

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
        if (isset($options['sort']) && in_array($options['sort'], $this->_getSortAvailable()))
        {
            $this->_sort = (string) $options['sort'];
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

                $data[$serverIndex] = $gearmanManager->version();

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
                        $workerStatus['name'] = $workerName;
                        $workerStatus['server'] = $server['name'];
                        $data[] = $workerStatus;
                    }
                }
            }
            catch (Exception $e)
            {
                $this->_addError($e->getMessage());
            }
        }

        $data = $this->_sortFunctionData($data);

        return $data;
    }

    /**
     * Returns available sort column
     *
     * @return array
     */
    protected function _getSortAvailable()
    {
        $sortAvailable = array(
            self::SORT_SERVER,
            self::SORT_NAME,
            self::SORT_JOBS_IN_QUEUE,
            self::SORT_JOBS_RUNNING,
            self::SORT_WORKERS
        );

        return $sortAvailable;
    }

    /**
     * Sort Gearman functions data
     *
     * @param array $data
     * @return array 
     */
    protected function _sortFunctionData(array $data)
    {
        if (in_array($this->_sort, $this->_getSortAvailable()))
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

?>