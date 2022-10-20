
// $('.msg').html('<h3 class="text-success">Informação: ***!</h3>');
// $('.msg').html('<h3 class="text-danger">Error: ***</h3>');
// $('.msg').html('<h3 class="text-info">Informação: ***!</h3>');
// $('.msg').html('<h3 class="text-warning">Informação: ***!</h3>');
// função em jquery pra quadno aperta F5

/*function ApertaF5() {
 $(document).ready(function () {
 $(document).keydown(function (event) {
 var k = event.keyCode
 if (k == 116) {
 $.post() // funcao post jquery para outra pagina que fara o ajax
 }
 })
 });
 }*/

/*
 * Para testes em momento de desenvolvimento
 * focando em responsivilidade do layout
 */
var GetResolution = function(){
    var Resolutions;
    var textWidth = "";
    var widthMain = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    var heightMain = (window.innerHeight > 0) ? window.innerHeight : screen.height;
    if (widthMain < 768) {
        textWidth = "Smartphones XS";
    }
    if (widthMain >= 768) {
        textWidth = "Tablets SM";
    }
    if (widthMain > 992) {
        textWidth = "NoteBoots MD";
    }
    if (widthMain > 1200) {
        textWidth = "Desktop LG";
    }
    Resolutions = {textWidth:textWidth, widthMain:widthMain, heightMain:heightMain};
    return Resolutions;
};

function Carregado() {
    $(".msg").html('<h3 class="text-info">Carregado!</h3>');
}

function limpar() {
    $(".msg").empty();
}

function Refet(msg, tempo) {
    var tempoFull = 4000;
    if (tempo != null) {
        tempoFull = tempo;
    }
    if (msg === 0) {
        setTimeout('Carregado()', 4000);
        setTimeout('limpar()', 6000);
    }
    if (msg > 0) {
        setTimeout('limpar()', tempoFull);
    }
}

function ValiForm() {
    var decisao = confirm("Os Dados estão Corretos?");
    if (decisao) {
        return false;
    } else {
        return false;
    }
}

function ValiExc() {
    var decisao = confirm("Deseja realmente Excluir?");
    if (decisao) {
        return false;
    } else {
        return false;
    }
}

function checar_caps_lock(ev) {
    var e = ev || window.event;
    codigo_tecla = e.keyCode ? e.keyCode : e.which;
    tecla_shift = e.shiftKey ? e.shiftKey : ((codigo_tecla == 16) ? true : false);
    if (((codigo_tecla >= 65 && codigo_tecla <= 90) && !tecla_shift) || ((codigo_tecla >= 97 && codigo_tecla <= 122) && tecla_shift)) {
        $('#aviso_caps_lock').html('<div class="text-center alert-info">Atenção: O Caps Lock esta ativado</div>');
    } else {
        $('#aviso_caps_lock').empty();
    }
}

function MostrarDIV(params) {
    if (params == 0)
        $("#CampDIV").show();
    if (params == 1)
        $("#CampDIVI").show();
    if (params == 2)
        $("#CampDIVII").show();
    if (params == 3)
        $("#CampDIVIII").show();
}

function EsconderDIV(params) {
    if (params == 0)
        $("#CampDIV").hide();
    if (params == 1)
        $("#CampDIVI").hide();
    if (params == 2)
        $("#CampDIVII").hide();
    if (params == 3)
        $("#CampDIVIII").hide();
}

function enableCPF() {
    $("#cpf").prop("readonly", false);
    $("#cnpj").prop("readonly", true);
}

function enableCNPJ() {
    $("#cpf").prop("readonly", true);
    $("#cnpj").prop("readonly", false);
}
/*
 * mainVersion
 * usar 
 * <input type="hidden" name="caminho" value="{caminhos}" id="caminho" />
 */

var mainVersion = function () {
    var caminho = "";
    var url = "INFO/version.json";
    caminho = $("#caminho").val();
    $.ajax({
        type: "POST",
        url: caminho + url,
        //data: {},
        dataType: "json",
        beforeSend: function () {
//            $(".msg").html('<h3 class="text-info">Carregando...</h3>');
        },
        error: function () {
            msg = 1;
            $('.msg').html('<h3 class="text-danger">Error em Ver Dados: Há allgun problemas com a fonte de dados</h3>');
        },
        success: function (json) {
            console.log("version the App " + json.name + ": " + json.version);
            console.log("current version of PHP OF App: " + json.PHP_atual);
        }
    });
};

