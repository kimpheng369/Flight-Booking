# SkyBook — Flight Booking System

A complete, modern, and responsive **Flight Booking System** built with PHP 8.3+, **Laravel 13**, Blade Templates, Tailwind CSS, Eloquent ORM, Chart.js statistics, and RESTful APIs.

---

## Key Features

### Customer Portal
- **Flight Search & Filtering**: Filter flights by origin airport, destination airport, departure date, passenger count, airline, price range, and departure time range using database-level Eloquent queries.
- **Flight Details & Schedule**: View flight duration, seat availability, aircraft registration, baggage allowances, and flight status.
- **Interactive Booking Checkout**: Multi-step booking workflow with passenger information input and simulated payment approval.
- **Race Condition & Overbooking Prevention**: Atomic database transactions (`DB::transaction`) and pessimistic locking (`lockForUpdate`) prevent overbooking.
- **Customer Dashboard**: Overview metrics (Total Bookings, Upcoming Flights, Completed Trips, Cancelled) and quick access to next departure tickets.
- **Printable E-Ticket Boarding Pass**: Airline boarding pass layout with simulated security barcodes and standard browser `window.print()` support.
- **Self-Service Cancellation**: Customers can cancel bookings and automatically restore seat availability to flight inventory via atomic transactions.

### Administrator Control Center
- **Dynamic Analytics Dashboard**: Powered by **Chart.js** featuring real-time database charts:
  - Monthly Bookings Trend (Line Chart)
  - Monthly Revenue ($) (Bar Chart)
  - Popular Destinations (Doughnut Chart)
  - Booking Status Distribution (Pie Chart)
- **Flight Management CRUD**: Create, edit, search, filter, and update status (`Scheduled`, `Boarding`, `Departed`, `Arrived`, `Cancelled`). Includes strict validation (Origin != Destination, Price > 0, Available <= Total seats).
- **Airline Management CRUD**: Manage commercial airlines, IATA codes, logos, and origin countries.
- **Airport Management CRUD**: Manage global airport hubs, unique IATA codes (e.g. `PNH`, `SIN`, `BKK`, `HND`), cities, and timezones.
- **Aircraft Fleet CRUD**: Manage fleet models (`A320`, `A350`, `B787`), tail registration numbers, and seat capacities.
- **Master Booking Management**: Search, filter, view passenger ID credentials, confirm bookings, mark payment status as paid, and handle cancellations.

### RESTful API
- `GET /api/flights` — Search and filter flights with JSON pagination and API Resources.
- `GET /api/flights/{id}` — Fetch detailed flight metadata.
- `GET /api/bookings` — Fetch customer bookings.
- `POST /api/bookings` — Create a new flight booking.
- `GET /api/bookings/{id}` — Fetch booking e-ticket resource.
- `DELETE /api/bookings/{id}` — Cancel booking and restore flight inventory.

---

## Technology Stack

- **Backend**: PHP 8.3+ / PHP 8.5, Laravel 13 Framework
- **Frontend**: Blade Templates, Tailwind CSS v4, Lucide Icons, Chart.js
- **Database**: SQLite (Local Dev & Testing), PostgreSQL / MySQL (Production)
- **ORM & Auth**: Laravel Eloquent, Policies & Gates, Middleware
- **Build Tools**: Vite, Composer, npm

---

## Demo Credentials

| Role | Email | Password |
|---|---|---|
| **Administrator** | `admin@skybook.test` | `password` |
| **Customer** | `john@skybook.test` | `password` |

> *Note: These are pre-seeded development accounts.*

---

## Local Installation Guide

### Prerequisites
- PHP 8.3+ (with `pdo_sqlite` or `pdo_mysql` enabled)
- Composer 2.x
- Node.js & npm

### Setup Steps

1. **Clone & Navigate to Repository**:
   ```bash
   cd skybook
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment File**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seed Database**:
   ```bash
   php artisan migrate:fresh --seed
   ```

5. **Build Frontend Assets**:
   ```bash
   npm run build
   ```

6. **Start Local Server**:
   ```bash
   php artisan serve
   ```
   Open `http://localhost:8000` in your web browser.

---

## Running Automated Tests

SkyBook includes feature and unit tests for authentication, query builder filtering, atomic seat transactions, overbooking prevention, and REST APIs.

Run tests via Artisan:
```bash
php artisan test
```

---

## Vercel & Production Deployment

For complete instructions on deploying SkyBook to **Vercel** with a **PostgreSQL** database (e.g. Neon or Supabase), refer to [VERCEL_DEPLOYMENT.md](file:///C:/Users/Hakki/.gemini/antigravity-ide/scratch/skybook/VERCEL_DEPLOYMENT.md).
