<?php
// module/GestaoFrota/src/GestaoFrota/Helper/format_helpers.php

function formatRG($rg) {
    return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{1})/", "$1.$2.$3-$4", $rg);
}

function formatCPF($cpf) {
    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "$1.$2.$3-$4", $cpf);
}

function formatTelefone($telefone) {
    return preg_replace("/(\d{2})(\d{5})(\d{4})/", "($1) $2-$3", $telefone);
}
?>