# 🚀 XAMPP Setup Guide for Timeline Cultural Platform

## Prerequisites
- XAMPP 8.1+ (Download from https://www.apachefriends.org/)
- Composer (Download from https://getcomposer.org/)
- Node.js 16+ (Download from https://nodejs.org/)

## Step-by-Step Setup

### 1. Install XAMPP
1. Download and install XAMPP
2. Start Apache and MySQL services
3. Verify installation at http://localhost

### 2. Install Composer
1. Download Composer installer
2. Run installer and follow instructions
3. Verify installation: `composer --version`

### 3. Install Node.js
1. Download and install Node.js
2. Verify installation: `node --version` and `npm --version`

### 4. Project Setup
1. **Download Project Files**
   - Extract all files to `C:\xampp\htdocs\timeline-cultural`

2. **Install PHP Dependencies**
   ```bash
   cd C:\xampp\htdocs\timeline-cultural
   composer install
   ```

3. **Install Node Dependencies**
   ```bash
   npm install
   ```

4. **Environment Configuration**
   - Copy `.env.example` to `.env`
   - Update database settings in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=timeline_cultural
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

### 5. Database Setup
1. **Create Database**
   - Open phpMyAdmin: http://localhost/phpmyadmin
   - Create new database: `timeline_cultural`
   - Set collation: `utf8mb4_unicode_ci`

2. **Run Migrations**
   ```bash
   php artisan migrate
   ```

3. **Create Storage Link**
   ```bash
   php artisan storage:link
   ```

### 6. Asset Compilation
```bash
npm run dev
```

For production:
```bash
npm run build
```

### 7. Start Development Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## 🔧 Troubleshooting

### Common Issues

#### 1. Composer Not Found
- Ensure Composer is in your PATH
- Restart command prompt after installation

#### 2. PHP Version Issues
- XAMPP should include PHP 8.1+
- Check version: `php --version`

#### 3. Database Connection Error
- Verify MySQL is running in XAMPP
- Check database credentials in `.env`
- Ensure database `timeline_cultural` exists

#### 4. Permission Issues
- Run command prompt as Administrator
- Check folder permissions in htdocs

#### 5. Node/NPM Issues
- Clear npm cache: `npm cache clean --force`
- Delete node_modules and reinstall: `rm -rf node_modules && npm install`

#### 6. Asset Compilation Issues
- Ensure Node.js 16+ is installed
- Run `npm run dev` for development
- Run `npm run build` for production

### 7. Storage Issues
- Ensure storage folder is writable
- Run: `php artisan storage:link`
- Check file upload permissions

## 📁 Project Structure
```
timeline-cultural/
├── app/                    # Application logic
├── database/              # Migrations and seeders
├── public/                # Web accessible files
├── resources/             # Views, CSS, JS
├── routes/                # Route definitions
├── storage/               # File storage
├── .env                   # Environment configuration
├── composer.json          # PHP dependencies
├── package.json           # Node dependencies
└── README.md             # Project documentation
```

## 🎯 Default Credentials
After setup, you can register new users or create test accounts.

## 🚀 Production Deployment
For production deployment:
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Run `composer install --optimize-autoloader --no-dev`
4. Run `npm run build`
5. Configure proper web server (Apache/Nginx)

## 📞 Support
If you encounter issues:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check XAMPP error logs
3. Verify all prerequisites are installed
4. Ensure all services are running

---

**Timeline Cultural Platform** - Preserving heritage, one story at a time.