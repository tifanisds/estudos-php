<?php
require_once './funcoes/exibirComentarios.php';
gravarComentario();
?>

<form class="max-w-2xl mx-auto my-6" action="" method="post">
    <div class="mb-6">
        <label for="autor" class="block mb-2 text-lg font-medium text-purple-900">Autor</label>
        <input type="text" name="autor" id="autor" class="block w-full p-2 text-gray-900 border border-4 border-purple-300 rounded-lg bg-gray-50 text-xs">
    </div>
    <div class="mb-5">
        <label for="comentario" class="block mb-2 text-lg font-medium text-purple-900">Comentário</label>
        <input type="text" name="comentario" id="comentario" class="block w-full p-4 text-gray-900 border border-4 border-purple-300 rounded-lg bg-gray-50 text-base">
    </div>
    <button type="submit" class="text-white bg-purple-700 hover:bg-purple-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-5 py-2.5 text-center">Submit</button>
</form>
