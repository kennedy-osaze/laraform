function drawCharts(data_for_chart) {
    if (data_for_chart.length) {
        for (var i = 0; i < data_for_chart.length; i++) {
            chart_data = data_for_chart[i];
            if (chart_data.chart === 'pie_chart') {
                drawPieChart(chart_data);
            } else if (chart_data.chart === 'h_bar_chart') {
                drawBarChart(chart_data);
            } else if (chart_data.chart === 'v_bar_chart') {
                drawColumnChart(chart_data);
            }
        }
    }
}

function drawPieChart(chart_data) {
    var data = google.visualization.arrayToDataTable(chart_data.data);

    var options_pie = {
        fontName: 'Roboto',
        height: 250,
        width: 350,
        chartArea: {
            left: 50,
            width: '90%',
            height: '90%'
        }
    };

    var container_element = $('#' + chart_data.name)[0];
    var pie = new google.visualization.PieChart(container_element);
    pie.draw(data, options_pie);
}

// Draw vertical bar chart
function drawColumnChart(chart_data) {
    var data = google.visualization.arrayToDataTable(chart_data.data);

    var options_column = {
        fontName: 'Roboto',
        height: 400,
        fontSize: 12,
        tooltip: {
            textStyle: {
                fontName: 'Roboto',
                fontSize: 13
            }
        },
        vAxis: {
            gridlines: {
                color: '#e5e5e5',
            },
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    var container_element = $('#' + chart_data.name)[0];
    var column = new google.visualization.ColumnChart(container_element);
    column.draw(data, options_column);
}

// Draw horizontal bar chart
function drawBarChart(chart_data) {
    var data = google.visualization.arrayToDataTable(chart_data.data);

    var options_bar = {
        fontName: 'Roboto',
        height: 400,
        fontSize: 12,
        tooltip: {
            textStyle: {
                fontName: 'Roboto',
                fontSize: 13
            }
        },
        vAxis: {
            gridlines: {
                color: '#e5e5e5',
                count: 10
            },
        },
        legend: {
            position: 'top',
            alignment: 'center',
            textStyle: {
                fontSize: 12
            }
        }
    };

    var container_element = $('#' + chart_data.name)[0];
    var bar = new google.visualization.BarChart(container_element);
    bar.draw(data, options_bar);
}
