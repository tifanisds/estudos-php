<?php

    include 'conexao.php';

    $busca = $_GET['busca'] ?? null;

    $sql = "
        SELECT receitas.id, receitas.imagem_id, receitas.nome, receitas.descricao, imagens.caminho
        FROM receitas
        JOIN imagens ON receitas.imagem_id = imagens.id
        WHERE receitas.nome LIKE :busca
    ";


    $stmt = $pdo->prepare($sql);
    $stmt->execute([':busca' => "%$busca%"]);
    $receitas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <nav class="flex items-center justify-between mb-10 relative md:mb-20">
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

    <div id="banner" class="flex relative overflow-hidden h-80 items-center mb-6 md:overflow-visible md:static md:mb-30">
        <div>
            <h1 class="text-[#BFA78F] font-bold text-4xl mb-4 text-center md:w-[80%] md:text-start lg:text-5xl">Micro & Sabor: Receitas Rápidas, Sabores Incríveis</h1>
            <h2 class="text-[#BFA78F] font-semibold text-xl text-center md:w-[80%] md:text-start lg:text-2xl">Descubra pratos prontos em minutos, direto do micro-ondas para a sua mesa</h2>
        </div>

        <img src="./images/main-image.png" alt="" class="absolute inset-0 w-full h-full object-cover opacity-25 -z-10 md:static md:opacity-90 md:h-auto md:w-100 lg:w-130">
    </div>

    <div id="busca" class="mb-8">
        <form action="" method="get" class="flex justify-between">
            <input type="text" name="busca" id="busca" class="rounded-lg border-1 border-gray-200 pl-4 py-2 text-white w-[90%] mr-4 md:text-lg" placeholder="Buscar pelo nome da receita">
            <button type="submit" class="bg-[#BFA78F] text-gray-900 py-2 px-4 rounded-lg font-semibold md:text-lg">Buscar</button>
        </form>
    </div>

    <div id="receitas" class="grid grid-cols-1 md:grid-cols-3 md:gap-8">
        <?php foreach ($receitas as $receita): ?>
            <div class="w-full bg-gray-300/20 mx-auto rounded-lg mb-4 p-4 flex flex-col items-center text-center md:p-6">
                <img src="<?= htmlspecialchars($receita['caminho']) ?>" alt="" class="rounded-lg mb-4">
                <p class="text-2xl font-bold text-[#BFA78F]"><?= htmlspecialchars($receita['nome']) ?></p>
                <p class="mb-6 text-gray-300 text-md"><?= htmlspecialchars($receita['descricao']) ?></p>
                <a href="./verReceita.php?id=<?= $receita['id'] ?>" class="bg-[#BFA78F] text-gray-900 py-2 px-4 rounded-lg font-semibold md:text-lg">Ver receita</a>
            </div>
        <?php endforeach; ?>
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