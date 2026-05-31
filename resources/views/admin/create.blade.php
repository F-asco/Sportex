<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nowy Użytkownik - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 550px;">
        <div class="mb-3">
            <a href="/admin/users" class="text-decoration-none text-secondary">← Powrót do listy</a>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <h2 class="fw-bold mb-4 text-dark text-center">Utwórz Nowe Konto</h2>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/users" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-semibold">Imię i nazwisko</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Adres e-mail</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Rola systemowa</label>
                    <select name="role" class="form-select">
                        <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>Klient</option>
                        <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Pracownik / Moderator</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold">Hasło konta</label>
                    <input type="password" name="password" class="form-control" placeholder="Minimum 8 znaków" required>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Zapisz użytkownika</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>