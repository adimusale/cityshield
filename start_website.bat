@echo off
title Starting CityShield Local Server...
echo ========================================================
echo   Starting CityShield Newcomer Survival & Anti-Fraud Kit
echo   URL: http://localhost:8000
echo ========================================================

rem Open Chrome or default browser to the localhost URL
start "" "http://localhost:8000"

rem Check if XAMPP PHP exists
if exist "C:\xampp\php\php.exe" (
    echo Starting PHP Built-in Server with XAMPP PHP...
    "C:\xampp\php\php.exe" -S localhost:8000
) else (
    echo Starting PHP with system PATH...
    php -S localhost:8000
)

pause
