<?php 
include "./functions/retornaImagem.php";

$diretorio = getcwd();
$conteudoDiretorio = scandir($diretorio);
$arquivos = formatarSaidaDiretorio($conteudoDiretorio);

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iLoveFiles</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="bg-[#6161db]">
    
    <nav class="border-gray-200 bg-gray-50 bg-white mt-3 mb-10">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-3xl whitespace-nowrap text-[#6161db]">i<span class="text-[#dd5fcf] font-bold">Love</span><span class="font-bold italic">Files</span></span>
        </a>
        <div class="hidden w-full md:block md:w-auto" id="navbar-solid-bg">
        <ul class="flex flex-col font-medium mt-4 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-transparent">
            <li>
            <a href="#" class="text-[#6161db] block py-2 px-3 md:p-0 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Sobre a plataforma</a>
            </li>
            <li>
            <a href="#" class="text-[#6161db] block py-2 px-3 md:p-0 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Ajuda</a>
            </li>
            <li>
            <a href="#" class="text-[#6161db] block py-2 px-3 md:p-0 rounded-sm hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700">Contato</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

    <div id="meusArquivos" class="w-4xl bg-white mx-auto rounded-md p-5 mb-5">
        
        <h1 class="text-xl text-[#6161db] font-bold mb-6">Meus Arquivos</h1>
        
        <?php foreach ($arquivos as $arquivo): ?>
        <div class="w-[855px] bg-[#E0E0FA] mx-auto rounded-md flex justify-between items-center p-5 mb-4">
            <div class="flex">
                <div id="img" class="mr-7 text-2xl text-[#6161db]">
                    <?= $arquivo['tipo']['icon'] ?>
                </div>
                <div class="text-[#6161db]">
                    <p class="text-md font-bold"><?= $arquivo['nome'] ?></p>
                    <p class="text-sm"><?= $arquivo['tamanho'] ?> - <?= $arquivo['tipo']['mime'] ?></p>
                </div>
            </div>

            <a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </a>
        </div>
        <?php endforeach ?>

    </div>

    <footer class="text-center text-white my-8">
        <p>iLoveFiles - Projeto desenvolvido por Tífani Sá</p>
    </footer>

</body>
</html>