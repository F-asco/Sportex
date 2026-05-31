<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edycja Użytkownika - Sportex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

    <div class="container" style="max-width: 550px;">
        <div class="mb-3">
            <a href="/admin/users" class="text-decoration-none text-secondary">← Anuluj zmiany</a>
        </div>

        <div class="card shadow-sm border-0 p-4">
            <h2 class="fw-bold mb-1 text-dark text-center">Modyfikacja Konta</h2>
            <p class="text-muted small text-center mb-4">Edytujesz profil użytkownika: ID {{ $user->id }}</p>

            @if ($errors->any())
                <div class="alert alert-danger py-2 small">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/admin/users/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Imię i nazwisko</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-semibold">Adres e-mail</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label small fw-semibold">Poziom uprawnień (Rola)</label>
                    <select name="role" class="form-select" {{ auth()->id() === $user->id ? 'disabled' : '' }}>
                        <option value="client" {{ old('role', $user->role) == 'client' ? 'selected' : '' }}>Klient</option>
                        <option value="employee" {{ old('role', $user->role) == 'employee' ? 'selected' : '' }}>Pracownik / Moderator</option>
                        <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Administrator</option>
                    </select>
                    @if(auth()->id() === $user->id)
                        <div class="form-text text-muted small">Nie możesz zmienić własnej roli administratora, aby nie zablokować sobie dostępu.</div>
                    @endif
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">Zapisz wprowadzone zmiany</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>