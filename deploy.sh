#!/bin/bash
set -e

git fetch origin
git reset --hard origin/main
git clean -fd


npm run build
mv public/build/.vite/manifest.json public/build/manifest.json
rm -rf public/build/.vite

composer dump-autoload

php artisan optimize:clear

echo "Deploy hotový"
