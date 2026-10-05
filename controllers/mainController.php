<?php
session_start();

// Cargar la conexión y los repositorios subiendo un nivel a la raíz
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../repositories/ClienteRepository.php';
require_once __DIR__ . '/../repositories/ProductoRepository.php';

// Capturar la acción de la URL
$action = "";
if (isset($_GET["action"])) {
    $action = $_GET["action"];
}

// ------------------------------------------------------------------
// 1. ACCIÓN: LOGIN
// ------------------------------------------------------------------
if ($action === "login") {
    $error = "";

    if (isset($_POST["usuario"])) {
        $usuario = "";
        if (isset($_POST["usuario"])) {
            $usuario = $_POST["usuario"];
        }

        $password = "";
        if (isset($_POST["password"])) {
            $password = $_POST["password"];
        }

        if ($usuario !== "" && $password !== "") {
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

    require_once __DIR__ . '/../views/loginView.phtml';
    exit();
}

// ------------------------------------------------------------------
// 2. ACCIÓN: LOGOUT
// ------------------------------------------------------------------
if ($action === "logout") {
    session_destroy();
    header("Location: index.php");
    exit();
}

// ------------------------------------------------------------------
// 3. ACCIÓN: PROCESAR PEDIDO
// ------------------------------------------------------------------
if ($action === "procesarPedido") {
    $error = "";

    if (isset($_POST["total"])) {
        $total = $_POST["total"];

        $itemsCarrito = [];
        if (isset($_POST["itemsCarrito"])) {
            $itemsCarrito = $_POST["itemsCarrito"];
        }

        if ($total > 0) {
            header("Location: index.php?action=pedidoExitoso");
            exit();
        } else {
            $error = "Por favor, complete el pedido antes de enviarlo.";
        }
    }

    require_once __DIR__ . '/../views/header.phtml';
    ?>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white p-8 rounded-xl border border-stone-200 shadow-sm text-center">
            <?php if ($error !== ""): ?>
                <div class="bg-red-50 text-red-600 text-xs p-3 rounded-lg mb-4 border border-red-100">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <h1 class="text-2xl font-bold text-stone-900 mb-4">Procesamiento de Pedido</h1>
            <p class="text-stone-600 mb-6">Revisa tus productos antes de finalizar la compra.</p>
            <a href="index.php" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm py-3 px-6 rounded-lg transition">
                Volver a la tienda
            </a>
        </div>
    </div>
    <?php
    require_once __DIR__ . '/../views/footer.phtml';
    exit();
}

// ------------------------------------------------------------------
// 4. ACCIÓN: CONFIRMACIÓN DE PEDIDO EXITOSO
// ------------------------------------------------------------------
if ($action === "pedidoExitoso") {
    require_once __DIR__ . '/../views/header.phtml';
    ?>
    <div class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white p-8 rounded-xl border border-stone-200 shadow-sm text-center">
            <h1 class="text-2xl font-bold text-stone-900 mb-4">Pedido Procesado</h1>
            <p class="text-stone-600 mb-6">Tu pedido ha sido recibido exitosamente. Te enviaremos un correo de confirmación.</p>
            <a href="index.php" class="inline-block bg-amber-600 hover:bg-amber-700 text-white font-semibold text-sm py-3 px-6 rounded-lg transition">
                Volver a la tienda
            </a>
        </div>
    </div>
    <?php
    require_once __DIR__ . '/../views/footer.phtml';
    exit();
}

// ------------------------------------------------------------------
// 5. ACCIÓN POR DEFECTO: VISTA PRINCIPAL DE PRODUCTOS
// ------------------------------------------------------------------
$productoRepo = new ProductoRepository($mysqli);
$productos = $productoRepo->obtenerTodos();
$title = "TiendaPHP";

require_once __DIR__ . '/../views/mainView.phtml';