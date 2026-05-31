<!DOCTYPE html>
<html lang="pl">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Historia Zamówień</h2>
    <a href="/employee/dashboard" class="btn btn-secondary">
        ⬅ Wróć do Panelu
    </a>
</div>
    <table class="table table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Klient</th> <th>Produkt</th>
                <th>Ilość</th>
                <th>Suma (PLN)</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><?php echo e($order->id); ?></td>
                <td><?php echo e($order->user->name ?? 'Nieznany'); ?></td>
                <td><?php echo e($order->product->name ?? 'Usunięty'); ?></td>
                <td><?php echo e($order->quantity); ?></td>
                <td><?php echo e(number_format($order->total_price, 2)); ?></td>
                <td><?php echo e($order->created_at->format('d.m.Y H:i')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
</body>
</html><?php /**PATH P:\Xampp\htdocs\sklep\resources\views/orders/index.blade.php ENDPATH**/ ?>