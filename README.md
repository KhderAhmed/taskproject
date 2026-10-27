# TaskProject

A **task management system with authentication**, built in **pure PHP (no framework)** using **PDO + MySQL**. It follows a clean layered structure (Models / Services / Controllers / Views) and includes an admin dashboard styled with **UIkit**.

> This project demonstrates separation of concerns and a hand-built router and auth flow, without relying on Laravel or any other framework.

---

## Features

- User registration, login, and logout
- Add, delete, and toggle tasks (done / not done)
- User dashboard and an admin panel with a dedicated admin login page
- Bilingual support: **Arabic** and **English** (`lang/` files)
- Seeder for creating a default admin account
- Request validation classes (`LoginRequest`, `RegisterRequest`)
- **PSR-4** autoloading via Composer
- Optional code documentation generated with **phpDocumentor**

## Tech Stack

| Component | Technology |
|---|---|
| Language | PHP (pure) |
| Database | MySQL via PDO |
| Frontend | HTML / CSS + [UIkit](https://getuikit.com) |
| Dependency management | Composer (PSR-4) |
| Documentation | phpDocumentor (dev) |

## Project Structure

```
taskproject/
├── composer.json
├── seed.php                 # Runs the seeders
├── sql/
│   └── create_tables.sql    # Database schema
├── config/
│   └── config.php           # Database connection settings
├── seeders/
│   └── AdminSeeder.php
├── src/
│   ├── Database/Database.php
│   ├── Models/              # User.php, Task.php
│   ├── Requests/            # LoginRequest.php, RegisterRequest.php
│   ├── Services/            # AuthService.php, TaskService.php
│   ├── Controllers/         # AuthController.php, TaskController.php
│   └── Views/               # login, register, dashboard, tasks_list
├── lang/
│   ├── ar.php
│   └── en.php
└── public/                  # Web root (entry point)
    ├── index.php            # Router / entry
    ├── login.php, register.php, logout.php
    ├── loginadmin.php, admin.php, dashboard.php
    ├── add_task.php, delete_task.php, toggle_task.php
    ├── styles.css
    └── assets/
```

## Requirements

- PHP 8.0+ with the `pdo_mysql` extension
- MySQL or MariaDB
- Composer

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/KhderAhmed/taskproject.git
   cd taskproject
   ```

2. **Create the database and import the schema**
   ```bash
   mysql -u root -p -e "CREATE DATABASE taskproject CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
   mysql -u root -p taskproject < sql/create_tables.sql
   ```

3. **Configure the database connection**
   Update the host, database name, username, and password in:
   ```
   config/config.php
   ```

4. **Install the autoloader**
   ```bash
   composer install
   ```

5. **(Optional) Seed the admin account**
   ```bash
   php seed.php
   ```

6. **Start the local server**
   ```bash
   php -S localhost:8000 -t public
   ```

7. Open **http://localhost:8000/** in your browser.

## Generating Documentation (Optional)

The project includes phpDocumentor settings in the `.phpdoc` folder:

```bash
composer install        # installs dev tools
vendor/bin/phpdoc       # generates the docs
```

## Notes

- `public/` is the only directory that should be exposed as the web root.
- Don't commit a real `config/config.php` containing production credentials; use an example file instead.
- Change the default admin credentials immediately on any non-local environment.

## Author

**Khder Ahmed** — Backend Developer (PHP & Laravel)
GitHub: [@KhderAhmed](https://github.com/KhderAhmed)
