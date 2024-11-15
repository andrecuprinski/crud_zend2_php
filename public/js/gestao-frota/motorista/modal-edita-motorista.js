$(document).ready(function() {
    $("#editaMotorista").click(function () {
        $("#modalEditaMotorista").fadeIn();
    });

    $("#closerModal").click(function () {
        $("#modalEditaMotorista").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalEditaMotorista") {
            $("#modalEditaMotorista").fadeOut();
        }
    });

    $(".btn-edit").click(function(event) {
        console.log('Ue');
        event.preventDefault();

        let row = $(this).closest("tr");
        let id = row.find("td:eq(0)").text();
        let nome = row.find("td:eq(1)").text();
        let rg = row.find("td:eq(2)").text();
        let cpf = row.find("td:eq(3)").text();
        let telefone = row.find("td:eq(4)").text();
        let placaVeiculo = row.find("td:eq(6)").text();

        $("#modalEditaMotorista #id").val(id);
        $("#modalEditaMotorista #nome").val(nome);
        $("#modalEditaMotorista #rg").val(rg);
        $("#modalEditaMotorista #cpf").val(cpf);
        $("#modalEditaMotorista #telefone").val(telefone);
        $("#modalEditaMotorista #placaVeiculo").val(placaVeiculo);

        $("#modalEditaMotorista").show();
    });


    // Evento de clique no botão "Salvar" do modal
    $("#formEditaMotorista").submit(function(event) {
        event.preventDefault();

        let id = $("#modalEditaMotorista #id").val();
        let nome = $("#modalEditaMotorista #nome").val();
        let rg = $("#modalEditaMotorista #rg").val();
        let cpf = $("#modalEditaMotorista #cpf").val();
        let telefone = $("#modalEditaMotorista #telefone").val();
        let placaVeiculo = $("#modalEditaMotorista #placaVeiculo").val();

        $.ajax({
            url: "/gestao-frota/motorista/edita-motorista",
            type: "POST",
            data: {
                id: id,
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
                }
            },
            error: function() {
                $("#error-alert").text("Erro ao editar motorista.").show();
            }
        });
    });

    // Evento de clique no botão "Fechar" do modal
    $("#closeModal").click(function() {
        $("#modalEditaMotorista").hide();
    });
});