<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj Produkt - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 600px;">
        <div class="mb-3">
            <a href="/" class="text-decoration-none text-secondary">← Powrót do oferty</a>
        </div>

        <div class="card shadow-sm border-0 p-4 bg-white">
            <h2 class="fw-bold mb-4 text-dark text-center">Nowy Produkt</h2>

            <?php if($errors->any()): ?>
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li><?php echo e($error); ?></li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="/products" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Nazwa produktu</label>
                    <input type="text" name="name" value="<?php echo e(old('name')); ?>" class="form-control" placeholder="np. Piłka meczowa">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Opis produktu</label>
                    <textarea name="description" rows="4" class="form-control" placeholder="Krótki opis specyfikacji technicznej..."></textarea>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <label class="form-label fw-semibold">Cena (PLN)</label>
                        <input type="number" step="0.01" name="price" value="<?php echo e(old('price')); ?>" class="form-control" placeholder="0.00">
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-semibold">Stan magazynowy</label>
                        <input type="number" name="stock" value="<?php echo e(old('stock')); ?>" class="form-control" placeholder="0">
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary btn-lg fs-6 shadow-sm">Zapisz produkt w bazie</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH P:\Xampp\htdocs\sklep\resources\views/products/create.blade.php ENDPATH**/ ?>