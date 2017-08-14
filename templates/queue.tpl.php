<?php include 'content_header.tpl.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-10" id="graph_1_second" style="min-width: 310px; height: 400px; margin: 0 auto">Realtime Graph</div>
        <div class="cols-sm-12 col-md-2">
            <div class="row text-center">
                <div class="badge badge-warning">In Queue: <span id="totalInQueueWorkers">0</span></div>
                <div class="badge badge-info">Running: <span id="totalRunningWorkers">0</span></div>
                <div class="badge badge-dark">Last time: <span id="totalInQueueDiff">0</span></div>
            </div>

            <p class="pt-3">
                <button class="btn btn-secondary btn-sm btn-block" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                    Filter
                </button>
            </p>
            <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <?php include 'search.tpl.php';?>
                </div>
            </div>
        </div>
    </div>
    <div class="result">
        <?php include 'queue_table.tpl.php';?>
    </div>

    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="js/main.js?t=<?php echo time();?>"></script>
</div>
<?php include 'content_footer.tpl.php';?>
