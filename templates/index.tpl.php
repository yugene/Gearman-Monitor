<html>
<head>
    <title>Gearman Monitor</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<?php if ($this->gearmanClassExists) { ?>
    <frameset cols="250,*" rows="*" id="mainFrame">
        <frame frameborder="0" id="filterFrame" name="filterFrame" src="filter.php" />
        <frame frameborder="0" id="contentFrame" name="contentFrame" src="content.php?sort=<?php echo GA_ServerList::SORT_NAME; ?>" />
        <noframes>
            <body>Frame-capable browser required</body>
        </noframes>
    </frameset>
<?php } else { ?>
<body class="content">
    <div class="error">
        Net_Gearman package not found!<br />
        <br />
        You can get it at <a href="http://pear.php.net/package/Net_Gearman/">http://pear.php.net/package/Net_Gearman/</a> or install by pear:<br />
        <br />
        <i>pear install Net_Gearman</i>
    </div>
<?php } ?>
</body>
</html>