function Gerar_DADOS_GRAFiCO(gaugeOptions, ID, DATA) {
    $('#' + ID + '').highcharts(Highcharts.merge(gaugeOptions, {
        yAxis: {
            min: 0,
            max: 200,
            title: {
                text: ''
            }
        },
        series: [{
                name: 'Índices',
                data: [DATA],
                dataLabels: {
                    format: '<div style="text-align:center">' +
                            '<span style="font-size:25px;color:' +
                            ((Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black') +
                            '">{y:.1f}</span><br/>' +
                            '<span style="font-size:12px;color:silver">' +
                            '</span>' +
                            '</div>'
                },
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

    }));
}


var gaugeOptions = {
        chart: {
            type: 'solidgauge'
        },
        title: null,
        pane: {
            center: ['50%', '85%'],
            size: '140%',
            startAngle: -90,
            endAngle: 90,
            background: {
                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || '#EEE',
                innerRadius: '60%',
                outerRadius: '100%',
                shape: 'arc'
            }
        },
        tooltip: {
            enabled: false
        },
        // the value axis
        yAxis: {
            stops: [
                [0.1, '#55BF3B'], // green
                [0.5, '#DDDF0D'], // yellow
                [0.9, '#DF5353'] // red
            ],
            lineWidth: 0,
            minorTickInterval: null,
            tickPixelInterval: 400,
            tickWidth: 0,
            title: {
                y: -70
            },
            labels: {
                y: 16
            }
        },
        plotOptions: {
            solidgauge: {
                dataLabels: {
                    y: 5,
                    borderWidth: 0,
                    useHTML: true
                }
            }
        }
    };

