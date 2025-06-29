<?php
require_once '../models/AgendamentoDAO.php';
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $agendamentoDAO = new AgendamentoDAO();
    if ($agendamentoDAO->delete($id)) {
        header("Location: ../index.php?status=deleted");
    } else {
        header("Location: ../index.php?status=error");
    }
    exit();
} else {
    die("Erro: ID do agendamento não fornecido.");
}