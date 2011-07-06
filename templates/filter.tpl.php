<html>
<head>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body class="left">

    <div class="logo">
        <a href="https://github.com/yugene/Gearman-Monitor" target="_blank">
        <img src="images/gearman.png" /><br />
        Gearman Monitor
        </a>
    </div>

    <form id="filterForm" action="<?php echo $this->action; ?>.php" target="contentFrame">
        <input type="hidden" name="sort" id="filterSort" value="name" />
        <input type="hidden" name="dir" id="filterDir" value="asc" />

        <?php if (count($this->servers) > 1) { ?>
        Servers:<br />
        <select multiple name="filterServers[]" id="filterServers">
            <?php foreach ($this->servers as $serverIndex => $server) { ?>
                <option value="<?php echo $serverIndex; ?>"><?php echo htmlspecialchars($server['name']); ?></option>
            <?php } ?>
        </select>
        <?php } else { ?>
            <?php foreach ($this->servers as $serverIndex =>  $server) { ?>
                <input type="hidden" name="flt_servers" value="<?php echo $serverIndex; ?>" />
            <?php } ?>
        <?php } ?>

        <br />
        Name filter:<br />
        <input name="filterName" id="filterName" type="text" /><br />

        <br />
        <input name="submit" type="submit" value="Apply" />

    </form>

</body>
</html>