#!/bin/bash
set -e

git pull

npm run build
mv public/build/.vite/manifest.json public/build/manifest.json
rm -rf public/build/.vite

php artisan optimize:clear

echo "Deploy hotový"
