# 🎬 Sports Live Stream Dashboard

موقع احترافي لمشاهدة البث المباشر للمباريات الرياضية (كأس العالم والمباريات العالمية) مع لوحة تحكم متقدمة.

## ✨ المميزات

- ✅ **لوحة تحكم متقدمة** - إدارة كاملة للمباريات والقنوات والفرق
- ✅ **مشغل فيديو احترافي** - يدعم HLS و M3U8 والبث المباشر
- ✅ **واجهة عصرية** - تصميم جميل وسهل الاستخدام
- ✅ **دعم اللغة العربية** - واجهة كاملة باللغة العربية
- ✅ **قاعدة بيانات SQLite** - لا تحتاج إلى تثبيت MySQL
- ✅ **سريع وخفيف** - أداء عالي واستهلاك منخفض
- ✅ **جاهز للاستضافة** - يعمل على أي استضافة عادية

## 📋 المتطلبات

- PHP 8.1 أو أعلى
- Composer
- Node.js و npm (اختياري)
- SQLite (مدمج في PHP)

## 🚀 التثبيت السريع

### 1. استنساخ المشروع

```bash
git clone https://github.com/yourusername/sports-streaming-app.git
cd sports-streaming-app
```

### 2. تثبيت المتطلبات

```bash
composer install
npm install
```

### 3. إعداد البيئة

```bash
cp .env.example .env
php artisan key:generate
```

### 4. إنشاء قاعدة البيانات

```bash
php artisan migrate
```

### 5. تشغيل المشروع محلياً

```bash
php artisan serve
```

ثم افتح المتصفح وذهب إلى: `http://localhost:8000`

## 🌐 التثبيت على استضافة حقيقية

### خطوات التثبيت على Hostinger أو أي استضافة أخرى:

#### 1. تحضير الملفات

```bash
zip -r sports-streaming-app.zip . -x "node_modules/*" ".git/*"
```

#### 2. رفع الملفات

- استخدم FTP أو File Manager في لوحة التحكم
- رفع ملفات المشروع إلى مجلد `public_html` أو `www`

#### 3. إعدادات الاستضافة

- تأكد من أن `public` هو جذر المشروع (Document Root)
- تفعيل `mod_rewrite` في Apache

#### 4. تثبيت المتطلبات على الخادم

```bash
composer install --no-dev
php artisan key:generate
php artisan migrate --force
php artisan config:cache
```

#### 5. إعدادات الملفات

```bash
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

## 📖 الاستخدام

### الصفحة الرئيسية

- عرض المباريات المباشرة الآن
- عرض المباريات القادمة
- إحصائيات سريعة

### إضافة فريق جديد

1. اذهب إلى "الفرق"
2. اضغط "إضافة فريق جديد"
3. أدخل اسم الفريق وشعاره
4. اضغط "حفظ"

### إضافة قناة بث

1. اذهب إلى "القنوات"
2. اضغط "إضافة قناة جديدة"
3. أدخل:
   - اسم القناة
   - رابط البث (HLS/M3U8 URL)
   - شعار القناة (اختياري)
4. اضغط "حفظ"

### إضافة مباراة

1. اذهب إلى "المباريات"
2. اضغط "إضافة مباراة جديدة"
3. اختر:
   - الفريق الأول والثاني
   - القناة
   - وقت البداية
   - الحالة (قادمة/مباشر/انتهت)
4. اضغط "حفظ"

### مشاهدة المباراة

1. اضغط على أي مباراة من الصفحة الرئيسية
2. سيتم فتح صفحة البث المباشر
3. استمتع بمشاهدة المباراة!

## 🔗 روابط البث (Stream URLs)

يمكنك استخدام روابط HLS/M3U8 من مصادر مختلفة:

### أمثلة على صيغ الروابط:

```
https://example.com/stream.m3u8
https://example.com/live/channel.m3u8
https://cdn.example.com/video/stream.m3u8
```

## 📁 هيكل المشروع

```
sports-streaming-app/
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── GameController.php
│   │       ├── ChannelController.php
│   │       └── TeamController.php
│   └── Models/
│       ├── Game.php
│       ├── Channel.php
│       └── Team.php
├── database/
│   ├── migrations/
│   └── database.sqlite
├── resources/
│   └── views/
│       ├── layouts/
│       ├── games/
│       ├── channels/
│       └── teams/
├── routes/
│   └── web.php
└── public/
    └── index.php
```

## 🗄️ قاعدة البيانات

### جداول البيانات:

#### teams
- id
- name
- logo
- description
- created_at, updated_at

#### channels
- id
- name
- stream_url
- logo
- description
- is_active
- created_at, updated_at

#### games
- id
- team_a_id (foreign key)
- team_b_id (foreign key)
- channel_id (foreign key)
- start_time
- status (upcoming/live/finished)
- score_a
- score_b
- description
- created_at, updated_at

## 🔒 الأمان

- تم تطبيق CSRF Protection على جميع النماذج
- تحقق من صحة البيانات المدخلة
- استخدام Eloquent ORM لمنع SQL Injection
- تشفير كلمات المرور (إذا تم إضافة نظام تسجيل دخول)

## 🐛 استكشاف الأخطاء

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

## 🤝 المساهمة

نرحب بالمساهمات! يرجى:
1. عمل Fork للمشروع
2. إنشاء فرع جديد
3. إرسال Pull Request

## 📄 الترخيص

هذا المشروع مرخص تحت MIT License

## 💬 الدعم

للمساعدة والدعم، يرجى فتح Issue على GitHub

## ⚠️ ملاحظة مهمة

**هذا المشروع مخصص للاستخدام التعليمي والقانوني فقط**

- استخدم روابط بث قانونية ومرخصة
- احترم حقوق الملكية الفكرية
- لا تستخدم محتوى مقرصن أو مسروق

---

تم إنشاء هذا المشروع بواسطة **Manus AI**
آخر تحديث: 2026
