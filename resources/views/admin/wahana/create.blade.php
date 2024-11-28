<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Wahana</title>
</head>
<body>
    <h1>Tambah Wahana Baru</h1>
    <form action="{{ route('wahana.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="name">Nama Wahana:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Deskripsi:</label>
        <textarea id="description" name="description" required></textarea><br><br>

        <label for="price">Harga:</label>
        <input type="number" id="price" name="price" min="0" required><br><br>

        <label for="image">Gambar:</label>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit">Simpan Wahana</button>
    </form>
</body>
</html>
