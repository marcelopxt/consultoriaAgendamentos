<?php
session_start();
require_once 'models/AgendamentoDAO.php';
$searchTerm = $_GET['search'] ?? null;
$agendamentoDAO = new AgendamentoDAO();
$agendamentos_futuros = $agendamentoDAO->getAllFuturos($searchTerm);
$agendamentos_passados = $agendamentoDAO->getAllPassados($searchTerm);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Agendamentos</title>
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
                        <a class="nav-link active" href="index.php">Agendamentos</a>
                    </li>
                </ul>
                <form class="d-flex mx-auto navbar-search-form" role="search" action="index.php" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Buscar por título ou cliente"
                        name="search" value="<?= htmlspecialchars($searchTerm ?? '') ?>">
                    <button class="btn btn-outline-light" type="submit">Buscar</button>
                </form>
            </div>
        </div>
    </nav>
    <div class="container mt-5">
        <?php
        if (isset($_SESSION['success_message'])) {
            echo '
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ' . htmlspecialchars($_SESSION['success_message']) . '
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        ';
            unset($_SESSION['success_message']);
        }
        ?>
        <h1 class="mb-4">Agendamentos da Consultoria</h1>
        <?php if ($searchTerm): ?>
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <span>Resultados da busca por: <strong><?= htmlspecialchars($searchTerm) ?></strong></span>
                <a href="index.php" class="btn-close" aria-label="Limpar Busca"></a>
            </div>
        <?php endif; ?>
        <h2 class="border-bottom pb-2 mb-3">Próximos Agendamentos</h2>
        <div class="row">
            <?php if (count($agendamentos_futuros) > 0): ?>
                <?php foreach ($agendamentos_futuros as $agendamento): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?= htmlspecialchars($agendamento['titulo']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($agendamento['nome_cliente']) ?>
                                </h6>
                                <p class="card-text">
                                    <strong>Início:</strong>
                                    <?= date('d/m/Y H:i', strtotime($agendamento['data_inicial'])) ?><br>
                                    <strong>Fim:</strong> <?= date('d/m/Y H:i', strtotime($agendamento['data_final'])) ?>
                                </p>
                                <p class="card-text small flex-grow-1"><?= nl2br(htmlspecialchars($agendamento['descricao'])) ?>
                                </p>
                                <div class="card-footer bg-transparent border-top-0 pt-3">
                                    <a href="formulario_agendamento.php?id=<?= $agendamento['id'] ?>"
                                        class="btn btn-sm btn-outline-secondary">Editar</a>
                                    <a href="actions/excluir_agendamento.php?id=<?= $agendamento['id'] ?>"
                                        class="btn btn-sm btn-outline-danger btn-excluir">Excluir</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-muted">Nenhum agendamento futuro encontrado.</p>
                </div>
            <?php endif; ?>
        </div>
        <h2 class="border-bottom pb-2 mb-3 mt-5">Agendamentos Passados</h2>
        <div class="row">
            <?php if (count($agendamentos_passados) > 0): ?>
                <?php foreach ($agendamentos_passados as $agendamento): ?>
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 opacity-75">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($agendamento['titulo']) ?></h5>
                                <h6 class="card-subtitle mb-2 text-muted"><?= htmlspecialchars($agendamento['nome_cliente']) ?>
                                </h6>
                                <p class="card-text">
                                    <strong>Realizado em:</strong>
                                    <?= date('d/m/Y H:i', strtotime($agendamento['data_inicial'])) ?>
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0 pt-3">
                                <a href="formulario_agendamento.php?id=<?= $agendamento['id'] ?>"
                                    class="btn btn-sm btn-outline-secondary">Editar</a>
                                <a href="actions/excluir_agendamento.php?id=<?= $agendamento['id'] ?>"
                                    class="btn btn-sm btn-outline-danger btn-excluir">Excluir</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col">
                    <p class="text-muted">Nenhum agendamento passado encontrado.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <a href="formulario_agendamento.php" class="btn btn-primary btn-fab" title="Novo Agendamento">
        +
    </a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/script.js"></script>
</body>

</html>