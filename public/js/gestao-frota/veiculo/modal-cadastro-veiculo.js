$(document).ready(function() {
    $("#formVeiculo").submit(function(event) {
        event.preventDefault();

        let modelo = $("#modelo").val();
        let marca = $("#marca").val();
        let ano = $("#ano").val();
        let placa = $("#placaVeiculo").val();
        let cor = $("#cor").val();
        let renavam = $("#renavam").val();

        $.ajax({
            url: "/gestao-frota/veiculo/cadastra-veiculo",
            type: "POST",
            data: {
                modelo: modelo,
                marca: marca,
                ano: ano,
                placa: placa,
                cor: cor,
                renavam: renavam
            },
            success: function(response) {
                if (response.sucesso) {
                    $("#success-alert").text(response.mensagem).show();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $("#error-alert").text(response.mensagem).show();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                }
            },
            error: function() {
                $("##error-alert").text("Erro ao cadastrar o veículo.").show();
            }
        });
    });
});