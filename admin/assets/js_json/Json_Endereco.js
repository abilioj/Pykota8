var url = "../../Api_IntJSON/JSON_BUSCAR_ENDERECO_VIACEPCOM.php";

function jsonEnd1(json) {
    $.each(json.Endereco, function (key, value) {
        $("#cep").val(value.cep);
        $("#logradouro").val(value.logradouro);
        $("#bairro").val(value.bairro);
        $("#cidade").val(value.cidade);
        $("#uf").val(value.uf);
    });

}

function jsonEnd2(json) {
    $.each(json.Endereco, function (key, value) {
        $("#cepC").val(value.cep);
        $("#logradouroC").val(value.logradouro);
        $("#bairroC").val(value.bairro);
        $("#cidadeC").val(value.cidade);
        $("#ufC").val(value.uf);
    });
}

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
}

function enableCamposEND2() {
//        $("#cepC").prop("readonly", false);
    $("#tplogradouroC").prop("readonly", false);
    $("#logradouroC").prop("readonly", false);
    $("#bairroC").prop("readonly", false);
    $("#cidadeC").prop("readonly", false);
    $("#ufC").prop("readonly", false);
}

function readonlyCamposEND2() {
//        $("#cepC").prop("readonly", true);
    $("#tplogradouroC").prop("readonly", true);
    $("#logradouroC").prop("readonly", true);
    $("#bairroC").prop("readonly", true);
    $("#cidadeC").prop("readonly", true);
    $("#ufC").prop("readonly", true);
}

function enableCPF() {
    $("#cpf").prop("readonly", false);
    $("#cnpj").prop("readonly", true);
}

function enableCNPJ() {
    $("#cpf").prop("readonly", true);
    $("#cnpj").prop("readonly", false);
}

$(document).ready(function () {

    var flag1 = parseInt($("#flag1").val());
    var flag2 = parseInt($("#flag2").val());

    if (flag1 == 1) {
        readonlyCamposEND1();
    }else{
        enableCamposEND1();
    }
    if (flag2 == 1) {
        readonlyCamposEND2();
    }else{
        enableCamposEND2();
    }

    var cpfcnpj = parseInt($("#cpfcnpj").val());

    if (cpfcnpj === 1) {
        enableCPF();
    }

    if (cpfcnpj === 2) {
        enableCNPJ();
    }

    $("#btn-BuscarEND1").click(function () {

        var msg = 0;
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
                msg = 1;
                $('#msg').html('<h3 class="text-danger">Error: Há allgun problemas com a fonte de dados. Ou CEP não existe.</h3>');
            },
            success: function (json) {
                jsonEnd1(json);
            }
        });
    });

    $("#btn-BuscarEND2").click(function () {
        
        var msg = 0;
        var cepC = $("#cepC").val();

        $.ajax({
            type: "POST",
            url: url,
            dataType: "json",
            data: {cep: cepC},
            beforeSend: function () {
//            $("#msg").html('<h3 class="text-info">Carregando...</h3>');
            },
            error: function () {
                msg = 1;
                $('#msg').html('<h3 class="text-danger">Error: Há allgun problemas com a fonte de dados. Ou CEP não existe.</h3>');
            },
            success: function (json) {
                jsonEnd2(json);
            }
        });
    });

    $("#flag1").change(function () {
        var f = parseInt($("#flag1").val());

        if (f === 1) {
            readonlyCamposEND1();
        } else {
            enableCamposEND1();
        }
    });

    $("#flag2").change(function () {
        var f = parseInt($("#flag2").val());

        if (f === 1) {
            readonlyCamposEND2();
        } else {
            enableCamposEND2();
        }
    });

    $("#cpfcnpj").change(function () {
        var cpfcnpj = parseInt($("#cpfcnpj").val());

        if (cpfcnpj === 1) {
            enableCPF();
        }

        if (cpfcnpj === 2) {
            enableCNPJ();
        }
    });

});
