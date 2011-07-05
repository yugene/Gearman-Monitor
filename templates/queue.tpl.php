<?php include('content_header.tpl.php'); ?>

    <h2>Queue</h2>

    <table>
        <thead>
            <tr>
                <th><?php $this->fnSortCol($this->pageUri, 'Server', GA_ServerList::SORT_SERVER); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Function', GA_ServerList::SORT_NAME); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Jobs in queue', GA_ServerList::SORT_JOBS_IN_QUEUE); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Jobs running', GA_ServerList::SORT_JOBS_RUNNING); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Workers registered', GA_ServerList::SORT_WORKERS); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($this->functionData as $functionItem) { ?>
            <tr class="<?php echo ($i % 2 ? "even" : "odd"); ?>">
                <td><?php echo htmlspecialchars($functionItem['server']); ?></td>
                <td><?php echo htmlspecialchars($functionItem['name']); ?></td>
                <td class="ra"><?php echo $functionItem['in_queue']; ?></td>
                <td class="ra"><?php echo $functionItem['jobs_running']; ?></td>
                <td class="ra">
                    <?php if ($functionItem['capable_workers'] == 0 && $functionItem['in_queue'] > 0) { ?><img src="images/s_warn.png" /><?php } ?>
                    <?php echo $functionItem['capable_workers']; ?>
                </td>
            </tr>
            <?php $i ++; } ?>
        </tbody>
    </table>

<?php include('content_footer.tpl.php'); ?>
