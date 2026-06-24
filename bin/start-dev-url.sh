#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DC="${DC:-docker compose}"
LOCAL_URL="${LOCAL_URL:-http://localhost:8080}"
WP_ADMIN_USER="${WP_ADMIN_USER:-admin}"
NGROK_LOG="${NGROK_LOG:-/tmp/growmodo-ngrok.log}"
NGROK_PID_FILE="${NGROK_PID_FILE:-/tmp/growmodo-ngrok.pid}"

run_wp() {
  (cd "$ROOT_DIR" && $DC run --rm wpcli "$@")
}

echo "This will expose the local WordPress site at $LOCAL_URL to the public internet."
echo "Before creating the tunnel, this script will rotate the local WordPress admin password."
echo
read -r -p "Type EXPOSE to continue: " confirm
if [[ "$confirm" != "EXPOSE" ]]; then
  echo "Cancelled."
  exit 0
fi

if ! command -v ngrok >/dev/null 2>&1; then
  echo "ngrok is not installed or is not on PATH." >&2
  exit 1
fi

echo "Ensuring Docker WordPress is running..."
(cd "$ROOT_DIR" && $DC up -d db wordpress)

NEW_PASSWORD="$(LC_ALL=C tr -dc 'A-Za-z0-9_@%+=-' </dev/urandom | head -c 28)"
run_wp user update "$WP_ADMIN_USER" --user_pass="$NEW_PASSWORD" >/dev/null

echo "Starting ngrok tunnel..."
if [[ -f "$NGROK_PID_FILE" ]] && kill -0 "$(cat "$NGROK_PID_FILE")" >/dev/null 2>&1; then
  echo "Existing ngrok process detected: $(cat "$NGROK_PID_FILE")"
else
  nohup ngrok http 8080 --log=stdout > "$NGROK_LOG" 2>&1 &
  echo "$!" > "$NGROK_PID_FILE"
fi

PUBLIC_URL=""
for _ in {1..30}; do
  if PUBLIC_URL="$(curl -fsS http://127.0.0.1:4040/api/tunnels 2>/dev/null | sed -n 's/.*"public_url":"\([^"]*https:\/\/[^"]*\)".*/\1/p' | head -n 1)"; then
    if [[ -n "$PUBLIC_URL" ]]; then
      break
    fi
  fi
  sleep 1
done

if [[ -z "$PUBLIC_URL" ]]; then
  echo "Could not read ngrok public URL. Check $NGROK_LOG" >&2
  exit 1
fi

run_wp option update home "$PUBLIC_URL" >/dev/null
run_wp option update siteurl "$PUBLIC_URL" >/dev/null
run_wp rewrite flush --hard >/dev/null

cat <<EOF

Dev URL is live:
  $PUBLIC_URL

WordPress admin:
  $PUBLIC_URL/wp-admin
  User: $WP_ADMIN_USER
  Password: $NEW_PASSWORD

ngrok PID:
  $(cat "$NGROK_PID_FILE")

To restore local URLs and stop the tunnel:
  ./bin/stop-dev-url.sh

EOF
