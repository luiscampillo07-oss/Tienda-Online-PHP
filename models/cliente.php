<?php
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/src/repositories/ClienteRepository.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"] ?? "";
    $password = $_POST["password"] ?? "";
    
    if (!empty($usuario) && !empty($password)) {
        $clienteRepo = new ClienteRepository($mysqli);
        $result = $clienteRepo->login($usuario, $password);

        if ($result) {
            $_SESSION["cliente"] = [
                "ID_Cliente" => $result["ID_Cliente"],
                "Nombre"     => $result["Nombre"],
                "Apellidos"  => $result["Apellidos"],
                "Email"      => $result["Email"]
            ];
            header("Location: index.php");
            exit();
        } else {
            $error = "Credenciales inválidas. Por favor, verifique su usuario y contraseña.";
        }
    } else {
        $error = "Se requieren ambos campos (usuario y contraseña).";
    }
}

require_once __DIR__ . '/views/header.phtml';
?>

<?php require_once __DIR__ . '/views/footer.phtml'; ?>