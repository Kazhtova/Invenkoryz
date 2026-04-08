# 📦 Invenkoryz - Inventory Management System

> **English:** A comprehensive and centralized web-based application designed to manage inventory operations, track inbound and outbound transactions, and generate analytical reports.
>
> **Bahasa Indonesia:** Aplikasi berbasis web yang komprehensif dan terpusat, dirancang untuk mengelola operasi inventaris, melacak transaksi barang masuk dan keluar, serta menghasilkan laporan analitik.

---

## 🚀 Features (Fitur)

* **Dashboard Analitik (Analytics Dashboard):** Visualisasi data ringkas mengenai status inventaris.
* **Master Data Management:** Pengelolaan data inti barang, kategori, dan entitas terkait.
* **Manajemen Transaksi (Transaction Management):**
    * **Transaksi Masuk (Inbound Transactions):** Pencatatan barang masuk dari pemasok.
    * **Transaksi Keluar (Outbound Transactions):** Pencatatan distribusi atau pengeluaran barang.
    * **Transaksi Retur (Return Transactions):** Penanganan pengembalian barang.
* **Stok Opname (Stocktaking):** Fitur untuk penyesuaian dan audit stok fisik.
* **Laporan Kenaikan Harga (Price Increase Reports):** Pemantauan fluktuasi harga barang.
* **Export Functionality:** Ekspor data transaksi untuk kebutuhan pelaporan eksternal.

---

## 🛠️ Tech Stack (Teknologi yang Digunakan)

* **Framework:** Laravel (PHP)
* **Database:** MySQL
* **Frontend UI:** HTML, CSS, JavaScript (Template by ThemeKita / ThemeWagon)
* **Local Server:** XAMPP / Laragon

---

## ⚙️ Installation & Setup (Instalasi & Pengaturan)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di lingkungan lokal Anda (Local Environment):

1. **Clone the repository:**
   ```bash
   git clone [https://github.com/Kazhtova/Invenkoryz.git](https://github.com/Kazhtova/Invenkoryz.git)
   cd Invenkoryz

    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    php artisan serve
    npm run dev