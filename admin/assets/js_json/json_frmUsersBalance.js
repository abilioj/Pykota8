var url = "app/WS/JSON_ADMIN_VICULAR_USERSGROUPPRINTS.php";
var urlLangDataTable = "../assets/language/datatables/Portuguese-Brasil.json";
var targets = [0, 1];
var idU;

function formatTable (data) {
    $('#dataTablesListIMP').DataTable({
        data: data
        , "pagingType": "full"
        , "responsive": true
        , "columnDefs": [
            {
                "targets": targets
                , "visible": false
            }
        ]
        , "language": {
            "url": urlLangDataTable
        },
//        "paging": false,
        "ordering": false,
        "info": true
    });
}

function jsonTab(json) {
    var data = [];
    if (json.data != null) {
        data = json.data;
    }
    table = $('#dataTablesListIMP').DataTable();
    table.destroy();
    table = formatTable(data);
}

var constionTable = function (json) {
    var data = [];
    if (json.printers != []) {
        data = json.printers;
    }
    table = $('#dataTablesListIMP').DataTable();
    table.destroy();
    table = formatTable(data);
};

function BuscarDados(idU) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: url,
        data: {idU: idU},
        //contentType: 'application/json; charset=utf-8',
        //async: false,            
        error: function () {
            $('.msg').html('button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            jsonTab(data);
        }
    });
}

var Ajax_Controle_Data = function (acao, idU, idP, idUQ) {
    $.ajax({
        type: "POST",
        url: url,
        data: {acao: acao, idU: idU, idP: idP, idUQ: idUQ},
        dataType: "json",
        beforeSend: function () {
            $(".msg").html('');
        },
        error: function () {
            msg = 1;
            $('.msg').html('');
        },
        success: function (json) { 
            location.reload();
        }
    });
};

var Main = function () {
    var caminhos = $('#caminhos').val();
    url = caminhos + url;
};

$(document).ready(function () {
    Main();

    idU = $("#id").val();
    BuscarDados(idU);

    $(".sel").select2({
        placeholder: 'Selecione o item',
        allowClear: true
    });

    $("#btn-Add").click(function () {
        var idP = $("#printer").val();
        if (idU > 0) {
            Ajax_Controle_Data(1, idU, idP, 0);
        }
    });
    
    $("#btn-Add-All").click(function(){
        Ajax_Controle_Data(3,idU,0,0);
    });

    $('#dataTablesListIMP tbody').on('click', 'tr', function () {
        var data = table.row(this).data();
        var pkuser = data[0];
        var pkprinter = data[1];
        console.log("idU: " + pkuser + " - idP" + pkprinter);
        if (idU > 0 && pkuser > 0) {
            var decisao = confirm("Deseja Realmente Excluir a " + data[2]);
            if (decisao) {
                Ajax_Controle_Data(2, idU, pkprinter, pkuser);
            } else {
                console.log("n");
            }
        }
        BuscarDados(idU);
    });

    Refet(1, 3000);
});