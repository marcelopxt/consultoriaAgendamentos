<?php
require_once __DIR__ . '/../config/Connection.php';

class AgendamentoDAO
{
    private $pdo;
    public function __construct()
    {
        $this->pdo = Connection::conectar();
    }
    public function create(array $dadosAgendamento): bool
    {
        try {
            $sql = "INSERT INTO tb_agendamento (titulo, descricao, nome_cliente, data_inicial, data_final) 
                    VALUES (:titulo, :descricao, :nome_cliente, :data_inicial, :data_final)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':titulo', $dadosAgendamento['titulo']);
            $stmt->bindValue(':descricao', $dadosAgendamento['descricao']);
            $stmt->bindValue(':nome_cliente', $dadosAgendamento['nome_cliente']);
            $stmt->bindValue(':data_inicial', $dadosAgendamento['data_inicial']);
            $stmt->bindValue(':data_final', $dadosAgendamento['data_final']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao criar agendamento: " . $e->getMessage());
            return false;
        }
    }
    public function getById(int $id)
    {
        try {
            $sql = "SELECT * FROM tb_agendamento WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar agendamento por ID: " . $e->getMessage());
            return false;
        }
    }
    public function getAllFuturos(?string $search = null): array
    {
        $dataAtual = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM tb_agendamento WHERE data_inicial >= ?";
        $params = [$dataAtual];
        if ($search) {
            $sql .= " AND (titulo LIKE ? OR nome_cliente LIKE ?)";
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        $sql .= " ORDER BY data_inicial ASC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getAllPassados(?string $search = null): array
    {
        $dataAtual = date('Y-m-d H:i:s');
        $sql = "SELECT * FROM tb_agendamento WHERE data_inicial < ?";
        $params = [$dataAtual];
        if ($search) {
            $sql .= " AND (titulo LIKE ? OR nome_cliente LIKE ?)";
            $searchTerm = '%' . $search . '%';
            $params[] = $searchTerm;
            $params[] = $searchTerm;
        }
        $sql .= " ORDER BY data_inicial DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM tb_agendamento WHERE id = ?";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            error_log("Erro ao excluir agendamento: " . $e->getMessage());
            return false;
        }
    }
    public function update(array $dadosAgendamento): bool
    {
        try {
            $sql =
                "UPDATE tb_agendamento 
                SET titulo = :titulo, descricao = :descricao, nome_cliente = :nome_cliente, 
                data_inicial = :data_inicial, data_final = :data_final 
                WHERE id = :id";

            $stmt = $this->pdo->prepare($sql);
            $stmt->bindValue(':id', $dadosAgendamento['id'], PDO::PARAM_INT);
            $stmt->bindValue(':titulo', $dadosAgendamento['titulo']);
            $stmt->bindValue(':descricao', $dadosAgendamento['descricao']);
            $stmt->bindValue(':nome_cliente', $dadosAgendamento['nome_cliente']);
            $stmt->bindValue(':data_inicial', $dadosAgendamento['data_inicial']);
            $stmt->bindValue(':data_final', $dadosAgendamento['data_final']);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Erro ao atualizar agendamento: " . $e->getMessage());
            return false;
        }
    }
}