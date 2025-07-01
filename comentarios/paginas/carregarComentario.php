<div class="container bg-purple-400 max-w-2xl mx-auto mt-8 p-6 rounded-md">
    <h1 class="text-2xl text-purple-800 font-bold mb-6">Página de comentários</h1>

    <?php
    $comentarios = carregarComentarios();

    foreach ($comentarios as $comentario) {
        echo "<h2 class='text-lg font-bold text-purple-800 mt-5'>" . $comentario['autor'] . "</h2>";
        echo "<p class='text-base font-semibold text-purple-800 text-white mb-5'>" . $comentario['comentario'] . "</p>";
    }
    
    ?>
</div>