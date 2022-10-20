
$(document).ready(function () {

    var url = "../API_IntJSON/JSON_ADMIN_Dashboard.php";
    var msg = 0;

    var idOrg = parseInt($("#idOrg").val());

    $.ajax({
        type: "POST",
        url: url,
        dataType: "json",
        data: {idOrg: idOrg},
        beforeSend: function () {
            $("#msg").html('<h3 class="text-info">Carregando...</h3>');
        },
        error: function () {
            msg = 1;
            $('#msg').html('<h3 class="text-danger">Error: Há allgun problemas com a fonte de dados</h3>');
            Refet(msg, null);
        },
        success: function (json) {

            /*$.each(json.grafico, function (key, value) {

                var id = parseInt(value.id);
                var valor = parseInt(value.quant);

                if (idOrg === 0) {
                    if (id === 2)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'amma', valor);
                    if (id === 3)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'agetul', valor);
                    if (id === 4)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'gcm', valor);
                    if (id === 5)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'comurg', valor);
                    if (id === 6)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'cmtc', valor);
                    if (id === 7)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'cgm', valor);
                    if (id === 8)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'imas', valor);
                    if (id === 9)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'ipsm', valor);
                    if (id === 10)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'procon', valor);
                    if (id === 11)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'pgm', valor);
                    if (id === 12)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'sma', valor);
                    if (id === 13)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'semas', valor);
                    if (id === 14)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'secom', valor);
                    if (id === 15)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'secult', valor);
                    if (id === 16)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'sme', valor);
                    if (id === 17)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'seplanh', valor);
                    if (id === 18)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'sefin', valor);
                    if (id === 19)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'segov', valor);
                    if (id === 20)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'sedetec', valor);
                    if (id === 21)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'seinfra', valor);
                    if (id === 22)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'smpm', valor);
                    if (id === 23)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'sms', valor);
                    if (id === 24)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'smt', valor);
                    if (id === 25)
                        Gerar_DADOS_GRAFiCO(gaugeOptions, 'smdhpa', valor);
                } else {
                    Gerar_DADOS_GRAFiCO(gaugeOptions, 'Graf', valor);
                    $("#GrafNome").html(value.sgl);
                }

            });*/

            Gerar_DADOS_GRAFiCO(gaugeOptions, 'Graf', 12000);//valor
            $("#GrafNome").html(1500)//value.sgl;
            Refet(msg, null);
        }
    });

});