Panduan Instalasi Proyek XYZ
Selamat datang di Proyek XYZ! Ikuti langkah-langkah berikut untuk mengatur dan menjalankan proyek di komputer lokal Anda.

Anggota Kelompok
Michael (2226240001)
Jenifer Gunawan (2226240003)
Anas Al Marzaq (2226240070)
Jordi Willyam AK (2226240138)
Michael Richi (2226240154)
Krisna Riyandi (2226240155)
Petunjuk Instalasi
Langkah 1: Unduh Proyek
Unduh file proyek dalam format RAR atau fork repositori ini.
Langkah 2: Buka di Visual Studio Code
Ekstrak file RAR (jika diunduh) dan buka folder tersebut di Visual Studio Code.
Langkah 3: Perbarui Composer
Pada terminal di Visual Studio Code, jalankan perintah berikut:
bash
Copy code
composer update
Langkah 4: Jalankan XAMPP
Buka XAMPP dan aktifkan modul Apache dan MySQL.
Langkah 5: Buat Database
Buka browser Anda dan navigasikan ke phpMyAdmin.
Buat database baru.
Langkah 6: Perbarui Konfigurasi Lingkungan
Di Visual Studio Code, buka file .env.
Ubah nilai DB_DATABASE menjadi nama database yang baru Anda buat:
env
Copy code
DB_DATABASE=nama_database_anda
Langkah 7: Migrasi Database
Pada terminal di Visual Studio Code, jalankan perintah berikut:
bash
Copy code
php artisan migrate
Langkah 8: Seed Database
Untuk memasukkan data pengguna admin, jalankan perintah berikut:
bash
Copy code
php artisan db:seed
Langkah 9: Kredensial Pengguna Admin
Gunakan kredensial berikut untuk masuk sebagai admin:
Email: admin@admin.com
Password: password
Langkah 10: Jalankan Server Pengembangan
Pada terminal di Visual Studio Code, jalankan perintah berikut:
bash
Copy code
php artisan serve
Langkah 11: Akses Aplikasi
Buka browser Anda dan pergi ke http://127.0.0.1:8000/.
Masuk menggunakan kredensial admin yang telah disediakan di atas.
