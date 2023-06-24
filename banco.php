<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Obter os dados do formulário
$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$sobre = $_POST['sobre'];

// Processar o arquivo enviado
$curriculo = $_FILES['curriculo']['name'];
$curriculo_temp = $_FILES['curriculo']['tmp_name'];
$curriculo_destino = "C:\Users\andre\OneDrive\Documentos\armazena" . $curriculo;

if (move_uploaded_file($curriculo_temp, $curriculo_destino)) {
    // Arquivo movido com sucesso, aguardar 4 segundos e depois inserir os dados no banco de dados
    sleep(4);

    // Arquivo movido com sucesso, inserir os dados no banco de dados
    $sql = "INSERT INTO user (nome, sobrenome, sobre, curriculo) VALUES ('$nome', '$sobrenome', '$sobre', '$curriculo')";

    if ($conn->query($sql) === TRUE) {
        // Dados inseridos com sucesso, redirecionar de volta à página HTML
        header("Location: index.html");
        exit();
    } else {
        echo "Erro ao inserir os dados: " . $conn->error;
    }
} else {
    echo "Erro ao fazer o upload do currículo.";
}


// Fechar a conexão
$conn->close();





/*<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario";

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Consulta para obter os nomes das tabelas
$sql = "SHOW TABLES";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "Tabelas encontradas:<br>";
    while ($row = $result->fetch_assoc()) {
        echo $row['Tables_in_' . $dbname] . "<br>";
    }
} else {
    echo "Nenhuma tabela encontrada.";
}

// Fechar a conexão
$conn->close();
?>
*/