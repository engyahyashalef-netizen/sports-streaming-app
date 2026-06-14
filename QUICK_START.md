# ⚡ البدء السريع

## تشغيل محلي (5 دقائق)

```bash
# 1. استنساخ المشروع
git clone https://github.com/yourusername/sports-streaming-app.git
cd sports-streaming-app

# 2. تثبيت المتطلبات
composer install

# 3. إعداد البيئة
cp .env.example .env
php artisan key:generate

# 4. إنشاء قاعدة البيانات
php artisan migrate

# 5. تشغيل الخادم
php artisan serve
```

الآن افتح: `http://localhost:8000`

---

## إضافة بيانات تجريبية

```bash
php artisan tinker

# أضف فرق
Team::create(['name' => 'Real Madrid']);
Team::create(['name' => 'Barcelona']);
Team::create(['name' => 'Manchester United']);

# أضف قنوات
Channel::create([
    'name' => 'beIN Sports',
    'stream_url' => 'https://example.com/stream.m3u8',
    'is_active' => true
]);

# أضف مباراة
Game::create([
    'team_a_id' => 1,
    'team_b_id' => 2,
    'channel_id' => 1,
    'start_time' => now()->addHours(2),
    'status' => 'upcoming'
]);

exit
```

---

## الوصول إلى الموقع

- **الصفحة الرئيسية:** http://localhost:8000
- **المباريات:** http://localhost:8000/games
- **القنوات:** http://localhost:8000/channels
- **الفرق:** http://localhost:8000/teams

---

## النشر على Hostinger (15 دقيقة)

1. **تحضير الملفات:**
   ```bash
   composer install --no-dev
   zip -r app.zip . -x "node_modules/*" ".git/*"
   ```

2. **الرفع:**
   - افتح File Manager في Hostinger
   - رفع الملف المضغوط
   - فك الضغط

3. **التثبيت:**
   ```bash
   cd public_html
   composer install --no-dev
   cp .env.example .env
   php artisan key:generate
   php artisan migrate --force
   chmod -R 775 storage bootstrap/cache
   ```

---

## الخطوات التالية

1. ✅ أضف فريقك الأول
2. ✅ أضف قناة بث
3. ✅ أضف مباراة
4. ✅ اختبر البث المباشر
5. ✅ انشر على الإنترنت

---

**تم إنشاؤه بواسطة Manus AI**
