<?php include 'content_header.tpl.php';?>
<div class="container-fluid">
    <table class="table table-sm table-striped table-bordered table-responsive small">
        <thead>
            <tr>
                <th><?php $this->fnSortCol($this->pageUri, 'Server', GA_ServerList::SORT_SERVER);?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'IP', GA_ServerList::SORT_IP);?></th>
                <th>Functions</th>
                <th><?php $this->fnSortCol($this->pageUri, 'Descriptor', GA_ServerList::SORT_FD);?></th>
                <th><?php $this->fnSortCol($this->pageUri, 'Id', GA_ServerList::SORT_ID);?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->workersData as $workerItem): ?>
            <tr>
                <td><?php echo htmlspecialchars($workerItem['server']);?></td>
                <td><?php echo $workerItem['ip'];?></td>
                <td>
                    <ul>
                    <?php foreach ($workerItem['abilities'] as $ability): ?>
                        <li><?php echo $ability;?></li>
                    <?php endforeach;?>
                    </ul>
                </td>
                <td><?php echo $workerItem['fd'];?></td>
                <td><?php echo $workerItem['id'];?></td>
            </tr>
            <?php endforeach;?>

        </tbody>
    </table>

<?php include 'content_footer.tpl.php';?>
</div>
