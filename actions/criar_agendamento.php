<?php
session_start();
require_once '../models/AgendamentoDAO.php';
if (empty($_POST['titulo']) || empty($_POST['nome_cliente'])) {
    $_SESSION['error_message'] = "Título e Nome do Cliente são obrigatórios.";
    header('Location: ../formulario_agendamento.php');
    exit();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data_inicial_obj = new DateTime($_POST['data_inicial']);
        $data_final_obj = new DateTime($_POST['data_final']);
        if ($data_final_obj <= $data_inicial_obj) {
            $_SESSION['error_message'] = "Erro: A data final deve ser posterior à data inicial.";
            header('Location: ../formulario_agendamento.php');
            exit();
        }
    } catch (Exception $e) {
        $_SESSION['error_message'] = "Formato de data inválido. Por favor, verifique as datas inseridas.";
        header('Location: ../formulario_agendamento.php');
        exit();
    }
    $agendamentoDAO = new AgendamentoDAO();
    if ($agendamentoDAO->create($_POST)) {
        $_SESSION['success_message'] = "Agendamento criado com sucesso!";
        header("Location: ../index.php?status=success");
    } else {
        $_SESSION['error_message'] = "Erro ao salvar agendamento no banco de dados.";
        header('Location: ../formulario_agendamento.php');
    }
    exit();
}