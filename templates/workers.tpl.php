    <?php include('content_header.tpl.php'); ?>

    <h2>Workers</h2>

    <table>
        <thead>
            <tr>
                <th><?php $this->fnSortCol($this->pageUri, 'Server', GA_ServerList::SORT_SERVER); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'IP', GA_ServerList::SORT_IP); ?></th>
                <th>Functions</th>
                <th><?php $this->fnSortCol($this->pageUri, 'Descriptor', GA_ServerList::SORT_FD); ?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Id', GA_ServerList::SORT_ID); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($this->workersData as $workerItem) { ?>
            <tr class="<?php echo ($i % 2 ? "even" : "odd"); ?>">
                <td><?php echo htmlspecialchars($workerItem['server']); ?></td>
                <td><?php echo $workerItem['ip']; ?></td>
                <td>
                    <ul>
                    <?php foreach ($workerItem['abilities'] as $ability) { ?>
                        <li><?php echo $ability; ?></li>
                    <?php } ?>
                    </ul>
                </td>
                <td class="ra"><?php echo $workerItem['fd']; ?></td>
                <td class="ra"><?php echo $workerItem['id']; ?></td>
            </tr>
            <?php $i ++; } ?>
        </tbody>
    </table>

<?php include('content_footer.tpl.php'); ?>
