<?php
class Connection
{
    public static function conectar(): PDO
    {
        $host = "127.0.0.1";
        $dbname = "dbconsultoria";
        $username = "root";
        $password = "12345678";
        $mysql_port = 3306;
        $dsn = "mysql:host=$host;port=$mysql_port;dbname=$dbname;charset=utf8";
        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erro ao conectar com o banco de dados: " . $e->getMessage());
        }
    }
}