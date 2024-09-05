/* Dashboard */
var i = 0;
var msg = 0;
var row = 0;
var op = 0;
var opEstat = 0;
var idG = 0;
var html = '';
var isOK = false;
var indxf = 0;//index pra dertemina o fim/quantidade de grafico
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlDataMain = "../app/WS/JSON_ADMIN_GRAFICOS.php";
var labels;

function MontarDadosGrafico(data, ano) {
    i = 0;
    row = 0;
    $('#g').html('');
    labels = data.graficoLabesNome;
    var array, nome;
    row = data.info.row;
    if (row > 0) {
        while (i <= row) {
            html += '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 grom"> <canvas class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="myChart' + i + '" ></canvas> </div>';
            i++;
        }
        $('#g').html(html);
        array = data.grafico;
        Gerar_DADOS_GRAFiCO_Chart('myChart' + 0, 'Impressora' + " Em " + ano, labels, array);
    }
}

function MontarDadosGraficoI(data, ano) {
    row = 0;
    $('#g').html('');
    labelsnome = data.graficoLabesNome;
    labels = data.graficoLabesTitle;
    console.log(labels);
    var array;
    row = data.info.row;
    if (row > 0) {
        while (i <= row) {
            html += '<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4"> <canvas class="" id="myChart' + i + '" ></canvas> </div>';
            i++;
        }
        $('#g').html(html);
        var ii = 0;
        $.each(data.grafico, function (key, value) {
            array = [value[0], value[1], value[2], value[3], value[4], value[5], value[6], value[7], value[8], value[9], value[10], value[11]];
            Gerar_DADOS_GRAFiCO_Chart('myChart' + key, 'Impressora ' + labelsnome[ii] + " Em " + ano, labels, array);
            ii++;
        });
    }
}

// ajaxBuscarDados Ok
var AJAXMontaGrafico = function (ano, opEstat, indxf) {
    $('#g').empty();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {op: 1, opEstat: opEstat, ano: ano, indxf: indxf},
        beforeSend: function () {
            msg = 1;
            $(".msg").html('<div class="alert alert-info alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Informação!</strong> Carregando...</div></div>');
            Refet(msg, 6000);
        },
        error: function () {
            msg = 1;
            $('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            switch (opEstat) {
                case 0:
                    MontarDadosGrafico(data, ano);
                    break;
                case 1:
                    MontarDadosGraficoI(data,ano);
                    break;
                default:
                    break;
            }
            console.log(row);
        }
    });
};

var main = function () {
    indxf = 0;
    var ano = 2019;
    //AJAXMontaGrafico(ano, 0, indxf);
};

$(document).ready(function () {

    main();
    opEstat = $('#opEstat').val();
    var $btnPesquisar = $("#btn-pesquisar");
    var $btnTodos = $("#btn-todos");

    $btnPesquisar.on("click", function () {
        var opEstat = parseInt($("#opEstat").val());
        var ano = parseInt($("#ano").val());
        AJAXMontaGrafico(ano, opEstat, indxf);
    });

    $btnTodos.on("click", function () {
        location.reload();
    });
    
});
