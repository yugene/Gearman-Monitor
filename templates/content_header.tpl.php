<html>
<head>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <meta>
</head>
<body class="content">

    <div class="container-fluid">
        <ul class="nav nav-tabs">
            <li role="presentation" class="nav-item"><a target="_parent" href="index.php?action=queue" class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'queue.php') {echo ' active';}
?>">Queue</a></li>
            <li role="presentation" class="nav-item"><a target="_parent" href="index.php?action=workers" class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'workers.php') {echo ' active';}
?>">Workers</a></li>
            <li role="presentation" class="nav-item"><a target="_parent" href="index.php?action=servers" class="nav-link<?php if (basename($_SERVER['PHP_SELF']) == 'servers.php') {echo ' active';}
?>">Servers</a></li>
        </ul>
    </div>
    <br style="clear:both;" />

    <?php foreach ($this->errors as $error) {?>
        <br />
        <div class="error"><?php echo htmlspecialchars($error);?></div>
    <?php }
?>
