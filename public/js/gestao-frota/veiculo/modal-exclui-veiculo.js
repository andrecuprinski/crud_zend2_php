$(document).ready(function() {
    $("#deletaVeiculo").click(function () {
        $("#modalExcluiVeiculo").fadeIn();
    });

    $("#closerModalDelete").click(function () {
        $("#modalExcluiVeiculo").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalExcluiVeiculo") {
            $("#modalExcluiVeiculo").fadeOut();
        }
    });

    $(".btn-delete").click(function(event) {
        console.log('Ue');
        event.preventDefault();

        let row = $(this).closest("tr");
        let id = row.find("td:eq(0)").text();
        let modelo = row.find("td:eq(1)").text();
        let marca = row.find("td:eq(2)").text();
        let ano = row.find("td:eq(3)").text();
        let cor = row.find("td:eq(4)").text();
        let placa = row.find("td:eq(5)").text();
        let renavam = row.find("td:eq(6)").text();

        $("#modalExcluiVeiculo #id").val(id);
        $("#modalExcluiVeiculo #modelo").val(modelo);
        $("#modalExcluiVeiculo #marca").val(marca);
        $("#modalExcluiVeiculo #ano").val(ano);
        $("#modalExcluiVeiculo #cor").val(cor);
        $("#modalExcluiVeiculo #placaVeiculo").val(placa);
        $("#modalExcluiVeiculo #renavam").val(renavam);

        $("#modalExcluiVeiculo").show();
    });


    $("#formExcluiVeiculo").submit(function(event) {
        event.preventDefault();

        let id = $("#modalExcluiVeiculo #id").val();

        $.ajax({
            url: "/gestao-frota/veiculo/exclui-veiculo",
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