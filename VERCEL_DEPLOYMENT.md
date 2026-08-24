# Vercel Deployment Guide — SkyBook Zero-Database Portfolio Demo

SkyBook is configured for **instant zero-configuration deployment** on **Vercel** with **no external database required**.

---

## 1-Minute Vercel Deployment

### Step 1: Push to GitHub
```bash
git add .
git commit -m "Configure SkyBook for zero-database portfolio deployment"
git push origin main
```

### Step 2: Import into Vercel
1. Navigate to [vercel.com/new](https://vercel.com/new).
2. Select your `skybook` repository.
3. Leave **Framework Preset** as **Other** (or default).
4. Click **Deploy**.

> **No Environment Variables Needed**: The app runs entirely in modern client-side JavaScript with `localStorage` state persistence and pre-seeded aviation records.

---

## Deployment to Other Static Hosts

Because SkyBook is completely self-contained, you can also deploy to:

- **Netlify**: Drag & drop the repository folder or link GitHub.
- **GitHub Pages**: Go to Repo Settings &rarr; Pages &rarr; Branch: `main` &rarr; Folder: `/ (root)`.
- **Cloudflare Pages**: Connect Git repo &rarr; Framework preset: None &rarr; Deploy.
