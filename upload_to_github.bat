@echo off
title Push Updates to GitHub
echo ========================================================
echo        CityShield - Push Updates to GitHub
echo        Repo: https://github.com/adimusale/cityshield.git
echo ========================================================
echo.

echo [1/3] Adding changes...
git add .

echo.
set /p COMMIT_MSG="Enter commit message (e.g. Update features) or press Enter: "
if "%COMMIT_MSG%"=="" set COMMIT_MSG=Update CityShield project files

echo [2/3] Committing changes...
git commit -m "%COMMIT_MSG%"

echo [3/3] Pushing to GitHub (main)...
git push origin main

echo.
echo ========================================================
echo  Done! Your updates are now live on GitHub.
echo ========================================================
pause
