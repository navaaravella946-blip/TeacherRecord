# Teacher Records

A Laravel application for managing a searchable teacher directory. It supports adding, editing, deleting, and searching teacher records, with login protection for all directory pages and actions.

## Requirements

- PHP 8.3 or newer
- Composer
- PHP extensions required by Laravel, including `pdo_sqlite` for the default SQLite database

## Install and run locally

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
```

Create your first administrator account (replace the sample values with your own):

```bash
php artisan tinker --execute="App\\Models\\User::create(['name' => 'School Administrator', 'email' => 'admin@your-school.edu', 'password' => 'Choose-A-Strong-Password'])"
```

Then start the application:

```bash
php artisan serve
```

Open [http://localhost:8000](http://localhost:8000), sign in using the administrator email and password you created, and manage the teacher directory. There is no default or publicly accessible registration account.

The default SQLite database is `database/database.sqlite`. The included database file is intentionally empty; `php artisan migrate` creates the required tables, including `teachers`.

## Run tests

```bash
php artisan test
```

The test environment must have the PHP SQLite extension enabled.

## Deploy to Render

1. Push the project to a Git repository. Do not commit `.env`; it contains environment-specific secrets.
2. Create a Render Web Service using the included Dockerfile.
3. Set `APP_ENV=production`, `APP_DEBUG=false`, a private `APP_KEY` generated with `php artisan key:generate --show`, `DB_CONNECTION=pgsql`, and `DB_URL` to your Render PostgreSQL internal connection string.
4. Deploy, then create the administrator account using the command above from the deployed service's shell (or an equivalent secure provisioning process).

Use PostgreSQL for persistent production data. A local SQLite file on an ephemeral hosting filesystem may be lost during redeploys or restarts.

## Teacher fields

- Name and subject are required.
- Email and phone are optional; email addresses must be unique.
- Status is either active or inactive.
"# TeacherRecord" 
