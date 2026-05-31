<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

    <div class="card shadow-sm border-0 p-4 w-100" style="max-width: 450px;">
        <div class="text-center mb-4">
            <a href="/" class="fs-3 fw-bold text-dark text-decoration-none text-uppercase">Sportex</a>
            <p class="text-muted small">Utwórz darmowe konto użytkownika</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2 small">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="/register" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label small fw-semibold">Imię i nazwisko</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="np. Jan Kowalski" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Adres e-mail</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-semibold">Hasło</label>
                <input type="password" name="password" class="form-control" placeholder="Minimum 8 znaków" required>
            </div>

            <div class="mb-4">
                <label class="form-label small fw-semibold">Potwierdź hasło</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-success">Zarejestruj się</button>
            </div>

            <div class="text-center">
                <span class="text-muted small">Masz już konto?</span>
                <a href="/login" class="small text-decoration-none">Zaloguj się</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>