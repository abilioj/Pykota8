//  "cep": "75064-030",
//  "logradouro": "Rua Ouro Branco",
//  "complemento": "",
//  "bairro": "Vila Jaiara",
//  "localidade": "Anápolis",
//  "uf": "GO",
//  "unidade": "",
//  "ibge": "5201108",
//  "gia": ""
function jsonEnd1(json) {
    $.each(json.Endereco, function (key, value) {
        $("#cep").val(value.cep);
        $("#logradouro").val(value.logradouro);
        $("#bairro").val(value.bairro);
        $("#cidade").val(value.localidade);
        $("#uf").val(value.uf);
    });

}
/*
function enableCamposEND1() {
//        $("#cep").prop("readonly", false);
    $("#tplogradouro").prop("readonly", false);
    $("#logradouro").prop("readonly", false);
    $("#bairro").prop("readonly", false);
    $("#cidade").prop("readonly", false);
    $("#uf").prop("readonly", false);
}

function readonlyCamposEND1() {
//        $("#cep").prop("readonly", true);
    $("#tplogradouro").prop("readonly", true);
    $("#logradouro").prop("readonly", true);
    $("#bairro").prop("readonly", true);
    $("#cidade").prop("readonly", true);
    $("#uf").prop("readonly", true);
}*/

$(document).ready(function () {
    $("#btn-BuscarEND1").click(function () {
        var msg = 0;
        var cep = $("#cep").val().replace(/\D/g, '');
        $.getJSON("//viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {
            console.log("in getJSON");
            if (!("erro" in dados)) {
                $("#cep").val(dados.cep);
                $("#logradouro").val(dados.logradouro);
                $("#bairro").val(dados.bairro);
                $("#cidade").val(dados.localidade);
                $("#uf").val(dados.uf);
            } 
            else {
                $("$msg").val("<h3 class='ext-info'>Informação:CEP não encontrado.</h2>");
            }
        }); 
    });
});


//console.log("cep: " + dados.cep + " ");
//console.log("logradouro: " + dados.logradouro + " ");
//console.log("bairro: " + dados.bairro + " ");
//console.log("cidade: " + dados.localidade + " ");
//console.log("uf: " + dados.uf);