
function jsonEnd1(json) {
    $.each(json.Endereco, function (key, value) {
        $("#cep").val(value.cep);
        $("#logradouro").val(value.logradouro);
        $("#bairro").val(value.bairro);
        $("#cidade").val(value.cidade);
        $("#uf").val(value.uf);
    });
}

/*function enableCamposEND1() {
//        $("#cep").prop("readonly", false);
    $("#tplogradouro").prop("readonly", false);
    $("#logradouro").prop("readonly", false);
    $("#bairro").prop("readonly", false);
    $("#cidade").prop("readonly", false);
    $("#uf").prop("readonly", false);
}

function readonlyCamposEND1() {
        $("#cep").prop("readonly", true);
    $("#tplogradouro").prop("readonly", true);
    $("#logradouro").prop("readonly", true);
    $("#bairro").prop("readonly", true);
    $("#cidade").prop("readonly", true);
    $("#uf").prop("readonly", true);
}
*/

$(document).ready(function () {
    $("#btn-BuscarEND1").click(function () {
        var url = "../../Api_IntJSON/BUSCAR_END_VIACEPCOM.php";
        var msg = 1;
        var cep = $("#cep").val().replace(/\D/g, '');
        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {cep: cep},
            beforeSend: function () {
//            $("#msg").html('<h3 class="text-info">Carregando...</h3>');
            },
            error: function () {
                $('#msg').html('<h3 class="text-danger">Error: Há allgun problemas com a fonte de dados. Ou CEP não existe.</h3>');
            },
            success: function (json) {
                jsonEnd1(json);
            }
        });
        Refet(msg, null);
    });
});
