
var caminho = "";
var caminhos = "";

//geral
caminho = $("#caminho").val();
caminhos = $('#caminhos').val();
    
//Datatables
var table;
var urlLangDataTable = caminho + "assets/language/datatables/Portuguese-Brasil.json";
var targetsDatatables = [];
var domDatatables = "lfrtip";// D - lfrtip || B - Bfrtip
var buttonsDatatables = null;
var selectDatatables = false;

//exemplo buttonsDatatables
/*
     buttonsDatatables = [
        {
            text: 'Imprimir',
            extend: 'print',
            messageTop: 'This print was produced using the Print button for DataTables'
        }
        , {
            text: 'Imprimir tudo',
            extend: 'print',
            exportOptions: {
                modifier: {
                    selected: null
                }
            },
            messageTop: 'This print was produced using the Print button for DataTables'
        }
    ]
 */

var buttonPrint = function () {
    domDatatables = "Bfrtip";
    buttonsDatatables = [
        {
            text: 'Imprimir',
            extend: 'print',
            messageTop: 'This print was produced using the Print button for DataTables'
        }
    ]
};
