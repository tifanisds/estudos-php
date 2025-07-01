<?php

function carregarComentarios()
{
    $comentarios = file_get_contents('comentarios.json');

    if (empty($comentarios)) {
        return [];
    } else {
        return json_decode($comentarios, true);
    }
}

function gravarComentario()
{

    if (!isset($_POST['autor']) || !isset($_POST['comentario'])) {
        return;
    }

    $registro = [
        'autor' => $_POST['autor'],
        'comentario' => $_POST['comentario']
    ];

    $registros = carregarComentarios();
    $registros[] = $registro;

    file_put_contents('comentarios.json', json_encode($registros));
}