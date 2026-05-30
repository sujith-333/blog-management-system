# BlogYaari - Blog Management System

A full-featured Blog Management System built with Laravel and MySQL.

---

## Live Links

- Website: https://blog-management-system-production-8205.up.railway.app/blogs
- Admin Panel: https://blog-management-system-production-8205.up.railway.app/admin/login
- GitHub: https://github.com/YOUR_USERNAME/blog-management-system

---

## Admin Credentials

- Email: admin@blog.com
- Password: admin123

---

## Features

### User Side
- Blog listing page with all blogs fetched dynamically from database
- Hero section with search bar
- AJAX filter by category without page reload
- AJAX filter by date without page reload
- Live search without page reload
- Blog detail page with full content
- Related blogs sidebar
- Category widget in sidebar
- Responsive design for mobile and laptop
- Copy link share button

### Admin Side
- Secure admin login with session
- Dashboard with stats cards
- Add new blog with rich text editor
- Edit existing blog
- Delete blog with confirmation
- Image upload with preview
- Search and filter blogs in dashboard
- Writing tips sidebar
- Blog info card with metadata

---

## Tech Stack

- Backend: PHP / Laravel
- Database: MySQL
- Frontend: HTML, CSS Responsive
- JavaScript: jQuery and AJAX
- Hosting: Railway
- Version Control: GitHub

---

## Local Setup Steps

**Step 1 - Clone the repository**

    git clone https://github.com/YOUR_USERNAME/blog-management-system.git

**Step 2 - Install dependencies**

    composer install

**Step 3 - Copy environment file**

    cp .env.example .env

**Step 4 - Generate application key**

    php artisan key:generate

**Step 5 - Set database credentials in .env file**

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=blog_system
    DB_USERNAME=root
    DB_PASSWORD=

**Step 6 - Run migrations**

    php artisan migrate

**Step 7 - Seed the database**

    php artisan db:seed

**Step 8 - Start the server**

    php artisan serve

**Step 9 - Open in browser**

    http://localhost:8000/blogs

---

## AJAX Filter Implementation

The filter works without page reload using jQuery AJAX:

- User selects category or date or types in search box
- jQuery sends POST request to /blogs/filter route
- Laravel queries database with filters applied
- Laravel returns filtered blog cards as HTML partial
- jQuery updates the blog listing section instantly
- No full page reload at any point

---

## Image Guidelines

- Ideal size: 1200 x 630 pixels
- Aspect ratio: 16:9
- Max file size: 2MB
- Accepted formats: JPG, PNG, GIF

---

## Project Structure

- app
    - Http
        - Controllers
            - BlogController.php
            - Admin
                - AdminAuthController.php
                - AdminBlogController.php
        - Middleware
            - AdminMiddleware.php
    - Models
        - Blog.php
        - Category.php
- database
    - migrations
    - seeders
        - DatabaseSeeder.php
- resources
    - views
        - layouts
            - app.blade.php
            - admin.blade.php
        - blogs
            - index.blade.php
            - show.blade.php
            - partials
                - blog-list.blade.php
        - admin
            - login.blade.php
            - dashboard.blade.php
            - blogs
                - create.blade.php
                - edit.blade.php
- routes
    - web.php
- Procfile
- nixpacks.toml
- README.md

---

## Database Tables

- users - Admin login credentials
- categories - Blog categories like Admit Card and Result
- blogs - All blog posts with title, content, image, category

---

## Assignment Details

- Role: PHP / Laravel Developer Intern
- Company: JobYaari
- Assignment Title: Blog Management System with AJAX Filtering
- Deployment: Railway free hosting
- Code: GitHub public repository