# 🚀 دليل النشر والاستضافة

## الخيارات المتاحة للاستضافة

### 1. Hostinger (الأفضل للمبتدئين)

**المميزات:**
- سهل الاستخدام
- دعم عربي
- أسعار منخفضة
- لوحة تحكم بسيطة

**الخطوات:**
1. اشترك في خطة استضافة
2. افتح File Manager
3. رفع ملفات المشروع
4. افتح Terminal وتابع التثبيت

### 2. Bluehost

**المميزات:**
- موثوق جداً
- دعم WordPress
- cPanel سهل الاستخدام
- سعر معقول

### 3. SiteGround

**المميزات:**
- أداء عالي جداً
- دعم ممتاز
- Site Tools متقدمة
- SSL مجاني

### 4. DigitalOcean (للمتقدمين)

**المميزات:**
- تحكم كامل
- أداء عالي جداً
- أسعار منخفضة
- يتطلب معرفة تقنية

---

## خطوات النشر على Hostinger

### الخطوة 1: الإعداد الأولي

```bash
# تحضير المشروع
cd sports-streaming-app
composer install --no-dev
npm run build
```

### الخطوة 2: إنشاء ملف ZIP

```bash
zip -r sports-streaming-app.zip . \
  -x "node_modules/*" ".git/*" ".env" "*.log"
```

### الخطوة 3: الرفع عبر FTP

1. افتح FileZilla
2. اتصل بخادمك:
   - Host: ftp.yourdomain.com
   - Username: your_ftp_username
   - Password: your_ftp_password
3. رفع الملف المضغوط

### الخطوة 4: فك الضغط

1. افتح File Manager في Hostinger
2. انقر بزر الماوس الأيمن على الملف
3. اختر "Extract"

### الخطوة 5: التثبيت عبر SSH

```bash
# الاتصال بالخادم
ssh username@yourdomain.com

# الانتقال للمجلد
cd public_html

# تثبيت المتطلبات
composer install --no-dev

# إعداد البيئة
cp .env.example .env
php artisan key:generate

# إنشاء قاعدة البيانات
php artisan migrate --force

# تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache

# إعدادات الملفات
chmod -R 775 storage bootstrap/cache
```

---

## إعدادات النطاق (Domain)

### تعيين النطاق إلى الاستضافة

1. اذهب إلى مسجل النطاق
2. غيّر Name Servers إلى:
   - ns1.hostinger.com
   - ns2.hostinger.com
   - ns3.hostinger.com

### إعدادات SSL

```bash
# تفعيل HTTPS
# في Hostinger: اذهب إلى SSL → Let's Encrypt → Install
```

---

## تحسين الأداء

### تفعيل Caching

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### تحسين قاعدة البيانات

```bash
# إضافة فهارس
php artisan tinker
DB::statement('CREATE INDEX idx_games_status ON games(status)');
DB::statement('CREATE INDEX idx_games_channel ON games(channel_id)');
exit
```

### تفعيل Gzip Compression

أضف هذا إلى `.htaccess`:

```apache
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript
</IfModule>
```

---

## المراقبة والصيانة

### التحقق من الأخطاء

```bash
# عرض آخر الأخطاء
tail -f storage/logs/laravel.log
```

### النسخ الاحتياطية

```bash
# نسخ احتياطية يومية
0 2 * * * cd /home/username/public_html && tar -czf ~/backups/backup-$(date +\%Y\%m\%d).tar.gz . 2>/dev/null
```

### تحديث المشروع

```bash
cd public_html
git pull origin main
composer install --no-dev
php artisan migrate --force
php artisan config:cache
```

---

## استكشاف الأخطاء الشائعة

### خطأ 500

```bash
# تحقق من الأخطاء
cat storage/logs/laravel.log

# تأكد من الأذونات
chmod -R 775 storage bootstrap/cache

# امسح الـ cache
php artisan cache:clear
php artisan config:clear
```

### خطأ 403 Forbidden

```bash
# تأكد من .htaccess
# تأكد من mod_rewrite
# تأكد من الأذونات
chmod 644 .htaccess
```

### خطأ الاتصال بقاعدة البيانات

```bash
# تحقق من .env
# تأكد من وجود database.sqlite
touch database/database.sqlite
chmod 666 database/database.sqlite
```

---

## الأمان

### تحديث البيانات الحساسة

```bash
# غيّر APP_KEY
php artisan key:generate

# غيّر قيم الـ session
php artisan session:table
php artisan migrate
```

### تفعيل HTTPS

```bash
# في .env
APP_URL=https://yourdomain.com
```

### تحديث المتطلبات

```bash
composer update
npm update
```

---

## الأداء

### قياس الأداء

استخدم أدوات مثل:
- Google PageSpeed Insights
- GTmetrix
- Pingdom

### تحسينات إضافية

```bash
# تفعيل Query Caching
php artisan config:cache

# تحسين الصور
npm run build

# تفعيل CDN (اختياري)
# أضف رابط CDN في .env
```

---

## المراقبة المستمرة

### إعداد تنبيهات

1. استخدم Uptime Robot لمراقبة الموقع
2. استخدم New Relic لمراقبة الأداء
3. استخدم Sentry لمراقبة الأخطاء

---

تم إنشاء هذا الدليل بواسطة **Manus AI**
