# Technical Documentation — Naima Website

> Last updated: 2026-03-22  
> Stack: Laravel 12 · Tailwind v4 · Blade · SQLite (dev) · HTMX

---

## Table of Contents

1. [Stack & Architecture](#1-stack--architecture)
2. [Local Dev Setup](#2-local-dev-setup)
3. [Project Structure](#3-project-structure)
4. [Database & Migrations](#4-database--migrations)
5. [File Storage System](#5-file-storage-system)
6. [Admin Panel](#6-admin-panel)
7. [Public Site](#7-public-site)
8. [Localisation (EN / FR)](#8-localisation-en--fr)
9. [Deployment](#9-deployment)
10. [Migrating Storage to Cloudflare R2](#10-migrating-storage-to-cloudflare-r2)
11. [Adding a New Resource Type](#11-adding-a-new-resource-type)

---

## 1. Stack & Architecture

| Layer | Technology |
|---|---|
| Framework | Laravel 12 |
| Frontend | Blade + Tailwind v4 |
| Dynamic UI | HTMX (partial page swaps, no full-page reload) |
| Database | SQLite (dev) / MySQL or PostgreSQL (prod) |
| File Storage | Local `public` disk (dev) → Cloudflare R2 (prod) |
| Languages | English + French (URL-prefixed: `/en/`, `/fr/`) |

**Pattern:** Controller → Service → Repository → Model. Controllers stay thin, business logic lives in Services.

---

## 2. Local Dev Setup

```bash
# 1. Install PHP dependencies
composer install

# 2. Install JS dependencies
npm install

# 3. Copy and configure environment
cp .env.example .env
php artisan key:generate

# 4. Run migrations
php artisan migrate

# 5. Create storage symlink (required for file uploads to be publicly accessible)
php artisan storage:link

# 6. Start dev servers (two terminals)
php artisan serve
npm run dev
```

### Admin account

Create the first admin user via Artisan tinker or a seeder:

```bash
php artisan tinker
# Inside tinker:
App\Models\User::create([
    'name'     => 'Naima',
    'email'    => 'naima@example.com',
    'password' => bcrypt('your-password'),
    'is_admin' => true,
]);
```

Then access the admin panel at `http://localhost:8000/en/admin/mind-maps`.

---

## 3. Project Structure

```
app/
  Http/
    Controllers/
      Admin/          # MindMapController, WorksheetController, VideoController, BookingController
      Site/           # HomeController, MindMapController, VideoController, WorksheetController
  Models/             # MindMap, Worksheet, Video, Booking, User
  Repositories/       # DB query layer (paginate, stats, grouped)
  Services/           # Business logic + file upload orchestration
  Traits/
    HandlesFileUploads.php   # Reusable upload/delete/replace helpers
resources/
  views/
    admin/            # Admin CRUD views + partials (HTMX targets)
    components/site/  # Public site section components
    layouts/          # app.blade.php
  lang/
    en/site.php       # English strings
    fr/site.php       # French strings
routes/
  web.php             # All routes (locale-prefixed)
database/
  migrations/         # One file per table
docs/                 # This file + GUIA-CLIENTE.md
```

---

## 4. Database & Migrations

| Table | Key Columns |
|---|---|
| `users` | `name`, `email`, `password`, `is_admin` |
| `mind_maps` | `slug`, `title_en`, `title_fr`, `group`, `level`, `preview_image`, `file_path`, `is_published`, `sort_order` |
| `worksheets` | `title_en`, `title_fr`, `level`, `preview_image`, `file_path`, `is_published`, `sort_order` |
| `videos` | `title_en`, `title_fr`, `video_url`, `level`, `is_published`, `sort_order` |
| `bookings` | `name`, `email`, `phone`, `message`, `status`, `preferred_date` |

**`file_path` and `preview_image`** store relative storage paths (e.g. `worksheets/files/abc123.pdf`), not full URLs. Use `Storage::url($path)` in Blade to get the public URL.

Run migrations:
```bash
php artisan migrate
# Reset + re-seed (dev only)
php artisan migrate:fresh --seed
```

---

## 5. File Storage System

### Current setup (local)

Files are stored in `storage/app/public/` and served via the `public_path('storage')` symlink.

| Resource type | Preview path | PDF path |
|---|---|---|
| Mind Maps | `mind-maps/previews/` | `mind-maps/files/` |
| Worksheets | `worksheets/previews/` | `worksheets/files/` |

### How it works

All file operations go through `App\Traits\HandlesFileUploads`:

```php
$this->storeUpload($file, 'worksheets/files')      // store new
$this->replaceUpload($old, $new, 'worksheets/files') // replace (deletes old)
$this->deleteUpload($path)                           // delete
```

The disk used is controlled by the `UPLOAD_DISK` env variable (default: `public`).

### Generating a public URL in Blade

```blade
<img src="{{ Storage::url($worksheet->preview_image) }}">
<a href="{{ Storage::url($worksheet->file_path) }}">Download PDF</a>
```

### File size limits

Currently enforced in `Request` validation classes (`app/Http/Requests/Admin/`):
- Preview images: max 4 MB (`image/*`)
- PDF files: max 20 MB (`.pdf`)

---

## 6. Admin Panel

URL prefix: `/{locale}/admin/`  
Middleware: `auth` + `verified` + `admin`

| Route name | URL | Purpose |
|---|---|---|
| `admin.mind-maps.index` | `/en/admin/mind-maps` | List + filter mind maps |
| `admin.worksheets.index` | `/en/admin/worksheets` | List + filter worksheets |
| `admin.videos.index` | `/en/admin/videos` | List + filter videos |
| `admin.bookings.index` | `/en/admin/bookings` | View booking requests |

Each resource has full CRUD: `index`, `create`, `store`, `edit`, `update`, `destroy`, `togglePublish`.

HTMX is used for filter tabs (partial swaps into the list container) — no page reload needed.

---

## 7. Public Site

URL prefix: `/{locale}/` (locale = `en` or `fr`)

| Route | Controller |
|---|---|
| `/` | Redirects to `/en` |
| `/{locale}` | `HomeController` — renders all home sections |
| `/{locale}/mind-maps` | `MindMapController` |
| `/{locale}/videos` | `VideoController` |
| `/{locale}/worksheets` | `WorksheetController` |
| `/{locale}/book-free-assessment` | `BookingController` |

Home page sections (in order): Hero → Stats → About → Programs → Strategy → Benefits → Testimonials → Resources → Pricing → FAQ → Contact → Footer

---

## 8. Localisation (EN / FR)

- Locale is set from the URL prefix (`{locale}` route parameter) via `SetLocaleFromRoute` middleware.
- String translations live in `resources/lang/en/site.php` and `resources/lang/fr/site.php`.
- Models expose bilingual helpers: `$model->title()`, `$model->description()`, `$model->topic()` — all accept a `$locale` parameter.
- Language switcher in the nav toggles between `/en/...` and `/fr/...`.

---

## 9. Deployment

### Nginx config

Template at `deploy/nginx/frenchboost.local.8081.conf.template`.  
Install script: `scripts/nginx-install-site.sh`.

### Required after every deploy

```bash
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan migrate --force
php artisan storage:link   # only first time or if symlink is missing
npm run build
```

### Environment variables to set in production

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com
DB_CONNECTION=mysql   # or pgsql
UPLOAD_DISK=public    # or r2 when ready
```

---

## 10. Migrating Storage to Cloudflare R2

When traffic grows or the client wants cloud-based storage:

### Step 1 — Create R2 bucket in Cloudflare dashboard

1. Cloudflare dashboard → R2 → Create bucket (e.g. `naima-website`)
2. R2 → Manage R2 API Tokens → Create token with Object Read & Write
3. Enable "Public access" on the bucket and note the public URL

### Step 2 — Install S3 package (if not already)

```bash
composer require league/flysystem-aws-s3-v3
```

### Step 3 — Set env variables

```env
UPLOAD_DISK=r2
CLOUDFLARE_R2_ACCESS_KEY_ID=your_key
CLOUDFLARE_R2_SECRET_ACCESS_KEY=your_secret
CLOUDFLARE_R2_BUCKET=naima-website
CLOUDFLARE_R2_ENDPOINT=https://<account_id>.r2.cloudflarestorage.com
CLOUDFLARE_R2_URL=https://pub-<hash>.r2.dev
```

**That's it.** No code changes needed — the `r2` disk is already configured in `config/filesystems.php`.

### Step 4 — Migrate existing files (optional)

If there are already files in local storage, migrate them with Artisan tinker or rclone.

---

## 11. Adding a New Resource Type

To add a new manageable resource (e.g. `Exercise`):

1. **Migration**: `php artisan make:migration create_exercises_table`
2. **Model**: `app/Models/Exercise.php` — add `$fillable`, scopes, bilingual helpers
3. **Repository**: `app/Repositories/ExerciseRepository.php`
4. **Service**: `app/Services/ExerciseService.php` — use `HandlesFileUploads` if it has files
5. **Requests**: `app/Http/Requests/Admin/StoreExerciseRequest.php` + `UpdateExerciseRequest.php`
6. **Controller**: `app/Http/Controllers/Admin/ExerciseController.php`
7. **Views**: `resources/views/admin/exercises/` (index + form) + partial
8. **Routes**: add to the `admin` group in `routes/web.php`
9. Update `docs/TECHNICAL.md` and `docs/GUIA-CLIENTE.md`
