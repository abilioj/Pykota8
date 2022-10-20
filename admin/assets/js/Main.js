
$(jQuery).ready(function () {
    //mainVersion();

    function voltar() {
        window.history.go(-1);
    }

    $("#btnVoltar").on("click", function () {
        voltar();
    });
});
