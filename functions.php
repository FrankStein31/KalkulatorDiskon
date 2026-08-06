<?php
const DISCOUNT_RULES = [
    'Electronics' => ['threshold' => 1000000, 'high' => 120000, 'low' => 50000],
    'Furniture'   => ['threshold' => 2500000, 'high' => 375000, 'low' => 125000],
    'Food'        => ['threshold' =>  200000, 'high' =>  10000, 'low' =>      0],
];

function hitungDiskon(string $category, float $price): int
{
    $rule = DISCOUNT_RULES[$category];
    return $price > $rule['threshold'] ? $rule['high'] : $rule['low'];
}

function validasiInput(string $name, string $price, string $category): array
{
    $errors = [];

    if (trim($name) === '') {
        $errors[] = 'Nama produk wajib diisi.';
    }

    if (!is_numeric($price) || (float) $price <= 0) {
        $errors[] = 'Harga harus berupa angka lebih dari 0.';
    }

    if (!array_key_exists($category, DISCOUNT_RULES)) {
        $errors[] = 'Kategori harus salah satu dari: Electronics, Furniture, Food.';
    }

    return ['valid' => empty($errors), 'errors' => $errors];
}

function prosesHargaAkhir(string $name, float $price, string $category): array
{
    $diskon     = hitungDiskon($category, $price);
    $hargaAkhir = $price - $diskon;

    return [
        'name'        => htmlspecialchars(trim($name)),
        'category'    => $category,
        'harga_asli'  => $price,
        'diskon'      => $diskon,
        'harga_akhir' => $hargaAkhir,
    ];
}

function formatRupiah(float $angka): string
{
    return 'Rp ' . number_format($angka, 0, ',', '.');
}
