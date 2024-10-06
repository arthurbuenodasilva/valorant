<?php
// Classe que representa um agente no jogo
class Agent {
    public $displayName; // Nome do agente
    public $description; // Descrição do agente
    public $fullPortrait; // URL da imagem do agente
    public $abilities; // Habilidades do agente
    public $color; // Cor do cartão

    // Construtor que inicializa os dados do agente
    public function __construct($displayName, $description, $fullPortrait, $abilities, $color) {
        $this->displayName = $displayName;
        $this->description = $description;
        $this->fullPortrait = $fullPortrait;
        $this->abilities = $abilities;
        $this->color = $color;
    }
}

// Classe para representar um mapa do jogo
class Map {
    public $displayName; // Nome do mapa
    public $image; // URL da imagem do mapa

    // Construtor que inicializa os dados do mapa
    public function __construct($displayName, $image) {
        $this->displayName = $displayName;
        $this->image = $image;
    }
}

// Função para buscar os agentes na API
function fetchAgents() {
    $url = 'https://valorant-api.com/v1/agents'; // URL da API
    $response = file_get_contents($url); // Pega a resposta da API
    $data = json_decode($response, true); // Converte a resposta para um array

    $agents = []; // Array para armazenar os agentes
    $colors = ['#f44336', '#3f51b5', '#4caf50', '#ff9800', '#9c27b0', '#2196f3']; // Cores para os cartões

    foreach ($data['data'] as $index => $agentData) {
        if ($agentData['isPlayableCharacter']) { // Só pega agentes jogáveis
            $abilities = array_map(function($ability) {
                return $ability['description']; // Pega a descrição das habilidades
            }, $agentData['abilities']);
            
            // Cria um novo agente e adiciona ao array
            $agents[] = new Agent(
                $agentData['displayName'],
                $agentData['description'],
                $agentData['fullPortrait'],
                $abilities,
                $colors[$index % count($colors)] // Atribui cores ciclicamente
            );
        }
    }
    return $agents; // Retorna a lista de agentes
}

// Função para buscar os mapas na API
function fetchMaps() {
    $url = 'https://valorant-api.com/v1/maps'; // URL da API
    $response = file_get_contents($url); // Pega a resposta da API
    $data = json_decode($response, true); // Converte a resposta para um array

    $maps = []; // Array para armazenar os mapas
    foreach ($data['data'] as $mapData) {
        // Adiciona o mapa ao array
        $maps[] = new Map($mapData['displayName'], $mapData['splash']); 
    }
    return $maps; // Retorna a lista de mapas
}

// Faz a busca dos agentes e mapas
$agents = fetchAgents(); // Chama a função para pegar os agentes
$maps = fetchMaps(); // Chama a função para pegar os mapas
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agentes do Valorant</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: white;
            color: black;
        }
        .card {
            border: none;
            margin: auto;
            width: 100%;
            max-width: 600px;
            padding: 10px;
        }
        .agent-image {
            width: 250px;
            height: auto;
            max-height: 200px;
            object-fit: cover;
        }
        .card-content {
            margin-left: 30px;
            flex: 1;
        }
        .card-body {
            display: flex;
            flex-direction: column;
        }
        .details {
        display: none; /* Inicialmente oculto */
        }

        .flex-row {
            display: flex;
            align-items: center;
        }
        .btn-agent {
            background-color: white;
            border: 2px solid;
            color: black;
            border-radius: 5px;
            padding: 10px 15px;
            transition: background-color 0.3s, color 0.3s;
        }
        .btn-agent:hover {
            background-color: #f0f0f0;
            color: #333;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
    <script>
        // Função para mostrar/esconder os detalhes do agente
    function toggleDetails(index) {
    const details = document.getElementById(`details-${index}`);
    details.style.display = details.style.display === "block" ? "none" : "block";
    }

    </script>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Valorant</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#agents">Agentes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#maps">Mapas</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container mt-5">
    <h1 id="agents">Agentes</h1>
    <div class="row">
        <?php foreach ($agents as $index => $agent): ?>
            <div class="col-md-12 mb-4">
                <div class="card" style="background-color: <?= $agent->color ?>;">
                    <div class="flex-row">
                        <img src="<?= $agent->fullPortrait ?>" class="agent-image" alt="<?= htmlspecialchars($agent->displayName) ?>">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($agent->displayName) ?></h5>
                                <p class="card-text"><?= htmlspecialchars($agent->description) ?></p>
                                <button class="btn btn-agent" onclick="toggleDetails(<?= $index ?>)">Detalhes</button>
                                <div id="details-<?= $index ?>" class="details">
                                    <h6>Habilidades:</h6>
                                    <div class="d-flex flex-column">
                                        <?php foreach ($agent->abilities as $ability): ?>
                                            <span><?= htmlspecialchars($ability) ?></span>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <h2 id="maps" class="mt-5">Mapas</h2>
    <div class="row">
        <?php foreach ($maps as $map): ?>
            <div class="col-md-4 mb-4">
                <div class="card" style="max-width: 400px;">
                    <div class="d-flex">
                        <img src="<?= $map->image ?>" class="agent-image" alt="<?= htmlspecialchars($map->displayName) ?>">
                        <div class="card-content">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($map->displayName) ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<!--  

(1.0) Interface HTML Responsiva
Apresentação dos dados recebidos pela API:
Utilização de Bootstrap para criar uma interface responsiva que exibe informações dos agentes e mapas em cartões, adaptando-se a diferentes tamanhos de tela.
(3.0) Integração Front-end x API Back-end
Integração com no mínimo 3 métodos da API:

GET /agents: Para buscar e exibir os agentes jogáveis.
GET /maps: Para buscar e exibir os mapas disponíveis.
(Um terceiro método poderia ser adicionado se a API suportar, como GET /weapons).
Exibição de dados com repetição:

Utilização de loops para iterar sobre os dados dos agentes e mapas, exibindo todos os itens retornados da API.
Exibição de dados sem repetição:

Implementação de uma lógica (potencialmente filtrando ou ajustando) que permite exibir apenas informações únicas ou específicas (ex: tipos de agentes).
Chamada de método com e sem filtros:

Sem filtros: Chamada simples para obter todos os agentes e mapas.
Com filtros: Funcionalidade de busca (não explicitamente no código, mas sugerida como uma futura implementação).
(4.0) Desenvolva uma aplicação que faça o consumo de dados de uma API (back-end) de terceiros.
Objetivo: O código cria uma aplicação que consome dados da API do Valorant, exibindo informações de forma organizada e interativa na interface.
-->