var url = "";
var msg = 0;
var row = 0;
var tempo = 4000;
var isOK = false;
var table;
var targets = [0];
var urlLangDataTable = "./assets/language/datatables/Portuguese-Brasil.json";
var URL = "app/WS/JSON_ADMIN_SELECT_USERSCOTA_DATA_BALANCE.php";
var URLAcao = "app/WS/JSON_ADMIN_ALTERAR_COTA_BALANCE.php";
var URLAcaoResp = "app/WS/JSON_ADMIN_ADICIONAL_RESPONSAVEL.php";
var URLSelectGeral = "app/WS/JSON_ADMIN_SELECT_GERAL.php";
var URLM = "app/WS/JSON_ADMIN_GRUPO_MONTADO.php";
var limiteGeralGroup, limiteUsadoGeralGroup, users, disponivelA, impressoraA, userA, consumidoA
var LimiteAtual, LimiteMensal, LimiteMensalNew, LimiteN, LimiteNAdd;
var pku, pkg, pki, pkuc;//id modal
var limite_disponivel = 0;
var nivelUseID = 0;
var idUQ = 0; // usuarios que disponisbilizar as cotas
var idU = 0; //usuario a receber as cotas
var IDRESPONSAVEL = 0; //usuario a RESPONSAVEL
var IDRESPONSAVELGRUOP = 0; //usuario a RESPONSAVEL GRUPO

var limparData = function () {
    idUQ = 0;
    pki = 0;
    pku = 0;
    pkg = 0;
};

//SETA DADOS NO MODAL
var setImputModal = function (data) {
    $("#pku").val(data[0]);
    $("#usuario").val(data[1]);
    $("#LimiteAtual").val(data[3]);
    $("#LimiteMensal").val(data[2]);
    $("#LimiteMensalNew").val(data[2]);
    $("#limite_disponivel").val(limite_disponivel);
};

function readonlyDisabledImput() {
    $(".disp").prop("readonly", false);
}

function readonlyEnableImput() {
    $(".disp").prop("readonly", true);
}

function jsonCampoSelect(json) {
    var html;
    html = '';
    html = '<option value="0">Geral</option>';
    $.each(json.userS, function (key, value) {
        html += '<option value="' + value.id + '">' + value.text + '' + ' </option>';
    });
    $(".users").html(html);
    html = '';
}

//ok
var constionTable = function () {
    table = $('#dataTablesList').DataTable();
    table.destroy();
    table = $('#dataTablesList').DataTable({
        //data: data,
        "pagingType": "full_numbers"
        , "responsive": false
        , "ordering": true
        , "columnDefs": [
            {
                "type": "Usuarios-grade",
                "targets": targets
                , "visible": false
            }
        ]
        , "language": {
            "url": urlLangDataTable
        }
    });
    tableUS = $('#dataTablesListUS').DataTable();
    tableUS.destroy();
    tableUS = $('#dataTablesListUS').DataTable({
        //data: data,
        "pagingType": "full_numbers"
        , "responsive": false
        , "ordering": true
        , "columnDefs": [
            {
                "type": "Usuarios-grade-pre",
                "targets": [1]
                , "visible": false
            }
        ]
        , "language": {
            "url": urlLangDataTable
        }
    });
};

var Ajax_DadosSELECTGERAL = function () {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: URLSelectGeral,
        //data: {},
        beforeSend: function () {
            $(".msg-m").html('');
        },
        error: function () {
            msg = 1;
            $('.msg-m').html('');
        },
        success: function (json) {
            var html = '';
            html = '<option value="0"></option>';
            $.each(json.users, function (key, value) {
                html += '<option value="' + value.id + '">' + value.text + '' + ' </option>';
            });
            $(".idUseRes").html(html);
        }
    });
};

// OK
var Ajax_DadosSELECT = function (idG, idU, idI) {
    $.ajax({
        type: "POST",
        dataType: "json",
        // url: URLM,
        url: URL,
        data: {idg: idG, idu: idU, idi: idI},
        beforeSend: function () {
            $(".msg-m").html('');
        },
        error: function () {
            msg = 1;
            $('.msg-m').html('');
        },
        success: function (json) {
            jsonCampoSelect(json);
        }
    });
};

