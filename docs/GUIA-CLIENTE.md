# Guía de uso — Panel de administración Naima

> Última actualización: 2026-03-22  
> Este documento se actualiza cada vez que se agrega o modifica una funcionalidad.

---

## Tabla de contenidos

1. [Acceso al panel de administración](#1-acceso-al-panel-de-administración)
2. [Mind Maps](#2-mind-maps)
3. [Worksheets (hojas de trabajo)](#3-worksheets-hojas-de-trabajo)
4. [Videos](#4-videos)
5. [Reservas (Bookings)](#5-reservas-bookings)
6. [Publicar y despublicar contenido](#6-publicar-y-despublicar-contenido)
7. [Subir archivos: qué se acepta y límites](#7-subir-archivos-qué-se-acepta-y-límites)
8. [Preguntas frecuentes](#8-preguntas-frecuentes)

---

## 1. Acceso al panel de administración

1. Ingresa a `https://tudominio.com/en/login` (o `/fr/login` para francés)
2. Ingresa tu correo y contraseña
3. Haz clic en **Dashboard** en el menú superior, o navega directamente a `/en/admin/mind-maps`

> Solo las cuentas marcadas como **administrador** pueden acceder al panel.

---

## 2. Mind Maps

Los mind maps son materiales visuales en PDF, organizados por **grupo escolar** y **nivel**.

### Crear un mind map

1. Ve a **Admin → Mind Maps → New Mind Map**
2. Completa los campos:

| Campo | Descripción | Obligatorio |
|---|---|---|
| Title EN | Título en inglés | Sí |
| Title FR | Título en francés | Sí |
| Description EN / FR | Descripción corta | No |
| Group | Grupo escolar (Maternelle, Primaire, Collège, Lycée) | Sí |
| Level | Nivel específico (CP, CE1, CM1, 6ème, etc.) | Sí |
| Topic EN / FR | Tema (Grammar, Conjugation, Vocabulary…) | No |
| Preview Image | Imagen de portada — PNG, JPG o WEBP, máx. 4 MB | No |
| PDF File | Archivo PDF del mind map, máx. 20 MB | No |
| Sort Order | Número para ordenar (0 = primero) | No |
| Slug | Identificador en URL (se genera automáticamente del título EN) | No |
| Published | Tilde para que sea visible al público | No |

3. Haz clic en **Create Mind Map**

### Editar un mind map

1. En la lista, haz clic en el ícono de lápiz del mind map a editar
2. Modifica los campos que necesites
3. Para reemplazar la imagen o el PDF, simplemente sube el nuevo archivo — el antiguo se elimina automáticamente
4. Haz clic en **Save Changes**

### Eliminar un mind map

1. En la lista, haz clic en el ícono de papelera
2. Confirma la eliminación

> Al eliminar un mind map, **la imagen y el PDF también se eliminan** del servidor.

### Filtrar por grupo

En la lista de mind maps, usa las pestañas de grupo (Maternelle / Primaire / Collège / Lycée) para ver solo los de ese grupo.

---

## 3. Worksheets (hojas de trabajo)

Las worksheets son ejercicios en PDF organizados por **nivel de dificultad**.

### Crear una worksheet

1. Ve a **Admin → Worksheets → New Worksheet**
2. Completa los campos:

| Campo | Descripción | Obligatorio |
|---|---|---|
| Title EN / FR | Título en inglés y francés | Sí |
| Description EN / FR | Descripción corta | No |
| Level | Nivel de dificultad: Beginner, Intermediate, Advanced o General | Sí |
| Topic EN / FR | Tema de la hoja (Grammar, Vocabulary, etc.) | No |
| Preview Image | Imagen de portada — PNG, JPG o WEBP, máx. 4 MB | No |
| PDF File | Archivo PDF de la hoja de trabajo, máx. 20 MB | No |
| Sort Order | Número para ordenar (0 = primero dentro del nivel) | No |
| Published | Tilde para que sea visible al público | No |

3. Haz clic en **Create Worksheet**

### Editar / Eliminar

El proceso es idéntico al de los mind maps (ver sección anterior).

---

## 4. Videos

Los videos son enlaces de **YouTube** organizados por nivel. Los archivos de video **no se suben al servidor** — solo se registra la URL de YouTube.

### Crear un video

1. Ve a **Admin → Videos → New Video**
2. Completa los campos:

| Campo | Descripción | Obligatorio |
|---|---|---|
| Title EN / FR | Título en inglés y francés | Sí |
| Description EN / FR | Descripción corta | No |
| Video URL | URL del video en YouTube o Vimeo | Sí |
| Level | Nivel de dificultad: Beginner, Intermediate, Advanced o General | Sí |
| Topic EN / FR | Tema del video | No |
| Sort Order | Número para ordenar | No |
| Published | Tilde para que sea visible al público | No |

3. Haz clic en **Create Video**

> La miniatura del video se obtiene **automáticamente** para YouTube. Para Vimeo se muestra un placeholder genérico.

### Formatos de URL aceptados

**YouTube:**
- `https://www.youtube.com/watch?v=XXXXXXXXXXX`
- `https://youtu.be/XXXXXXXXXXX`
- `https://www.youtube.com/shorts/XXXXXXXXXXX`

**Vimeo:**
- `https://vimeo.com/123456789`
- `https://vimeo.com/video/123456789`

> La fuente (YouTube o Vimeo) se detecta automáticamente — no necesitas hacer nada especial.

---

## 5. Reservas (Bookings)

Cuando un visitante completa el formulario de **"Free Assessment"** en el sitio, la reserva aparece aquí.

### Ver reservas

1. Ve a **Admin → Bookings**
2. Verás la lista de solicitudes con nombre, correo, teléfono y mensaje

### Cambiar el estado de una reserva

Cada reserva puede tener uno de estos estados:

| Estado | Significado |
|---|---|
| **Pending** | Nueva solicitud sin revisar |
| **Confirmed** | Sesión confirmada con la familia |
| **Cancelled** | Solicitud cancelada |

Para cambiar el estado, usa el selector de estado en la fila de la reserva.

---

## 6. Publicar y despublicar contenido

Todo el contenido (mind maps, worksheets, videos) tiene un estado **publicado / no publicado**.

- **Publicado**: visible para cualquier visitante del sitio
- **No publicado**: solo visible en el panel de administración (útil para preparar contenido antes de lanzarlo)

Puedes cambiar el estado de dos formas:
1. Desde el **formulario de edición** — cambia el tilde "Published"
2. Desde la **lista**, con el botón de toggle (ícono de ojo / check) — cambia el estado al instante sin abrir el formulario

---

## 7. Subir archivos: qué se acepta y límites

| Tipo de archivo | Formatos aceptados | Tamaño máximo |
|---|---|---|
| Imagen de portada | PNG, JPG, JPEG, WEBP | 4 MB |
| PDF (mind map / worksheet) | PDF | 20 MB |

### Almacenamiento

Los archivos se guardan **en el mismo servidor** donde está alojado el sitio. No se usa ningún servicio externo de pago.

- **Costo actual de almacenamiento: $0/mes** — incluido en el hosting
- Si el volumen de archivos crece significativamente (más de 10 GB), se puede migrar a **Cloudflare R2** sin ningún costo adicional hasta ese límite

### Recomendaciones para los archivos

- **PDFs**: exporta desde el programa original en calidad media (no la máxima) para reducir el tamaño
- **Imágenes**: usa formato WEBP siempre que sea posible — es más liviano que JPG/PNG con la misma calidad. Puedes convertir en [squoosh.app](https://squoosh.app) de forma gratuita
- **Nombre del archivo**: no importa cómo se llame, el sistema asigna un nombre único automáticamente

---

## 8. Preguntas frecuentes

**¿Puedo subir el mismo PDF para inglés y francés por separado?**  
Sí. Si tienes versiones bilingüales del mismo material, créalos como dos entradas separadas — una con el title_en/fr correspondiente y su PDF.

**¿Qué pasa si borro un archivo por error?**  
Una vez eliminado, no se puede recuperar desde el panel. Si tienes el archivo original, simplemente crea una nueva entrada y vuelve a subirlo.

**¿El sitio se ve diferente si el visitante usa inglés o francés?**  
Sí. El sitio detecta el idioma por la URL (`/en/` o `/fr/`). Los títulos, descripciones y etiquetas que ingresas en EN y FR se muestran según el idioma del visitante. Si el campo FR está vacío, se muestra el EN como fallback.

**¿Puedo preparar contenido sin que sea visible en el sitio?**  
Sí. Deja el campo "Published" sin marcar. El contenido queda guardado en el sistema pero no aparece en el sitio hasta que lo publiques.

**¿Cuántos archivos puedo tener en total?**  
No hay límite técnico definido. El espacio disponible depende del plan de hosting. Con archivos PDF bien optimizados (2-5 MB c/u), 10 GB alcanza para más de 2.000 documentos.

**¿Puedo ver cómo queda antes de publicar?**  
Actualmente no hay modo "preview" para entradas individuales. Para revisar, publícalo temporalmente y visita el sitio en una ventana de incógnito. Luego puedes despublicarlo si aún no está listo.

---

> Para reportar un problema o pedir una nueva funcionalidad, contacta al desarrollador con una descripción del problema y capturas de pantalla si es posible.
