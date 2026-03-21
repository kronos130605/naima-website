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

# Arquitectura (patrones)
- **Controllers**: solo HTTP + delegación
- **Services**: orquestación y view-models
- **Repositories**: acceso a datos (por ahora en memoria / config)

Estructura propuesta:
- `app/Http/Controllers/Site/HomeController.php`
- `app/Http/Middleware/SetLocaleFromRoute.php`
- `app/Services/Site/SiteContentService.php`
- `app/Repositories/Site/*Repository.php`

# Workflow de trabajo
1. ✅ Implementar infraestructura i18n (rutas, middleware, selector)
2. ✅ Implementar layout base (header/footer)
3. ✅ Implementar Home con todas las secciones (12 secciones, datos placeholder EN)
4. ⬜ Confirmar puntos pendientes (público, CTA booking, moneda, idioma default)
5. ⬜ Refinar copy EN y traducir FR completo (cuando estén confirmaciones)
6. ⬜ Ajustar estilos/branding (colores, logo final, foto de Naima)
7. ⬜ Conectar CTA booking (Calendly / WhatsApp / formulario)
8. ⬜ Poblar sección Resources con mind maps y fichas reales

# Comandos útiles
- Nginx en WSL sirve la app (no es necesario `php artisan serve` para el flujo normal)
- `npm run dev` (solo si quieres HMR de Vite)
- `npm run build` (para compilar assets Tailwind/Vite)
- Instalar/activar el site de Nginx: `bash scripts/nginx-install-site.sh frenchboost 8081 /home/kronos/Code/naima-website`
- `composer run test`
