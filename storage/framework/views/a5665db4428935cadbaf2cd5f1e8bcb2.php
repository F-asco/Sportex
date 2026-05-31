<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zarządzanie Użytkownikami - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/admin/dashboard">PANEL ADMINISTRATORA</a>
        
        <div class="d-flex gap-2">
            <a href="/employee/dashboard" class="btn btn-outline-warning btn-sm">🛠️ Panel pracownika</a>
            <a href="/admin/dashboard" class="btn btn-outline-light btn-sm">Powrót do pulpitu</a>
        </div>
    </div>
</nav>

    <div class="container">
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold m-0 text-dark">Użytkownicy Systemu</h2>
                <a href="/admin/users/create" class="btn btn-primary">➕ Dodaj użytkownika</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Imię i nazwisko</th>
                            <th>Adres e-mail</th>
                            <th>Rola w systemie</th>
                            <th>Data rejestracji</th>
                            <th class="text-center">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($user->id); ?></td>
                                <td class="fw-semibold"><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td>
                                    <?php if($user->role === 'admin'): ?>
                                        <span class="badge bg-danger text-uppercase px-2 py-1">Admin</span>
                                    <?php elseif($user->role === 'employee'): ?>
                                        <span class="badge bg-warning text-dark text-uppercase px-2 py-1">Pracownik</span>
                                    <?php else: ?>
                                        <span class="badge bg-secondary text-uppercase px-2 py-1">Klient</span>
                                    <?php endif; ?>
                                </td>
                                <td class="small text-muted"><?php echo e($user->created_at->format('Y-m-d')); ?></td>
                                <td class="text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="/admin/users/<?php echo e($user->id); ?>/edit" class="btn btn-sm btn-outline-primary">Edytuj</a>
                                        
                                        <?php if(auth()->id() !== $user->id): ?>
                                            <form action="/admin/users/<?php echo e($user->id); ?>" method="POST" class="m-0" onsubmit="return confirm('Czy na pewno chcesz usunąć tego użytkownika?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger">Usuń</button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-sm btn-outline-secondary" disabled>Mój profil</button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html><?php /**PATH P:\Xampp\htdocs\sklep\resources\views/admin/index.blade.php ENDPATH**/ ?>