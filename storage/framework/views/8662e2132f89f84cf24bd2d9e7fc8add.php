<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sportex - Sklep Sportowy</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold text-uppercase" href="/">Sportex</a>
            <div class="d-flex align-items-center text-white gap-3">
                <?php if(auth()->check()): ?>
                    <span class="small">Zalogowany jako: <strong><?php echo e(auth()->user()->name); ?></strong></span>
                    
                    <?php if(auth()->user()->role === 'admin'): ?>
                        <a href="/admin/dashboard" class="btn btn-danger btn-sm fw-semibold">🛡️ Panel Admina</a>
                    <?php endif; ?>
                    <?php if(auth()->user()->role === 'employee'): ?>
                        <a href="/employee/dashboard" class="btn btn-warning btn-sm fw-semibold text-dark">🛠️ Panel Pracownika</a>
                    <?php endif; ?>

                    <a href="/cart" class="btn btn-outline-light btn-sm position-relative">
                        🛒 Koszyk
                    </a>
                    <?php if(auth()->user()->role === 'admin' || auth()->user()->role === 'employee'): ?>
                        <a href="/products/create" class="btn btn-success btn-sm">➕ Dodaj produkt</a>
                    <?php endif; ?>
                    <form action="/logout" method="POST" class="m-0">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Wyloguj</button>
                    </form>
                <?php else: ?>
                    <a href="/login" class="btn btn-outline-light btn-sm">Zaloguj się</a>
                    <a href="/register" class="btn btn-light btn-sm">Zarejestruj się</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <?php if(session('error')): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo e(session('error')); ?>

            </div>
        <?php endif; ?>

        <div class="row my-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold m-0">Nasza Oferta Produktów</h2>
            </div>
            <div class="col-md-6">
                <form action="/" method="GET" class="d-flex gap-2 justify-content-md-end mt-3 mt-md-0">
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Szukaj produktu..." style="max-width: 300px;">
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                    <?php if(request('search')): ?>
                        <a href="/" class="btn btn-secondary">Wyczyść</a>
                    <?php endif; ?>
                </form>
            </div>
        </div>

        <?php if($products->isEmpty()): ?>
            <div class="alert alert-warning text-center py-4">
                Nie znaleziono produktów spełniających kryteria.
            </div>
        <?php endif; ?>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark"><?php echo e($product->name); ?></h5>
                            <p class="card-text text-muted small flex-grow-1"><?php echo e($product->description); ?></p>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-primary"><?php echo e($product->price); ?> PLN</span>
                                    <span class="badge <?php echo e($product->stock > 0 ? 'bg-success' : 'bg-danger'); ?>">
                                        W magazynie: <?php echo e($product->stock); ?> szt.
                                    </span>
                                </div>

                                <div class="d-grid gap-2">
                                    <?php if(auth()->check()): ?>
                                        <form action="/cart/add/<?php echo e($product->id); ?>" method="POST" class="d-grid">
                                            <?php echo csrf_field(); ?>
                                            <button type="submit" class="btn btn-outline-primary" <?php echo e($product->stock == 0 ? 'disabled' : ''); ?>>
                                                Dodaj do koszyka
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <button class="btn btn-outline-secondary btn-sm" disabled>Zaloguj się, aby kupić</button>
                                    <?php endif; ?>

                                    <?php if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'employee')): ?>
                                        <div class="d-flex gap-2 mt-2">
                                            <a href="/products/<?php echo e($product->id); ?>/edit" class="btn btn-sm btn-warning flex-grow-1 fw-semibold text-dark">✏️ Edytuj</a>
                                            
                                            <form action="/products/<?php echo e($product->id); ?>" method="POST" class="flex-grow-1 m-0" onsubmit="return confirm('Usunąć ten produkt?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Usuń</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="d-flex justify-content-center mt-5">
            <?php echo e($products->links('pagination::bootstrap-5')); ?>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH P:\Xampp\htdocs\sklep\resources\views/sklep_home.blade.php ENDPATH**/ ?>