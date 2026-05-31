<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="/">SPORTEX SYSTEM</a>
            <span class="navbar-text text-white small">Poziom dostępu: <strong class="text-danger">Administrator</strong></span>
        </div>
    </nav>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-body text-center py-4">
                        <div class="fs-1 text-primary mb-2">👤</div>
                        <h5 class="card-title fw-bold">{{ auth()->user()->name }}</h5>
                        <p class="card-text text-muted small">{{ auth()->user()->email }}</p>
                        <hr>
                        <form action="/logout" method="POST" class="d-grid">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Wyloguj się</button>
                        </form>
                    </div>
                </div>

                <div class="list-group shadow-sm border-0 mb-4">
                    <a href="/" class="list-group-item list-group-item-action fw-semibold">📋 Strona główna sklepu</a>
                    <a href="/admin/users" class="list-group-item list-group-item-action fw-semibold list-group-item-primary">👥 Zarządzanie użytkownikami (CRUD)</a>
                    <a href="/products/create" class="list-group-item list-group-item-action fw-semibold">➕ Dodaj nowy produkt</a>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4 mb-4">
                    <h3 class="fw-bold mb-3 text-dark">Zarządzanie Systemem</h3>
                    <p class="text-muted">Witaj w panelu głównym. Jako administrator masz pełne uprawnienia do zarządzania bazą użytkowników, weryfikacji ról systemowych oraz pełnej modyfikacji asortymentu sklepu.</p>
                </div>

                <div class="card shadow-sm border-0 bg-dark text-white p-4 mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h4 class="fw-bold m-0 text-warning">🛠️ Funkcje Pracownicze</h4>
                        <span class="badge bg-warning text-dark text-uppercase fw-bold">Pełny Dostęp</span>
                    </div>
                    <p class="text-white-50 small mb-3">
                        Posiadasz najwyższe uprawnienia w systemie. Możesz bez przeszkód przełączyć się do modułu pracowniczego, aby zarządzać bieżącymi rezerwacjami, zwrotami oraz weryfikować stan sprzętu w wypożyczalni.
                    </p>
                    <div>
                        <a href="/employee/dashboard" class="btn btn-warning fw-semibold px-4">Przejdź do panelu pracownika</a>
                    </div>
                </div>

                <div class="card shadow-sm border-0 p-4">
                    <h4 class="fw-bold mb-3 text-dark">Szybkie statystyki i narzędzia</h4>
                    <div class="row g-3 text-center">
                        <div class="col-6">
                            <div class="p-3 bg-primary bg-opacity-10 rounded">
                                <span class="d-block text-muted small">Status bazy</span>
                                <strong class="text-primary fs-5">Połączono</strong>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="p-3 bg-success bg-opacity-10 rounded">
                                <span class="d-block text-muted small">Silnik bazodanowy</span>
                                <strong class="text-success fs-5">SQLite</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>