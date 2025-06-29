<?php
session_start();
require_once '../models/AgendamentoDAO.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dataI = new DateTime($_POST['data_inicial']);
    $dataF = new DateTime($_POST['data_final']);

    if ($dataF <= $dataI) {
        $_SESSION['error_message'] = "Erro: A data final deve ser posterior à data inicial.";
        header('Location: ../formulario_agendamento.php?id=' . $_POST['id']);
        exit();
    } else {
        $agendamentoDAO = new AgendamentoDAO();
        if ($agendamentoDAO->update($_POST)) {
            header("Location: ../index.php?status=updated");
        } else {
            $_SESSION['error_message'] = "Erro ao atualizar agendamento.";
            header('Location: ../formulario_agendamento.php?id=' . $_POST['id']);
        }
        exit();
    }

}