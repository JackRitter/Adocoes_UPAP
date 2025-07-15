<?php
// Configurações do banco de dados
//  codigo original ---- $host = 'localhost';//
$host 'https://github.com/login?client_id=08cb4f3eb1c9976a92ee&return_to=%2Flogin%2Foauth%2Fauthorize%3Fclient_id%3D08cb4f3eb1c9976a92ee%26redirect_uri%3Dhttps%253A%252F%252Fconsole.neon.tech%252Frealms%252Fprod-realm%252Fbroker%252Fgithub%252Fendpoint%26response_type%3Dcode%26scope%3Duser%253Aemail%26state%3DUbEW4X8IwAp-jGO1L9yFneTI7mF48c0NqKIs3YMUODY.tsPi2BUObI8.FggMbeJNQvGDpiNKH3TE_A.eyJydSI6Imh0dHBzOi8vY29uc29sZS5uZW9uLnRlY2gvYXV0aC9rZXljbG9hay9jYWxsYmFjayIsInJ0IjoiY29kZSIsInN0IjoiYXhZYWZIUUFJRDNnME9pSXRkalhpQT09LCwsIn0'
$usuario = 'JackRitter'
$senha = 'Mct3p3ptmc';
$banco = 'adocaocaes';

// Conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Captura os dados do formulário
$nomeAdotante = $_POST['nomeAdotante'];
$cpfAdotante = $_POST['cpfAdotante'];
$emailAdotante = $_POST['emailAdotante'];
$telefoneAdotante = $_POST['telefoneAdotante'];
$enderecoAdotante = $_POST['enderecoAdotante'];

$nomeAnimal = $_POST['nomeAnimal'];
$racaAnimal = $_POST['racaAnimal'];
$corAnimal = $_POST['corAnimal'];
$sexoAnimal = $_POST['sexoAnimal'];
$dataAdocao = $_POST['dataAdocao'];

$castrado = $_POST['castrado'] ?? 'Nao';

$desverminado1aDose = $_POST['desverminado1aDose'] ?? 'Nao';
$dataDesverminacao1aDose = $_POST['dataDesverminacao1aDose'] ?? null;

$desverminado2aDose = $_POST['desverminado2aDose'] ?? 'Nao';
$dataDesverminacao2aDose = $_POST['dataDesverminacao2aDose'] ?? null;

$vacinado = $_POST['vacinado'] ?? 'Nao';
$dataVacinacao = $_POST['dataVacinacao'] ?? null;
$nomeVacina = $_POST['nomeVacina'] ?? null;

// Upload das imagens
$fotoAnimal = $_FILES['fotoAnimal']['tmp_name'] ? file_get_contents($_FILES['fotoAnimal']['tmp_name']) : null;
$fotoAdocao = $_FILES['fotoAdocao']['tmp_name'] ? file_get_contents($_FILES['fotoAdocao']['tmp_name']) : null;

// Prepara a SQL
$stmt = $conn->prepare("INSERT INTO adocoes (
    nomeAdotante, cpfAdotante, emailAdotante, telefoneAdotante, enderecoAdotante,
    nomeAnimal, racaAnimal, corAnimal, sexoAnimal, dataAdocao,
    castrado, desverminado1aDose, dataDesverminacao1aDose,
    desverminado2aDose, dataDesverminacao2aDose,
    vacinado, dataVacinacao, nomeVacina,
    fotoAnimal, fotoAdocao
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

$stmt->bind_param("ssssssssssssssssssss",
    $nomeAdotante, $cpfAdotante, $emailAdotante, $telefoneAdotante, $enderecoAdotante,
    $nomeAnimal, $racaAnimal, $corAnimal, $sexoAnimal, $dataAdocao,
    $castrado, $desverminado1aDose, $dataDesverminacao1aDose,
    $desverminado2aDose, $dataDesverminacao2aDose,
    $vacinado, $dataVacinacao, $nomeVacina,
    $fotoAnimal, $fotoAdocao
);

// Executa
if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $stmt->error;
}

// Encerra conexões
$stmt->close();
$conn->close();
?>
