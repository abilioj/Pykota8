
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

function Gerar_DADOS_GRAFiCO_Highcharts(gaugeOptions, ID, DATA) {
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

function Gerar_DADOS_GRAFiCO_Chart(ID, label, labels, data) {
    var ctx = document.getElementById(ID).getContext('2d');
    var chart = new Chart(ctx, {
        animation: {
            duration: 0 // general animation time
        },
        hover: {
            animationDuration: 0 // duration of animations when hovering an item
        },
        responsiveAnimationDuration: 0,// animation duration after a resize
        //Chart.js types:line,bar,radar,pie,doughnut,polarArea,bubble
        // O tipo de gráfico que queremos criar
        type: 'line',
        // Os dados para o nosso conjunto de dados
        data: {
            labels: labels,
            datasets: [{
                    label: label,
                    backgroundColor: 'rgb(100,149,237)',
                    borderColor: 'rgb(0, 0, 255)',
                    borderWidth: 1,
                    data: data
                }]
        },
        // As opções de configuração estão aqui
        options: {
            scales: {
                yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
            },
            //title: {display: true, text: 'Grupo ' + label},
            legend: {
                display: true,
                labels: {
                    fontSize: 14,
                    fontColor: 'rgb(255, 99, 132)'
                }
            }
        }
    });
}
