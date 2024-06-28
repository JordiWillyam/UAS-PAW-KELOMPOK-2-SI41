# Panduan Instalasi Proyek Penjualan,Pembelian dan Persediaan Pada Toko Plastik 

Kelompok 2.
Kelas SI41.
Universitas Multi Data Palembang.

## Anggota Kelompok 2
- **Michael** (2226240001)
- **Jenifer Gunawan** (2226240003)
- **Anas Al Marzaq** (2226240070)
- **Jordi Willyam AK** (2226240138)
- **Michael Richi** (2226240154)
- **Krisna Riyandi** (2226240155)

## Petunjuk Instalasi

### Langkah 1: Unduh Proyek
- Unduh file proyek dalam format Zip atau fork repositori ini.

### Langkah 2: Buka di Visual Studio Code
- Ekstrak file Zip (jika diunduh) dan buka folder POS-LaravelFinalsPaw di Visual Studio Code.

### Langkah 3: Perbarui Composer
- Pada terminal di Visual Studio Code, jalankan perintah berikut:
  ```bash
  composer update

### Langkah 4: Jalankan XAMPP
- Buka XAMPP dan aktifkan modul Apache dan MySQL.
- Jika kamu belum memiliki aplikasi XAMPP kamu bisa mendownloadnya di [XAMPP](https://www.apachefriends.org/download.html)

### Langkah 5: Buat Database
- Buka browser Anda dan navigasikan ke [phpMyAdmin](http://localhost/phpmyadmin).
- Buat database baru.

### Langkah 6: Perbarui Konfigurasi .env
- Buka Folder POS-LaravelFinalsPaw pada Visual Studio Code dan buka file `.env`.
- Ubah nilai `DB_DATABASE` menjadi nama database yang baru Anda buat:
  ```env
  DB_DATABASE= nama_database_anda

### Langkah 7: Migrasi Database
- Pada terminal di Visual Studio Code, jalankan perintah berikut untuk melakukan migrasi database:
  ```bash
  php artisan migrate

### Langkah 8: Seed Database
- Pada terminal di Visual Studio Code, jalankan perintah berikut untuk menambahkan kredensial Admin:
  ```bash
  php artisan db:seed

### Langkah 9: Kredensial Pengguna Admin
- Berikut merupakan kredensial untuk masuk sebagai admin:
- **Email: admin@admin.com**
- **Password: password**

### Langkah 10: Jalankan Server
- Pada terminal di Visual Studio Code, jalankan perintah berikut:
  ```bash
  php artisan serve

### Langkah 11: Akses Aplikasi
- Buka browser Anda dan pergi ke http://127.0.0.1:8000/.
- Masuk menggunakan kredensial admin yang telah disediakan di atas.

**Atau kamu bisa membuka aplikasi tersebut yang telah kami Hosting di** - https://tokoplastikcharlesjaya.my.id/
