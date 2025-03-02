# 📌 Website Absensi Siswa

Website ini bertujuan untuk mempermudah guru dalam mengabsen siswa di sekolah. Proyek ini dibangun menggunakan:

- **Framework:** Laravel 11
- **Database:** MySQL
- **Editor:** Visual Studio Code (VS Code)

## 🚀 Fitur

### 🎓 Siswa
- [ ] Fitur Login sesuai NISN dan Password
- [ ] Fitur Mengajukan ketidak hadiran melalui sistem
- [ ] Fitur Melihat Rekap Absen
- [ ] Fitur Log-out

### 👨‍🏫 Admin
- [ ] Dashboard
- [ ] Fitur Login
- [ ] Fitur Register
- [ ] Fitur Menambahkan data siswa
- [ ] Fitur Melihat data siswa
- [ ] Fitur Mengedit data siswa
- [ ] Fitur Menghapus data siswa
- [ ] Fitur Menambahkan data guru
- [ ] Fitur Melihat data guru
- [ ] Fitur Mengedit data guru
- [ ] Fitur Menghapus data guru
- [ ] Fitur Menambahkan data kelas
- [ ] Fitur Melihat data kelas
- [ ] Fitur Mengedit data kelas
- [ ] Fitur Menghapus data kelas
- [ ] Fitur Menambahkan data jurusan
- [ ] Fitur Melihat data jurusan
- [ ] Fitur Mengedit data jurusan
- [ ] Fitur Menghapus data jurusan
- [ ] Fitur Menambahkan data wali kelas
- [ ] Fitur Melihat data wali kelas
- [ ] Fitur Mengedit data wali kelas
- [ ] Fitur Menghapus data wali kelas
- [ ] Fitur Log-out

### 🏫 Guru
- [ ] Fitur Login
- [ ] Fitur Melihat dan Mengedit data absensi
- [ ] Fitur Absen Masuk
- [ ] Fitur Melihat rekap absensi siswa
- [ ] Fitur Menerima notifikasi keterangan dari siswa
- [ ] Fitur Mencetak rekap absensi siswa
- [ ] Fitur Absen Pulang
- [ ] Fitur Log-out

### 👨‍👩‍👧 Orang Tua
- [ ] Fitur Menerima rekap absensi anak tidak secara langsung
- [ ] Fitur Mengajukan permohonan izin untuk anaknya
- [ ] Fitur Menerima notifikasi absensi anak melalui WA

## 📌 Instalasi

1. Clone repository ini:
```bash
git clone https://github.com/username/absensi-siswa.git
```
2. Masuk ke folder proyek:
```bash
cd absensi-siswa
```
3. Install dependensi Laravel:
```bash
composer install
```
4. Buat file `.env` dengan menyalin `.env.example`:
```bash
cp .env.example .env
```
5. Generate key aplikasi:
```bash
php artisan key:generate
```
6. Konfigurasi database di file `.env`:
```
  DB_CONNECTION=mysql
  DB_HOST=127.0.0.1
  DB_PORT=3306
  DB_DATABASE=absensi_siswa
  DB_USERNAME=root
  DB_PASSWORD=
  ```
7. Jalankan migrasi database:
```bash
php artisan migrate
```
8. Jalankan server lokal:
```bash
php artisan serve
```
9. Akses website di browser:
```
  http://localhost:8000
  ```

## 📌 Perkembangan
Centang fitur yang telah berhasil diimplementasikan ✅ dan update README ini seiring perkembangan proyek.

## 📌 Kontribusi
Jika ingin berkontribusi, silakan fork repository ini dan buat pull request dengan perubahan yang telah dilakukan.

## 📌 Lisensi