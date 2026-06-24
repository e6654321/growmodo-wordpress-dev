#!/usr/bin/env bash
set -euo pipefail

DC="${DC:-docker compose}"
URL="${WP_URL:-http://localhost:8080}"
TITLE="${WP_TITLE:-Estatein Local}"
ADMIN_USER="${WP_ADMIN_USER:-admin}"
ADMIN_PASSWORD="${WP_ADMIN_PASSWORD:-password}"
ADMIN_EMAIL="${WP_ADMIN_EMAIL:-admin@example.com}"

run_wp() {
  $DC run --rm wpcli "$@"
}

echo "Starting WordPress and MySQL containers..."
$DC up -d db wordpress

echo "Waiting for WordPress files to be available..."
for i in {1..30}; do
  if run_wp core is-installed >/dev/null 2>&1; then
    break
  fi

  if run_wp core version >/dev/null 2>&1; then
    break
  fi

  sleep 3
done

if ! run_wp core is-installed >/dev/null 2>&1; then
  echo "Installing WordPress..."
  run_wp core install \
    --url="$URL" \
    --title="$TITLE" \
    --admin_user="$ADMIN_USER" \
    --admin_password="$ADMIN_PASSWORD" \
    --admin_email="$ADMIN_EMAIL" \
    --skip-email
else
  echo "WordPress is already installed."
fi

echo "Activating Growmodo Assessment Theme..."
run_wp theme activate growmodo-assessment

echo "Creating required pages..."
create_page() {
  local title="$1"
  local slug="$2"
  local template="${3:-}"
  local content="${4:-}"
  local page_id

  page_id="$(run_wp post list --post_type=page --name="$slug" --field=ID | tr -d '\r')"
  if [[ -z "$page_id" ]]; then
    page_id="$(run_wp post create --post_type=page --post_status=publish --post_title="$title" --post_name="$slug" --post_content="$content" --porcelain | tr -d '\r')"
  fi

  if [[ -n "$template" ]]; then
    run_wp post meta update "$page_id" _wp_page_template "$template" >/dev/null
  fi

  printf '%s' "$page_id"
}

HOME_ID="$(create_page "Home" "home" "" "Estatein homepage powered by the custom Growmodo assessment theme.")"
ABOUT_ID="$(create_page "About Us" "about-us" "page-templates/about-us.php")"
PROPERTIES_ID="$(create_page "Properties" "properties" "page-templates/properties.php")"
SERVICES_ID="$(create_page "Services" "services" "page-templates/services.php")"
CONTACT_ID="$(create_page "Contact" "contact" "page-templates/contact.php")"

run_wp option update show_on_front page >/dev/null
run_wp option update page_on_front "$HOME_ID" >/dev/null

echo "Creating navigation menu..."
MENU_ID="$(run_wp menu list --fields=term_id,name --format=csv | awk -F, 'NR > 1 {gsub(/"/, "", $2); if ($2 == "Primary Menu") {print $1; exit}}')"
if [[ -z "$MENU_ID" ]]; then
  run_wp menu create "Primary Menu" >/dev/null
  MENU_ID="$(run_wp menu list --fields=term_id,name --format=csv | awk -F, 'NR > 1 {gsub(/"/, "", $2); if ($2 == "Primary Menu") {print $1; exit}}')"
fi

for page_id in "$HOME_ID" "$ABOUT_ID" "$PROPERTIES_ID" "$SERVICES_ID" "$CONTACT_ID"; do
  if ! run_wp menu item list "$MENU_ID" --fields=object_id --format=csv | tail -n +2 | grep -qx "$page_id"; then
    run_wp menu item add-post "$MENU_ID" "$page_id" >/dev/null
  fi
done
run_wp menu location assign "$MENU_ID" primary >/dev/null
run_wp menu location assign "$MENU_ID" footer >/dev/null

echo "Creating sample properties..."
create_property() {
  local title="$1"
  local slug="$2"
  local price="$3"
  local bedrooms="$4"
  local bathrooms="$5"
  local property_type="$6"
  local excerpt="$7"
  local image="${8:-}"
  local post_id

  post_id="$(run_wp post list --post_type=property --name="$slug" --field=ID | tr -d '\r')"
  if [[ -z "$post_id" ]]; then
    post_id="$(run_wp post create \
      --post_type=property \
      --post_status=publish \
      --post_title="$title" \
      --post_name="$slug" \
      --post_excerpt="$excerpt" \
      --post_content="$excerpt" \
      --porcelain | tr -d '\r')"
  fi

  run_wp post meta update "$post_id" price "$price" >/dev/null
  run_wp post meta update "$post_id" bedrooms "$bedrooms" >/dev/null
  run_wp post meta update "$post_id" bathrooms "$bathrooms" >/dev/null
  run_wp post meta update "$post_id" property_type "$property_type" >/dev/null

  if [[ -n "$image" ]]; then
    local thumbnail_id
    thumbnail_id="$(run_wp post meta get "$post_id" _thumbnail_id | tr -d '\r')"
    if [[ -z "$thumbnail_id" ]]; then
      thumbnail_id="$(run_wp media import "/var/www/html/wp-content/themes/growmodo-assessment/assets/images/$image" \
        --post_id="$post_id" \
        --featured_image \
        --porcelain | tr -d '\r')"
    fi

    if [[ -n "$thumbnail_id" ]]; then
      run_wp post meta update "$thumbnail_id" _wp_attachment_image_alt "$title" >/dev/null
    fi
  fi
}

create_property "Seaside Serenity Villa" "seaside-serenity-villa" '$1,250,000' "4-Bedroom" "3-Bathroom" "Villa" "A stunning villa in a peaceful coastal neighborhood with premium amenities." "estatein-card-seaside.png"
create_property "Metropolitan Haven" "metropolitan-haven" '$650,000' "2-Bedroom" "2-Bathroom" "Apartment" "A chic apartment with panoramic city views and refined finishes." "estatein-card-metropolitan.png"
create_property "Rustic Retreat Cottage" "rustic-retreat-cottage" '$350,000' "3-Bedroom" "2-Bathroom" "Cottage" "A warm countryside cottage designed for comfort, privacy, and weekend escapes." "estatein-card-rustic.png"

echo "Creating sample services..."
create_service() {
  local title="$1"
  local slug="$2"
  local excerpt="$3"
  if ! run_wp post list --post_type=service --name="$slug" --field=ID | grep -q '[0-9]'; then
    run_wp post create \
      --post_type=service \
      --post_status=publish \
      --post_title="$title" \
      --post_name="$slug" \
      --post_excerpt="$excerpt" \
      --post_content="$excerpt" >/dev/null
  fi
}

create_service "Find Your Dream Home" "find-your-dream-home" "Personalized search support and curated property shortlists."
create_service "Unlock Property Value" "unlock-property-value" "Strategic selling support for pricing, positioning, and presentation."
create_service "Smart Investment Guidance" "smart-investment-guidance" "Market-aware recommendations for confident property decisions."

run_wp rewrite structure '/%postname%/' >/dev/null
run_wp rewrite flush --hard >/dev/null

echo "Local WordPress is ready:"
echo "  Site:  $URL"
echo "  Admin: $URL/wp-admin"
echo "  Login: $ADMIN_USER / $ADMIN_PASSWORD"
