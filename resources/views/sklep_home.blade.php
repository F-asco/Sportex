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
                @if(auth()->check())
                    <span class="small">Zalogowany jako: <strong>{{ auth()->user()->name }}</strong></span>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="/admin/dashboard" class="btn btn-danger btn-sm fw-semibold">🛡️ Panel Admina</a>
                    @endif
                    @if(auth()->user()->role === 'employee')
                        <a href="/employee/dashboard" class="btn btn-warning btn-sm fw-semibold text-dark">🛠️ Panel Pracownika</a>
                    @endif

                    <a href="/cart" class="btn btn-outline-light btn-sm position-relative">
                        🛒 Koszyk
                    </a>
                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'employee')
                        <a href="/products/create" class="btn btn-success btn-sm">➕ Dodaj produkt</a>
                    @endif
                    <form action="/logout" method="POST" class="m-0">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Wyloguj</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline-light btn-sm">Zaloguj się</a>
                    <a href="/register" class="btn btn-light btn-sm">Zarejestruj się</a>
                @endif
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
            </div>
        @endif

        <div class="row my-4 align-items-center">
            <div class="col-md-6">
                <h2 class="fw-bold m-0">Nasza Oferta Produktów</h2>
            </div>
            <div class="col-md-6">
                <form action="/" method="GET" class="d-flex gap-2 justify-content-md-end mt-3 mt-md-0">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Szukaj produktu..." style="max-width: 300px;">
                    <button type="submit" class="btn btn-primary">Filtruj</button>
                    @if(request('search'))
                        <a href="/" class="btn btn-secondary">Wyczyść</a>
                    @endif
                </form>
            </div>
        </div>

        @if($products->isEmpty())
            <div class="alert alert-warning text-center py-4">
                Nie znaleziono produktów spełniających kryteria.
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">{{ $product->name }}</h5>
                            <p class="card-text text-muted small flex-grow-1">{{ $product->description }}</p>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <span class="fs-4 fw-bold text-primary">{{ $product->price }} PLN</span>
                                    <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}">
                                        W magazynie: {{ $product->stock }} szt.
                                    </span>
                                </div>

                                <div class="d-grid gap-2">
                                    @if(auth()->check())
                                        <form action="/cart/add/{{ $product->id }}" method="POST" class="d-grid">
                                            @csrf
                                            <button type="submit" class="btn btn-outline-primary" {{ $product->stock == 0 ? 'disabled' : '' }}>
                                                Dodaj do koszyka
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-secondary btn-sm" disabled>Zaloguj się, aby kupić</button>
                                    @endif

                                    @if(auth()->check() && (auth()->user()->role === 'admin' || auth()->user()->role === 'employee'))
                                        <div class="d-flex gap-2 mt-2">
                                            <a href="/products/{{ $product->id }}/edit" class="btn btn-sm btn-warning flex-grow-1 fw-semibold text-dark">✏️ Edytuj</a>
                                            
                                            <form action="/products/{{ $product->id }}" method="POST" class="flex-grow-1 m-0" onsubmit="return confirm('Usunąć ten produkt?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Usuń</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>