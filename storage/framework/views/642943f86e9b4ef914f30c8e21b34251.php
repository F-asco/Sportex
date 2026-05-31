<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Twój Koszyk - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 900px;">
        <div class="mb-4">
            <a href="/" class="text-decoration-none text-secondary">← Powrót do sklepu</a>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <h1 class="fw-bold mb-4 text-dark">Twój Koszyk Zakupowy</h1>

            <?php if(session('error')): ?>
                <div class="alert alert-danger"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if(empty($cart)): ?>
                <div class="text-center py-5">
                    <p class="text-muted fs-5">Twój koszyk jest obecnie pusty.</p>
                    <a href="/" class="btn btn-primary mt-2">Przeglądaj produkty</a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Nazwa produktu</th>
                                <th class="text-center">Cena</th>
                                <th class="text-center">Ilość</th>
                                <th class="text-end">Suma</th>
                                <th class="text-center">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-semibold"><?php echo e($details['name']); ?></td>
                                    <td class="text-center"><?php echo e($details['price']); ?> PLN</td>
                                    <td class="text-center">
                                        <span class="badge bg-secondary px-3 py-2 fs-6"><?php echo e($details['quantity']); ?> szt.</span>
                                    </td>
                                    <td class="text-end fw-bold text-primary"><?php echo e($details['price'] * $details['quantity']); ?> PLN</td>
                                    <td class="text-center">
                                        <form action="/cart/remove/<?php echo e($id); ?>" method="POST" class="m-0">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Usuń</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between align-items-center my-4 pt-3 border-top">
                    <span class="fs-4 text-muted">Do zapłaty:</span>
                    <span class="fs-3 fw-bold text-dark"><?php echo e($total); ?> PLN</span>
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <form action="/cart/checkout" method="POST" class="m-0 w-100 w-md-auto">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-success btn-lg px-5 shadow-sm">
                            🛒 Złóż zamówienie
                        </button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH P:\Xampp\htdocs\sklep\resources\views/cart/index.blade.php ENDPATH**/ ?>