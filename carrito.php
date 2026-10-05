<?php
session_start();

require_once __DIR__ . '/db.php';
require_once __DIR__ . '/repositories/ProductoRepository.php';
>>>>>>> 1635292 (mvc subido)

$productoRepo = new ProductoRepository($mysqli);

$action = $_GET["action"] ?? null;
$productId = $_GET["id"] ?? null;


// Añadir producto al carrito
>>>>>>> 1635292 (mvc subido)
if ($action === "add" && $productId !== null) {
    $product = $productoRepo->obtenerPorId($productId);
    if ($product) {
        if (!isset($_SESSION["carrito"])) {
            $_SESSION["carrito"] = [];
        }
        
        $productIdStr = (string)$product["ID_Producto"];
        if (isset($_SESSION["carrito"][$productIdStr])) {
            $_SESSION["carrito"][$productIdStr]["cantidad"] += 1;
        } else {
            $_SESSION["carrito"][$productIdStr] = [
                "ID_Producto" => $product["ID_Producto"],
                "Nombre" => $product["Nombre"],
                "Precio" => $product["Precio"],
                "cantidad" => 1
            ];
        }
    }
    header("Location: carrito.php");
    exit();
}


// Eliminar o decrementar producto
>>>>>>> 1635292 (mvc subido)
if ($action === "eliminar" && $productId !== null) {
    $productIdStr = (string)$productId;
    if (isset($_SESSION["carrito"][$productIdStr])) {
        if ($_SESSION["carrito"][$productIdStr]["cantidad"] > 1) {
            $_SESSION["carrito"][$productIdStr]["cantidad"] -= 1;
        } else {
            unset($_SESSION["carrito"][$productIdStr]);
        }
    }
    header("Location: carrito.php");
    exit();
}


// Limpiar carrito entero
>>>>>>> 1635292 (mvc subido)
if ($action === "limpiar") {
    unset($_SESSION["carrito"]);
    header("Location: carrito.php");
    exit();
}

$itemsCarrito = isset($_SESSION["carrito"]) ? array_values($_SESSION["carrito"]) : [];

require_once __DIR__ . '/views/header.phtml';
?>

<?php if (empty($itemsCarrito)): ?>
    <div class="bg-white p-12 text-center rounded-xl border border-stone-200">
        <p class="text-stone-500 mb-4">Aún no has agregado productos a tu carrito.</p>
        <a href="index.php" class="inline-block bg-stone-900 text-white text-xs font-semibold px-5 py-2.5 rounded-lg hover:bg-stone-800 transition">
            Volver a la tienda
        </a>
    </div>
<?php else: ?>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-xl border border-stone-200 overflow-hidden">
            <table class="w-full text-left text-sm text-stone-600">
                <thead class="bg-stone-50 text-xs font-bold uppercase text-stone-500 border-b border-stone-200">
                    <tr>
                        <th class="p-4">Producto</th>
                        <th class="p-4">Precio</th>
                        <th class="p-4 text-center">Cant.</th>
                        <th class="p-4">Subtotal</th>
                        <th class="p-4"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-stone-100">
                    <?php $total = 0; ?>
                    <?php foreach ($itemsCarrito as $item): ?>
                        <?php $subtotal = $item['Precio'] * $item['cantidad']; ?>
                        <?php $total += $subtotal; ?>
                        <tr>
                            <td class="p-4 font-semibold text-stone-900"><?= htmlspecialchars($item['Nombre']) ?></td>
                            <td class="p-4">$<?= number_format($item['Precio'], 2) ?></td>
                            <td class="p-4 text-center"><?= $item['cantidad'] ?></td>
                            <td class="p-4 font-bold text-stone-900">$<?= number_format($subtotal, 2) ?></td>
                            <td class="p-4 text-right">
                                <a href="carrito.php?action=eliminar&id=<?= $item['ID_Producto'] ?>" class="text-xs text-red-500 hover:underline">Quitar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="bg-white p-6 rounded-xl border border-stone-200 h-fit">
            <h2 class="text-lg font-bold text-stone-900 mb-4">Resumen del pedido</h2>
            
            <div class="flex justify-between py-2 border-b border-stone-100 text-sm">
                <span class="text-stone-500">Subtotal</span>
                <span class="font-semibold text-stone-900">$<?= number_format($total, 2) ?></span>
            </div>
            
            <div class="flex justify-between py-4 text-lg font-bold text-stone-900">
                <span>Total</span>
                <span class="text-amber-700">$<?= number_format($total, 2) ?></span>
            </div>

            <form action="procesar_pedido.php" method="POST" class="mt-4">
                <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white py-3 rounded-lg text-sm font-semibold transition">
                    Finalizar Compra
                </button>
            </form>
        </div>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/views/footer.phtml'; 
?>
