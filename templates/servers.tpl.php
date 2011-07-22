<?php include('content_header.tpl.php'); ?>

    <h2>Gearman servers</h2>

    <table>
        <thead>
            <tr>
                <th>Server</th>
                <th>Address</th>
                <th>Version</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 0; foreach ($this->versionData as $serverIndex => $serverData) { ?>
            <tr class="<?php echo ($i % 2 ? "even" : "odd"); ?>">
                <td><?php echo htmlspecialchars($this->servers[$serverIndex]['name']); ?></td>
                <td class="ra"><?php echo $serverData['address']; ?></td>
                <td class="ra"><?php echo $serverData['version']; ?></td>
            </tr>
            <?php $i ++; } ?>
        </tbody>
    </table>

<?php include('content_footer.tpl.php'); ?>
