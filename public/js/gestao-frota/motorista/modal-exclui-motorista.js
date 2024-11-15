$(document).ready(function() {
    $("#deleteMotorista").click(function () {
        $("#modalExcluiMotorista").fadeIn();
    });

    $("#closerModalExclui").click(function () {
        $("#modalExcluiMotorista").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalExcluiMotorista") {
            $("#modalExcluiMotorista").fadeOut();
        }
    });

    $(".btn-delete").click(function(event) {
        console.log('Ue');
        event.preventDefault();

        let row = $(this).closest("tr");
        let id = row.find("td:eq(0)").text();
        let nome = row.find("td:eq(1)").text();
        let rg = row.find("td:eq(2)").text();
        let cpf = row.find("td:eq(3)").text();
        let telefone = row.find("td:eq(4)").text();
        let placaVeiculo = row.find("td:eq(6)").text();

        $("#modalExcluiMotorista #id").val(id);
        $("#modalExcluiMotorista #nome").val(nome);
        $("#modalExcluiMotorista #rg").val(rg);
        $("#modalExcluiMotorista #cpf").val(cpf);
        $("#modalExcluiMotorista #telefone").val(telefone);
        $("#modalExcluiMotorista #placaVeiculo").val(placaVeiculo);

        $("#modalExcluiMotorista").show();
    });


    $("#formExcluiMotorista").submit(function(event) {
        event.preventDefault();

        let id = $("#modalExcluiMotorista #id").val();

        $.ajax({
            url: "/gestao-frota/motorista/exclui-motorista",
            type: "POST",
            data: {
                id: id,
            },
            success: function(response) {
                if (response.sucesso) {
                    $("#success-alert").text(response.mensagem).show();
                    setTimeout(function() {
                        location.reload();
                    }, 2000);
                } else {
                    $("#error-alert").text(response.mensagem).show();
                }
            },
            error: function() {
                $("#error-alert").text("Erro ao Excluir motorista.").show();
            }
        });
    });

    $("#closerModalExclui").click(function() {
        $("#modalExcluiMotorista").hide();
    });
});