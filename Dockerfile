FROM php:8.2-apache

# تثبيت المكتبات المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    sqlite3 \
    libsqlite3-dev \
    && rm -rf /var/lib/apt/lists/*

# تثبيت PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# تفعيل Apache mod_rewrite
RUN a2enmod rewrite

# تعيين مجلد العمل
WORKDIR /var/www/html

# نسخ ملفات المشروع
COPY . .

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تثبيت المكتبات
RUN composer install --no-dev --optimize-autoloader

# إنشاء قاعدة البيانات
RUN touch database/database.sqlite

# تعيين الأذونات
RUN chown -R www-data:www-data /var/www/html && \
    chmod -R 755 /var/www/html && \
    chmod -R 775 storage bootstrap/cache

# تعديل Apache config
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# تشغيل الأوامر المطلوبة
RUN php artisan key:generate --force && \
    php artisan migrate --force

EXPOSE 80
