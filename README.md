# Panduan Instalasi Proyek Penjualan,Pembelian dan Persediaan Pada Toko Plastik 

Kelompok 2  
Kelas : SI41  
[Universitas Multi Data Palembang](https://mdp.ac.id/)

## Anggota Kelompok 2
- **Michael** (2226240001)
- **Jenifer Gunawan** (2226240003)
- **Anas Al Marzaq** (2226240072)
- **Jordi Willyam AK** (2226240138)
- **Michael Richi** (2226240154)
- **Krisna Riyandi** (2226240155)

## Petunjuk Instalasi

### Step 1: Download Project
- Unduh file proyek dalam format Zip atau fork repositori ini.

### Step 2: Open in Visual Studio Code
- Ekstrak file Zip (jika diunduh) dan buka folder POS-LaravelFinalsPaw di Visual Studio Code.

### Step 3: Update Composer
- Pada terminal di Visual Studio Code, jalankan perintah berikut:
  ```bash
  composer update

### Step 4: Run XAMPP
- Buka XAMPP dan aktifkan modul Apache dan MySQL.
- Jika kamu belum memiliki aplikasi XAMPP kamu bisa mendownloadnya di [XAMPP](https://www.apachefriends.org/download.html)

### Step 5: Create a Database
- Buka browser Anda dan navigasikan ke [phpMyAdmin](http://localhost/phpmyadmin).
- Buat database baru.

### Step 6: Update .env Configuration
- Buka Folder POS-LaravelFinalsPaw pada Visual Studio Code dan buka file `.env`.
- Ubah nilai `DB_DATABASE` menjadi nama database yang baru Anda buat:
  ```env
  DB_DATABASE= nama_database_anda

### Step 7: Database Migration
- Pada terminal di Visual Studio Code, jalankan perintah berikut untuk melakukan migrasi database:
  ```bash
  php artisan migrate

### Step 8: Seed Database
- Pada terminal di Visual Studio Code, jalankan perintah berikut untuk menambahkan kredensial Admin:
  ```bash
  php artisan db:seed

### Step 9: Admin User Credentials
- Berikut merupakan kredensial untuk masuk sebagai admin:
- **Email: admin@admin.com**
- **Password: password**

### Step 10: Start the Server
- Pada terminal di Visual Studio Code, jalankan perintah berikut:
  ```bash
  php artisan serve

### Step 11: Access the Application
- Buka browser Anda dan pergi ke http://127.0.0.1:8000/.
- Masuk menggunakan kredensial admin yang telah disediakan di atas.

**Atau kamu bisa membuka aplikasi tersebut yang telah kami Hosting di** - https://tokoplastikcharlesjaya.my.id/
