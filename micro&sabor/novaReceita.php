<?php
    include 'conexao.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $mostrarAlerta = false;

        if ($_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
            $pastaUploads = 'images/uploads/';
            $nomeArquivo = basename($_FILES['imagem']['name']);
            $caminhoCompleto = $pastaUploads . $nomeArquivo;

            if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoCompleto)) {
                $stmt = $pdo->prepare("INSERT INTO imagens (nome, caminho) VALUES (:nome, :caminho)");
                $stmt->execute([
                ':nome' => $nomeArquivo,
                ':caminho' => $caminhoCompleto
            ]);

            $imagemId = $pdo->lastInsertId();

            $nome = $_POST['nome'] ?? null;
            $descricao = $_POST['descricao'] ?? null;
            $tempo_de_preparo = $_POST['tempo_de_preparo'] ?? null;
            $ingredientes = $_POST['ingredientes'] ?? null;
            $preparo = $_POST['preparo'] ?? null;

            if ($nome && $descricao && $tempo_de_preparo && $ingredientes && $preparo) {
                $sqlReceita = "INSERT INTO receitas (imagem_id, nome, descricao, tempo_de_preparo, ingredientes, preparo) VALUES (:imagem_id, :nome, :descricao, :tempo_de_preparo, :ingredientes, :preparo)";
                $stmt = $pdo->prepare($sqlReceita);
                $stmt->execute([
                    ':imagem_id' => $imagemId,
                    ':nome' => $nome,
                    ':descricao' => $descricao,
                    ':tempo_de_preparo' => $tempo_de_preparo,
                    ':ingredientes' => $ingredientes,
                    ':preparo' => $preparo,
                ]);
                    
                }

                $mostrarAlerta = true;

            } else {
                echo "Erro ao mover arquivo.";
            }
        
    } else {
        echo "Erro no upload.";
    }
    }  
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Micro&Sabor</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/qr36agfguyfv88u2cf93z3ls4uct5os0d862tx837d1vjevi/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: 'textarea',
        plugins: [
        // Core editing features
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        // Your account includes a free trial of TinyMCE premium features
        // Try the most popular premium features until Jul 30, 2025:
        'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
        ],
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
        tinycomments_mode: 'embedded',
        tinycomments_author: 'Author name',
        mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
        ],
        ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
    });
    </script>
</head>
<body class="bg-[#180900] px-6 md:px-30">
    <nav class="flex items-center justify-between mb-10 relative md:mb-30">
        <div id="logomarca">
            <img src="./images/logomarca.png" alt="" class="w-25 mt-6 md:w-30">
        </div>

        <button id="menu-toggle" class="md:hidden text-[#BFA78F] text-3xl focus:outline-none">
            <i class="bi bi-list"></i>
        </button>

        <ul id="menu" class="hidden md:flex flex-col md:flex-row md:static top-16 right-4 bg-[#3d2b21] md:bg-transparent p-4 md:p-0 rounded shadow-md md:shadow-none text-[#BFA78F] font-semibold items-start md:items-center text-sm z-50">
            <li class="mx-2 my-1 md:my-0 md:text-lg"><a href="./novaReceita.php">Envie a sua receita</a></li>
            <li class="mx-2 my-1 md:my-0 md:text-lg"><a href="#">Sobre nós</a></li>
            <li class="mx-2 my-1 md:my-0 md:text-lg"><a href="#">Contato</a></li>
        </ul>
    </nav>

    <div class="flex items-center p-4 mb-4 text-md rounded-lg bg-gray-200/20 text-green-400 mb-10 <?php echo $mostrarAlerta ? 'block' : 'hidden'; ?>" role="alert">
        <p class="mx-auto">
            Sua receita foi cadastrada com <span class="font-medium">sucesso</span>.
        </p>
    </div>


    <form action="" method="post" enctype="multipart/form-data" class="flex flex-col items-center">
        <h1 class="text-[#BFA78F] text-center text-3xl font-semibold mb-6">Cadastre uma <br>nova receita aqui</h1>

        <label for="imagem" class="text-gray-300 text-lg w-full text-start">Imagem da receita</label>
        <input type="file" name="imagem" class="w-full rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" required>

        <label for="nome" class="text-gray-300 text-lg w-full text-start">Nome da receita</label>
        <input type="text" name="nome" id="nome" class="w-full rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" placeholder="Ex: Brigadeiro" required>
    
        <label for="descricao" class="text-gray-300 text-lg w-full text-start">Descrição da receita</label>
        <input type="text" name="descricao" id="descricao" class="w-full rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" placeholder="Escreva uma descrição sobre a sua receita" required>
    
        <label for="tempo_de_preparo" class="text-gray-300 text-lg w-full text-start">Tempo de preparo da receita em minutos</label>
        <input type="text" name="tempo_de_preparo" id="tempo_de_preparo" class="w-full rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" placeholder="Ex: 10" required>
    
        <label for="ingredientes" class="text-gray-300 text-lg w-full text-start">Ingredientes da receita</label>
        <input type="text" name="ingredientes" id="ingredientes" class="w-full rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" placeholder="Ex: Ovos, Leite, Queijo" required>
    
        <label for="preparo" class="text-gray-300 text-lg w-full text-start">Preparo da receita</label>
        <textarea name="preparo" id="preparo" class="rounded-lg border-1 border-gray-200 pl-4 py-2 mb-9 mt-2 text-white w-[90%] md:text-lg" placeholder="Descreva a forma de preparo da sua receita"></textarea>

        <button type="submit" class="bg-[#BFA78F] text-gray-900 py-2 px-4 mt-9 rounded-lg font-semibold md:text-lg">Enviar</button>
    </form>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>