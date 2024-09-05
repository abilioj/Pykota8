
function closeModal() {
    $('#ModalUpdateConta').modal('hide');
}

function closeModalHome() {
    $('.ModalOpcoes').modal({backdrop: 'static', show: false});
}

function CarregadoModal() {
    $(".msg-m").html('<h3 class="text-info">Carregado!</h3>');
}

function limparMSG() {
    $(".msg-m").empty();
}

function RefetModal(msg, tempo, op) {
    var tempoFull = 4000;
    if (tempo != null) {
        tempoFull = tempo;
    }
    if (msg === -1) {
        setTimeout('closeModal()', tempoFull + 2000);
    }
    if (msg === 0) {
        setTimeout('CarregadoModal()', 4000);
        setTimeout('limparMSG()', 5000);
    }
    if (msg > 0) {
        if (op === 0) {
            setTimeout('limparMSG()', tempoFull + 1000);
            setTimeout('closeModal()', tempoFull + 2000);
        }
        if (op === 1) {
            setTimeout('closeModal()', tempoFull + 2000);
            setTimeout("location.reload()", tempoFull + 2000);
        }
        if (op === 2) {
            setTimeout('limparMSG()', 5000);
        }
    }
}

function RefetModalHome(msg, tempo, op) {
    var tempoFull = 4000;
    if (tempo != null) {
        tempoFull = tempo;
    }
    if (msg === 0) {
        setTimeout('limparMSG()', tempoFull + 2000);
    }
    if (msg === 1) {
        setTimeout('limparMSG()', tempoFull + 500);
        setTimeout('closeModalHome()', tempoFull + 500);
    }
    if (msg > 1) {
        setTimeout('limparMSG()', tempoFull + 1000);
        setTimeout('closeModalHome()', tempoFull + 1000);
        location.reload();
    }
}
