<?php

// Order processing page
$pedido = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $total = $_POST["total"];
    $itemsCarrito = $_POST["itemsCarrito"];
    
    if ($total > 0) {
        $pedido = new Pedido(null, 0, "", "Pendiente", $total);
        foreach ($itemsCarrito as $item) {
            $pedido->agregarLinea(new LineaPedido($pedido->getId(), $item["ID_Producto"], $item["cantidad"], $item["Precio"], $item["Stock"]));
        }
        $pedido->guardar(); // Assuming Pedido has a save method
        header("Location: index.php");
        exit();
    } else {
        $error = "Por favor, complete el pedido antes de enviarlo.";
    }
} else {
    $error = ""; // No error for GET requests
}

include "header.phtml";
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

<?php include "footer.phtml"; ?>