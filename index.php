<?php
require_once 'functions.php';

$result   = null;
$errors   = [];
$formData = ['name' => '', 'price' => '', 'category' => ''];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputName     = $_POST['name']     ?? '';
    $inputPrice    = $_POST['price']    ?? '';
    $inputCategory = $_POST['category'] ?? '';

    $formData = [
        'name'     => htmlspecialchars($inputName),
        'price'    => htmlspecialchars($inputPrice),
        'category' => htmlspecialchars($inputCategory),
    ];

    $validasi = validasiInput($inputName, $inputPrice, $inputCategory);

    if ($validasi['valid']) {
        $result = prosesHargaAkhir($inputName, (float) $inputPrice, $inputCategory);
    } else {
        $errors = $validasi['errors'];
    }
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalkulator Diskon Produk</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Kalkulator Diskon Produk</h1>
    <p class="subtitle">Diskon produk berbeda sesuai kategori dan harga, dalam nominal (Rp).</p>

    <hr>

    <h2>Aturan Diskon</h2>
    <table>
        <thead>
            <tr>
                <th>Kategori</th>
                <th>Kondisi</th>
                <th>Diskon</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">Electronics</td>
                <td>Harga &gt; Rp 1.000.000</td>
                <td>Rp 120.000</td>
            </tr>
            <tr>
                <td>Harga &le; Rp 1.000.000</td>
                <td>Rp 50.000</td>
            </tr>
            <tr>
                <td rowspan="2">Furniture</td>
                <td>Harga &gt; Rp 2.500.000</td>
                <td>Rp 375.000</td>
            </tr>
            <tr>
                <td>Harga &le; Rp 2.500.000</td>
                <td>Rp 125.000</td>
            </tr>
            <tr>
                <td rowspan="2">Food</td>
                <td>Harga &gt; Rp 200.000</td>
                <td>Rp 10.000</td>
            </tr>
            <tr>
                <td>Harga &le; Rp 200.000</td>
                <td>Rp 0</td>
            </tr>
        </tbody>
    </table>

    <hr>

    <h2>Cek Harga Produk</h2>

    <?php if (!empty($errors)) : ?>
    <div class="error-box">
        <strong>Input Tidak Valid:</strong>
        <ul>
            <?php foreach ($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>

    <form method="POST" action="">
        <div class="form-group">
            <label for="name">Nama Produk:</label>
            <input type="text" id="name" name="name" value="<?= $formData['name'] ?>" placeholder="Contoh: Laptop Lenovo" required>
        </div>

        <div class="form-group">
            <label for="price">Harga (Rp):</label>
            <input type="number" id="price" name="price" value="<?= $formData['price'] ?>" placeholder="Contoh: 1200000" min="1" required>
        </div>

        <div class="form-group">
            <label for="category">Kategori:</label>
            <select id="category" name="category" required>
                <option value="" disabled <?= empty($formData['category']) ? 'selected' : '' ?>>-- Pilih Kategori --</option>
                <?php foreach (array_keys(DISCOUNT_RULES) as $cat) : ?>
                <option value="<?= $cat ?>" <?= $formData['category'] === $cat ? 'selected' : '' ?>><?= $cat ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Hitung Diskon</button>
    </form>

    <?php if ($result !== null) : ?>
    <hr>
    <h2>Hasil Kalkulasi</h2>
    <table>
        <tr>
            <th>Nama Produk</th>
            <td><?= $result['name'] ?></td>
        </tr>
        <tr>
            <th>Kategori</th>
            <td><?= $result['category'] ?></td>
        </tr>
        <tr>
            <th>Harga Asli</th>
            <td><?= formatRupiah($result['harga_asli']) ?></td>
        </tr>
        <tr>
            <th>Diskon</th>
            <td><?= $result['diskon'] > 0 ? formatRupiah($result['diskon']) : 'Tidak ada diskon' ?></td>
        </tr>
        <tr>
            <th>Harga Akhir</th>
            <td><strong><?= formatRupiah($result['harga_akhir']) ?></strong></td>
        </tr>
    </table>
    <?php endif; ?>

    <hr>

    <footer>
        &copy; <?= date('Y') ?> Kalkulator Diskon E-Commerce &mdash; PHP Native
    </footer>

</body>
</html>
