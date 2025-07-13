<?php
include 'conexao.php';

$busca = $_GET['busca'] ?? null;

$sql = "
    SELECT pessoas.id, pessoas.nome, pessoas.cidade, pessoas.profissao, formacao.inicio
    FROM pessoas
    JOIN experiencias ON experiencias.pessoa_id = pessoas.id
    JOIN formacao ON formacao.pessoa_id = pessoas.id
    WHERE pessoas.nome LIKE :busca OR pessoas.profissao LIKE :busca OR pessoas.cidade LIKE :busca OR pessoas.estado LIKE :busca
    ";              

$stmt = $pdo->prepare($sql);
$stmt->execute([':busca' => "%$busca%"]);
$pessoas = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalentConect</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>

<body class="bg-gray-100 flex flex-col items-center">
    <nav class="flex justify-around py-5 shadow-[0_4px_4px_-2px_rgba(0,0,0,0.3)] bg-white w-full mb-11">
        <h1 class="text-2xl font-bold text-sky-700">TalentConect</h1>
        <ul class="flex">
            <li class="mx-4 text-gray-600 font-semibold"><a href="novoCurriculo.php">Cadastre-se</a></li>
            <li class="mx-4 text-gray-600 font-semibold"><a href="#">Empresas</a></li>
            <li class="mx-4 text-gray-600 font-semibold"><a href="#">Vagas</a></li>
            <li class="mx-4 text-gray-600 font-semibold"><a href="#">Insights</a></li>
            <li class="mx-4 text-gray-600 font-semibold"><a href="#">Soluções</a></li>
        </ul>
    </nav>

    <div id="filter" class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-7">
        <form action="" method="get" class="flex justify-between">
            <input type="text" name="busca" id="busca" class="rounded-sm border-1 border-gray-200 w-[770px] pl-4 py-2" placeholder="Buscar por nome, profissão ou região">
            <button type="submit" class="bg-sky-700 text-white py-2 px-4 rounded-sm">Buscar</button>
        </form>
    </div>

    <?php foreach ($pessoas as $pessoa): ?>
        <div id="listagem" class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5">
            <div id="curriculo" class="flex justify-between items-center my-3">
                <ul>
                    <li class="flex mb-1">
                        <i class="bi bi-person-fill mr-2"></i>
                        <p><?= htmlspecialchars($pessoa['nome']) ?></p>
                    </li>
                    <li class="flex mb-1">
                        <i class="bi bi-briefcase-fill mr-2"></i>
                        <p><?= htmlspecialchars($pessoa['profissao']) ?></p>
                    </li>
                    <li class="flex mb-1">
                        <i class="bi bi-geo-alt-fill mr-2"></i>
                        <p><?= htmlspecialchars($pessoa['cidade']) ?></p>
                    </li>
                </ul>

                <a href="curriculo.php?id=<?= $pessoa['id'] ?>" class="bg-sky-700 text-white py-2 px-4 rounded-sm">Ver Currículo</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
</body>

</html>