@echo off
title Upload CityShield to GitHub
echo ========================================================
echo        CityShield - Upload to GitHub Helper
echo ========================================================
echo.

rem Check git
where git >nul 2>nul
if %errorlevel% neq 0 (
    echo [ERROR] Git is not installed or not in PATH!
    echo Please install Git from https://git-scm.com/
    pause
    exit /b
)

echo [1/4] Initializing Git repository...
if not exist ".git" (
    git init
)

echo [2/4] Adding all project files...
git add .

echo [3/4] Creating initial commit...
git commit -m "Initial commit: CityShield Newcomer Survival & Anti-Fraud Kit"

echo.
set /p REPO_URL="Enter your GitHub Repository URL (e.g. https://github.com/username/cityshield.git): "

if "%REPO_URL%"=="" (
    echo [ERROR] Repository URL cannot be empty!
    pause
    exit /b
)

echo [4/4] Setting main branch and pushing to GitHub...
git branch -M main
git remote remove origin 2>nul
git remote add origin %REPO_URL%
git push -u origin main

echo.
echo ========================================================
echo  Done! Your project is now live on GitHub.
echo ========================================================
pause
