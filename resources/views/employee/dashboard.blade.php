<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Pracownika - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">SPORTEX PANEL</a>
                @if(auth()->user()->role === 'admin')
            <a href="/admin/dashboard" class="btn btn-danger btn-sm">⬅ Wróć do Panelu Admina</a>
                @endif
            <span class="navbar-text text-white small">Poziom dostępu: <strong class="text-warning">Pracownik</strong></span>
        </div>
    </nav>

    <div class="container" style="max-width: 800px;">
        <div class="card shadow-sm border-0 p-4 mb-4 text-center bg-white">
            <div class="fs-1 mb-2">🛠️</div>
            <h2 class="fw-bold text-dark">Panel Kontrolny Moderatora</h2>
            <p class="text-muted">Witaj, <strong>{{ auth()->user()->name }}</strong>. Posiadasz uprawnienia do edycji, dodawania oraz usuwania towarów z asortymentu sklepu.</p>
        </div>

        <div class="card shadow-sm border-0 p-4 bg-white mb-4">
    <h4 class="fw-bold text-dark mb-4 text-center">Dostępne operacje</h4>
    <div class="row g-3">
        <div class="col-md-4">
            <div class="card h-100 border text-center p-3">
                <h5>Dodaj produkt</h5>
                <p class="text-muted small">Wprowadź nowy sprzęt sportowy do bazy.</p>
                <a href="/products/create" class="btn btn-success mt-auto">➕ Dodaj</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border text-center p-3">
                <h5>Zarządzaj ofertą</h5>
                <p class="text-muted small">Edytuj lub usuwaj pozycje w sklepie.</p>
                <a href="/" class="btn btn-primary mt-auto">📋 Produkty</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card h-100 border text-center p-3">
                <h5>Historia zamówień</h5>
                <p class="text-muted small">Podgląd wszystkich zrealizowanych transakcji.</p>
                <a href="/orders" class="btn btn-info text-white mt-auto">📦 Zobacz zamówienia</a>
            </div>
        </div>
    </div>
</div>

        <div class="text-center">
            <form action="/logout" method="POST" class="d-inline-block">
                @csrf
                <button type="submit" class="btn btn-outline-danger px-4">Wyloguj się z systemu</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>