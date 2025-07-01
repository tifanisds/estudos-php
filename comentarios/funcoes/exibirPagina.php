<?php

function exibirPagina($paginaSelecionada) {

    if (empty($paginaSelecionada)) {
        include "./paginas/carregarComentario.php";
    } else {
        $caminho = "./paginas/{$paginaSelecionada}.php";
        if (file_exists($caminho)) {
            include "./paginas/{$paginaSelecionada}.php";
        } else {
            echo '<div class="p-6 w-1/2 border border-red-900 mx-auto rounded-lg bg-red-200">404 - Arquivo não encontrado</div>';
        }
    }
}