var Ajax_Controle_Data = function (acao) {
    $.ajax({
        type: "POST",
        url: URLAcao,
        data: {
            acao: acao, idg: pkg, iduq: idUQ, pku: pku, LimiteAtual: LimiteAtual
            , limite_disponivel: limite_disponivel, LimiteMensal: LimiteMensal
            , LimiteNAdd: LimiteNAdd, LimiteMensalNew: LimiteMensalNew
        },
        dataType: "json",
        beforeSend: function () {
            $(".msg-m").html('');
        },
        error: function (xhr, ajaxOptions, thrownError) {
            //            console.log(xhr.status);
            //            console.log(thrownError);
            msg = 1;
            $('.msg-m').html('errer');
        },
        success: function (json) {
            console.log(json);
            switch (acao) {
                case "b":
                    $.each(json.userLimite, function (key, value) {
                        limite_disponivel = value.balance;
                    });
                    break;
                case "a":
                    if (json.info.isok === true) {
                        $(".msg-m").html('<h3 class="text-info">Informação: Operação Realizado com Sucesso!</h3>');
                        RefetModal(1, 1000, 1);
                    }
                    break;
                case "z":
                    if (json.info.isok === true) {
                        $(".msg-m").html('<h3 class="text-info">Informação: Operação Realizado com Sucesso!</h3>');
                        RefetModal(1, 1000, 1);
                    }
                    break;
                case "r":
                    if (json.info.isok === true) {
                        $(".msg-m").html('<h3 class="text-info">Informação: Operação Realizado com Sucesso!</h3>');
                        RefetModal(1, 1000, 1);
                    }
                    break;
                case "alm":
                    if (json.info.isok === true) {
                        $(".msg-m").html('<h3 class="text-info">Informação: Operação Realizado com Sucesso!</h3>');
                        RefetModal(1, 1000, 1);
                    }
                    break;
                case "rl":
                    if (json.info.isok === true) {
                        $(".msg-m").html('<h3 class="text-info">Informação: Operação Realizado com Sucesso!</h3>');
                        RefetModal(1, 1000, 1);
                    }
                    break;
            }
            $("#limite_disponivel").val(limite_disponivel);
            Refet(1, 12000);
        }
    });
};

//OK
var Ajax_Controle_Resposaveis = function (acao, idu, idur, idg) {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: URLAcaoResp,
        data: {acao: acao, idu: idu, idur: idur, idg: idg},
        error: function () {
            console.log('erro');
            //$('.msg').html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div></div>');
        },
        success: function (data) {
            console.log(data);
            $.each(data.info, function (key, value) {
                row = value.row;
                isOK = value.isOK;
            });
        }
    });
};

//ok
var Main = function () {
    var caminhos = $('#caminhos').val();
    $('.msg-m').html('');
    idUQ = 0;
    URLM = caminhos + URLM;
    URL = caminhos + URL;
    URLAcao = caminhos + URLAcao;
    URLAcaoResp = caminhos + URLAcaoResp;
    URLSelectGeral = caminhos + URLSelectGeral;
    constionTable();
};

