# Kalkulator Diskon Produk (E-Commerce)

Proyek ini adalah aplikasi web sederhana berbasis **PHP Native** untuk menghitung harga akhir sebuah produk setelah diberikan diskon. Diskon yang diberikan bervariasi bergantung pada kategori produk dan harga aslinya.

## 📷 Tampilan Aplikasi

<img width="1912" height="1327" alt="image" src="https://github.com/user-attachments/assets/ddf0236c-0630-4d04-9102-65cddc097cc0" />

## 🚀 Fitur

- Menghitung diskon berdasarkan **Kategori** (Electronics, Furniture, Food).
- Terdapat batasan harga minimal (*threshold*) pada tiap kategori untuk mendapatkan diskon maksimal.
- Form validasi input (tidak boleh kosong, harga harus berupa angka positif).
- Menampilkan hasil kalkulasi dalam format mata uang Rupiah (Rp).

## 🛠️ Aturan Diskon

| Kategori    | Kondisi                | Diskon     |
|-------------|------------------------|------------|
| Electronics | Harga > Rp 1.000.000   | Rp 120.000 |
|             | Harga ≤ Rp 1.000.000   | Rp  50.000 |
| Furniture   | Harga > Rp 2.500.000   | Rp 375.000 |
|             | Harga ≤ Rp 2.500.000   | Rp 125.000 |
| Food        | Harga > Rp 200.000     | Rp  10.000 |
|             | Harga ≤ Rp 200.000     | Rp       0 |

## 📁 Struktur File

- `index.php`: Antarmuka pengguna (UI) utama dan form untuk input data produk.
- `functions.php`: Berisi logika perhitungan diskon, validasi form, dan fungsi format mata uang Rupiah.
- `style.css`: File CSS untuk mengatur gaya tampilan antarmuka web.

## 💻 Cara Menjalankan

1. Pastikan Anda sudah menginstal web server lokal seperti **XAMPP**, **Laragon**, atau sejenisnya.
2. Clone atau unduh repositori ini dengan command: 
`git clone https://github.com/FrankStein31/KalkulatorDiskon.git`.
3. Ekstrak atau pindahkan folder proyek ke direktori root server lokal Anda (`htdocs` untuk XAMPP, atau `www` untuk Laragon).
4. Buka browser dan akses proyek melalui URL lokal, contoh: `http://localhost/kalkulatordiskon/`.
