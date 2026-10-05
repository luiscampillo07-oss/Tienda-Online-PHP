<?php

// Import repository classes
require_once "models/Cliente.php";
require_once "repositories/clienteRepository.php";
require_once "db.php";

// Login page - handles user authentication
$error = "";
$cliente = null;

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
    if (!empty($email) && !empty($password)) {
        // Create repository instance
        $clienteRepo = new ClienteRepository($mysqli);
        $result = $clienteRepo->login($email, $password);
        if ($result) {
            session_start();
            $_SESSION["cliente"] = [
                "ID_Cliente" => $result["ID_Cliente"],
                "Nombre" => $result["Nombre"],
                "Apellidos" => $result["Apellidos"],
                "Email" => $result["Email"]
            ];
            header("Location: index.php");
            exit();
        } else {
            $error = "Credenciales inválidas. Por favor, verifique su correo y contraseña.";
        }
    } else {
        $error = "Se requieren ambos campos (correo y contraseña).";
    }
}

include "header.phtml";
?>

    <div class="max-w-md mx-auto bg-white p-8 rounded-xl border border-stone-200 shadow-sm mt-8">
        <h1 class="text-2xl font-bold text-stone-900 mb-1">Inicia Sesión</h1>
        <p class="text-xs text-stone-500 mb-6">Ingresa tus datos para acceder a tu cuenta.</p>

        <?php if (!empty($error)): ?>
            <div class="bg-red-50 text-red-600 text-xs p-3 rounded-lg mb-4 border border-red-100">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="POST" class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Correo Electrónico</label>
                <input type="email" name="email" required class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-600">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase text-stone-600 mb-1">Contraseña</label>
                <input type="password" name="password" required class="w-full border border-stone-300 rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-amber-600">
            </div>

            <button type="submit" class="w-full bg-stone-900 hover:bg-stone-800 text-white font-semibold text-xs py-3 rounded-lg transition">
                Ingresar
            </button>
        </form>
    </div>

<?php include "footer.phtml"; ?>