$(document).ready(function () {

    $.fn.dataTable.ext.type.order['Usuarios-grade-pre'] = function (d) {
        return 0;
    };

    Main();
    readonlyEnableImput();

    $('#VerUser_ModalVUsersResp').modal({backdrop: 'static', show: false});

    $('#dataTablesList tbody').on('click', 'tr', function () {
        limparData();
        pkg = $(".idg").val();
        var data = table.row(this).data();

        //pega os dados e seta no modAL
        //Ajax_DadosModal(pkg, pkuc, pki);
        Ajax_DadosSELECT(pkg, pkuc, pki);
        setImputModal(data);
        limiteGeralGroup = $('#limiteGeralGroup').val();
        $('#limite_disponivel').val(limiteGeralGroup);


        $('#ModalUpdateConta').modal({backdrop: 'static', show: false});
        $("#ModalUpdateLimiteMensal").modal({backdrop: 'static', show: false});

        //valida a permição de altualizacao do usuario pelo nivel de acesso
        if (limiteGeralGroup < 0) {
            if (nivelUseID < 4) {
                $('.msg').html('<h3 class="text-info">Informação: Não a limite disponisvel, contate o setor de TI!</h3>');
                Refet(1, 8000);
            } else {
                $('#ModalUpdateConta').modal({backdrop: 'static', show: true});
            }
        } else {
            $('#ModalUpdateConta').modal({backdrop: 'static', show: true});
        }
    });

    //select de usuario que pega o balance de um outro usuario - ok
    $('#users').change(function () {
        idUQ = parseInt(this.value);
        if (idUQ <= 0) {
            $("#limite_disponivel").val(limiteGeralGroup);
        } else {
            Ajax_Controle_Data("b");
        }
    });

    $("#btn-AlterarLimiteMensal").click(function () {
        $("#ModalUpdateLimiteMensal").modal({backdrop: 'static', show: true});
    });

    //--------------------------------------------------------------------------
    //ok
    $('#btn-Alterar').click(function () {
        pku = parseInt($("#pku").val());
        LimiteAtual = parseInt($("#LimiteAtual").val());
        LimiteNAdd = parseInt($("#LimiteNAdd").val());
        limite_disponivel = parseInt($("#limite_disponivel").val());
        if (LimiteNAdd == 0 || LimiteNAdd < 0) {
            $('.msg-m').html('<h3 class="text-warning">Informação: Campo Adicionar é 0 ou negativo, e não é posivel fazer a Alteração !</h3>');
            RefetModal(1, 5000, 2);
        } else {
            if (LimiteNAdd > limite_disponivel) {
                $('.msg-m').html('<h3 class="text-warning">Informação: Essa cota informada para ser adicionada é maior que a disponisvel para a Alteração!</h3>');
                RefetModal(1, 5000, 2);
            } else {
                Ajax_Controle_Data("a");
                //                RefetModal(1, tempo, 0);
            }
        }
    });

    //ok
    $('#btn-ZeroCota').click(function () {
        pku = $("#pku").val();
        Ajax_Controle_Data("z");
    });

    $('#btn-Remover').click(function () {
        console.log('idG: ' + pkg);
        pku = $("#pku").val();
        Ajax_Controle_Data("r");
    });

    $('#btn-Canselar').click(function () {
        clearConsole();
        $('#ModalUpdateConta').modal('hide');
        Recarregar();
    });

    //ok
    $('#btn-salvar-Limite-mensal').click(function () {
        //        clearConsole();
        LimiteMensal = parseInt($('#LimiteMensal').val());
        pku = $('#pku').val();
        limiteUsadoGeralGroup = parseInt($('#limiteUsadoGeralGroup').val());
        LimiteMensalNew = $('#LimiteMensalNew').val();

        var disponivel = (limiteGeralGroup - limiteUsadoGeralGroup);//-LimiteMensal;
        if (LimiteMensalNew <= disponivel) {
            Ajax_Controle_Data('alm');
        } else {
            $('.msg-m').html('<h3 class="text-info">Informação: Não a limite disponisvel, <br/> valor disponivel atual é <b>' + disponivel + '</b></h3>');
            RefetModal(1, 10000, 2);
        }
        $('#ModalUpdateLimiteMensal').modal('hide');
    });
    //--------------------------------------------------------------------------
    $(".sel").select2({
        dropdownParent: $('#ModalUpdateConta'),
        placeholder: 'Selecione o item',
        allowClear: true
    });

    $(".sel_u").select2({
        dropdownParent: $('#VerUser_ModalVUsersResp'),
        placeholder: 'Selecione o item',
        allowClear: true,
        width: '100%'
    });
    //--------------------------------------------------------------------------
    //para novo responsavel
    $("#btn-novo").click(function () {
        Ajax_DadosSELECTGERAL();
        pkg = $('.idg').val();
        IDRESPONSAVELGRUOP = $('#IDRESPONSAVEL').val();
        Ajax_DadosSELECT(pkg, IDRESPONSAVELGRUOP, 0);
        $('#VerUser_ModalVUsersResp').modal({backdrop: 'static', show: true});
    });

    $(".btn-Add").click(function () {
        IDRESPONSAVEL = 0;
        IDRESPONSAVEL = parseInt($('#idUseRes').val());//idUsePykota
        if (IDRESPONSAVEL === 0) {
            $(".msg-m").html('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><i class="fa fa-refresh fa-spin"></i> <strong>Atenção!</strong> Erro ao realizar essa Operação.</div>');
            RefetModal(1, 3000, 2);
        } else {
            Ajax_Controle_Resposaveis("a", IDRESPONSAVEL, IDRESPONSAVELGRUOP, pkg);
            RefetModal(1, 3000, 1);
        }
    });

    $('#btn-CanselarII').click(function () {
        clearConsole();
        $('#VerUser_ModalVUsersResp').modal('hide');
        Recarregar();
    });

    $('#dataTablesListUS tbody').on('click', 'tr', function () {
        limparData();
        var data = tableUS.row(this).data();
        IDRESPONSAVEL = data[1];
        pkg = $('#idg').val();
        IDRESPONSAVELGRUOP = $('#IDRESPONSAVEL').val();

        var decisao = confirm("Deseja realmente Excluir?");
        if (decisao) {
            Ajax_Controle_Resposaveis("e", IDRESPONSAVEL, IDRESPONSAVELGRUOP, pkg);
            location.reload();
        } else {
            return false;
        }
    });
    //--------------------------------------------------------------------------
});

// Faça isso antes de inicializar qualquer um dos seus modais
//    $.fn.modal.Constructor.prototype.enforceFocus = function () {};

//redefinir as opções padrão para seus valores iniciais chamando
//$.fn.select2.defaults.reset();

//destruio
//$('.sel').select2('destroy');
/*
 dropdownParent: $('#ModalUpdateConta'),
 width: 'element',
 theme: "classic",
 placeholder: 'Selecione o item',
 disabled: true,
 allowClear: true
 */