<html>
<head>
    <!-- <link rel="stylesheet" type="text/css" href="css/style.css" /> -->
    <link rel="shortcut icon" type="image/png" href="images/favicon.png"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <meta>
</head>
<body class="content">
    <nav class="navbar navbar-light navbar-expand-md" style="background-color: #d0dce0;">
        <a class="navbar-brand" href="#"><img src="images/gearman.png" height="30"  class="d-inline-block align-top"> Gearman Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav mr-auto mt-lg-0">
                <li class="nav-item<?php if (basename($_SERVER['PHP_SELF']) == 'queue.php'): ?> active<?php endif;?>">
                    <a class="nav-link" target="_parent" href="queue.php" >Queue <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item<?php if (basename($_SERVER['PHP_SELF']) == 'workers.php'): ?> active<?php endif;?>">
                    <a class="nav-link" target="_parent" href="workers.php" >Workers <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item<?php if (basename($_SERVER['PHP_SELF']) == 'servers.php'): ?> active<?php endif;?>">
                    <a class="nav-link" target="_parent" href="servers.php" >Servers <span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
    <?php if (isset($this->errors) && count($this->errors) > 0): ?>
        <div class="alert alert-danger" role="alert">
            <strong>Errors: </strong>
            <?php foreach ($this->errors as $error): ?>
                <p><?php echo htmlspecialchars($error);?></p>
            <?php endforeach;?>
        </div>
    <?php endif;?>
