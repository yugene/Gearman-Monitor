<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="content">

    <div>
        <ul class="topmenu">
            <li><a class="tab" target="_parent" href="index.php?action=queue">Queue</a></li>
            <li><a class="tab" target="_parent" href="index.php?action=workers">Workers</a></li>
            <li><a class="tab" target="_parent" href="index.php?action=servers">Servers</a></li>
        </ul>
    </div>
    <br style="clear:both;" />

    <?php foreach ($this->errors as $error) { ?>
        <br />
        <div class="error"><?php echo htmlspecialchars($error); ?></div>
    <?php } ?>
