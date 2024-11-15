$(document).ready(function() {
    $("#formMotorista").submit(function(event) {
        event.preventDefault();

        let nome = $("#nome").val();
        let rg = $("#rg").val();
        let cpf = $("#cpf").val();
        let telefone = $("#telefone").val();
        let placaVeiculo = $("#placaVeiculo").val();

        $.ajax({
            url: "/gestao-frota/motorista/cadastra-motorista",
            type: "POST",
            data: {
                nome: nome,
                rg: rg,
                cpf: cpf,
                telefone: telefone,
                placaVeiculo: placaVeiculo
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
                $("##error-alert").text("Erro ao cadastrar motorista.").show();
            }
        });
    });
});
