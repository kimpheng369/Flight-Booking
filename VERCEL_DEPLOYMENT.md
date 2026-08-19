# Deployment Guide — SkyBook Flight Booking System

This document provides a comprehensive guide for deploying **SkyBook** to production platforms, specifically **Vercel**, **Railway**, **Render**, and **FrankenPHP Docker environments**.

---

## 1. External Database Setup (PostgreSQL or MySQL)

Vercel functions operate on ephemeral serverless filesystems. Therefore, **do not use SQLite in Vercel production**. Instead, connect to an external hosted database service such as **Neon (PostgreSQL)**, **Supabase (PostgreSQL)**, **Railway (MySQL/PostgreSQL)**, or **PlanetScale**.

### Database Environment Variables
```env
DB_CONNECTION=pgsql
DB_HOST=ep-example-123456.us-east-2.aws.neon.tech
DB_PORT=5432
DB_DATABASE=skybook_db
DB_USERNAME=skybook_user
DB_PASSWORD=your_secure_password
DB_SSLMODE=require
```

---

## 2. Deploying to Vercel

### Step 1: Push Repository to GitHub
```bash
git init
git add .
git commit -m "Initial SkyBook Flight Booking System release"
git branch -M main
git remote add origin https://github.com/your-username/skybook.git
git push -u origin main
```

### Step 2: Create Vercel Project
1. Log in to [Vercel Dashboard](https://vercel.com).
2. Click **Add New...** &rarr; **Project**.
3. Select and import your `skybook` GitHub repository.

### Step 3: Configure Environment Variables in Vercel
Under **Environment Variables**, add:

| Key | Value | Description |
|---|---|---|
| `APP_NAME` | `SkyBook` | Application title |
| `APP_ENV` | `production` | Production environment |
| `APP_KEY` | `base64:rmsLT3MF1E+n50Wbg9kSKvG95Ixd8nLHAUlyumjLk90=` | Generated Laravel app key |
| `APP_DEBUG` | `false` | Disable debug mode for security |
| `APP_URL` | `https://your-skybook-app.vercel.app` | Production URL |
| `DB_CONNECTION` | `pgsql` | PostgreSQL driver |
| `DB_HOST` | `<your-db-host>` | External DB Hostname |
| `DB_PORT` | `5432` | DB Port |
| `DB_DATABASE` | `skybook_db` | Database Name |
| `DB_USERNAME` | `<your-db-user>` | DB Username |
| `DB_PASSWORD` | `<your-db-password>` | DB Password |

### Step 4: Run Initial Database Migrations & Seeding
From your local terminal connected to the production database:
```bash
php artisan migrate --force
php artisan db:seed --force
```

---

## 3. Alternative Portable Deployments

If serverless cold starts or timeout limits become inconvenient, SkyBook is fully portable and can be deployed with zero code modifications to:

### FrankenPHP / Docker
```dockerfile
FROM dunglas/frankenphp:latest
COPY . /app
RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build
EXPOSE 8080
CMD ["frankenphp", "php-server", "--listen", ":8080", "--root", "/app/public"]
```

### Railway / Render
1. Connect GitHub repository to Railway or Render.
2. Build command: `composer install --no-dev && npm install && npm run build`
3. Start command: `php artisan serve --host=0.0.0.0 --port=$PORT`
