<?php
class GA_Report
{
    public $totalInQueue     = 0;
    public $totaljobsRunning = 0;

    public function total($functionData)
    {
        if (count($functionData) > 0) {
            for ($i = 0; $i < count($functionData); $i++) {
                $this->totalInQueue += $functionData[$i]['in_queue'];
                $this->totaljobsRunning += $functionData[$i]['jobs_running'];
            }
        }
        return [
            'date'         => date('Y-m-d H:i:s'),
            'inQueue'      => $this->totalInQueue,
            'jobs_running' => $this->totaljobsRunning,
        ];
    }

}
