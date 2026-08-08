# Dokumen Perencanaan Deploy ke VPS (Ubuntu/Debian)

Dokumen ini berisi panduan teknis langkah demi langkah untuk melakukan *setup* server VPS (Virtual Private Server) dan *deploy* proyek **Gereja Backend (Laravel 11)**, termasuk proses pengaturan basis data dan *seeding* beserta gambar.

## 1. Persiapan Server VPS
Asumsi OS yang digunakan adalah **Ubuntu 22.04 LTS** atau **24.04 LTS**.

### a. Update Sistem
Masuk ke VPS via SSH dan perbarui sistem:
```bash
ssh root@IP_ADDRESS_VPS
apt update && apt upgrade -y
```

### b. Install Nginx, PHP 8.2, dan Ekstensi Pendukung
```bash
# Tambahkan repositori ondrej/php (jika diperlukan)
apt install software-properties-common -y
add-apt-repository ppa:ondrej/php -y
apt update

# Install Nginx dan PHP 8.2
apt install nginx -y
apt install php8.2-fpm php8.2-cli php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-gd unzip -y
```

### c. Install Composer
```bash
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
```

### d. Install MySQL / MariaDB
```bash
apt install mariadb-server -y
mysql_secure_installation
```

---

## 2. Setup Basis Data MySQL
Buat *database* dan *user* baru untuk aplikasi Laravel.

```bash
mysql -u root -p
```
Di dalam prompt MySQL:
```sql
CREATE DATABASE gereja_db;
CREATE USER 'gereja_user'@'localhost' IDENTIFIED BY 'PasswordKuat123!';
GRANT ALL PRIVILEGES ON gereja_db.* TO 'gereja_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

---

## 3. Clone & Setup Proyek Laravel

### a. Clone Repository
Pindahkan ke direktori web dan *clone* proyek dari GitHub:
```bash
cd /var/www
git clone https://github.com/Iznsraa03/gereja_backend.git
cd gereja_backend
```

### b. Install Dependensi PHP
```bash
composer install --optimize-autoloader --no-dev
```

### c. Konfigurasi Environment (`.env`)
Salin file konfigurasi:
```bash
cp .env.example .env
```
Edit konfigurasi `.env` (`nano .env`):
```env
APP_NAME="Church Finder"
APP_ENV=production
APP_KEY= # (Bisa dikosongkan dulu, akan di-generate)
APP_DEBUG=false
APP_URL=http://DOMAIN_ANDA.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gereja_db
DB_USERNAME=gereja_user
DB_PASSWORD=PasswordKuat123!
```

Generate App Key:
```bash
php artisan key:generate
```

### d. Setup Storage Symlink
Agar gambar bisa diakses publik:
```bash
php artisan storage:link
```

---

## 4. Migrasi & Seeding Data (Termasuk Gambar)

Jalankan perintah migrasi dan *seeder* khusus yang telah kita buat (termasuk *seeder* dari CSV file).

```bash
php artisan migrate --force
```

**Seeding Data & Gambar:**
Jika *seeder* `CsvSeeder` membaca file CSV lokal (`DATA GEREJA PERMANEN DI MAKASSAR - Sheet2.csv`), pastikan file tersebut ada di server.

Untuk gambar, ada dua pendekatan yang perlu disiapkan dalam *seeder*:
1. Gambar diunggah secara manual ke folder `storage/app/public/churches/` di server dan jalur *path*-nya didefinisikan dalam CSV.
2. Jika ada *folder* sumber gambar *default*, kita bisa menggunakan `php artisan db:seed` untuk langsung menyalin gambar-gambar bawaan dari direktori `/database/seeders/images` ke `storage/app/public/churches` selama proses *seeding*.

Jalankan seeder utama:
```bash
php artisan db:seed --force
```

---

## 5. Konfigurasi Permission (Hak Akses)
Laravel membutuhkan akses tulis ke folder `storage` dan `bootstrap/cache`.

```bash
chown -R www-data:www-data /var/www/gereja_backend
find /var/www/gereja_backend -type f -exec chmod 644 {} \;
find /var/www/gereja_backend -type d -exec chmod 755 {} \;
chmod -R 775 /var/www/gereja_backend/storage
chmod -R 775 /var/www/gereja_backend/bootstrap/cache
```

---

## 6. Setup Web Server (Nginx)
Buat konfigurasi *server block* untuk aplikasi Laravel.

```bash
nano /etc/nginx/sites-available/gereja_backend
```

Isi dengan konfigurasi berikut:
```nginx
server {
    listen 80;
    server_name DOMAIN_ANDA.com;
    root /var/www/gereja_backend/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

Aktifkan konfigurasi dan _restart_ Nginx:
```bash
ln -s /etc/nginx/sites-available/gereja_backend /etc/nginx/sites-enabled/
nginx -t
systemctl restart nginx
```

---

## 7. Optimasi Produksi (Laravel Optimization)
Untuk performa terbaik, *cache* seluruh konfigurasi dan rute:

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## Selesai!
Aplikasi backend dan API sekarang harusnya sudah bisa diakses lewat `http://DOMAIN_ANDA.com`. Panel admin dapat diakses di `http://DOMAIN_ANDA.com/admin/login`.
