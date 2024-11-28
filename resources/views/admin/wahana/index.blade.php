<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wahana Germanggis</title>
</head>
<body>
    <h1>Daftar Wahana di Germanggis</h1>
    <ul>
        @foreach ($wahanas as $wahana)
            <li>
                <h2>{{ $wahana->name }}</h2>
                <p>{{ $wahana->description }}</p>
                <p>Harga: Rp {{ number_format($wahana->price, 0, ',', '.') }}</p>
                <img src="{{ asset('storage/' . $wahana->image) }}" alt="{{ $wahana->name }}" width="300">
            </li>
        @endforeach
    </ul>
</body>
</html>
