#!/usr/bin/env bash
set -euo pipefail

ROOT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
THEME_SLUG="growmodo-assessment"
DIST_DIR="$ROOT_DIR/dist"
PACKAGE="$DIST_DIR/growmodo-aws-eb-wordpress.zip"
WORK_DIR="$(mktemp -d)"

cleanup() {
  rm -rf "$WORK_DIR"
}
trap cleanup EXIT

mkdir -p "$DIST_DIR" "$WORK_DIR/$THEME_SLUG"

cp "$ROOT_DIR/aws/elastic-beanstalk/Dockerfile" "$WORK_DIR/Dockerfile"
cp "$ROOT_DIR/aws/elastic-beanstalk/docker-compose.yml" "$WORK_DIR/docker-compose.yml"

rsync -a \
  --exclude='.git' \
  --exclude='.github' \
  --exclude='.DS_Store' \
  --exclude='dist' \
  --exclude='bin' \
  --exclude='aws' \
  --exclude='docker-compose.yml' \
  --exclude='README.md' \
  --exclude='SUBMISSION.md' \
  --exclude='DEPLOYMENT.md' \
  --exclude='AWS_DEPLOYMENT.md' \
  --exclude='FIGMA_MATCH_CHECKLIST.md' \
  "$ROOT_DIR/" "$WORK_DIR/$THEME_SLUG/"

rm -f "$PACKAGE"
(cd "$WORK_DIR" && zip -r "$PACKAGE" Dockerfile docker-compose.yml "$THEME_SLUG" >/dev/null)
unzip -t "$PACKAGE" >/dev/null

echo "Built $PACKAGE"
