<?php
class Vela {
    public $nameVela;
    public $precoVela;
    private static $produtos = []; // Array estático para armazenar os produtos

    function __construct($nameVela, $precoVela) {
        $this->nameVela = $nameVela;
        $this->precoVela = $precoVela;

        // Adiciona o novo produto ao array
        $this->adicionarProduto();
    }

    private function adicionarProduto() {
        self::$produtos[] = [
            "id" => count(self::$produtos) + 1, // Incrementa o ID baseado no tamanho do array
            "nome" => $this->nameVela,
            "preco" => $this->precoVela,
            "descricao" => "Cheirosa igual você, meu dengo",
            "imagem" => "./img/coleçoes/lavanda/vela lavanda.jpg" // Usar imagem específica
        ];
    }

    public static function listarProdutos() {
        return self::$produtos; // Retorna o array de produtos
    }

    public static function exibirProdutos() {
        $produtos = self::listarProdutos();
        echo "<div class='row justify-content-center'>"; 
        foreach ($produtos as $produto) {
            echo "<div class='col-6 col-md-3 mb-3 d-flex'>"; // Ajustado para 3 por linha em telas médias
            echo "<div class='card position-relative' style='width: 100%;'>";
            echo "<img src='{$produto['imagem']}' class='card-img-top' alt='Imagem do Card'>";
            echo "<div class='details-button'>";
            echo "<button class='btn btn-primary' style='background-color: #5c1163; border: #310735;'>Detalhes</button>";
            echo "</div>";
            echo "<div class='product-info'>";
            echo "<h5 class='card-title'>{$produto['nome']}</h5>";
            echo "<p class='font-weight-bold'>R$ " . number_format($produto['preco'], 2, ',', '.') . "</p>";
            echo "<p class='text-muted'>{$produto['descricao']}</p>";
            echo "</div>";
            echo "</div>"; // Fecha o card
            echo "</div>"; // Fecha a coluna
        }
        echo "</div>"; // Fecha a linha
    }
    
    
}    

// Criando objetos de vela
new Vela("Lavanda", 69.90);
new Vela("Cítrico", 95.00);
new Vela("Cítrico", 95.00);




?>
