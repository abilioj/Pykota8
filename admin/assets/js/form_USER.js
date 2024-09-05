
function limparFormUsuL() {
    $("#msgL").empty();
}

function limparFormUsuE() {
    $("#msgE").empty();
}

var url = "../../app/WS/JSON_ADMIN_VALIDATION_FORM_USER.php";
var msg = 0;
var tamanho = 8;

var msgL=false;
var msgE=false;


function validaLogin(campo) {
    var login = campo.value;
    console.log(login);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {login: login}, 
        error: function () {
//            msg = 1;
//            $('#msg').html('<h3 class="text-warning">Error: Há allgun problemas com a fonte de dados</h3>');
        },
        success: function (json) {

            $.each(json.Result, function (key, value) {
                switch (value.ResultL) {
                    case true:
                        $('#msgL').html('<b class="text-warning" style="font-size: '+tamanho+'pt">Aviso: Login "'+login+'" já cadastrado no sistema!</b>');
                        msgL=true;
                        break;
                    case false:
                        msgL=false;
                        limparFormUsuL();
                        break;
                }
            });
        }
    });
};

function validaEmail(campo) {
    var email = campo.value;
    console.log(email);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {email: email}, 
//        error: function () {
//            msg = 1;
//            $('#msg').html('<h3 class="text-warning">Error: Há allgun problemas com a fonte de dados</h3>');
//        },
        success: function (json) {
            $.each(json.Result, function (key, value) {
                switch (value.ResultE) {
                    case true:
                        $('#msgE').html('<b class="text-warning"  style="font-size: '+tamanho+'pt">Aviso: Email "'+email+'" já cadastrado no sistema!</b>');
                        msgE=true;
                        break;
                    case false:
                        msgE=false;
                        limparFormUsuE();
                        break;
                }
            });
        }
    });
};

function validarForm(){
    if(msgE == false && msgL == false){
        var decisao = confirm("Os Dados estão Corretos?");
        if (decisao) {
            return true;
        } else {
            return false;
        }
    }else{
        alert("Revise os Campos, se os Dados estão validos!");
        return false;
    }
};

function validarFormalAteral(){
    if(msgE == false && msgL == false){
        var decisao = confirm("Os Dados estão Corretos?");
        if (decisao) {
            return true;
        } else {
            return false;
        }
    }else{
        var decisao = confirm("Os Dados estão Corretos, Estão tados validos? E se Responsabilizar pela alteração! Se ocorre erro de Redondacia de Dados!");
        if (decisao) {
            return true;
        } else {
            return false;
        }
    }
};