<?php
include "./funcoes/exibirPagina.php";
include "./funcoes/exibirComentarios.php";

$paginaSelecionada = $_GET['page'] ?? '';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ComentApp</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body>
    
    <nav class="bg-purple-500">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Flowbite</span>
            </a>
            <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
            <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
                <li>
                <a href="/?page=criarComentario" class="block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-purple-700 text-white">Criar comentário</a>
                </li>
                <li>
                <a href="/?page=carregarComentario" class="block py-2 px-3 md:p-0 text-gray-900 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-purple-700 text-white">Ver Comentários</a>
                </li>
            </ul>
            </div>
        </div>
    </nav>

    <?php exibirPagina($paginaSelecionada) ?>

</body>
</html>