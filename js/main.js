var chart;

function requestChartData() {
    $.ajax({
        url: 'live-data.php',
        success: function(point) {
            var series = chart.series[0],
                shift = series.data.length > 20; // shift if the series is
            // longer than 20
            // add the point
            chart.series[0].addPoint(point, true, shift);
            // call it again after one second
            setTimeout(requestChartData, 1000);
        },
        cache: false
    });
}

function requestTableData(url, element) {
    $.ajax({
        method: 'GET',
        url: url,
        success: function(info) {
            var obj = jQuery.parseJSON(info);
            if (obj['data']) {
                for (var i = obj['data'].length - 1; i >= 0; i--) {
                    $('#' + obj['data'][i]['id_key'] + 'in_queue').html(obj['data'][i]['in_queue']);
                    $('#' + obj['data'][i]['id_key'] + 'jobs_running').html(obj['data'][i]['jobs_running']);
                    $('#' + obj['data'][i]['id_key'] + 'capable_workers').html(obj['data'][i]['capable_workers']);
                }
            }
        }
    });
}
$(document).ready(function() {
    chart = new Highcharts.Chart({
        chart: {
            renderTo: 'container',
            defaultSeriesType: 'spline',
            events: {
                load: requestChartData
            }
        },
        title: {
            text: 'Jobs in Queue'
        },
        xAxis: {
            type: 'datetime',
            tickPixelInterval: 150,
            maxZoom: 20 * 1000
        },
        yAxis: {
            minPadding: 0.2,
            maxPadding: 0.2,
            title: {
                text: 'Total',
                margin: 80
            }
        },
        series: [{
            name: 'Total',
            data: []
        }]
    });
    setInterval(function() {
        requestTableData('queue.php?json', '.result');
    }, 2000);
});