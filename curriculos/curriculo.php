<?php
    include 'conexao.php';

    $id = $_GET['id'] ?? null;

    if ($id !== null) {
        $sql = '
            SELECT *
            FROM pessoas
            JOIN experiencias ON experiencias.pessoa_id = pessoas.id
            JOIN formacao ON formacao.pessoa_id = pessoas.id
            WHERE pessoas.id = :id
        ';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);

        $pessoa = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        echo "Não foi possivel concluir a consulta.";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Curriculo</title>
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

    <div id="info" class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-3">
        <div>
            <h1><?= htmlspecialchars($pessoa['nome']) ?></h1>
            <h2><?= htmlspecialchars($pessoa['profissao']) ?></h2>
            <p><?= htmlspecialchars($pessoa['cidade']) ?>, <?= htmlspecialchars($pessoa['estado']) ?></p>
        </div>

        <div>
            <div class="flex">
                <i class="bi bi-envelope-fill mr-2"></i>
                <p><?= htmlspecialchars($pessoa['email']) ?></p>
            </div>
            <div class="flex">
                <i class="bi bi-telephone-fill mr-2"></i>
                <p><?= htmlspecialchars($pessoa['telefone']) ?></p>
            </div>
        </div>
    </div>

    <div id="formacao" class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-3">
        <div class="flex text-gray-800 mb-3">
            <i class="bi bi-mortarboard-fill mr-2 text-xl"></i>
            <p class="text-xl font-semibold">Formações Acadêmicas</p>
        </div>

        <div>
            <p class="text-lg font-semibold text-gray-700"><?= htmlspecialchars($pessoa['curso']) ?></p>
            <p class="text-base font-semibold text-green-700 mb-2"><?= htmlspecialchars($pessoa['instituicao']) ?></p>
            <div class="flex">
                <i class="bi bi-calendar3 mr-2"></i>
                <p><?= htmlspecialchars($pessoa['inicio']) ?> até <?= htmlspecialchars($pessoa['fim']) ?></p>
            </div>
        </div>
    </div>

    <div id="experiencia" class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5">
        <div class="flex text-gray-800 mb-3">
            <i class="bi bi-briefcase-fill mr-2 text-lg"></i>
            <p class="text-xl font-semibold">Experiências Profissionais</p>
        </div>

        <div>
            <p class="text-lg font-semibold text-gray-700"><?= htmlspecialchars($pessoa['cargo']) ?></p>
            <p class="text-base font-semibold text-blue-700 mb-2"><?= htmlspecialchars($pessoa['empresa']) ?></p>
            <div class="flex">
                <i class="bi bi-calendar3 mr-2"></i>
                <p><?= htmlspecialchars($pessoa['entrada']) ?> até <?= htmlspecialchars($pessoa['saida']) ?></p>
            </div>
            <p class="text-gray-600"><?= htmlspecialchars($pessoa['descricao_emprego']) ?></p>
        </div>
    </div>
</body>
</html>