$(document).ready(function() {
    $("#novoVeiculo").click(function () {
        $("#modalVeiculo").fadeIn();
    });

    $("#closeModal").click(function () {
        $("#modalVeiculo").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalVeiculo") {
            $("#modalVeiculo").fadeOut();
        }
    });
});