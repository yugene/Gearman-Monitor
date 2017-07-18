<html>
<head>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta>
</head>
<body class="content">

    <div>
        <ul class="nav nav-tabs">
            <li role="presentation" class="<?php if (basename($_SERVER['PHP_SELF']) == 'queue.php') {echo ' active';}
?>"><a target="_parent" href="index.php?action=queue">Queue</a></li>
            <li role="presentation" class="<?php if (basename($_SERVER['PHP_SELF']) == 'workers.php') {echo ' active';}
?>"><a target="_parent" href="index.php?action=workers">Workers</a></li>
            <li role="presentation" class="<?php if (basename($_SERVER['PHP_SELF']) == 'servers.php') {echo ' active';}
?>"><a target="_parent" href="index.php?action=servers">Servers</a></li>
        </ul>
    </div>
    <br style="clear:both;" />

    <?php foreach ($this->errors as $error) {?>
        <br />
        <div class="error"><?php echo htmlspecialchars($error);?></div>
    <?php }
?>
