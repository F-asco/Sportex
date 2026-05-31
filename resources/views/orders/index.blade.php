<!DOCTYPE html>
<html lang="pl">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Historia Zamówień</h2>
    <a href="/employee/dashboard" class="btn btn-secondary">
        ⬅ Wróć do Panelu
    </a>
</div>
    <table class="table table-hover bg-white shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Klient</th> <th>Produkt</th>
                <th>Ilość</th>
                <th>Suma (PLN)</th>
                <th>Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user->name ?? 'Nieznany' }}</td>
                <td>{{ $order->product->name ?? 'Usunięty' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>{{ number_format($order->total_price, 2) }}</td>
                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>