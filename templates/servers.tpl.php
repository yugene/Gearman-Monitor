<?php include 'content_header.tpl.php';?>
<div class="container-fluid pt-3">
    <h2>Servers</h2>
    <table class="table table-sm table-striped table-bordered table-responsive small">
        <thead>
            <tr>
                <th>Server</th>
                <th>Address</th>
                <th>Version</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->versionData as $serverIndex => $serverData): ?>
            <tr>
                <td><?php echo htmlspecialchars($this->servers[$serverIndex]['name']);?></td>
                <td><?php echo $serverData['address'];?></td>
                <td><?php echo $serverData['version'];?></td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>
<?php include 'content_footer.tpl.php';?>

