Refet(1, 8000);
var tipo = 0;
var op = 0;
var logMsg = "";
var isOK = false;
var caminho = "";
var nomeControle = "";
var tipoText = "";
var linkTipoText = "";
var urlPADRAO = "";
var linkFinal = "";

var functionTable = function () {
        $('#dataTablesList').DataTable({
            "language": {
                "url": "" + caminho + "assets/language/datatables/Portuguese-Brasil.json"
            },
            "pagingType": "full_numbers",
            "stateSave": false,
            "responsive": true,
            "processing": true,
            "serverSide": false
        });
};

$(document).ready(function () {
    console.log("groupList");
    tipo = parseInt($("#tipo").val());
    op = parseInt($("#op").val());

    if (typeof tipo === "undefined") {
        tipo = 0;
        // Não será mostrado
        //console.log("tipo é undefined");
    } 
    else {
        if (tipo > 0) {
            tipoText = "tipo=" + tipo + "&";
        }
    }

    caminho = $("#caminho").val();
    //verificar tipo
//    console.log(tipo);
    // Será mostrado a ulr de tipo
//    console.log(tipoText);

    //resolução 'real' navegador
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    functionTable(width);
    nomeControle = $("#nomeControle").val();
    urlPADRAO = "../controle/cad_" + nomeControle + ".php?acao=";

    //click blur mouseover dblclick change
    $(".Opids").on("click", function () {
        var valorIds = $(this).val();
        $('#valorIds').val(valorIds);
        $('.ModalOpcoes').modal('show');
    });
    $(".Opcoes").on("click", function () {
        //indentifique o elemento clicada
        var self = $(this);
        //procura o valo id pelo elemento indentifique
        var valorIds = self.closest("tr").find(".IDRa").val();
        $('#valorIds').val(valorIds);
        $('.ModalOpcoes').modal('show');
    });
    $("#OpEditar").on("click", function () {
        var valorIds = $('#valorIds').val();
        var acao = "a";
        linkFinal = "" + urlPADRAO + "" + acao + "&id=" + valorIds + "" + tipoText + "";
        window.location.href = linkFinal;
    });
    $("#OpVisualizar").on("click", function () {
        console.log($('.valorIds').val());
        var valorIds = $('#valorIds').val();
        var acao = "v";
        linkFinal = "" + urlPADRAO + "" + acao + "&id=" + valorIds + "" + tipoText + "";
//        window.location.href = linkFinal;
//        window.location.href = "?id=" + valorIds + "";
    });
    $("#OpRemover").on("click", function () {
        var decisao = confirm("Deseja realmente Excluir?");
        if (decisao) {
            var valorIds = $('#valorIds').val();
            var acao = "e";
            linkFinal = "" + urlPADRAO + "" + acao + "&id=" + valorIds + "" + tipoText + "";
            window.location.href = linkFinal;
        } else {
            return false;
        }
    });

    GetResolution();
});

