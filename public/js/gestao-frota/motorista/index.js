$(document).ready(function() {
    $("#novoMotorista").click(function () {
        $("#modalMotorista").fadeIn();
    });

    $("#closeModal").click(function () {
        $("#modalMotorista").fadeOut();
    });

    $(window).click(function (event) {
        if (event.target.id === "modalMotorista") {
            $("#modalMotorista").fadeOut();
        }
    });
});