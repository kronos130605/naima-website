#!/usr/bin/env bash
set -euo pipefail

SITE_NAME="${1:-frenchboost}"
PORT="${2:-8081}"
PROJECT_ROOT="${3:-$(pwd)}"
TEMPLATE_PATH="${4:-$PROJECT_ROOT/deploy/nginx/frenchboost.local.8081.conf.template}"
PHP_FPM_SOCK="${5:-/run/php/php8.3-fpm.sock}"

if [[ ! -f "$TEMPLATE_PATH" ]]; then
  echo "Template not found: $TEMPLATE_PATH" >&2
  exit 1
fi

if [[ ! -d "/etc/nginx/sites-available" ]] || [[ ! -d "/etc/nginx/sites-enabled" ]]; then
  echo "Nginx sites-available/sites-enabled not found under /etc/nginx. Is this an Ubuntu/Debian layout?" >&2
  exit 1
fi

TARGET_AVAILABLE="/etc/nginx/sites-available/${SITE_NAME}.conf"
TARGET_ENABLED="/etc/nginx/sites-enabled/${SITE_NAME}.conf"

TMP_FILE="$(mktemp)"
trap 'rm -f "$TMP_FILE"' EXIT

sed \
  -e "s|__PROJECT_ROOT__|${PROJECT_ROOT}|g" \
  -e "s|listen 8081;|listen ${PORT};|g" \
  -e "s|listen \[::\]:8081;|listen [::]:${PORT};|g" \
  -e "s|fastcgi_pass unix:/run/php/php8.3-fpm.sock;|fastcgi_pass unix:${PHP_FPM_SOCK};|g" \
  "$TEMPLATE_PATH" > "$TMP_FILE"

sudo cp "$TMP_FILE" "$TARGET_AVAILABLE"

if [[ -L "$TARGET_ENABLED" ]] || [[ -f "$TARGET_ENABLED" ]]; then
  sudo rm -f "$TARGET_ENABLED"
fi
sudo ln -s "$TARGET_AVAILABLE" "$TARGET_ENABLED"

sudo nginx -t
sudo systemctl reload nginx || sudo service nginx reload

MANIFEST_SRC="${PROJECT_ROOT}/public/build/.vite/manifest.json"
MANIFEST_DEST_DIR="${PROJECT_ROOT}/public/build"
MANIFEST_DEST="${MANIFEST_DEST_DIR}/manifest.json"

if [[ ! -f "$MANIFEST_SRC" ]]; then
  echo "Vite manifest not found: $MANIFEST_SRC" >&2
  echo "Run 'npm run build' first to generate it." >&2
  exit 1
fi

mkdir -p "$MANIFEST_DEST_DIR"
cp "$MANIFEST_SRC" "$MANIFEST_DEST"

echo "Installed Nginx site: $SITE_NAME"
echo "- Available: $TARGET_AVAILABLE"
echo "- Enabled:   $TARGET_ENABLED"
echo "- URL:       http://localhost:${PORT}"
