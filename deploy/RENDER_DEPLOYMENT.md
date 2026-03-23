# Guía de Deployment en Render.com

## 📋 Requisitos previos

1. Cuenta en [Render.com](https://render.com)
2. Repositorio Git (GitHub, GitLab, o Bitbucket)
3. Código pusheado al repositorio

## 🚀 Deployment Automático con render.yaml

### Opción 1: Blueprint (Recomendado)

1. **Push del código a tu repositorio**
   ```bash
   git add .
   git commit -m "Add Render deployment configuration"
   git push origin main
   ```

2. **Crear nuevo Blueprint en Render**
   - Ve a [Render Dashboard](https://dashboard.render.com)
   - Click en "New +" → "Blueprint"
   - Conecta tu repositorio
   - Render detectará automáticamente `render.yaml`
   - Click en "Apply"

3. **Render creará automáticamente:**
   - ✅ Web Service (naima-website)
   - ✅ PostgreSQL Database (naima-db)
   - ✅ Variables de entorno configuradas
   - ✅ Auto-deploy habilitado

### Opción 2: Deployment Manual

Si prefieres configurar manualmente:

#### 1. Crear PostgreSQL Database

1. En Render Dashboard → "New +" → "PostgreSQL"
2. Configuración:
   - **Name**: `naima-db`
   - **Database**: `naima_production`
   - **User**: `naima_user`
   - **Region**: Oregon (o el más cercano)
   - **Plan**: Starter ($7/mes)
3. Click "Create Database"
4. **Guarda las credenciales** (Internal Database URL)

#### 2. Crear Web Service

1. En Render Dashboard → "New +" → "Web Service"
2. Conecta tu repositorio
3. Configuración:
   - **Name**: `naima-website`
   - **Region**: Oregon (mismo que la DB)
   - **Branch**: `main`
   - **Runtime**: Docker
   - **Plan**: Starter ($7/mes)
   - **Docker Command**: (dejar vacío, usa CMD del Dockerfile)

#### 3. Configurar Variables de Entorno

En la sección "Environment" del Web Service, agrega:

```env
# App
APP_NAME=FrenchBoost
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
APP_URL=https://tu-app.onrender.com

# Database (usar valores de la DB creada)
DB_CONNECTION=pgsql
DB_HOST=dpg-xxxxxxxxxxxxx-a.oregon-postgres.render.com
DB_PORT=5432
DB_DATABASE=naima_production
DB_USERNAME=naima_user
DB_PASSWORD=xxxxxxxxxxxxxxxxxxxxxxxxxxxxx

# Session & Cache
SESSION_DRIVER=database
SESSION_LIFETIME=120
QUEUE_CONNECTION=database
CACHE_STORE=database

# Storage
FILESYSTEM_DISK=local
UPLOAD_DISK=public

# Mail
MAIL_MAILER=log
MAIL_FROM_ADDRESS=hello@frenchboost.com
MAIL_FROM_NAME=FrenchBoost

# Logging
LOG_CHANNEL=stack
LOG_LEVEL=error
```

**Importante**: Para generar `APP_KEY`:
```bash
# Localmente
php artisan key:generate --show
# Copia el resultado y pégalo en Render
```

#### 4. Configurar Health Check

- **Health Check Path**: `/health`
- Render verificará automáticamente que la app esté funcionando

#### 5. Deploy

- Click "Create Web Service"
- Render comenzará el build y deploy automáticamente
- El primer deploy puede tardar 5-10 minutos

## 🔧 Post-Deployment

### Ejecutar Migraciones Manualmente (si es necesario)

Si las migraciones no se ejecutaron automáticamente:

1. Ve a tu Web Service en Render
2. Click en "Shell" (terminal)
3. Ejecuta:
   ```bash
   php artisan migrate --force
   ```

### Ejecutar Seeders

```bash
php artisan db:seed --force
```

### Verificar la Aplicación

1. Accede a tu URL: `https://tu-app.onrender.com`
2. Verifica el health check: `https://tu-app.onrender.com/health`

## 📊 Monitoreo

### Ver Logs

En Render Dashboard:
- Web Service → "Logs" tab
- Logs en tiempo real de la aplicación

### Métricas

- CPU, Memory, Request metrics disponibles en el dashboard
- Alertas configurables

## 🔄 Actualizaciones

### Auto-Deploy

Con `autoDeploy: true` en `render.yaml`:
- Cada push a `main` despliega automáticamente
- Build y deploy en ~5 minutos

### Deploy Manual

1. En Render Dashboard → tu Web Service
2. Click "Manual Deploy" → "Deploy latest commit"

## 💾 Backups de Base de Datos

### Backups Automáticos

Render hace backups automáticos de PostgreSQL:
- Plan Starter: 7 días de retención
- Plan Pro: 30 días de retención

### Backup Manual

```bash
# Desde el Shell de Render
pg_dump $DATABASE_URL > backup.sql

# O descarga localmente
render pg:backups:download naima-db
```

## 🔒 Seguridad

### Variables Sensibles

- ✅ Nunca commitees `.env` al repositorio
- ✅ Usa las variables de entorno de Render
- ✅ Genera un `APP_KEY` único para producción

### HTTPS

- ✅ Render proporciona HTTPS automático
- ✅ Certificados SSL gratuitos

### Dominio Personalizado

1. En Web Service → "Settings" → "Custom Domains"
2. Agrega tu dominio
3. Configura DNS según las instrucciones
4. Render configura SSL automáticamente

## 🐛 Troubleshooting

### Build Falla

**Error: "npm run build failed"**
```bash
# Verifica que package.json tenga el script build
# Verifica que todos los assets estén commiteados
```

**Error: "Composer install failed"**
```bash
# Verifica composer.json y composer.lock
# Asegúrate de que estén en sync
```

### App no Inicia

**Error: "Connection refused"**
- Verifica que el puerto sea el correcto (usa variable `$PORT`)
- Revisa logs en Render Dashboard

**Error: "Database connection failed"**
- Verifica las credenciales de DB en variables de entorno
- Asegúrate de que la DB esté en la misma región

### Migraciones Fallan

```bash
# En Shell de Render
php artisan migrate:status
php artisan migrate --force
```

### Storage/Permissions

```bash
# En Shell de Render
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

## 💰 Costos

### Plan Starter (Recomendado para inicio)

- **Web Service**: $7/mes
- **PostgreSQL**: $7/mes
- **Total**: ~$14/mes

### Incluye:

- ✅ 512 MB RAM
- ✅ 0.5 CPU
- ✅ SSL gratuito
- ✅ Auto-deploy
- ✅ Backups automáticos (7 días)
- ✅ 100 GB bandwidth

## 📚 Recursos

- [Render Docs](https://render.com/docs)
- [Render Laravel Guide](https://render.com/docs/deploy-laravel)
- [Render PostgreSQL](https://render.com/docs/databases)
- [Blueprint Spec](https://render.com/docs/blueprint-spec)

## 🎯 Checklist de Deployment

- [ ] Código pusheado a repositorio
- [ ] `render.yaml` configurado
- [ ] Variables de entorno configuradas
- [ ] `APP_KEY` generado
- [ ] Database creada
- [ ] Web Service creado
- [ ] Health check funcionando
- [ ] Migraciones ejecutadas
- [ ] Seeders ejecutados (si aplica)
- [ ] Dominio personalizado configurado (opcional)
- [ ] SSL verificado
- [ ] Logs revisados
- [ ] App funcionando correctamente

## 🚨 Comandos Útiles

```bash
# Ver logs en tiempo real
render logs -f naima-website

# Ejecutar comando en el contenedor
render shell naima-website

# Ver status de servicios
render services list

# Restart del servicio
render services restart naima-website

# Ver info de la base de datos
render pg:info naima-db
```

## 📧 Soporte

Si tienes problemas:
1. Revisa los logs en Render Dashboard
2. Consulta la documentación de Render
3. Contacta soporte de Render (muy responsivos)
