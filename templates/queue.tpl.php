<?php include 'content_header.tpl.php';?>
<div class="container-fluid">
    <h2>Queue</h2>
    <form>
        <div class="form-group row">
            <label for="staticEmail" class="col-sm-1 col-form-label">Group By: </label>
            <div class="col-sm-10">
                <div class="form-check form-check-inline"><?php $this->fnGroupRadio($this->pageUri, 'None', GA_ServerList::GROUP_NONE);?></div>
                <div class="form-check form-check-inline"><?php $this->fnGroupRadio($this->pageUri, 'Server', GA_ServerList::GROUP_SERVER);?></div>
                <div class="form-check form-check-inline"><?php $this->fnGroupRadio($this->pageUri, 'Function', GA_ServerList::GROUP_NAME);?></div>
            </div>
        </div>
    </form>
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">Realtime Graph</div>
    <div class="result">
        <?php include 'queue_table.tpl.php';?>
    </div>


    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="js/main.js?t=<?php echo time();?>"></script>

    <?php include 'content_footer.tpl.php';?>
</div>