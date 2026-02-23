<?php
ini_set("display_errors", 1);

// Configurações do Banco
$servername = getenv('DB_HOST')     ?: 'db';
$username   = getenv('DB_USER')     ?: 'toshiro';
$password   = getenv('DB_PASSWORD') ?: 'toshiro';
$database   = getenv('DB_NAME')     ?: 'meubanco';

$link = new mysqli($servername, $username, $password, $database);

if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

$valor_rand1 = rand(1, 999);
$valor_rand2 = strtoupper(substr(bin2hex(random_bytes(4)), 1));
$host_name   = gethostname();

$stmt = $link->prepare("INSERT INTO dados (AlunoID, Nome, Sobrenome, Endereco, Cidade, Host) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("isssss", $valor_rand1, $valor_rand2, $valor_rand2, $valor_rand2, $valor_rand2, $host_name);
$success = $stmt->execute();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Toshiro Shibakita Plus</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f0f2f5; }
        .card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .container-id { color: #007bff; font-weight: bold; font-family: monospace; font-size: 1.2em; }
    </style>
</head>
<body>
    <div class="card">
        <h2>🚀 Status do Microserviço</h2>
        <p>Versão PHP: <?php echo phpversion(); ?></p>
        <hr>
        <?php if ($success): ?>
            <p style="color: green;">✅ Registro inserido no banco com sucesso!</p>
            <p>ID do Container que respondeu: <span class="container-id"><?php echo $host_name; ?></span></p>
        <?php else: ?>
            <p style="color: red;">❌ Erro: <?php echo $stmt->error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
$stmt->close();
$link->close();
?>