# Pilares da Programação Orientada a Objetos (POO)
---

## 1. Abstração

A **abstração** na POO é a capacidade de **ocultar detalhes irrelevantes ou complexos** de um problema e focar nos aspectos essenciais.

Ela é implementada por meio de **classes**, que descrevem os atributos e comportamentos comuns de um grupo de objetos.

Exemplo: a classe `Animal` pode ter atributos como `nome`, `espécie`, `idade` e métodos como `comer()` e `dormir()`.

```php
<?php
// Classe abstrata: define o que todo pagamento deve fazer
abstract class Pagamento {
    abstract public function pagar($valor);
}

// Cada classe implementa o pagamento de forma diferente
class PagamentoCartao extends Pagamento {
    public function pagar($valor) {
        echo "Pagando R$ $valor com Cartão de Crédito.\n";
    }
}

class PagamentoPIX extends Pagamento {
    public function pagar($valor) {
        echo "Pagando R$ $valor via PIX.\n";
    }
}

class PagamentoBoleto extends Pagamento {
    public function pagar($valor) {
        echo "Pagando R$ $valor com Boleto Bancário.\n";
    }
}

// Código principal: só se importa em pagar, não como
function processarPagamento(Pagamento $pagamento, $valor) {
    $pagamento->pagar($valor);
}

// Testando
processarPagamento(new PagamentoPIX(), 100);
processarPagamento(new PagamentoCartao(), 200);
```

---

## 2. Encapsulamento
O **encapsulamento** é o conceito de proteger os dados internos de um objeto, controlando quem pode acessá-los ou modificá-los.

```php
class ContaBancaria {
    public $saldo = 0;  
}

$conta = new ContaBancaria();
$conta->saldo = 200000; // Modificação indevida do atributo
```

Se os atributos ficarem públicos, qualquer parte do código poderá modificá-los de forma errada.  
Para evitar isso, usamos **modificadores de acesso**:

| Modificador | Onde pode ser acessado? | Uso comum |
| ----------- | ----------------------- | --------- |
| `public`    | Em qualquer lugar        | Métodos e atributos que podem ser acessados livremente |
| `private`   | Apenas dentro da própria classe | Para proteger totalmente os dados internos |
| `protected` | Dentro da própria classe e subclasses | Quando subclasses precisam acessar atributos/métodos herdados |

---

## 3. Herança

A **herança** permite que uma classe filha (subclasse) herde atributos e métodos de uma classe pai (superclasse).

```php
class Animal {
    public function emitirSom() {
        echo "Algum som genérico.\n";
    }
}

class Cachorro extends Animal {
    public function emitirSom() {
        echo "Latido: au au!\n";
    }
}

class Gato extends Animal {
    public function emitirSom() {
        echo "Miado: miau!\n";
    }
}

$dog = new Cachorro();
$cat = new Gato();

$dog->emitirSom(); // Latido: au au!
$cat->emitirSom(); // Miado: miau!
```

---

## 4. Polimorfismo

O **polimorfismo** significa “muitas formas”.  
Na POO, ele permite que **um mesmo método tenha comportamentos diferentes** dependendo do objeto.

Reaproveitando o exemplo anterior:

```php
function fazerEmitirSom(Animal $animal) {
    $animal->emitirSom();
}

fazerEmitirSom(new Cachorro()); // Latido: au au!
fazerEmitirSom(new Gato());     // Miado: miau!
```

A função **fazerEmitirSom()** chama o mesmo método **emitirSom()**,
mas o resultado varia conforme o tipo de objeto recebido.