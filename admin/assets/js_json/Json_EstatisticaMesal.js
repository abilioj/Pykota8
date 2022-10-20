/* Dashboard */
var i = 0;
var msg = 0;
var row = 0;
var idG = 0;
var html = '';
var isOK = false;
var indxf = 0;//index pra dertemina o fim/quantidade de grafico
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var urlDataMain = "../app/WS/JSON_ADMIN_ESTATISTICA.php";
var labels;

//jan fev mar abr mai jun jul ago set out nov dez

//
var ajaxBuscarDados = function () {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: urlDataMain,
        data: {ano: 2022},
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
            $.each(data.data, function (key,value) {
                $('#jan').text(value.jan);
                $('#fev').text(value.fev);
                $('#mar').text(value.mar);
                $('#abr').text(value.abr);
                $('#mai').text(value.mai);
                $('#jun').text(value.jun);
                $('#jul').text(value.jul);
                $('#ago').text(value.ago);
                $('#set').text(value.set);
                $('#out').text(value.out);
                $('#nov').text(value.nov);
                $('#dez').text(value.dez);
            });
        }
    });
};

var main = function () {

    ajaxBuscarDados();
    
};

$(document).ready(function () {

    main();
    var $btnPesquisar = $("#btn-pesquisar");
    var $btnTodos = $("#btn-todos");

    $btnPesquisar.on("click", function () {
    });

    $btnTodos.on("click", function () {
        location.reload();
    });


});
