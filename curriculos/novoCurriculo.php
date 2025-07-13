<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'conexao.php';

    $nome = $_POST['nome'] ?? null;
    $profissao = $_POST['profissao'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefone = $_POST['telefone'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $cidade = $_POST['cidade'] ?? null;

    $empresa = $_POST['empresa'] ?? null;
    $cargo = $_POST['cargo'] ?? null;
    $entrada = $_POST['entrada'] ?? null;
    $saida = $_POST['saida'] ?? null;
    $descricao_emprego = $_POST['descricao_emprego'] ?? null;

    $curso = $_POST['curso'] ?? null;
    $instituicao = $_POST['instituicao'] ?? null;
    $inicio = $_POST['inicio'] ?? null;
    $fim = $_POST['fim'] ?? null;

    if ($nome && $email && $curso && $empresa) {
        $sqlPessoas = 'INSERT INTO pessoas (nome, profissao, email, telefone, estado, cidade)
                       VALUES (:nome, :profissao, :email, :telefone, :estado, :cidade)';
        $stmt = $pdo->prepare($sqlPessoas);
        $stmt->execute([
            ':nome' => $nome,
            ':profissao' => $profissao,
            ':email' => $email,
            ':telefone' => $telefone,
            ':estado' => $estado,
            ':cidade' => $cidade,
        ]);

        $pessoa_id = $pdo->lastInsertId();

        $sqlExperiencia = 'INSERT INTO experiencias (pessoa_id, empresa, cargo, entrada, saida, descricao_emprego)
                           VALUES (:pessoa_id, :empresa, :cargo, :entrada, :saida, :descricao_emprego)';
        $stmt = $pdo->prepare($sqlExperiencia);
        $stmt->execute([
            ':pessoa_id' => $pessoa_id,
            ':empresa' => $empresa,
            ':cargo' => $cargo,
            ':entrada' => $entrada,
            ':saida' => $saida,
            ':descricao_emprego' => $descricao_emprego,
        ]);

        $sqlFormacao = 'INSERT INTO formacao (pessoa_id, curso, instituicao, inicio, fim)
                        VALUES (:pessoa_id, :curso, :instituicao, :inicio, :fim)';
        $stmt = $pdo->prepare($sqlFormacao);
        $stmt->execute([
            ':pessoa_id' => $pessoa_id,
            ':curso' => $curso,
            ':instituicao' => $instituicao,
            ':inicio' => $inicio,
            ':fim' => $fim,
        ]);
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de novo currículo</title>
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

    <form action="" method="post">
        <div class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-5">
            <div class="flex">
                <i class="bi bi-person-fill text-2xl mr-2"></i>
                <p class="text-2xl font-semibold">Dados Pessoais</p>
            </div>
            <p class="text-base text-gray-600 mb-5">Vamos começar com suas informações e dados de contato</p>

            <label for="nome">Nome completo*</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="profissao">Profissão*</label>
            <input type="text" name="profissao" id="profissao" placeholder="Ex: Desenvolvedor Full Stack" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="email">Email*</label>
            <input type="text" name="email" id="email" placeholder="seu.email@exemplo.com" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="telefone">Telefone*</label>
            <input type="text" name="telefone" id="telefone" placeholder="(11) 99999-9999" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <div class="flex items-center">
                <div class="flex flex-col mr-6">
                    <label for="estado">Estado*</label>
                    <input type="text" name="estado" id="estado" placeholder="Digite estado. Ex: BA" required class="w-full border-1 border-gray-200 p-3 mb-6">
                </div>

                <div class="flex flex-col">
                    <label for="cidade">Cidade*</label>
                    <input type="text" name="cidade" id="cidade" placeholder="Digite sua cidade" required class="w-full border-1 border-gray-200 p-3 mb-6">
                </div>
            </div>
        </div>

        <div class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-3">
            <div class="flex">
                <i class="bi bi-briefcase-fill text-2xl mr-2"></i>
                <p class="text-2xl font-semibold">Experiência</p>
            </div>
            <p class="text-base text-gray-600 mb-5">Conte-nos sobre sua experiência profissional e principais conquistas.</p>

            <label for="empresa">Empresa*</label>
            <input type="text" name="empresa" id="empresa" placeholder="Nome da empresa" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="cargo">Cargo*</label>
            <input type="text" name="cargo" id="cargo" placeholder="Seu cargo na empresa" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="entrada">Data de entrada*</label>
            <input type="date" name="entrada" id="entrada" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="saida">Data de saída*</label>
            <input type="date" name="saida" id="saida" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="descricao_emprego">Descrição*</label>
            <textarea type="text" name="descricao" id="descricao_emprego" placeholder="Digite seu nome completo" required class="w-full border-1 border-gray-200 p-3 mb-6"></textarea>

        </div>

        <div class="bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-5">
            <div class="flex">
                <i class="bi bi-mortarboard-fill text-2xl mr-2"></i>
                <p class="text-2xl font-semibold">Formação</p>
            </div>
            <p class="text-base text-gray-600 mb-5">Vamos começar com suas informações e dados de contato</p>

            <label for="curso">Curso*</label>
            <input type="text" name="curso" id="curso" placeholder="Digite o nome do seu curso" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="instituicao">Instituição*</label>
            <input type="text" name="instituicao" id="instituicao" placeholder="Digite o nome da sua instituição de ensino" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="inicio">Data de inicio*</label>
            <input type="date" name="inicio" id="inicio" required class="w-full border-1 border-gray-200 p-3 mb-6">

            <label for="fim">Data de fim*</label>
            <input type="date" name="fim" id="fim" required class="w-full border-1 border-gray-200 p-3 mb-6">

        </div>

        <div class="flex justify-center bg-white w-[900px] border-1 border-gray-200 rounded-sm p-5 mb-5">
            <div class="mr-10">
                <p class="text-xl font-semibold">Tem certeza de que deseja enviar?</p>
                <p>Após o envio, o formulário não poderá ser alterado.</p>
            </div>
            <button type="submit" class="bg-sky-700 text-white px-5 rounded-sm">Enviar respostas</button>
        </div>  
    </form>
</body>
</html>