<?php

function randomString($largura)
{
    $caracteres = array('0', '1', '2', '3', '4', '5',
     '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f',
     'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p',
     'q', 'r', 's', 't', 'u', 'v', 'x', 'w', 'y', 'z');
    $ID = '';

    for ($i = 0; $i < $largura; $i++) {
        $ID .= $caracteres[floor(rand() % count($caracteres))];
    }

    return $ID;
}

function moedaBr($valor)
{
    if (!empty($valor)) {
        $valor = str_replace(",", "", $valor);
        $valor = number_format($valor, 2, ',', '.');
    }
    return $valor;
}
