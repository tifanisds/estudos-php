<?php

/*Exercicio 1

Crie uma classe chamada `Pessoa` com os seguintes atributos:
- nome
- idade
E os seguintes métodos:

- `apresentar()`: imprime na tela o nome e a idade da pessoa.*/

class Pessoa {
  public $nome;
  public $idade;

  public function apresentar() {
    echo "Olá meu nome é $this->nome. E eu tenho $this->idade anos";
  }
}

$tifani = new Pessoa();
$tifani->nome = "Tífani";
$tifani->idade = 19;
$tifani->apresentar();

// Com o construct

class Pessoa {
  private $nome;
  private $idade;

  public function __construct($nome, $idade) {
    $this->nome = $nome;
    $this->idade = $idade;
  }

  public function apresentar() {
    echo "Olá meu nome é $this->nome. E eu tenho $this->idade anos";
  }
}

$tifani = new Pessoa('tifani', 19);
$tifani->apresentar();

/*Exercicio 2
    Crie uma classe `ContaBancaria` com:
    - Atributos privados: `titular`, `saldo`
    - Métodos públicos:
        - `depositar($valor)`
        - `sacar($valor)`
        - `verSaldo()`

    **Regras:**
    - Não é possível sacar mais do que o saldo disponível.
    - O saldo só pode ser acessado pelo método `verSaldo()`.
*/

class ContaBancaria {
  private $saldo = 0;
  private $titular;

  public function __construct($titular) {
    $this->titular = $titular;
  }

  public function depositar($valor) {
    $this->saldo += $valor;
    echo "Deposito feito com sucesso, $this->titular!";
  }

  public function verSaldo() {
    echo "Saldo atual: {$this->saldo}";
  }

  public function sacar($valor) {
    if ($this->saldo - $valor < 0) {
      echo "Não é possível sacar esse valor, $this->titular!";
    } else {
      $this->saldo -= $valor;
      echo "Saque feito com sucesso, $this->titular!";
    }
  }
}

$conta = new ContaBancaria('Tifani');
$conta->depositar(20);
$conta->sacar(21);
$conta->verSaldo();


/*Exercicio 3
**Enunciado:**

Crie uma classe `Aluno` e uma classe `Curso`.

- Um aluno pode estar matriculado em um curso.
- A classe `Aluno` deve ter um atributo `$curso`, que é um objeto da classe `Curso`.
- Crie um método `mostrarInformacoes()` que exibe o nome do aluno e o nome do curso em que ele está matriculado.
*/
class Curso {
  private $nome;

  public function __construct($nome) {
    $this->nome = $nome;
    echo "Curso $this->nome cadastrado com sucesso.";
  }

  public function obterNome() {
    return $this->nome;
  }
}

class Aluno {
  private $nome;
  private $curso;

  public function __construct($nome, $curso) {
    $this->nome = $nome;
    $this->curso = $curso;
    echo "Aluno $this->nome cadastrado com sucesso.";
  }

  public function exibirInformacoes() {
    echo "Aluno: $this->nome";
    echo "Curso: {$this->curso->obterNome()}"; 
  }
}

$sistemasDeInformacao = new Curso('Sistemas de informação');
$tifani = new Aluno('Tífani', $sistemasDeInformacao);
$tifani->exibirInformacoes();

/*Exercicio 4
Crie uma classe `Carro` que contém um `Motor`.

- A classe `Motor` deve ter um método `ligar()`.
- A classe `Carro` deve criar o `Motor` internamente e chamar `ligar()` quando o método `ligarCarro()` for chamado.
*/
class Motor {
  private $motorLigado = false;
  
  public function ligarMotor() {
    $this->motorLigado = true;
    return $this->motorLigado;
  }
  
  public function desligarMotor() {
    $this->motorLigado = false;
    return $this->motorLigado;
  }
}

class Carro {
  private $modelo;
  private $motor;

  public function __construct($nome, $motor) {
    $this->modelo = $nome;
    $this->motor = $motor;
  }

  public function ligarCarro() {
    
    if ($this->motor->ligarMotor()) {
      echo "O carro está ligado";
      exit;
    }

    echo "Não foi possível ligar o carro";
  }
  
  public function desligarCarro() {
    
    if ($this->motor->desligarMotor() == false) {
      echo "O carro está desligado";
      exit;
    }

    echo "Não foi possível desligar o carro";
  }
}

$motor = new Motor;
$palio = new Carro('Palio', $motor);
$palio->ligarCarro();


/*Exercicio 5
Crie uma classe `Funcionario` com os atributos:

- nome
- salario

Crie uma subclasse chamada `Gerente`, que herda de `Funcionario`, mas tem também um atributo extra: `departamento`.

Implemente um método `exibirInformacoes()` que mostre todos os dados.
*/

abstract class Funcionario {
  protected $nome;
  protected $salario;
  
}

class Gerente extends Funcionario {
  private $departamento;
  
  public function __construct($nome, $salario, $departamento) {
    $this->nome = $nome;
    $this->salario = $salario;
    $this->departamento = $departamento;
  }

  public function mostrarInformacao() {
    echo "Nome: $this->nome";
    echo "Salario: $this->salario";
    echo "Departamento: $this->departamento";
  }
}

$gerente = new Gerente("Carlos", 5800, "Administração");
$gerente->mostrarInformacao();

/*Exercicio 6
Use as classes do exercício anterior.

- Adicione um método `calcularBonificacao()`:
    - Para um `Funcionario`, o bônus é 10% do salário.
    - Para um `Gerente`, o bônus é 30% do salário.
*/

class Funcionario {
	protected $bonificacao = 0.1;
  protected $nome;
  public $salario;

  public function calcularBonificacao() {
    $this->salario += $this->bonificacao * $this->salario; 
  }
}

class Gerente extends Funcionario {
  private $departamento;
	private $bonificacao = 0.3;

  public function __construct($nome, $salario, $departamento) {
    $this->nome = $nome;
    $this->salario = $salario;
    $this->departamento = $departamento;
  }

  public function mostrarInformacao() {
    echo "Nome: $this->nome";
    echo "Salario: $this->salario";
    echo "Departamento: $this->departamento";
  }
}

$gerente = new Gerente("Carlos", 700, "Administração");
$gerente->calcularBonificacao();
$gerente->mostrarInformacao();