<?php
    include 'conexao.php';

    $id = $_GET['id'];
    $mostrarAlerta = false;

    if ($id !== null) {
        $verificaSQL = "SELECT 1 FROM receitas WHERE id = :id LIMIT 1";
        $verificaStmt = $pdo->prepare($verificaSQL);
        $verificaStmt->execute(['id' => $id]);

        if ($verificaStmt->fetch()) {
            $sql = "
                SELECT receitas.nome, receitas.descricao, receitas.tempo_de_preparo, receitas.ingredientes, receitas.preparo, imagens.caminho 
                FROM receitas
                JOIN imagens ON receitas.imagem_id = imagens.id
                WHERE imagens.id = :id
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute(['id' => $id]);

            $receitas = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $mostrarAlerta = true;
        }

    } else {
        $mostrarAlerta = true;
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

    <div class="flex items-center p-4 mb-4 text-md rounded-lg bg-gray-200/20 text-red-400 <?php echo $mostrarAlerta ? 'block' : 'hidden'?>" role="alert">
        <p class="mx-auto">
            <span class="font-medium">AVISO!</span> Não foi possível concluir a sua consulta.
        </p>
    </div>


    <div class="<?php echo $mostrarAlerta ? 'hidden' : 'block'; ?>">
        <div id="receita" class="md:mb-30">
            <div class="flex flex-col relative overflow-hidden h-64 items-center justify-center mb-6 md:overflow-visible md:static md:mb-30 md:flex-row md:justify-between">
                <img src="<?= htmlspecialchars($receitas['caminho']) ?>" alt="" class="mx-auto w-[70%] rounded-full absolute inset-0 object-cover opacity-30 -z-10 md:static md:opacity-90 md:h-auto md:w-70 md:mx-0 lg:w-100">
                <div class="flex flex-col md:items-end">
                    <h1 class="text-[#BFA78F] font-bold text-4xl text-center md:text-6xl md:text-end"><?= htmlspecialchars($receitas['nome']) ?></h1>
                    <h2 class="text-[#BFA78F] font-semibold text-xl text-center md:text-2xl md:mb-5 md:text-end"><?= htmlspecialchars($receitas['descricao']) ?></h2>
                    <p class="text-md font-semibold text-[#BFA78F] text-center md:text-lg md:p-3 md:bg-gray-300/20 md:w-[30%] md:rounded-xl">Pronto em: <?= htmlspecialchars($receitas['tempo_de_preparo']) ?> minutos</p>
                </div>
            </div>
        </div>

        <div id="ingredientes" class="w-full bg-gray-300/20 mx-auto rounded-lg mb-4 p-4 flex flex-col items-center text-center">
            <div class="flex text-lg font-bold text-[#BFA78F] md:text-3xl md:mb-2">
                <i class="bi bi-basket mr-2"></i>
                <p>Ingredientes</p>
            </div>
            <p class="text-md font-semibold text-[#BFA78F] mb-6 md:text-xl md:mb-12"><?= htmlspecialchars($receitas['ingredientes']) ?></p>

            <div class="flex text-lg font-bold text-[#BFA78F] md:text-3xl md:mb-2">
                <i class="bi bi-cake2-fill mr-2"></i>
                <p>Modo de preparo</p>
            </div>
            <div class="text-md font-semibold text-[#BFA78F] mb-4 md:text-xl"><?= $receitas['preparo'] ?></div>
        </div>
    </div>

    <script>
        const toggle = document.getElementById('menu-toggle');
        const menu = document.getElementById('menu');

        toggle.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>