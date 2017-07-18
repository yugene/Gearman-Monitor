<?php include 'content_header.tpl.php';?>
<h2>Queue</h2>
<form>
    Group by:<br>

    <label class="radio-inline"><?php $this->fnGroupRadio($this->pageUri, 'None', GA_ServerList::GROUP_NONE);?></label>
    <label class="radio-inline"><?php $this->fnGroupRadio($this->pageUri, 'Server', GA_ServerList::GROUP_SERVER);?></label>
    <label class="radio-inline"><?php $this->fnGroupRadio($this->pageUri, 'Function', GA_ServerList::GROUP_NAME);?></label>
    </ul>
</form>
<div class="result">
    <?php include 'queue_table.tpl.php';?>
</div>
<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">Realtime Graph</div>

<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="js/main.js"></script>

<?php include 'content_footer.tpl.php';?>
