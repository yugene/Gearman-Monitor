<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

</head>
<body class="left">

    <div class="logo">
        <a href="https://github.com/yugene/Gearman-Monitor" target="_blank">
        <img src="images/gearman.png" /><br />
        Gearman Monitor
        </a>
    </div>

    <form id="filterForm" action="<?php echo $this->action;?>.php" target="contentFrame">
        <input type="hidden" name="sort" id="filterSort" value="name" />
        <input type="hidden" name="dir" id="filterDir" value="asc" />
        <input type="hidden" name="groupby" id="filterGroupby" value="none" />

        <?php if (count($this->servers) > 1): ?>
            <div class="form-group">
                <label for="filterServers">Servers:</label>
                <select class="form-control form-control-sm" multiple name="filterServers[]" id="filterServers">
                    <?php foreach ($this->servers as $serverIndex => $server): ?>
                        <option value="<?php echo $serverIndex;?>"><?php echo htmlspecialchars($server['name']);?></option>
                    <?php endforeach;?>
                </select>
            </div>
        <?php else: ?>
            <?php foreach ($this->servers as $serverIndex => $server): ?>
                <input type="hidden" name="flt_servers" value="<?php echo $serverIndex;?>" />
            <?php endforeach;?>
        <?php endif;?>
        <div class="form-group">
            <label for="filterName">Name filter:</label>
            <input class="form-control form-control-sm" name="filterName" id="filterName" type="text" /><br />
        </div>
        <input class="btn btn-light btn-block btn-sm" name="submit" type="submit" value="Apply" />

    </form>

</body>
</html>