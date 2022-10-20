
$(document).ready(function () {
    barChart();
    lineChart();
    areaChart();
    donutChart();

    $(window).resize(function () {
        window.barChart.redraw();
        window.lineChart.redraw();
        window.areaChart.redraw();
        window.donutChart.redraw();
    });

    new Morris.Line({
        element: 'myfirstchart',
        data: [
            {year: '2008', value: 4},
            {year: '2009', value: 10},
            {year: '2010', value: 55},
            {year: '2011', value: 25},
            {year: '2012', value: 20}
        ],
        xkey: 'year',
        ykeys: ['value'],
        labels: ['Valor']
    });

});

function barChart() {
    window.barChart = Morris.Bar({
        element: 'bar-chart',
        data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Grupo A', 'Grupo B'],
        lineColors: ['#1e88e5', '#ff3321'],
        lineWidth: '3px',
        resize: true,
        redraw: true
    });
}

function lineChart() {
    window.lineChart = Morris.Line({
        element: 'line-chart',
        data: [
            {y: '2006', a: 100, b: 90, c: 2, d: 19},
            {y: '2007', a: 75, b: 65, c: 26, d: 60},
            {y: '2008', a: 50, b: 40, c: 21, d: 61},
            {y: '2009', a: 75, b: 65, c: 20, d: 71},
            {y: '2010', a: 50, b: 40, c: 41, d: 11},
            {y: '2011', a: 75, b: 65, c: 10, d: 31},
            {y: '2012', a: 100, b: 90, c: 2, d: 18}
        ],
        xkey: 'y',
        ykeys: ['a', 'b', 'c', 'd'],
        labels: ['Grupo A', 'Grupo B', 'Grupo C', 'Grupo D'],
        lineColors: ['#1e88e5', '#ff3321', '#228B22', '#6959CD'],
        lineWidth: '3px',
        resize: true,
        redraw: true
    });
}

function areaChart() {
    window.areaChart = Morris.Area({
        element: 'area-chart',
        data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
        ],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Grupo A', 'Grupo B'],
        lineColors: ['#1e88e5', '#ff3321'],
        lineWidth: '3px',
        resize: true,
        redraw: true
    });
}

function donutChart() {
    window.donutChart = Morris.Donut({
        element: 'donut-chart',
        data: [
            {label: "Download Sales", value: 50},
            {label: "In-Store Sales", value: 25},
            {label: "Mail-Order Sales", value: 5},
            {label: "Uploaded Sales", value: 10},
            {label: "Uploaded test", value: 70},
            {label: "Video Sales", value: 10}
        ],
        resize: true,
        redraw: true
    });
}

