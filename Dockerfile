FROM php:8.2-fpm

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
    libsqlite3-dev

# تثبيت PHP extensions
RUN docker-php-ext-install pdo pdo_sqlite mbstring exif pcntl bcmath gd

# تثبيت Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# تعيين مجلد العمل
WORKDIR /app

# نسخ ملفات المشروع
COPY . .

# تثبيت المكتبات
RUN composer install --no-dev --optimize-autoloader

# إنشاء قاعدة البيانات
RUN touch database/database.sqlite

# تعيين الأذونات
RUN chmod -R 775 storage bootstrap/cache

# تشغيل الأوامر المطلوبة
RUN php artisan key:generate --force
RUN php artisan migrate --force

# تشغيل الخادم
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8080"]

EXPOSE 8080
