# Telkom Internship Management System

Aplikasi web ini dibuat untuk mengelola sistem manajemen magang Telkom, dengan fitur lengkap mulai dari registrasi, login, dashboard berdasarkan role (Admin, User, dan Pembimbing), hingga upload tugas dan edit profil.

## 📦 Fitur Utama

- 🔐 **Login & Register sesuai role pengguna:** Memungkinkan pengguna untuk masuk sesuai peran masing-masing (Admin, User, atau Pembimbing).
- 📊 **Dashboard dengan navigasi berdasarkan peran:** Setiap pengguna akan melihat tampilan dashboard yang berbeda sesuai hak aksesnya.
- 📁 **Upload dan Kelola Tugas:** User dapat mengunggah tugas magang dan Pembimbing bisa meninjau serta mengelola tugas tersebut.
- 🖼️ **Ganti Foto Profil & Edit Informasi Akun:** Pengguna dapat memperbarui informasi pribadi serta mengganti foto profil.
- 🎨 **Tampilan Responsif dan Modern:** UI dirancang dengan konsep minimalis namun tetap menarik dan mudah digunakan.
- 🧑‍💼 **Hak Akses Berdasarkan Role:** Setiap fitur dibatasi sesuai dengan peran pengguna dalam sistem.
- ⚙️ **CRUD Data Tugas & Manajemen Pengguna:** Admin memiliki akses penuh untuk mengelola data pengguna dan tugas.
- 🖌️ **Desain Mengikuti Figma:** Struktur tampilan, font, dan warna disesuaikan dengan mockup Figma.

## 💡 Teknologi yang Digunakan

- **Laravel 10:** Framework utama backend untuk manajemen data dan routing.
- **Blade Template:** Engine templating Laravel untuk membuat tampilan HTML yang dinamis.
- **Tailwind CSS / Custom CSS:** Digunakan untuk membangun tampilan antarmuka yang responsif dan modern.
- **MySQL / SQLite:** Basis data untuk menyimpan informasi user, tugas, dan peran.
- **PHP 8.x:** Bahasa pemrograman backend utama.
- **Composer:** Untuk mengelola dependensi Laravel.
- **Artisan CLI:** Digunakan untuk menjalankan migrasi, seeder, dan perintah lainnya.

## 🖼️ Preview Tampilan

![Preview Profil](preview/profile-page.png)  
*Halaman profil dengan fitur ganti foto dan data lengkap pengguna.*

## 🚀 Cara Menjalankan Secara Lokal

1. Clone repositori ini atau unduh dari Google Drive:
   👉 [Download dari Google Drive](https://drive.google.com/drive/folders/10SJhLSn6w76U1lw6V7vfzbndvJwK6uM7?usp=sharing)

2. Jalankan perintah berikut:

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
