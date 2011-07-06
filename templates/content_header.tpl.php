<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="content">

    <div>
        <ul class="topmenu">
            <li><a class="tab<?php if (basename($_SERVER['PHP_SELF']) == 'queue.php') { echo ' tab_active'; } ?>" target="_parent" href="index.php?action=queue">Queue</a></li>
            <li><a class="tab<?php if (basename($_SERVER['PHP_SELF']) == 'workers.php') { echo ' tab_active'; } ?>" target="_parent" href="index.php?action=workers">Workers</a></li>
            <li><a class="tab<?php if (basename($_SERVER['PHP_SELF']) == 'servers.php') { echo ' tab_active'; } ?>" target="_parent" href="index.php?action=servers">Servers</a></li>
        </ul>
    </div>
    <br style="clear:both;" />

    <?php foreach ($this->errors as $error) { ?>
        <br />
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php } ?>
