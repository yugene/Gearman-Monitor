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
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is
            // longer than 20
            // add the point
            chart.series[0].addPoint(point, true, shift);
            // call it again after one second
            setTimeout(requestChartData, jsGraphTime);
        },
        cache: false
    });
}

function setStorageTotal(totalInQueueWorkers, totalRunningWorkers) {
    var lastTotalRunningWorkers = parseInt(
        sessionStorage.getItem("totalRunningWorkers")
    );
    var lastTotalInQueueWorkers = parseInt(
        sessionStorage.getItem("totalInQueueWorkers")
    );
    var diff = totalRunningWorkers - lastTotalRunningWorkers;
    $("#totalInQueueWorkers").html(totalInQueueWorkers);
    $("#totalInQueueDiff").html(diff);
    $("#totalRunningWorkers").html(totalRunningWorkers);
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
        $("#filterGroupby").val();
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
                if (obj["data"].length > 0) {
                    html = "";
                    for (var i = 0; i < obj["data"].length; i++) {
                        totalInQueueWorkers += parseInt(
                            obj["data"][i]["in_queue"]
                        );
                        totalRunningWorkers += parseInt(
                            obj["data"][i]["jobs_running"]
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
                        html + "</tr>";
                    }
                    setStorageTotal(totalInQueueWorkers, totalRunningWorkers);
                    $("#table > tbody").html(html);
                }
            }
            $("#table > tbody").html(html);
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
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: false
        },
        series: [
            {
                name: "Total",
                data: []
            }
        ]
    });
    setInterval(function() {
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
});
requestTableData("queue.php?json", ".result");
