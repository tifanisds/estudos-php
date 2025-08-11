# Introdução à Programação Orientada a Objetos (POO)

A **Programação Orientada a Objetos (POO)** é um **paradigma de programação** baseado no conceito de **"objetos"**, que são estruturas que **combinam dados (atributos)** e **comportamentos (métodos)**.

Esses objetos representam **elementos do mundo real** dentro do código — como uma pessoa, um carro, um produto, etc.

## Diferença entre Paradigmas

| Paradigma                     | Foco Principal                  | Organização do Código             | 
| ----------------------------- | -------------------------------- | ---------------------------------- | 
| **Procedural (estruturado)**  | Passos sequenciais e funções     | Código linear, com funções         | 
| **Orientado a Objetos (POO)** | Objetos com dados + comportamentos| Código dividido em classes/objetos | 
| **Funcional**                 | Funções puras e imutabilidade    | Código baseado em funções puras    | 

---

## Fundamentos da POO

### 1. Classes e Objetos
- **Classe**: um **molde** que define atributos (características) e métodos (ações).
- **Objeto**: uma **instância** de uma classe, ou seja, algo concreto criado a partir do molde.

```php
class Pessoa {
    public $nome;
    public $idade;

    public function apresentar() {
        echo "Olá, meu nome é $this->nome e tenho $this->idade anos.";
    }
}

$tifani = new Pessoa();
$tifani->nome = "Tifani";
$tifani->idade = 19;
$tifani->apresentar();
```

### 2. Atributos e Métodos
- **Atributos**: Variáveis que guardam dados do objeto.
- **Métodos**: Funções que definem ações do objeto.

```php
class Carro {
    public $marca;
    public $velocidade = 0;

    public function acelerar($valor) {
        $this->velocidade += $valor;
        echo "Velocidade atual: $this->velocidade km/h";
    }
}

$carro = new Carro();
$carro->marca = "Fiat";
$carro->acelerar(20);
```

### 3. Construtor e Destrutor
- **Construtor (__construct)**: executa automaticamente ao criar um objeto.
- **Destrutor (__destruct)**: executa automaticamente quando o objeto é destruído.

```php
class Pessoa {
    public $nome;
    public $idade;

    public function __construct($nome, $idade) {
        $this->nome = $nome;
        $this->idade = $idade;
        echo "Pessoa criada: $this->nome, $this->idade anos\n";
    }

    public function __destruct() {
        echo "Objeto destruído.";
    }
}

$p = new Pessoa("Tifani", 19);
```
