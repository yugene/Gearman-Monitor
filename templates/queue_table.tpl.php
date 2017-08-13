<table class="table table-sm table-striped table-bordered table-responsive small">
    <thead class="thead-default">
        <tr>
            <th><?php $this->fnSortCol($this->pageUri, 'Server', GA_ServerList::SORT_SERVER);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Function', GA_ServerList::SORT_NAME);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Jobs in queue', GA_ServerList::SORT_JOBS_IN_QUEUE);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Jobs running', GA_ServerList::SORT_JOBS_RUNNING);?></th>
            <th><?php $this->fnSortCol($this->pageUri, 'Workers registered', GA_ServerList::SORT_WORKERS);?></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($this->functionData as $functionItem): ?>
            <tr <?php if ($functionItem['capable_workers'] == 0 && $functionItem['in_queue'] > 0): ?>class="table-warning"<?php endif?>>
                <td><small><?php echo htmlspecialchars($functionItem['server']);?></small></td>
                <td><small><?php echo htmlspecialchars($functionItem['name']);?></small></td>
                <td class="ra" id="<?php echo $functionItem['id_key'] . 'in_queue'?>"><?php echo $functionItem['in_queue'];?></td>
                <td class="ra" id="<?php echo $functionItem['id_key'] . 'jobs_running'?>"><?php echo $functionItem['jobs_running'];?></td>
                <td class="ra" id="<?php echo $functionItem['id_key'] . 'capable_workers'?>">
                    <?php if ($functionItem['capable_workers'] == 0 && $functionItem['in_queue'] > 0): ?><img src="images/s_warn.png" /><?php endif;?>
                    <?php echo $functionItem['capable_workers'];?>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
