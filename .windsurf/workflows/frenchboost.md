---
description: FrenchBoost - decisiones y pasos del proyecto (sitio informativo bilingüe EN/FR)
---

# Objetivo
Construir el sitio informativo de la tutora de francés **FrenchBoost** con soporte bilingüe **EN/FR**, UI moderna (Tailwind) y arquitectura organizada (SOLID): controladores delgados, lógica en servicios y acceso a datos mediante repositorios.

# Estado actual del repo
- Laravel ^12, PHP ^8.2
- Vite + Tailwind v4
- Render: Blade (server-side)

# Decisiones (fuente de verdad)
## Frontend
- **UI:** Blade + Tailwind
- **Build de assets:** Vite
- **SPA framework:** ninguno (Vue removido)

## i18n
- **Locales soportados:** `en`, `fr`
- **Estrategia de URL:** `/{locale}` (ej: `/en`, `/fr`)
- **Fallback:** `en`
- **Selector de idioma:** header `EN | FR`, mantiene la ruta actual cuando sea posible.

## Nginx (local)
- **URL local:** `http://localhost:8081`
- **Root:** `public/`
- **PHP-FPM:** unix socket (por defecto `/run/php/php8.3-fpm.sock`)
- **Vite HMR:** opcional vía reverse proxy a `127.0.0.1:5173`

## Branding
- **Nombre:** FrenchBoost
- **Slogan (EN):** Boost your French, Boost your potential.
- **Colores guía:** Blue, Yellow, Purple, White
- **Logo:** pendiente elegir variante final (por ahora texto en header)

## Contenido / Home (implementado)
Secciones (single page, en orden):
1. Hero (slogan + CTA + testimonial card)
2. Stats bar (4,000+ horas · K–12 · 100% online · 5★) — `x-site.stats`
3. About (Naima, bio, highlights) — `x-site.about`
4. Programs / Levels (Beginner K-3, Intermediate 4-8, Advanced 9-12) — `x-site.programs`
5. Learning Strategy: Learn / Apply / Grow — `x-site.strategy`
6. Benefits (3 items) — `x-site.benefits`
7. Testimonials (6 reseñas, grid 3 col) — `x-site.testimonials`
8. Resources (mind maps, fichas; muestra "coming soon" cuando items=[]) — `x-site.resources`
9. Pricing (3 paquetes: Tartelette, Macaron, Croissant) — `x-site.pricing`
10. FAQ (accordion, 8 preguntas) — `x-site.faq`
11. Contact (info + form) — `x-site.contact`
12. Footer (3 col: brand+social, nav, contact) — `x-site.footer`

## Puntos por confirmar (bloquean copy final, no bloquean estructura)
1) Público objetivo: ¿solo K-12 o también adultos?
2) CTA Booking: destino (Calendly / WhatsApp / Google Calendar / formulario interno)
3) Moneda: USD vs CAD
4) Idioma por defecto: EN vs FR

# Arquitectura (patrones — fuente de verdad)

## Regla general
**Controllers** → delgados, solo HTTP (reciben request, devuelven response, delegan todo).
**Services** → orquestación y lógica de negocio. Usan repositorios y traits.
**Repositories** → acceso a datos (Eloquent). Sin lógica de negocio.
**Traits** → funciones reutilizables entre servicios (ej: uploads de archivos).
**Form Requests** → validación y autorización fuera del controlador.

## Estructura de directorios

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          ← CRUD del panel de administración
│   │   │   └── MindMapController.php
│   │   ├── Auth/           ← Auth (Breeze)
│   │   ├── Site/           ← Páginas públicas del sitio
│   │   │   ├── HomeController.php
│   │   │   └── MindMapController.php
│   │   └── ProfileController.php
│   ├── Middleware/
│   │   ├── EnsureUserIsAdmin.php
│   │   └── SetLocaleFromRoute.php
│   └── Requests/
│       └── Admin/
│           ├── StoreMindMapRequest.php
│           └── UpdateMindMapRequest.php
├── Models/
│   ├── MindMap.php
│   └── User.php
├── Repositories/
│   ├── MindMapRepository.php   ← Eloquent queries
│   └── Site/
│       └── HomeContentRepository.php  ← Datos estáticos home
├── Services/
│   ├── MindMapService.php      ← Lógica mind maps + uploads
│   └── Site/
│       └── SiteContentService.php
├── Traits/
│   └── HandlesFileUploads.php  ← storeUpload, deleteUpload, replaceUpload
└── View/
    └── Components/
        ├── GuestLayout.php
        └── SiteLayout.php
```

## Acceso al panel admin
- Solo el usuario con `is_admin = true` puede acceder a `/{locale}/dashboard` y `/{locale}/admin/*`
- Middleware: `EnsureUserIsAdmin` (alias `admin`) aplicado a todas las rutas admin
- Post-login: admin → dashboard, usuario normal → home

## Flujo de datos (ejemplo MindMaps)
```
Request → MindMapController (HTTP) → MindMapService (lógica) → MindMapRepository (BD)
                                          ↕ usa HandlesFileUploads (trait)
                                          ↕ usa StoreMindMapRequest (validación)
```

# Workflow de trabajo
1. ✅ Implementar infraestructura i18n (rutas, middleware, selector)
2. ✅ Implementar layout base (header/footer, sidebar)
3. ✅ Implementar Home con todas las secciones (12 secciones)
4. ✅ Auth pages rediseñadas (guest layout 2 columnas)
5. ✅ Admin access: columna `is_admin`, middleware, redirect post-login
6. ✅ Páginas internas: layout `SiteLayout`, mind maps (grid + modal Alpine.js), videos/worksheets (coming soon)
7. ✅ Mind maps dinámicos: migración, modelo, repositorio, servicio, CRUD admin, form requests, trait uploads
8. ⬜ Confirmar puntos pendientes (público K-12 o adultos, CTA booking, moneda, idioma default)
9. ⬜ Refinar copy EN y traducir FR completo
10. ⬜ Ajustar branding (colores finales, logo final, foto de Naima)
11. ⬜ Conectar CTA booking (Calendly / WhatsApp / formulario)
12. ⬜ Subir archivos reales: imágenes preview + PDFs de mind maps
13. ⬜ Sección Videos: implementar (YouTube embeds por nivel/tema)
14. ⬜ Sección Fiches/Worksheets: implementar

# Comandos útiles
- Nginx en WSL sirve la app (no es necesario `php artisan serve` para el flujo normal)
- `npm run dev` (solo si quieres HMR de Vite)
- `npm run build` (para compilar assets Tailwind/Vite)
- Instalar/activar el site de Nginx: `bash scripts/nginx-install-site.sh frenchboost 8081 /home/kronos/Code/naima-website`
- `composer run test`
