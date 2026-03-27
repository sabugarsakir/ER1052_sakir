# 🔐 TaskVault — Secure Task Management System

A Laravel project showcasing **advanced framework features**: middleware, validation, error handling, session management, URL generation, Blade templates, and security.

![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.5-777BB4?style=for-the-badge&logo=php&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-3-003B57?style=for-the-badge&logo=sqlite&logoColor=white)
![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)

---

## 📋 Table of Contents

- [Features](#-features)
- [Laravel Features Demonstrated](#-laravel-features-demonstrated)
- [Prerequisites](#-prerequisites)
- [Installation & Setup](#-installation--setup)
- [Running the Application](#-running-the-application)
- [Demo Accounts](#-demo-accounts)
- [Project Structure](#-project-structure)
- [Routes Overview](#-routes-overview)
- [Screenshots](#-screenshots)
- [Troubleshooting](#-troubleshooting)

---

## ✨ Features

- **User Authentication** — Register, Login, Logout, Password Reset
- **Task CRUD** — Create, Read, Update, Delete tasks
- **Task Sharing** — Share tasks via signed URLs (Laravel URL Generation)
- **Dashboard** — Stats overview with recent tasks
- **Profile Management** — Update name, email, password
- **Custom Error Pages** — Styled 404 page
- **Activity Logging** — Middleware-based request logging
- **Rate Limiting** — Throttle middleware on task routes

---

## 🛠 Laravel Features Demonstrated

| Feature | Where It's Used |
|---|---|
| **Middleware** | `TaskAccessMiddleware` (logs access), `auth`, `verified`, `signed`, `throttle:20,1` |
| **Validation** | `StoreTaskRequest`, `UpdateTaskRequest` with custom rules for title, description, status |
| **Error Handling** | Custom `404.blade.php` error page |
| **Session Management** | Flash messages (`session()->flash()`), CSRF tokens, session-based auth |
| **URL Generation** | Named routes (`route()`), Signed URLs for task sharing (`URL::signedRoute()`) |
| **Blade Templates** | Layouts (`@extends`), components, `@auth`/`@guest`, `@csrf`, `@foreach`, `@if`, `{{ }}` for XSS prevention |
| **Security** | CSRF protection, password hashing (bcrypt), XSS prevention via Blade escaping, signed URLs, rate limiting, Gate authorization |
| **Authorization** | `TaskPolicy` with Gate checks (`Gate::authorize()`) for view/update/delete |
| **Route Model Binding** | Automatic `Task $task` injection in controller methods |

---

## 📌 Prerequisites

Before you begin, make sure you have the following installed:

| Tool | Version | Check Command |
|---|---|---|
| **PHP** | 8.2+ | `php -v` |
| **Composer** | 2.x | `composer --version` |
| **Node.js** | 18+ | `node -v` |
| **npm** | 9+ | `npm -v` |

> **Note:** This project uses **SQLite** as the database — no MySQL/PostgreSQL installation needed!

### If PHP is not in your PATH (Windows)

If you extracted PHP manually (e.g., to a `php/` folder), you can either:

1. **Add to PATH permanently (recommended):**
   - Open Start → Search "Environment Variables" → Edit system environment variables
   - Under System Variables, select `Path` → Edit → Add your PHP folder path
   - Restart your terminal

2. **Or use the full path each time:**
   ```powershell
   # Example: if PHP is at d:\download\antigravity workspace\php\
   & "d:\download\antigravity workspace\php\php.exe" -v
   ```

---

## 🚀 Installation & Setup

### Step 1: Clone or navigate to the project

```bash
cd "d:\download\antigravity workspace\taskvault"
```

### Step 2: Install PHP dependencies

```bash
composer install
```

> **If `composer` is not in PATH**, use:
> ```powershell
> php "d:\download\antigravity workspace\composer.phar" install
> ```

### Step 3: Environment configuration

The `.env` file should already exist. If not, create it:

```bash
cp .env.example .env
```

### Step 4: Generate application key

```bash
php artisan key:generate
```

### Step 5: Create SQLite database & run migrations

The SQLite database file should already exist at `database/database.sqlite`. If not:

```bash
# Create the file (Windows PowerShell)
New-Item -ItemType File -Path database/database.sqlite -Force

# Or on Linux/Mac
touch database/database.sqlite
```

Then run migrations:

```bash
php artisan migrate
```

Expected output:
```
  Creating migration table ............... DONE
  create_users_table .................... DONE
  create_cache_table .................... DONE
  create_jobs_table ..................... DONE
  create_tasks_table .................... DONE
```

### Step 6: (Optional) Seed demo data

```bash
php artisan db:seed
```

This creates a test user: `test@example.com` / password: `password`

### Step 7: Install frontend dependencies

```bash
npm install
```

---

## ▶️ Running the Application

You need **two terminal windows** running simultaneously:

### Terminal 1 — Laravel Development Server

```bash
php artisan serve
```

This starts the backend at **http://127.0.0.1:8000**

### Terminal 2 — Vite Dev Server (for CSS/JS hot reload)

```bash
npm run dev
```

This starts the Vite dev server for Tailwind CSS and Alpine.js compilation.

### 🌐 Open in Browser

Navigate to: **http://127.0.0.1:8000**

> ⚠️ **Important:** Both servers must be running. If you only run `php artisan serve` without `npm run dev`, the styles and JavaScript won't load properly.

### Quick Start (Single Command)

You can run both servers at once using:

```bash
# Using npx concurrently (already in devDependencies)
npx concurrently "php artisan serve" "npm run dev"
```

---

## 👤 Demo Accounts

After running `php artisan db:seed`:

| Role | Email | Password |
|---|---|---|
| Test User | `test@example.com` | `password` |

Or simply **register a new account** at `/register`.

---

## 📁 Project Structure

```
taskvault/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/                        # Auth controllers (Login, Register, etc.)
│   │   │   ├── TaskController.php           # Task CRUD + signed URL sharing
│   │   │   └── ProfileController.php        # Profile management
│   │   ├── Middleware/
│   │   │   └── TaskAccessMiddleware.php      # Custom middleware (logs task access)
│   │   └── Requests/
│   │       ├── StoreTaskRequest.php          # Task creation validation
│   │       └── UpdateTaskRequest.php         # Task update validation
│   ├── Models/
│   │   ├── User.php                          # User model with tasks relationship
│   │   └── Task.php                          # Task model
│   └── Policies/
│       └── TaskPolicy.php                    # Authorization (view/update/delete)
├── resources/views/
│   ├── layouts/                              # Blade layout templates
│   ├── components/                           # Reusable Blade components
│   ├── auth/                                 # Login, Register views
│   ├── tasks/
│   │   ├── index.blade.php                   # Task list
│   │   ├── create.blade.php                  # Create task form
│   │   ├── edit.blade.php                    # Edit task form
│   │   └── show.blade.php                    # Task detail + shared view
│   ├── dashboard.blade.php                   # Dashboard with stats
│   ├── errors/
│   │   └── 404.blade.php                     # Custom 404 page
├── routes/
│   ├── web.php                               # Main routes
│   └── auth.php                              # Authentication routes
├── database/
│   ├── migrations/                           # Table schemas
│   ├── database.sqlite                       # SQLite database file
│   └── seeders/
│       └── DatabaseSeeder.php                # Demo data seeder
└── public/                                   # Publicly accessible files
```

---

## 🗺 Routes Overview

| Method | URI | Action | Middleware |
|---|---|---|---|
| GET | `/` | Redirects to Login | — |
| GET | `/register` | Registration form | `guest` |
| POST | `/register` | Create account | `guest` |
| GET | `/login` | Login form | `guest` |
| POST | `/login` | Authenticate | `guest` |
| POST | `/logout` | Logout | `auth` |
| GET | `/dashboard` | Dashboard with stats | `auth`, `verified` |
| GET | `/tasks` | List all tasks | `auth`, `TaskAccess`, `throttle` |
| GET | `/tasks/create` | Create task form | `auth`, `TaskAccess`, `throttle` |
| POST | `/tasks` | Store new task | `auth`, `TaskAccess`, `throttle` |
| GET | `/tasks/{task}` | View task | `auth`, `TaskAccess`, `throttle` |
| GET | `/tasks/{task}/edit` | Edit task form | `auth`, `TaskAccess`, `throttle` |
| PUT | `/tasks/{task}` | Update task | `auth`, `TaskAccess`, `throttle` |
| DELETE | `/tasks/{task}` | Delete task | `auth`, `TaskAccess`, `throttle` |
| GET | `/tasks/{task}/share` | View shared task | `signed` |
| GET | `/profile` | Edit profile | `auth` |
| PATCH | `/profile` | Update profile | `auth` |
| DELETE | `/profile` | Delete account | `auth` |

To see all routes, run:
```bash
php artisan route:list
```

---

## 📸 Screenshots

Screenshots are available in the `screenshot/` folder:

- Login/Register
- Dashboard with stats
- Task list and CRUD views
- Task detail view

---

## ❓ Troubleshooting

### "PHP is not recognized"
→ PHP is not in your system PATH. Either add it or use the full path:
```powershell
& "C:\path\to\php\php.exe" artisan serve
```

### "npm: cannot be loaded" (PowerShell execution policy)
→ Run this first:
```powershell
Set-ExecutionPolicy -Scope Process -ExecutionPolicy Bypass
```

### Styles not loading / blank white page
→ Make sure `npm run dev` is running in a separate terminal alongside `php artisan serve`.

### "SQLSTATE: no such table"
→ Run migrations:
```bash
php artisan migrate
```

### "Class not found" errors
→ Regenerate autoload:
```bash
composer dump-autoload
```

### Reset everything (fresh start)
```bash
php artisan migrate:fresh --seed
```
This drops all tables, re-runs migrations, and re-seeds demo data.

---

## 📚 Key Artisan Commands Reference

```bash
php artisan serve              # Start dev server
php artisan migrate            # Run pending migrations
php artisan migrate:fresh      # Drop all & re-migrate
php artisan db:seed            # Seed demo data
php artisan route:list         # Show all routes
php artisan make:controller    # Create a controller
php artisan make:middleware    # Create middleware
php artisan make:request       # Create form request
php artisan make:model         # Create a model
php artisan make:policy        # Create authorization policy
php artisan tinker             # Interactive PHP shell
```

---

## 📄 License

This project is open-source, built for educational and demonstration purposes.
