$(document).ready(function () {
    $('#sMelhor').highcharts({
        chart: {
            type: 'column'
        },
        xAxis: {
            categories: ['Serviços 1', 'Serviços 2', 'Serviços 3', 'Serviços 4', 'Serviços 5', 'Serviços 6', 'Serviços 7', 'Serviços 8', 'Serviços 9', 'Serviços 10']
        },
        plotOptions: {
            series: {
                allowPointSelect: true
            }
        },
        series: [{
                data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1]
            }]
    });
 
    $('#tResposta').highcharts({
        title: {
            text: ''
        },
//                    subtitle: {
//                        text: ''
//                    },
        xAxis: {
            categories: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Otu', 'Nov', 'Dez']
        },
        series: [{
                data: [29.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4],
                zoneAxis: 'x',
                zones: [{
                        value: 8
                    }
//                        , {
//                            dashStyle: 'dot'
//                        }
                ]
            }]
    });

    // Create the chart
    $('#satisfacao').highcharts({
        chart: {
            type: 'column'
        },
//                    title: {
//                        text: 'Browser market shares. January, 2015 to May, 2015'
//                    },
//                    subtitle: {
//                        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
//                    },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Índice'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> do total<br/>'
        },
        series: [{
                name: 'Satisfação',
                colorByPoint: true,
                data: [
                    {name: 'Janeiro', y: 97.33, drilldown: 'Janeiro'},
                    {name: 'Fevereiro', y: 80, drilldown: 'Fevereiro'},
                    {name: 'Março', y: 81, drilldown: 'Março'},
                    {name: 'Abril', y: 73, drilldown: 'Abril'},
                    {name: 'Maio', y: 98, drilldown: 'Maio'},
                    {name: 'Junho', y: 99.8, drilldown: 'Junho'},
                    {name: 'Julho', y: 81.8, drilldown: 'Julho'},
                    {name: 'Agosto', y: 69.8, drilldown: 'Agosto'},
                    {name: 'Setembro', y: 59.8, drilldown: 'Setembro'},
                    {name: 'Outubro', y: 79.8, drilldown: 'Outubro'},
                    {name: 'Novembro', y: 59.8, drilldown: 'Novembro'},
                    {name: 'Dezembro', y: 44.8, drilldown: 'Dezembro'}]}],
        drilldown: {
            series: [{
                    name: 'Janeiro',
                    id: 'Janeiro',
                    data: [['Serviço 1', 24.13], ['Serviço 2', 17.2], ['Serviço 3', 8.11], ['Serviço 4', 5.33], ['Serviço 5', 8.06], ['Serviço 6', 12.5], ['Serviço 7', 7.5], ['Serviço 8', 5.5], ['Serviço 9', 3.5], ['Serviço 10', 5.5]]},
                {
                    name: 'Fevereiro',
                    id: 'Fevereiro',
                    data: [['Serviço 1', 12.6], ['Serviço 2', 7.5], ['Serviço 3', 9.3], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 6.3], ['Serviço 7', 12], ['Serviço 8', 6.9], ['Serviço 9', 14.5], ['Serviço 10', 0.4]]},
                {
                    name: 'Março',
                    id: 'Março',
                    data: [['Serviço 1', 8.7], ['Serviço 2', 6.5], ['Serviço 3', 5.2], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 12.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 14.5], ['Serviço 10', 10.4]]},
                {
                    name: 'Abril',
                    id: 'Abril',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 6.5], ['Serviço 3', 14.2], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Maio',
                    id: 'Maio',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Junho',
                    id: 'Junho',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Julho',
                    id: 'Julho',
                    data: [['Serviço 1', 3.7], ['Serviço 2', 1.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Agosto',
                    id: 'Agosto',
                    data: [['Serviço 1', 2.7], ['Serviço 2', 11.5], ['Serviço 3', 4.2], ['Serviço 4', 5.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Setembro',
                    id: 'Setembro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 11.5], ['Serviço 3', 1.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 3.3], ['Serviço 7', 4.9], ['Serviço 8', 4.0], ['Serviço 9', 4.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Outubro',
                    id: 'Outubro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Novembro',
                    id: 'Novembro',
                    data: [['Serviço 1', 2.7], ['Serviço 2', 1.5], ['Serviço 3', 4.2], ['Serviço 4', 5.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Dezembro',
                    id: 'Dezembro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 1.5], ['Serviço 3', 1.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 3.3], ['Serviço 7', 1.9], ['Serviço 8', 1.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]}
            ]
        }
    });

    // Create the chart
    $('#qtAtendimento').highcharts({
        chart: {
            type: 'pie'
        },
//                    title: {
//                        text: 'Browser market shares. January, 2015 to May, 2015'
//                    },
//                    subtitle: {
//                        text: 'Click the columns to view versions. Source: <a href="http://netmarketshare.com">netmarketshare.com</a>.'
//                    },
        xAxis: {
            type: 'category'
        },
        yAxis: {
            title: {
                text: 'Índice'
            }

        },
        legend: {
            enabled: true
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.y:.1f}%'
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> do total<br/>'
        },
        series: [{
                name: 'Serviço',
                colorByPoint: true,
                data: [
                    {name: 'Serviço 1', y: 97.33, drilldown: 'Serviço 1'},
                    {name: 'Serviço 2', y: 80, drilldown: 'Serviço 2'},
                    {name: 'Serviço 3', y: 81, drilldown: 'Serviço 3'},
                    {name: 'Serviço 4', y: 73, drilldown: 'Serviço 4'},
                    {name: 'Serviço 5', y: 98, drilldown: 'Serviço 5'},
                    {name: 'Serviço 6', y: 99.8, drilldown: 'Serviço 6'},
                    {name: 'Serviço 7', y: 81.8, drilldown: 'Serviço 7'},
                    {name: 'Serviço 8', y: 69.8, drilldown: 'Serviço 8'},
                    {name: 'Serviço 9', y: 59.8, drilldown: 'Serviço 9'},
                    {name: 'Serviço 10', y: 59.8, drilldown: 'Serviço 10'}]}],
        drilldown: {
            series: [{
                    name: 'Serviço 1',
                    id: 'Serviço 1',
                    data: [['Serviço 1', 24.13], ['Serviço 2', 17.2], ['Serviço 3', 8.11], ['Serviço 4', 5.33], ['Serviço 5', 8.06], ['Serviço 6', 12.5], ['Serviço 7', 7.5], ['Serviço 8', 5.5], ['Serviço 9', 3.5], ['Serviço 10', 5.5]]},
                {
                    name: 'Fevereiro',
                    id: 'Fevereiro',
                    data: [['Serviço 1', 12.6], ['Serviço 2', 7.5], ['Serviço 3', 9.3], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 6.3], ['Serviço 7', 12], ['Serviço 8', 6.9], ['Serviço 9', 14.5], ['Serviço 10', 0.4]]},
                {
                    name: 'Março',
                    id: 'Março',
                    data: [['Serviço 1', 8.7], ['Serviço 2', 6.5], ['Serviço 3', 5.2], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 12.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 14.5], ['Serviço 10', 10.4]]},
                {
                    name: 'Abril',
                    id: 'Abril',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 6.5], ['Serviço 3', 14.2], ['Serviço 4', 7.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Maio',
                    id: 'Maio',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Junho',
                    id: 'Junho',
                    data: [['Serviço 1', 12.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Julho',
                    id: 'Julho',
                    data: [['Serviço 1', 3.7], ['Serviço 2', 1.5], ['Serviço 3', 14.2], ['Serviço 4', 15.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Agosto',
                    id: 'Agosto',
                    data: [['Serviço 1', 2.7], ['Serviço 2', 11.5], ['Serviço 3', 4.2], ['Serviço 4', 5.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Setembro',
                    id: 'Setembro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 11.5], ['Serviço 3', 1.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 3.3], ['Serviço 7', 4.9], ['Serviço 8', 4.0], ['Serviço 9', 4.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Outubro',
                    id: 'Outubro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 11.5], ['Serviço 3', 14.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Novembro',
                    id: 'Novembro',
                    data: [['Serviço 1', 2.7], ['Serviço 2', 1.5], ['Serviço 3', 4.2], ['Serviço 4', 5.2], ['Serviço 5', 3.3], ['Serviço 6', 8.3], ['Serviço 7', 6.9], ['Serviço 8', 6.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]},
                {
                    name: 'Dezembro',
                    id: 'Dezembro',
                    data: [['Serviço 1', 1.7], ['Serviço 2', 1.5], ['Serviço 3', 1.2], ['Serviço 4', 1.2], ['Serviço 5', 3.3], ['Serviço 6', 3.3], ['Serviço 7', 1.9], ['Serviço 8', 1.0], ['Serviço 9', 5.5], ['Serviço 10', 2.4]]}
            ]
        }
    });
});