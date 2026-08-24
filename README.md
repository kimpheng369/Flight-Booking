# SkyBook — Flight Booking & Aviation Platform (Portfolio Demo)

A modern, responsive **Flight Reservation & Aviation Platform** built for interactive web showcases, portfolio demonstrations, and production deployments.

> **Zero Database Required**: Designed with an integrated client-side reactive state engine and realistic aviation seed data. Deploys instantly to **Vercel, Netlify, GitHub Pages, or Cloudflare Pages** with zero configuration, zero environment variables, and 100% uptime.

---

## Live Demo Features

### 1. Interactive Flight Search & Real-Time Filtering
- **Airport Hubs Matrix**: Search across international hubs (`PNH`, `SIN`, `BKK`, `DXB`, `HND`, `LHR`, `JFK`, `LAX`, `SYD`, etc.).
- **Live Filtering**: Filter dynamically by maximum budget slider, direct vs multi-stop flights, and partner airline carriers.
- **Sorting Options**: Sort by lowest fare, shortest duration, or departure schedules.

### 2. Interactive Airplane Fuselage & Cabin Seat Selector
- **Cabin Classes**: Choose between **First Class Suites**, **Business Pods**, and **Economy Seats**.
- **Interactive Fuselage Map**: Click visual seats (Aisle, Window, Middle) with live seat status (Available, Occupied, Selected) and automatic price breakdown.

### 3. Instant Checkout & Boarding Pass Generator
- **Passenger Details**: Passenger name, passport verification, contact information, and airport security breakdown.
- **Digital Boarding Pass**: High-fidelity airline boarding pass with:
  - Scannable QR Code
  - Simulated barcode strip
  - Gate, terminal, boarding time, and seat assignment
  - **Print / Save as PDF** support via `window.print()`.

### 4. My Bookings & Customer Dashboard
- **Reservation Management**: View all active and completed flights with unique booking reference codes (`SB-XXXXX`).
- **Cancellation & Seat Return**: Cancel any booking with real-time seat inventory recovery.
- **Loyalty Metrics**: Track frequent flyer air miles, trip history, and upcoming departures.

### 5. Administrator Control Center & Chart.js Analytics
- **Live Operations Dashboard**: Revenue metrics, active flight count, and Chart.js analytics line charts.
- **Flight Roster CRUD**: Schedule new commercial flights or remove flights from inventory.
- **Customer Reservations Log**: Master registry of all passenger bookings and payment statuses.

### 6. One-Click Demo Role Switcher
- Instantly toggle between **Alex Morgan (Customer)**, **Admin System (Administrator)**, and **Guest Visitor** from the navigation bar without entering passwords.

---

## 🚀 Instant Deployment to Vercel

1. Push this repository to GitHub:
   ```bash
   git init
   git add .
   git commit -m "Deploy SkyBook Portfolio Demo"
   git branch -M main
   git remote add origin https://github.com/your-username/skybook.git
   git push -u origin main
   ```
2. Go to [Vercel Dashboard](https://vercel.com) &rarr; **Add New Project** &rarr; Select your `skybook` repository.
3. Click **Deploy** (No environment variables or database settings required!).

---

## Local Development

To run locally in any browser or local server:

```bash
# Using standard Python / Node / PHP static server or VS Code Live Server
npx serve .
# or
php -S localhost:8000
# or simply double-click index.html in any browser!
```

---

## Tech Stack
- **HTML5 & Vanilla JavaScript (ES6+)**: Reactive client-side architecture with persistent `localStorage`.
- **Tailwind CSS**: Modern UI layout, glassmorphism, responsive grid system.
- **Lucide Icons & Chart.js**: Vector icons and analytics visualization.
