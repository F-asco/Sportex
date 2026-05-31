<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sportex') }}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-light">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4 shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold" href="/">SPORTEX STORE</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-center gap-2">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <li class="nav-item"><a class="btn btn-danger btn-sm fw-semibold text-white px-3" href="/admin/dashboard">🛡️ Panel Administratora</a></li>
                            @endif
                            @if(auth()->user()->role === 'employee')
                                <li class="nav-item"><a class="btn btn-warning btn-sm fw-semibold text-dark px-3" href="/employee/dashboard">🛠️ Panel Pracownika</a></li>
                            @endif

                            <li class="nav-item"><a class="nav-link" href="/cart">🛒 Koszyk</a></li>
                            <li class="nav-item text-white-50 small px-2">Zalogowany jako: <strong>{{ auth()->user()->name }}</strong></li>
                            <li class="nav-item">
                                <form action="/logout" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Wyloguj się</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item"><a class="nav-link" href="/login">Zaloguj się</a></li>
                            <li class="nav-item"><a class="btn btn-sm btn-primary text-white" href="/register">Zarejestruj się</a></li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container py-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm mb-4" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold mb-4 text-dark">Dostępny Asortyment</h2>
                    
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @forelse($products as $product)
                            <div class="col">
                                <div class="card h-100 border-0 shadow-sm">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                                            <p class="card-text text-muted small">{{ \Illuminate\Support\Str::limit($product->description, 120, '...') }}</p>
                                        </div>
                                        <div class="mt-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <span class="text-primary fw-bold fs-5">{{ number_format($product->price, 2, ',', ' ') }} PLN</span>
                                                <span class="badge {{ $product->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }}">
                                                    {{ $product->stock > 0 ? 'Dostępny: ' . $product->stock : 'Brak na stanie' }}
                                                </span>
                                            </div>

                                            @auth
                                                @if($product->stock > 0)
                                                    <form action="/cart/add/{{ $product->id }}" method="POST" class="d-grid mb-2">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success fw-semibold">🛒 Dodaj do koszyka</button>
                                                    </form>
                                                @endif

                                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'employee')
                                                    <div class="d-flex gap-2 border-top pt-2 mt-2">
                                                        <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning flex-grow-1 fw-semibold">✏️ Edytuj</a>
                                                        <form action="/products/{{ $product->id }}" method="POST" class="d-inline flex-grow-1">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-sm btn-danger w-100 fw-semibold" onclick="return confirm('Czy na pewno chcesz usunąć ten produkt?')">Usuń</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="d-grid">
                                                    <a href="/login" class="btn btn-sm btn-outline-secondary">Zaloguj się, aby wypożyczyć</a>
                                                </div>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <p class="text-muted fs-5">Brak dostępnych produktów w bazie danych.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>