<?php



$host = 'ep-still-moon-adagjucu-pooler.c-2.us-east-1.aws.neon.tech';
$db = 'adocaocaes';
$user = 'neondb_owner';
$password = 'npg_S0WoDsRpCtg4';

$dsn = "pgsql:host=$host;port=5432;dbname=$db;sslmode=require;";

try {
    $pdo = new PDO($dsn, $user, $password);
    echo "Conexão realizada com sucesso!";
} catch (PDOException $e) {
   echo "Erro na conexão: " . $e->getMessage();
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

Prepara a SQL

$stmt = $conn->prepare("INSERT INTO adocoes (  nomeAdotante, cpfAdotante, emailAdotante, telefoneAdotante, enderecoAdotante,
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

//TESTE PARA VER SE ESTA PEGANDO CORRETAMENTE OS DADOS//

echo "Cadastro realizado com sucesso!!";
print_r($_POST);
print_r($_FILES);


    


// Encerra conexões
$stmt->close();
$conn->close();
?>
