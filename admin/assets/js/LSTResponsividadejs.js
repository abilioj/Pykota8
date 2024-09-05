Refet(1, 8000);
var logMsg = "";
var isOK = false;
var caminho = "";
var caminhos = "";
var tipo = parseInt($("#tipo").val());
var op = parseInt($("#op").val());
var nomeControle = "";
var tipoText = "";
var linkTipoText = "";
var urlPADRAO = "";
var linkFinal = "";

$(document).ready(function () {

    if (typeof tipo === "undefined") {
        tipo = 0;
    } else {
        if (tipo > 0) {
            tipoText = "tipo=" + tipo + "&";
        }
    }

    caminho = $("#caminho").val();
    caminhos = $('#caminhos').val();

    //resolução 'real' navegador
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width <= 727) {
        $(".column_hidden").remove();
        if (op === 0) {
            linkTipoText = "?" + tipoText + "op=1";
            window.location.href = linkTipoText;
        }
        $('#dataTablesList').DataTable({
            "responsive": true,
            "language": {
                "url": "" + caminho + "assets/language/datatables/Portuguese-Brasil.json"
            },
            "pagingType": "simple",
            "stateSave": false,
            "processing": true,
            "serverSide": false
        });
        console.log("FONE");
    } else {
        //dataTable list - dataTablesList
        $('#dataTablesList').DataTable({
            "responsive": true,
            "language": {
                "url": "" + caminho + "assets/language/datatables/Portuguese-Brasil.json"
            },
//            "pagingType": "full_numbers",
            "stateSave": false,
            "processing": true,
            "serverSide": false
        });
    }
    nomeControle = $("#nomeControle").val();
    urlPADRAO = caminhos + "controle/cad_" + nomeControle + ".php?acao=";

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
        window.location.href = linkFinal;
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

});
