#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PACKAGE="${PACKAGE:-$ROOT_DIR/dist/growmodo-assessment-theme.zip}"
THEME_SLUG="${THEME_SLUG:-growmodo-assessment}"
SSH_PORT="${SSH_PORT:-22}"

require_var() {
  local name="$1"
  if [[ -z "${!name:-}" ]]; then
    echo "Missing required environment variable: $name" >&2
    exit 1
  fi
}

require_var DEPLOY_HOST
require_var DEPLOY_USER
require_var WP_ROOT

if [[ ! -f "$PACKAGE" ]]; then
  echo "Package not found: $PACKAGE" >&2
  echo "Run ./bin/build-package.sh first." >&2
  exit 1
fi

REMOTE_TMP="/tmp/${THEME_SLUG}-theme.zip"
REMOTE_THEME_DIR="$WP_ROOT/wp-content/themes/$THEME_SLUG"

echo "Deploying $PACKAGE"
echo "Target: $DEPLOY_USER@$DEPLOY_HOST:$WP_ROOT"
echo
read -r -p "Continue and overwrite $REMOTE_THEME_DIR? [y/N] " confirm
if [[ "$confirm" != "y" && "$confirm" != "Y" ]]; then
  echo "Deployment cancelled."
  exit 0
fi

scp -P "$SSH_PORT" "$PACKAGE" "$DEPLOY_USER@$DEPLOY_HOST:$REMOTE_TMP"

ssh -p "$SSH_PORT" "$DEPLOY_USER@$DEPLOY_HOST" bash -s -- "$REMOTE_TMP" "$WP_ROOT" "$THEME_SLUG" <<'REMOTE'
set -euo pipefail

remote_tmp="$1"
wp_root="$2"
theme_slug="$3"
theme_dir="$wp_root/wp-content/themes/$theme_slug"

test -d "$wp_root/wp-content/themes"
rm -rf "$theme_dir"
unzip -q "$remote_tmp" -d "$wp_root/wp-content/themes"
rm -f "$remote_tmp"
test -f "$theme_dir/style.css"

echo "Theme files deployed to $theme_dir"

if command -v wp >/dev/null 2>&1; then
  cd "$wp_root"
  wp theme activate "$theme_slug" --allow-root || wp theme activate "$theme_slug"
  wp rewrite flush --allow-root || wp rewrite flush
  echo "Theme activated and permalinks flushed with WP-CLI."
else
  echo "WP-CLI not found on server. Activate the theme in WordPress Admin."
fi
REMOTE

echo "Deployment complete. Verify the dev URL in a browser."
