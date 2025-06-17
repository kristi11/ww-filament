# Production Optimization Script for Laravel
# This script enables caching optimizations for Laravel in production

Write-Host "Starting production optimization..." -ForegroundColor Green

# Clear any existing caches first
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Enable production caching optimizations
Write-Host "Enabling config cache..." -ForegroundColor Cyan
php artisan config:cache

Write-Host "Enabling route cache..." -ForegroundColor Cyan
php artisan route:cache

Write-Host "Enabling view cache..." -ForegroundColor Cyan
php artisan view:cache

Write-Host "Production optimization complete!" -ForegroundColor Green
Write-Host "Your application should now have improved performance." -ForegroundColor Green
