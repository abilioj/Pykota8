var nomeControle = $("#nomeControle").val();
var urlPADRAO = "./controle/cad_" + nomeControle + ".php?acao=";

var isOK = false;
var tipoText = "";
var link = "";

function ValidaVariavel(camp) {
    if (typeof camp === "undefined") {
        camp = 0;
        // Não será mostrado
        console.log("tipo é undefined");
    } else {
        if (camp > 0) {
            tipoText = "&tipo=" + camp + "";
        }
        // Será mostrado
        console.log(tipoText);
    }
}

//Pegar dimensões da Pagina
var PickingPageDimensions = function () {
//resolução 'real' navegador
//var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
};

/*
 if (width <= 727) {
 $(".tableNaoFone").remove();
 if (op === 0) {
 link = "?op=1" + tipoText + "";
 window.location.href = link;
 }
 console.log("FONE");
 } else {
 //dataTable list - dataTablesList
 $('#dataTablesList').DataTable({
 "language": {
 "url": "../assets/pluginsLocal/datatables/language/Portuguese-Brasil.json"
 },
 //            "pagingType": "full_numbers",
 //            "responsive": true,
 stateSave: true,
 "processing": true,
 "serverSide": false
 });
 }*/

//click blur mouseover dblclick change
$(document).ready(function () {
    console.log("INDEX");
    Refet(1, null);
    
    var objResolutions = GetResolution();
    if(objResolutions.widthMain <= 480){
        $('#infoCotaHome').hide();
        $('#form-home').hide();
    }
    if(objResolutions.widthMain <= 768){
        $('#infoCotaHome').hide();
        $('#form-home').hide();
    }
});
