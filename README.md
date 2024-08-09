# Proyek Laravel 

## Langkah-langkah Instalasi

1. Clone repositori:
    ```bash
    git clone https://github.com/PeterChen712/Pisah
    ```

2. Masuk ke repositori:
    ```bash 
    cd Pisah
    ```

3. Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```

4. Install dependencies PHP menggunakan Composer:
    ```bash
    composer install
    ```

5. Buat app key:
    ```bash
    php artisan key:generate
    ```

## Langkah-langkah Setup Database MySQL

1. Aktifkan XAMPP seperti pada gambar ini
    ![XAMPP](README/step1.png)

2. Buka phpMyAdmin di browser:
    [http://localhost/phpmyadmin/](http://localhost/phpmyadmin/)

3. Klik menu 'Databases' dan buat database `pisah` seperti pada gambar dan klik 'create':
    ![DB](README/step2.png)

4. Jalankan perintah ini di terminal:
    ```bash
    php artisan migrate
    ```

5. Selanjutnya jalankan perintah ini:
    ```bash
    php artisan db:seed
    ```

6. Atur file `.env` sesuai konfigurasi berikut:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pisah
    DB_USERNAME=root
    DB_PASSWORD=
    ```

7. Jalankan server Laravel:
    ```bash
    php artisan serve
    ```

8. Buka aplikasi di browser:
    [http://localhost:8000](http://localhost:8000)