// Como Usar = id="form" onsubmit="return validaarquivo(form.id_do_campo.value);" enctype="multipart/form-data"
function validaarquivo(campo) {
    TamanhoString = campo.length;
    extensao = campo.substr(TamanhoString - 4, TamanhoString);
    if (TamanhoString == 0) {
        alert('Você precisa selecionar um arquivo antes de transmitir.');
        return false;
    } else {
        var ext = new Array('.png', '.jpg', '.jpeg');//adicione as extensões desejadas
        for (var i = 0; i < ext.length; i++) {
            if (extensao == ext[i]) {
                flag = "ok";
                break;
            } else {
                flag = "erro";
            }
        }
        if (flag == "erro") {
            alert("Tipo de arquivo " + extensao + " invalido.")
            document.form.arquivo.value = "";
            return false;
        }
    }
}

//validaçães
function validarFormNovo() {
    var decisao = confirm("Os Dados estão Corretos?");
    if (decisao) {
        return true;
    } else {
        return false;
    }
}

function validarFormExcluir() {
    var decisao = confirm("Deseja realmente Excluir?");
    if (decisao) {
        return true;
    } else {
        return false;
    }
}

//exemplo
function validaForm(form) {
    if (form.nome.value == "") {
        alert("Preencha todos os campos.");
        form.nome.focus();
        return false;
    }
}

//arredonda valor
function arredondamento(x, n) {
    if (n < 0 || n > 10)
        return x;
    var pow10 = Math.pow(10, n);
    var y = x * pow10;
    return Math.round(y) / pow10;
}

//refresh na pagina
function autoRefresh(interval) {
    setTimeout("atualizar();", interval);
}

function atualizar() {
    this.deconto();
    this.autoRefresh(30);
}

//COMO USAR  onkeyup="SubstituiVirgulaPorPonto(this)" placeholder="R$"
function SubstituiVirgulaPorPonto(campo) {
    campo.value = campo.value.replace(/,/gi, ".");
}

//COM USAR  id="data" onkeyup="Mascara_Data(this, event)" maxlength="10" placeholder="DD/MM/AAAA"
function Mascara_Data(Campo, teclapres) {
    var tecla = teclapres.keyCode;
    var vr = new String(Campo.value);
    vr = vr.replace("/", "");
    vr = vr.replace("/", "");
    vr = vr.replace("/", "");
    tam = vr.length + 1;
    if (tecla != 8 && tecla != 8) {
        if (tam > 0 && tam < 2)
            Campo.value = vr.substr(0, 2);
        if (tam > 2 && tam < 4)
            Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2);
        if (tam > 4 && tam < 7)
            Campo.value = vr.substr(0, 2) + '/' + vr.substr(2, 2) + '/' + vr.substr(4, 7);
    }
}

function Verifica_Inteiros(input,name) {
    var er = /[^0-9]/;
    if (er.test(input.value)) {
        if (name == 1) {
            alert("No campo de CNPJ/CPF digite somente  número!");
        } else {
            alert("No campo de Quantidade digite somente  número!");
        }
    }

}

//COMO Usar onKeypress="campo_numerico()"
function campo_numerico() {
    if (event.keyCode < 45 || event.keyCode > 57)
        event.returnValue = false;
}

function isNumberKey(evt){
    var charCode = (evt.which) ? evt.which : event.keyCode
    if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
    return true;
}
 

//pra text-area
//COMO USAR id="campo" onkeyup="mostrarResultado(this.value, 600, 'spcontando'); contarCaracteres(this.value, 140, 'sprestante')"
/* NECESACIO
 <span id="spcontando" style="font-family:Georgia;">Nada digitado..</span><br />
 <span id="sprestante" style="font-family:Georgia;"></span>
 */
function mostrarResultado(box, num_max, campospan) {
    var contagem_carac = box.length;
    if (contagem_carac != 0) {
        document.getElementById(campospan).innerHTML = contagem_carac + " caracteres digitados";
        if (contagem_carac == 1) {
            document.getElementById(campospan).innerHTML = contagem_carac + " caracter digitado";
        }
        if (contagem_carac >= num_max) {
            document.getElementById(campospan).innerHTML = "Limite de caracteres excedido!";
        }
    } else {
        document.getElementById(campospan).innerHTML = "Nada digitado..";
    }
}

function clearConsole(){
        console.clear();
}

function Recarregar(){
    location.reload();
}