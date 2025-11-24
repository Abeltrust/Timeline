# Timeline - Cultural Preservation Platform

A Laravel-based social platform designed for authentic storytelling and cultural heritage preservation.

## 🚀 Local Setup Instructions (XAMPP)

### Prerequisites
- XAMPP with PHP 8.1+ and MySQL
- Composer (Download from https://getcomposer.org/)
- Node.js (for asset compilation)

### Step 1: Download Project
1. Download all project files to your XAMPP `htdocs` directory
2. Create folder: `C:\xampp\htdocs\timeline-cultural`
3. Extract all files into this folder

### Step 2: Install Dependencies
Open Command Prompt in the project directory and run:
```bash
composer install
npm install
```

### Step 3: Environment Setup
1. Copy `.env.example` to `.env`
2. Update database configuration in `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=timeline_cultural
DB_USERNAME=root
DB_PASSWORD=
```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Database Setup
1. Start XAMPP (Apache + MySQL)
2. Open phpMyAdmin (http://localhost/phpmyadmin)
3. Create database: `timeline_cultural`
4. Run migrations:
```bash
php artisan migrate
```

### Step 6: Storage Setup
```bash
php artisan storage:link
```

### Step 7: Compile Assets
```bash
npm run dev
```

### Step 8: Start Development Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## 🎯 Features

### Core Features
- ✅ **Timeline Feed** - Chronological storytelling
- ✅ **Cultural Hub** - Heritage preservation
- ✅ **Personal Vault** - Private memories
- ✅ **Life Chapters** - Organized life stories
- ✅ **TAP System** - Meaningful interactions
- ✅ **Lock-In System** - Cultural following
- ✅ **Events & Communities** - Cultural gatherings
- ✅ **Messaging System** - Direct communication
- ✅ **Analytics Dashboard** - Story insights

### Cultural Focus
- Multi-step culture documentation
- Endangerment level tracking
- Heritage preservation metrics
- Community collaboration
- Expert validation system

## 🛠 Technology Stack
- **Backend**: Laravel 10
- **Frontend**: Blade Templates + Alpine.js
- **Styling**: Tailwind CSS
- **Database**: MySQL
- **Icons**: Lucide Icons
- **File Storage**: Laravel Storage

## 📱 User Experience
- Responsive design for all devices
- Apple-level design aesthetics
- Smooth animations and micro-interactions
- Intuitive navigation
- Accessibility-first approach

## 🔧 Development
- Traditional server-side rendering
- AJAX interactions for dynamic features
- Progressive enhancement
- SEO-friendly URLs
- Proper error handling

## 📊 Database Schema
- 14 comprehensive migrations
- Proper relationships and indexing
- Optimized for cultural data
- Scalable architecture

## 🎨 Design Philosophy
- Authentic storytelling over algorithmic feeds
- Cultural preservation focus
- Meaningful interactions (TAPs vs likes)
- Privacy-first approach
- Community-driven content

---

**Timeline** - Where every story matters, every culture is preserved, and every voice is heard.