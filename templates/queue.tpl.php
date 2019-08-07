<?php include 'content_header.tpl.php';?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12 col-md-6" id="graph_1_second" style="min-width: 210px; height: 200px; margin: 0 auto">Realtime Graph</div>
        <div class="cols-sm-12 col-md-6 pt-3">

                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center p-1">
                        In Queue
                        <span class="badge badge-warning badge-pill"id="totalInQueueWorkers">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-1">
                        Running
                        <span class="badge badge-success badge-pill"id="totalRunningWorkers">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-1">
                        Last time
                        <span class="badge badge-secondary badge-pill"id="totalInQueueDiff">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-1">
                        Functions
                        <span class="badge badge-light badge-pill"id="totalFunctions">0</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center p-1">
                        Workers registered
                        <span class="badge badge-light badge-pill"id="totalJobs">0</span>
                    </li>
                </ul>
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
    <script src="js/main.js?t=<?php echo time(); ?>"></script>
</div>
<?php include 'content_footer.tpl.php';?>
