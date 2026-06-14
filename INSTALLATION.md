# 📦 دليل التثبيت الكامل

## المتطلبات الأساسية

- PHP 8.1 أو أعلى
- Composer
- Git
- SQLite (مدمج في PHP)

## التثبيت على جهازك المحلي

### الخطوة 1: استنساخ المشروع

```bash
git clone https://github.com/yourusername/sports-streaming-app.git
cd sports-streaming-app
```

### الخطوة 2: تثبيت Composer

```bash
composer install
```

### الخطوة 3: إعداد ملف البيئة

```bash
cp .env.example .env
```

### الخطوة 4: توليد مفتاح التطبيق

```bash
php artisan key:generate
```

### الخطوة 5: إنشاء قاعدة البيانات

```bash
php artisan migrate
```

### الخطوة 6: تشغيل الخادم

```bash
php artisan serve
```

الآن يمكنك الوصول إلى التطبيق على: `http://localhost:8000`

---

## التثبيت على استضافة Hostinger

### الخطوة 1: الوصول إلى لوحة التحكم

1. سجل الدخول إلى حسابك على Hostinger
2. اذهب إلى "Hosting" → "Manage"

### الخطوة 2: إعدادات الملفات

1. افتح "File Manager"
2. تأكد من أن جذر المشروع (Document Root) موجود في `public_html`
3. احذف الملفات القديمة إن وجدت

### الخطوة 3: رفع الملفات

#### الطريقة الأولى: استخدام Git (الأفضل)

1. افتح Terminal/SSH
2. انتقل إلى مجلد `public_html`:
   ```bash
   cd ~/public_html
   ```
3. استنسخ المشروع:
   ```bash
   git clone https://github.com/yourusername/sports-streaming-app.git .
   ```

#### الطريقة الثانية: استخدام FTP

1. استخدم FTP Client (مثل FileZilla)
2. رفع جميع ملفات المشروع إلى `public_html`

### الخطوة 4: تثبيت المتطلبات

1. افتح Terminal/SSH
2. انتقل إلى مجلد المشروع:
   ```bash
   cd ~/public_html
   ```
3. ثبت المتطلبات:
   ```bash
   composer install --no-dev
   ```

### الخطوة 5: إعداد البيئة

1. انسخ ملف البيئة:
   ```bash
   cp .env.example .env
   ```
2. عدّل ملف `.env`:
   ```bash
   nano .env
   ```
3. غيّر القيم التالية:
   ```
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

### الخطوة 6: توليد المفتاح

```bash
php artisan key:generate
```

### الخطوة 7: إنشاء قاعدة البيانات

```bash
php artisan migrate --force
```

### الخطوة 8: تحسين الأداء

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### الخطوة 9: إعدادات الملفات

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### الخطوة 10: إعدادات Apache

1. تأكد من تفعيل `mod_rewrite`
2. تأكد من وجود ملف `.htaccess` في مجلد `public`

---

## التثبيت على استضافة Bluehost

### الخطوات الأساسية

1. افتح cPanel
2. انتقل إلى "File Manager"
3. رفع ملفات المشروع إلى `public_html`
4. افتح Terminal:
   ```bash
   cd ~/public_html
   composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --force
   ```

---

## التثبيت على استضافة SiteGround

### الخطوات الأساسية

1. افتح Site Tools
2. انتقل إلى File Manager
3. رفع ملفات المشروع
4. افتح Terminal:
   ```bash
   cd public_html
   composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --force
   chmod -R 775 storage bootstrap/cache
   ```

---

## استكشاف الأخطاء

### خطأ: "Composer not found"

```bash
# تثبيت Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### خطأ: "No application encryption key has been specified"

```bash
php artisan key:generate
```

### خطأ: "SQLSTATE[HY000]: General error: 1 no such table"

```bash
php artisan migrate --force
```

### خطأ: "Permission denied" عند الكتابة

```bash
chmod -R 775 storage bootstrap/cache
```

### خطأ: "500 Internal Server Error"

1. تحقق من ملف `storage/logs/laravel.log`
2. تأكد من أن PHP 8.1+ مفعل
3. تأكد من تفعيل `mod_rewrite`

---

## إضافة بيانات تجريبية

```bash
php artisan tinker
```

ثم أدخل:

```php
// إضافة فرق
App\Models\Team::create(['name' => 'Real Madrid', 'description' => 'فريق ريال مدريد']);
App\Models\Team::create(['name' => 'Barcelona', 'description' => 'فريق برشلونة']);

// إضافة قنوات
App\Models\Channel::create([
    'name' => 'beIN Sports',
    'stream_url' => 'https://example.com/stream.m3u8',
    'is_active' => true
]);

exit
```

---

## تحديث المشروع

```bash
cd ~/public_html
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
```

---

## النسخ الاحتياطية

### نسخ احتياطية يدوية

```bash
# نسخ قاعدة البيانات
cp database/database.sqlite database/database.sqlite.backup

# نسخ ملفات التخزين
tar -czf storage_backup.tar.gz storage/
```

---

تم إنشاء هذا الدليل بواسطة **Manus AI**
