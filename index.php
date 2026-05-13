<?php

use CoffeeCode\Router\Router;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(ROOT);

writeLog("Router initialized with ROOT: " . ROOT, "router_init");

$router->namespace("Source\Controllers");



#ROTAS DE USUARIO
$router->group(null);
$router->get('/', 'UsuarioController:login', 'usuario.login');
$router->get('/registro', 'UsuarioController:registro', 'usuario.registro');
$router->post('/cadastrar', 'UsuarioController:cadastrar', 'usuario.cadastrar');
$router->post('/logar', 'UsuarioController:logar', 'usuario.logar');
$router->get('/sair', 'UsuarioController:sair', 'usuario.sair');
$router->get('/perfil', 'UsuarioController:perfil', 'usuario.perfil');

#ROTAS DA HOME PRINCIPAL ADMISTRACAO
$router->group('/adm');
$router->get('/home', 'AdministracaoController:home', 'adm.home');

#ROTAS DE ESPECIALIDADES
$router->group('/especialidade');
$router->get('/', 'EspecialidadeController:home', 'especialidade.home');
$router->get('/novo', 'EspecialidadeController:novo', 'especialidade.novo');
$router->get('/editar/{id}', 'EspecialidadeController:editar', 'especialidade.editar');
$router->post('/cadastrar', 'EspecialidadeController:cadastrar', 'especialidade.cadastrar');
$router->get('/deletar/{id}', 'EspecialidadeController:deletar', 'especialidade.deletar');

#ROTAS DE BARBEIROS
$router->group('/barbeiro');
$router->get('/', 'BarbeiroController:home', 'barbeiro.home');
$router->get('/novo', 'BarbeiroController:novo', 'barbeiro.novo');
$router->get('/especialidade', 'BarbeiroController:especialidade', 'barbeiro.especialidade');
$router->post('/cadastrar', 'BarbeiroController:cadastrar', 'barbeiro.cadastrar');
$router->get('/deletar/{id}', 'BarbeiroController:deletar', 'barbeiro.deletar');
$router->post('/get-especialidade', 'BarbeiroController:especialidadBarbeiro', 'barbeiro.get-especialidade');

#ROTAS DO AGENDAMENTO
$router->group('/agendamento');
$router->get('/novo', 'AgendamentoController:novo', 'agendamento.novo');
$router->get('/barbeiros', 'AgendamentoController:listaBarbeiros', 'agendamento.barbeiros');
$router->post('/horarios', 'AgendamentoController:horarios', 'agendamento.horarios');
$router->post('/cadastrar', 'AgendamentoController:cadastrar', 'agendamento.cadastrar');
$router->post('/agendamentos', 'AgendamentoController:listaAgendamentos', 'agendamento.agendamentos');
$router->post('/cancelar', 'AgendamentoController:cancelar', 'agendamento.cancelar');
$router->get('/concluir/{id}', 'AgendamentoController:concluirAgendamento', 'agendamento.concluir');
$router->get('/especialidade/{id}', 'AgendamentoController:especialidade', 'agendamento.especialidade');


session_start();

$router->dispatch();


if ($router->error()) {
    $errorCode = $router->error();
    $requestedRoute = $_GET['route'] ?? 'N/A';
    $requestMethod = $_SERVER['REQUEST_METHOD'];

    // Log the error
    writeLog("Router Error: {$errorCode} for route '{$requestedRoute}' with method '{$requestMethod}'", "router_errors");

    // Handle different error codes
    switch ($errorCode) {
        case CoffeeCode\Router\Dispatch::NOT_FOUND:
            header("HTTP/1.0 404 Not Found");
            echo "<h1>404 Not Found</h1><p>The page you requested could not be found.</p>";
            break;
        default:
            header("HTTP/1.0 500 Internal Server Error");
            echo "<h1>Error {$errorCode}</h1><p>An unexpected error occurred.</p>";
            break;
    }
    exit; // Terminate script execution after handling the error
}
