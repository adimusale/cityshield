@echo off
title Uploading CityShield to GitHub...
echo ========================================================
echo   Uploading CityShield to GitHub (Repository: cityshield)
echo ========================================================
echo.

git add .
git commit -m "Update CityShield code and features"
git branch -M main
echo Pushing to GitHub...
git push -u origin main

echo.
echo ========================================================
echo   Upload Complete!
echo   Repository: https://github.com/adimusale/cityshield
echo ========================================================
pause
