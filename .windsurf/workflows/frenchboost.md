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

## Contenido / Home (MVP)
Secciones (single page):
- Hero (slogan + CTA)
- Who I am (About)
- Learning Strategy: Learn / Apply / Grow
- Benefits (3 items)
- Pricing (3 paquetes)
- Testimonials
- Mind maps & related documents (resources)
- FAQ
- Contact

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

# Workflow de trabajo (actualizar este archivo cuando definamos algo)
1. Implementar infraestructura i18n (rutas, middleware, selector)
2. Implementar layout base (header/footer)
3. Implementar Home con secciones y datos placeholder
4. Refinar copy EN y traducir FR (cuando estén confirmaciones)
5. Ajustar estilos/branding (colores y logo final)

# Comandos útiles
- Nginx en WSL sirve la app (no es necesario `php artisan serve` para el flujo normal)
- `npm run dev` (solo si quieres HMR de Vite)
- `npm run build` (para compilar assets Tailwind/Vite)
- Instalar/activar el site de Nginx: `bash scripts/nginx-install-site.sh frenchboost 8081 /home/kronos/Code/naima-website`
- `composer run test`
