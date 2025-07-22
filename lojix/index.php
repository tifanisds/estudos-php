<?php
include 'conexao.php';

$busca = $_GET['busca'] ?? null;
$categoria = $_GET['categoria'] ?? null;
$fabricante = $_GET['fabricante'] ?? null;
$precoMin = $_GET['preco_min'] ?? null;
$precoMax = $_GET['preco_max'] ?? null;

$sqlProdutos = "SELECT produtos.nome AS produto, fabricantes.nome AS fabricante, produtos.preco
FROM produtos               
INNER JOIN fabricantes               
ON fabricantes.id = produtos.fabricantes_id
WHERE produtos.nome LIKE :busca
AND (:categoria IS NULL or produtos.categorias_id = :categoria)
AND (:fabricante IS NULL or produtos.fabricantes_id = :fabricante)";

$params = [
    ':busca' => '%' . $busca . '%',
    ':categoria' => $categoria,
    ':fabricante' => $fabricante,
];

if (!empty($precoMin) && is_numeric($precoMin)) {
    $sqlProdutos .= " AND produtos.preco >= :preco_min";
    $params[':preco_min'] = $precoMin;
}

if (!empty($precoMax) && is_numeric($precoMax)) {
    $sqlProdutos .= " AND produtos.preco <= :preco_max";
    $params[':preco_max'] = $precoMax;
}

$stmt = $pdo->prepare($sqlProdutos);
$stmt->execute($params);
$produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlCategorias = "SELECT nome, id FROM categorias";

$stmt = $pdo->prepare($sqlCategorias);
$stmt->execute();
$categorias = $stmt->fetchAll(PDO::FETCH_ASSOC);

$sqlFabricantes = "SELECT nome, id FROM fabricantes";

$stmt = $pdo->prepare($sqlFabricantes);
$stmt->execute();
$fabricantes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lojix - Loja de Eletrônicos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'lojix-blue': '#1e40af',
                        'lojix-dark': '#1f2937'
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg font-bold text-xl">
                        LOJIX
                    </div>
                    <div class="hidden md:flex space-x-6">
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Início</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Produtos</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Ofertas</a>
                        <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors">Contato</a>
                    </div>
                </div>
                <form method="get" action="./index.php" class="flex items-center space-x-4">
                    <div class="relative">
                        <input type="text" name="busca" id="busca" value="" placeholder="Buscar produtos..." 
                               class="w-64 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <button type="submit" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Carrinho (0)
                    </button>
                </form>
            </div>
        </div>
    </header>

    <div class="container mx-auto px-4 py-6">
        <div class="flex gap-6">
            <aside class="w-80 bg-white rounded-lg shadow-md p-6 h-fit sticky top-24">
                <form action="./index.php" method="get">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Filtros</h2>
                
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Categorias</h3>
                    <div class="space-y-3">
                        <?php foreach ($categorias as $categoria):?>
                            <label class="flex items-center">
                                <input type="radio" name="categoria" value="<?= htmlspecialchars($categoria['id'])?>" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                                <span class="text-gray-600"><?= htmlspecialchars($categoria['nome'])?></span>
                            </label>
                        <?php endforeach ?>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Fabricantes</h3>
                    <div class="space-y-3">
                        <?php foreach ($fabricantes as $fabricante): ?>
                        <label class="flex items-center">
                            <input type="radio" name="fabricante" value="<?= htmlspecialchars($fabricante['id'])?>" class="mr-3 rounded text-blue-600 focus:ring-blue-500">
                            <span class="text-gray-600"><?= htmlspecialchars($fabricante['nome'])?></span>
                        </label>
                        
                        <?php endforeach?>
                    </div>
                </div>

                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-700 mb-4">Faixa de Preço</h3>
                    <div class="space-y-3">
                        <select name="preco_min" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Preço minimo</option>
                            <option value="100">R$ 100</option>
                            <option value="500">R$ 500</option>
                            <option value="1000">R$ 1.000</option>
                            <option value="2000">R$ 2.000</option>
                            <option value="5000">R$ 5.000</option>
                        </select>
                        <select name="preco_max" class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option value="">Preço maximo</option>    
                            <option value="500">R$ 500</option>
                            <option value="1000">R$ 1.000</option>
                            <option value="2000">R$ 2.000</option>
                            <option value="5000">R$ 5.000</option>
                            <option value="10000">R$ 10.000</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                    Aplicar Filtros
                </button>
                <button class="w-full mt-3 border border-gray-300 text-gray-700 py-3 rounded-lg hover:bg-gray-50 transition-colors">
                    Limpar Filtros
                </button>
                </form>
            </aside>

            <main class="flex-1">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Produtos</h1>
                        <p class="text-gray-600 mt-1">Encontramos <?= count($produtos)?> produtos para você</p>
                    </div>
                    <div class="flex items-center space-x-4">
                        <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option>Ordenar por: Relevância</option>
                            <option>Menor preço</option>
                            <option>Maior preço</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($produtos as $produto): ?>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-800 mb-2 group-hover:text-blue-600 transition-colors">
                                    <?= htmlspecialchars($produto['produto']); ?>
                                </h3>
                                <p class="text-sm text-gray-600 mb-2"><?= htmlspecialchars($produto['fabricante']); ?></p>
                                <div class="flex items-center justify-between">
                                    <div>
                                        <p class="text-xl font-bold text-green-600">R$ <?= htmlspecialchars(number_format($produto['preco'], 2, '.', ',')); ?></p>
                                    </div>
                                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                        Comprar
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
                
                <?php if (count($produtos) == 0): ?>
                    <div class="p-4 mb-4 text-lg text-yellow-800 font-semibold rounded-lg bg-yellow-50 text-center" role="alert">
                        <span class="font-bold">Warning alert!</span> Change a few things up and try submitting again.
                    </div>
                <?php endif?>
            </main>
        </div>
    </div>

    <footer class="bg-gray-800 text-white mt-16">
        <div class="container mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-4 py-2 rounded-lg font-bold text-xl mb-4 w-fit">
                        LOJIX
                    </div>
                    <p class="text-gray-300">Sua loja de eletrônicos e variedades com os melhores produtos e preços do mercado.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Categorias</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Smartphones</a></li>
                        <li><a href="#" class="hover:text-white">Notebooks</a></li>
                        <li><a href="#" class="hover:text-white">Tablets</a></li>
                        <li><a href="#" class="hover:text-white">Acessórios</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Atendimento</h4>
                    <ul class="space-y-2 text-gray-300">
                        <li><a href="#" class="hover:text-white">Central de Ajuda</a></li>
                        <li><a href="#" class="hover:text-white">Fale Conosco</a></li>
                        <li><a href="#" class="hover:text-white">Trocas e Devoluções</a></li>
                        <li><a href="#" class="hover:text-white">Garantia</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contato</h4>
                    <div class="text-gray-300 space-y-2">
                        <p>📞 (71) 1234-5678</p>
                        <p>📧 contato@lojix.com.br</p>
                        <p>📍 Salvador - BA</p>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Lojix. Todos os direitos reservados.</p>
            </div>
        </div>
    </footer>
</body>
</html>