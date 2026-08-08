#!/bin/bash
set -e

echo "=== STARTING DEPLOYMENT ==="

# 1. Update and Install Dependencies
export DEBIAN_FRONTEND=noninteractive
sudo apt-get update -y
sudo apt-get upgrade -y
sudo apt-get install software-properties-common curl git unzip -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt-get update -y

sudo apt-get install nginx -y
sudo apt-get install php8.2-fpm php8.2-cli php8.2-mysql php8.2-mbstring php8.2-xml php8.2-curl php8.2-zip php8.2-gd -y
sudo apt-get install mariadb-server -y

# Install Composer
if ! command -v composer &> /dev/null; then
    curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
fi

echo "=== SETTING UP DATABASE ==="
# 2. Database Setup
sudo mysql -e "CREATE DATABASE IF NOT EXISTS gereja_db;"
sudo mysql -e "CREATE USER IF NOT EXISTS 'gereja_user'@'localhost' IDENTIFIED BY 'PasswordKuat123!';"
sudo mysql -e "ALTER USER 'gereja_user'@'localhost' IDENTIFIED BY 'PasswordKuat123!';"
sudo mysql -e "GRANT ALL PRIVILEGES ON gereja_db.* TO 'gereja_user'@'localhost';"
sudo mysql -e "FLUSH PRIVILEGES;"

echo "=== CLONING REPOSITORY ==="
# 3. Clone Repository
sudo mkdir -p /var/www
if [ -d "/var/www/gereja_backend/.git" ]; then
    echo "Directory exists, pulling latest..."
    cd /var/www/gereja_backend
    sudo git reset --hard
    sudo git pull origin main
else
    echo "Cloning..."
    cd /var/www
    sudo rm -rf gereja_backend
    sudo git clone https://github.com/Iznsraa03/gereja_backend.git
    cd gereja_backend
fi

echo "=== PROJECT SETUP ==="
sudo chown -R $USER:$USER /var/www/gereja_backend
cd /var/www/gereja_backend

# If lock file is incompatible with PHP 8.2, we run update
composer install --optimize-autoloader --no-dev || composer update --optimize-autoloader --no-dev

# Ensure .env is set
cat <<EOF > .env
APP_NAME="Church Finder"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=http://gerejamakassar.my.id

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gereja_db
DB_USERNAME=gereja_user
DB_PASSWORD=PasswordKuat123!

BROADCAST_CONNECTION=log
CACHE_STORE=database
CACHE_PREFIX=
QUEUE_CONNECTION=database
SESSION_DRIVER=database
SESSION_LIFETIME=120
SESSION_ENCRYPT=false
SESSION_PATH=/
SESSION_DOMAIN=null

MAIL_MAILER=log
MAIL_HOST=127.0.0.1
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="\${APP_NAME}"
EOF

php artisan key:generate --force
php artisan storage:link

echo "=== MIGRATION & SEEDING ==="
# 4. Migrate & Seed
php artisan migrate:fresh --force
php artisan db:seed --force

echo "=== PERMISSIONS ==="
# 5. Permissions
sudo chown -R www-data:www-data /var/www/gereja_backend
sudo find /var/www/gereja_backend -type f -exec chmod 644 {} \;
sudo find /var/www/gereja_backend -type d -exec chmod 755 {} \;
sudo chmod -R 775 /var/www/gereja_backend/storage
sudo chmod -R 775 /var/www/gereja_backend/bootstrap/cache

echo "=== NGINX SETUP ==="
# 6. Nginx configuration
sudo tee /etc/nginx/sites-available/gereja_backend > /dev/null <<EOF
server {
    listen 80;
    server_name gerejamakassar.my.id www.gerejamakassar.my.id;
    root /var/www/gereja_backend/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;

    charset utf-8;

    location / {
        try_files \$uri \$uri/ /index.php?\$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php\$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME \$realpath_root\$fastcgi_script_name;
        include fastcgi_params;
        fastcgi_hide_header X-Powered-By;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
EOF

sudo ln -sf /etc/nginx/sites-available/gereja_backend /etc/nginx/sites-enabled/
# Remove default nginx config if exists
sudo rm -f /etc/nginx/sites-enabled/default

sudo nginx -t
sudo systemctl restart nginx

echo "=== OPTIMIZATION ==="
# 7. Optimization
cd /var/www/gereja_backend
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache

echo "=== DEPLOYMENT COMPLETED SUCCESSFULLY ==="
