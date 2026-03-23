# Docker Deployment Guide

## Quick Start

### 1. Preparar el entorno

```bash
# Copiar el archivo de ejemplo
cp .env.example .env

# Editar .env con tus configuraciones de producción
nano .env
```

### 2. Build y Deploy

```bash
# Build de la imagen
docker build -t naima-website:latest .

# O usar docker-compose
docker-compose up -d --build
```

### 3. Inicializar la aplicación

```bash
# Entrar al contenedor
docker exec -it naima-app sh

# Generar APP_KEY si no existe
php artisan key:generate

# Ejecutar migraciones
php artisan migrate --force

# Ejecutar seeders (opcional)
php artisan db:seed --force

# Salir del contenedor
exit
```

## Configuración de Producción

### Variables de entorno importantes

```env
APP_NAME="FrenchBoost"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://tudominio.com

# Database (SQLite por defecto)
DB_CONNECTION=sqlite

# O usar MySQL/PostgreSQL
# DB_CONNECTION=mysql
# DB_HOST=mysql
# DB_PORT=3306
# DB_DATABASE=naima_db
# DB_USERNAME=naima
# DB_PASSWORD=secret

# Queue
QUEUE_CONNECTION=database

# Session
SESSION_DRIVER=database

# Cache
CACHE_STORE=database
```

## Comandos útiles

### Ver logs
```bash
# Logs de la aplicación
docker-compose logs -f app

# Logs de Laravel
docker exec -it naima-app tail -f storage/logs/laravel.log

# Logs del queue worker
docker exec -it naima-app tail -f storage/logs/queue-worker.log
```

### Ejecutar comandos Artisan
```bash
docker exec -it naima-app php artisan [comando]
```

### Backup de la base de datos (SQLite)
```bash
docker cp naima-app:/var/www/html/database/database.sqlite ./backup-$(date +%Y%m%d).sqlite
```

### Actualizar la aplicación
```bash
# Pull del nuevo código
git pull

# Rebuild y restart
docker-compose down
docker-compose up -d --build

# Ejecutar migraciones
docker exec -it naima-app php artisan migrate --force

# Limpiar cache
docker exec -it naima-app php artisan optimize:clear
docker exec -it naima-app php artisan config:cache
docker exec -it naima-app php artisan route:cache
docker exec -it naima-app php artisan view:cache
```

## Estructura de archivos

```
deploy/
├── nginx/
│   └── default.conf          # Configuración de Nginx
├── supervisor/
│   └── supervisord.conf      # Configuración de Supervisor
├── docker-entrypoint.sh      # Script de inicialización
└── README.md                 # Esta guía
```

## Troubleshooting

### Permisos
```bash
docker exec -it naima-app chown -R www-data:www-data /var/www/html/storage
docker exec -it naima-app chmod -R 755 /var/www/html/storage
```

### Limpiar cache
```bash
docker exec -it naima-app php artisan cache:clear
docker exec -it naima-app php artisan config:clear
docker exec -it naima-app php artisan route:clear
docker exec -it naima-app php artisan view:clear
```

### Recrear contenedores
```bash
docker-compose down -v
docker-compose up -d --build
```

## Producción con HTTPS (Nginx Proxy)

Para usar con un reverse proxy como Nginx Proxy Manager o Traefik:

```yaml
# docker-compose.yml
services:
  app:
    # ... configuración existente
    labels:
      - "traefik.enable=true"
      - "traefik.http.routers.naima.rule=Host(`tudominio.com`)"
      - "traefik.http.routers.naima.entrypoints=websecure"
      - "traefik.http.routers.naima.tls.certresolver=letsencrypt"
```

## Health Check

El contenedor incluye un endpoint de health check en `/health`:

```bash
curl http://localhost:8080/health
# Respuesta: healthy
```

## Monitoreo

Supervisor gestiona automáticamente:
- PHP-FPM
- Nginx
- Queue Worker

Para ver el estado:
```bash
docker exec -it naima-app supervisorctl status
```
