var chart;
var jsGraphTime = 2000;
var jsTableTime = 5000;

if (document.getElementById("tableTime")) {
    jsTableTime = parseInt(document.getElementById("tableTime").value);
}
if (document.getElementById("graphTime")) {
    jsGraphTime = parseInt(document.getElementById("graphTime").value);
}

function requestChartData() {
    $.ajax({
        url: "live-data.php",
        success: function(point) {
            if(chart.series){
                var series = chart.series[0];
                var shift = series.data.length > 20; // shift if the series is
                // longer than 20
                // add the point
                chart.series[0].addPoint(point, true, shift);
            }
            // call it again after one second
            setTimeout(requestChartData, jsGraphTime);

        },
        cache: false
    });
}

function setStorageTotal(totalInQueueWorkers, totalRunningWorkers, totalJobs, totalFunctions, totalProblem) {
    var lastTotalRunningWorkers = parseInt(
        sessionStorage.getItem("totalInQueueWorkers")
    );
    var lastTotalInQueueWorkers = parseInt(
        sessionStorage.getItem("totalInQueueWorkers")
    );
    var diff = lastTotalRunningWorkers - totalInQueueWorkers;
    $("#totalInQueueWorkers").html(totalInQueueWorkers);
    $("#totalInQueueDiff").html(diff);
    $("#totalRunningWorkers").html(totalRunningWorkers);
    $("#totalJobs").html(totalJobs);
    $("#totalFunctions").html(totalFunctions);
    $("#totalProblem").html(totalProblem);
    if (totalInQueueWorkers) {
        sessionStorage.setItem("totalInQueueWorkers", totalInQueueWorkers);
    }
    if (totalRunningWorkers) {
        sessionStorage.setItem("totalRunningWorkers", totalRunningWorkers);
    }
}

function requestTableData(url, element) {
    url +=
        "&sort=" +
        $("#filterSort").val() +
        "&dir=" +
        $("#filterDir").val() +
        "&groupby=" +
        $("#filterGroupby").val()
        +'&filterName=' + $("#filterName").val();
    $('#filterServers option').each(function (i) {
        if (this.selected == true) {
            url += '&filterServers[]='+(this.value);
        }
    });
    $.ajax({
        method: "GET",
        url: url,
        success: function(info) {
            try {
                var obj = info;
            } catch (e) {
                var html = '<tr><td colspan="5">No jobs in queue</td></tr>';
                $("#table > tbody").html(html);
                return false;
            }
            var html = '<tr><td colspan="5">No jobs in queue</td></tr>';
            if (obj["data"]) {
                var totalInQueueWorkers = 0;
                var totalRunningWorkers = 0;
                var totalJobs = 0;
                var totalFunctions = 0;
                var totalProblem = 0;
                if (obj["data"].length > 0) {
                    html = "";
                    for (var i = 0; i < obj["data"].length; i++) {
                        totalFunctions++;
                        if (obj["data"][i]["capable_workers"] == 0 &&
                            obj["data"][i]["in_queue"] > 0) {
                            totalProblem++;
                        }
                        totalInQueueWorkers += parseInt(
                            obj["data"][i]["in_queue"]
                        );
                        totalRunningWorkers += parseInt(
                            obj["data"][i]["jobs_running"]
                        );
                        totalJobs += parseInt(
                            obj["data"][i]["capable_workers"]
                        );

                        html +=
                            '<tr id="' +
                            obj["data"][i]["id_key"] +
                            'w"' +
                            (obj["data"][i]["capable_workers"] == 0 &&
                            obj["data"][i]["in_queue"] > 0
                                ? 'class="table-warning"'
                                : "") +
                            ">";
                        html +=
                            "<td><small>" +
                            obj["data"][i]["server"] +
                            "</small></td>";
                        html +=
                            "<td><small>" +
                            obj["data"][i]["name"] +
                            "</small></td>";
                        html +=
                            '<td id = "' +
                            obj["data"][i]["id_key"] +
                            'in_queue">' +
                            obj["data"][i]["in_queue"] +
                            "</td>";
                        html +=
                            '<td id = "' +
                            obj["data"][i]["id_key"] +
                            'jobs_running">' +
                            obj["data"][i]["jobs_running"] +
                            "</td>";
                        html +=
                            '<td id = "' +
                            obj["data"][i]["id_key"] +
                            'capable_workers">';
                        html +=
                            obj["data"][i]["capable_workers"] == 0 &&
                            obj["data"][i]["in_queue"] > 0
                                ? '<img src="images/s_warn.png" />'
                                : "";
                        html += obj["data"][i]["capable_workers"] + "</td>";
                        html += '<td>' + (obj["data"][i]["jobs_running"] > 0 ? '<span class="badge badge-success">running</span>' : (obj["data"][i]["capable_workers"] > 0 ? '<span class="badge badge-secondary">iddle</span>' :'<span class="badge badge-secondary">not registred</span>')) +'</td>';
                        html + "</tr>";
                    }
                    setStorageTotal(totalInQueueWorkers, totalRunningWorkers, totalJobs, totalFunctions, totalProblem);
                    $("#table > tbody").html(html);
                }
            }
            $("#table > tbody").html(html);
            $('#search >button').html('Search').attr('disabled',false);
        }
    });
}
$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: "graph_1_second",
            defaultSeriesType: "spline",
            events: {
                load: requestChartData
            }
        },
        title: {
            text: "",
            style: {
                display: "none"
            }
        },
        xAxis: {
            type: "datetime",
            tickPixelInterval: 150,
            maxZoom: 20 * 1000,
            title: false
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: false
        },
        series: [
            {
                name: "Total",
                data: [],
                showInLegend:false
            }
        ],
        credits:{enabled:false}
    });
    setInterval(function () {
        requestTableData("queue.php?json", ".result");
    }, jsTableTime);
    $(".sortTable").click(function() {
        $(".sortTable")
            .removeClass("up")
            .removeClass("down");
        $(this).data("sort", $(this).data("sort") == "asc" ? "desc" : "asc")
        $(this).addClass($(this).data("sort") === "asc" ? "up" : "down");
        $("#filterDir").addClass(
            $(this).data("sort") === "asc" ? "up" : "down"
        );
        $("#filterSort").val($(this).data("id"));
        $("#filterDir").val($(this).data("sort"));
        $("#filterGroupby").val($(this).data("group"));
        console.log($("#filterSort").val());
        console.log($("#filterDir").val());
        requestTableData("queue.php?json", ".result");
    });
    $('#search').submit(function(e){
        e.preventDefault();
        $('#search > button').html('Searching...').attr('disabled', true);
        requestTableData("queue.php?json", ".result");
        return false;
    });
});
requestTableData("queue.php?json", ".result");
