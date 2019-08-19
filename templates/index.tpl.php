<html>
<head>
    <title>Gearman Monitor</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <!-- <link href="https://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

</head>
<?php if ($this->gearmanClassExists) {
    ?>
    <frameset cols="200,*" rows="*" id="mainFrame">
        <frame frameborder="0" id="filterFrame" name="filterFrame" src="filter.php?action=<?php echo $this->action;?>" />
        <frame frameborder="0" id="contentFrame" name="contentFrame" src="<?php echo $this->action;?>.php?sort=<?php if ($this->action != 'queue') {echo GA_ServerList::SORT_SERVER;} else {echo GA_ServerList::SORT_NAME;}
    ?>" />
        <noframes>
            <body>Frame-capable browser required</body>
        </noframes>
    </frameset>
<?php } else {?>
<body class="content">
    <div class="error">
        Net_Gearman package not found!<br />
        <br />
        You can get it at <a href="http://pear.php.net/package/Net_Gearman/">http://pear.php.net/package/Net_Gearman/</a> or install by pear:<br />
        <br />
        <i>pear install Net_Gearman</i>
    </div>
<?php }
?>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
</body>
</html>