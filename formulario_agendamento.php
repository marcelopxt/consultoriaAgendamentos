<?php
session_start();
require_once 'models/AgendamentoDAO.php';
$agendamento = null;
$formAction = 'actions/criar_agendamento.php';
$pageTitle = 'Novo Agendamento';
if (isset($_GET['id'])) {
    $pageTitle = 'Editar Agendamento';
    $formAction = 'actions/editar_agendamento.php';
    $agendamentoDAO = new AgendamentoDAO();
    $agendamento = $agendamentoDAO->getById((int) $_GET['id']);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Consultoria da Maria</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Agendamentos</a>
                    </li>
                </ul>
                <form class="d-flex mx-auto navbar-search-form" role="search" action="index.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Buscar..." name="search" value="">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?php
        if (isset($_SESSION['error_message'])) {
            echo '<div class="alert alert-danger">' . htmlspecialchars($_SESSION['error_message']) . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
        <h1 class="mb-4"><?= htmlspecialchars($pageTitle) ?></h1>
        <form action="<?= $formAction ?>" method="POST">
            <?php if ($agendamento): ?>
                <input type="hidden" name="id" value="<?= $agendamento['id'] ?>">
            <?php endif; ?>
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo"
                    value="<?= htmlspecialchars($agendamento['titulo'] ?? '') ?>" required>
            </div>
            <div class="mb-3">
                <label for="nome_cliente" class="form-label">Nome do Cliente</label>
                <input type="text" class="form-control" id="nome_cliente" name="nome_cliente"
                    value="<?= htmlspecialchars($agendamento['nome_cliente'] ?? '') ?>" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="data_inicial" class="form-label">Início</label>
                    <input type="datetime-local" class="form-control" id="data_inicial" name="data_inicial"
                        value="<?= $agendamento ? date('Y-m-d\TH:i', strtotime($agendamento['data_inicial'])) : '' ?>"
                        required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="data_final" class="form-label">Fim</label>
                    <input type="datetime-local" class="form-control" id="data_final" name="data_final"
                        value="<?= $agendamento ? date('Y-m-d\TH:i', strtotime($agendamento['data_final'])) : '' ?>"
                        required>
                </div>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao"
                    rows="3"><?= htmlspecialchars($agendamento['descricao'] ?? '') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>