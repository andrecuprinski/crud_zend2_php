$(document).ready(function() {
    $("#editaVeiculo").click(function () {
        $("#modalEditaVeiculo").fadeIn();
    });

    $("#closerModalEdita").click(function () {
        $("#modalEditaVeiculo").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalEditaVeiculo") {
            $("#modalEditaVeiculo").fadeOut();
        }
    });

    $(".btn-edit").click(function(event) {
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

        $("#modalEditaVeiculo #id").val(id);
        $("#modalEditaVeiculo #modelo").val(modelo);
        $("#modalEditaVeiculo #marca").val(marca);
        $("#modalEditaVeiculo #ano").val(ano);
        $("#modalEditaVeiculo #cor").val(cor);
        $("#modalEditaVeiculo #placaVeiculo").val(placa);
        $("#modalEditaVeiculo #renavam").val(renavam);

        $("#modalEditaVeiculo").show();
    });


    // Evento de clique no botão "Salvar" do modal
    $("#formEditarVeiculo").submit(function(event) {
        event.preventDefault();

        let id = $("#modalEditaVeiculo #id").val();
        let modelo = $("#modalEditaVeiculo #modelo").val();
        let marca = $("#modalEditaVeiculo #marca").val();
        let ano = $("#modalEditaVeiculo #ano").val();
        let cor = $("#modalEditaVeiculo #cor").val();
        let placa = $("#modalEditaVeiculo #placaVeiculo").val();
        let renavam = $("#modalEditaVeiculo #renavam").val();

        $.ajax({
            url: "/gestao-frota/veiculo/edita-veiculo",
            type: "POST",
            data: {
                id: id,
                modelo: modelo,
                marca: marca,
                ano: ano,
                cor: cor,
                placa: placa,
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
                }
            },
            error: function() {
                $("#error-alert").text("Erro ao editar o veículo.").show();
            }
        });
    });

    $("#closeModalEdita").click(function() {
        $("#modalEditaVeiculo").hide();
    });
});