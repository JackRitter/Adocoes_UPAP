<?php
// Dados de conexão
$host = 'ep-still-moon-adagjucu-pooler.c-2.us-east-1.aws.neon.tech';
$port = '5432';
$dbname = 'adocaocaes';
$user = 'neondb_owner';
$password = 'npg_S0WoDsRpCtg4';
$sslmode = 'require';

try {
    // Monta a string de conexão DSN
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;sslmode=$sslmode";

    // Cria uma instância PDO
    $pdo = new PDO($dsn, $user, $password);

    // Define o modo de erro para exceções
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "✅ Conexão bem-sucedida com o banco de dados Neon!";
} catch (PDOException $e) {
    echo "❌ Erro ao conectar: " . $e->getMessage();
}
?>
