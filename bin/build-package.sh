#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_SLUG="growmodo-assessment"
DIST_DIR="$ROOT_DIR/dist"
PACKAGE="$DIST_DIR/growmodo-assessment-theme.zip"
WORK_DIR="$(mktemp -d)"

cleanup() {
  rm -rf "$WORK_DIR"
}
trap cleanup EXIT

mkdir -p "$DIST_DIR" "$WORK_DIR/$THEME_SLUG"

rsync -a \
  --exclude='.git' \
  --exclude='.github' \
  --exclude='.DS_Store' \
  --exclude='aws' \
  --exclude='dist' \
  --exclude='bin' \
  --exclude='docker-compose.yml' \
  --exclude='README.md' \
  --exclude='SUBMISSION.md' \
  --exclude='DEPLOYMENT.md' \
  --exclude='AWS_DEPLOYMENT.md' \
  --exclude='FIGMA_MATCH_CHECKLIST.md' \
  "$ROOT_DIR/" "$WORK_DIR/$THEME_SLUG/"

rm -f "$PACKAGE"

(cd "$WORK_DIR" && zip -r "$PACKAGE" "$THEME_SLUG" >/dev/null)

unzip -t "$PACKAGE" >/dev/null

echo "Built $PACKAGE"
