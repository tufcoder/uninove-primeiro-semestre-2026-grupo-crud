<?php

function validarDadosPost(array $campos) {
    foreach($campos as $campo => $valor) {
        if (empty($valor)) {
            return "$campo inválido, revise o formulário!";
        }
    }
    return null;
}

function validarCampoPost(string $valor) {
    if (empty($valor)) {
        return "Valor inválido.";
    }
    return null;
}

?>