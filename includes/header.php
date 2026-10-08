<?php
if (!defined('PAGE_TITLE')) {
    define('PAGE_TITLE', 'CityShield - The Honest Newcomer Survival Guide');
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars(PAGE_TITLE) ?> | Delhi NCR Pilot</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        shield: {
                            red: '#ef4444',
                            amber: '#f59e0b',
                            green: '#10b981',
                        }
                    }
                }
            }
        }
    </script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-slate-50 text-slate-800 flex flex-col min-h-screen font-sans antialiased">

    <!-- Top Alert Notification Bar -->
    <div class="bg-gradient-to-r from-red-600 via-amber-600 to-red-600 text-white text-xs sm:text-sm py-2 px-4 text-center font-medium shadow-sm flex items-center justify-center gap-2">
        <i data-lucide="shield-alert" class="w-4 h-4 shrink-0 animate-pulse"></i>
        <span><strong>NEWCOMER SCAM RADAR:</strong> Never pay ₹1,000–₹2,000 for a "Visiting Pass" or "Gate Entry Pass" on OLX/Instagram before physically seeing the PG room!</span>
        <a href="scam-shield.php" class="underline font-bold hover:text-amber-200 ml-1">Learn More &rarr;</a>
    </div>

    <!-- Main Navigation Bar -->
    <header class="bg-white border-b border-slate-200 sticky top-0 z-50 shadow-sm backdrop-blur-md bg-white/95">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Brand / Logo -->
                <div class="flex items-center gap-3">
                    <a href="index.php" class="flex items-center gap-2 group">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-blue-600 to-indigo-700 flex items-center justify-center text-white shadow-md shadow-blue-500/20 group-hover:scale-105 transition-transform">
                            <i data-lucide="shield-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-extrabold text-xl tracking-tight text-slate-900">City<span class="text-blue-600">Shield</span></span>
                                <span class="text-[10px] font-bold uppercase tracking-wider bg-blue-100 text-blue-700 px-2 py-0.5 rounded-full border border-blue-200">Delhi NCR Pilot</span>
                            </div>
                            <p class="text-[11px] text-slate-500 font-medium">Newcomer Survival & Anti-Fraud Kit</p>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links (Chronological Journey) -->
                <nav class="hidden md:flex items-center gap-1 font-medium text-sm text-slate-600">
                    <a href="index.php" class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-slate-50 transition-colors flex items-center gap-1.5 <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'text-blue-600 bg-blue-50 font-semibold' : '' ?>">
                        <i data-lucide="compass" class="w-4 h-4"></i> Overview
                    </a>
                    <a href="travel.php" class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-slate-50 transition-colors flex items-center gap-1.5 <?= basename($_SERVER['PHP_SELF']) == 'travel.php' ? 'text-blue-600 bg-blue-50 font-semibold' : '' ?>">
                        <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 text-xs flex items-center justify-center font-bold">1</span>
                        <span>Travel & Arrival</span>
                    </a>
                    <a href="stays.php" class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-slate-50 transition-colors flex items-center gap-1.5 <?= basename($_SERVER['PHP_SELF']) == 'stays.php' ? 'text-blue-600 bg-blue-50 font-semibold' : '' ?>">
                        <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold">2</span>
                        <span>Room & PG</span>
                    </a>
                    <a href="food.php" class="px-3 py-2 rounded-lg hover:text-blue-600 hover:bg-slate-50 transition-colors flex items-center gap-1.5 <?= basename($_SERVER['PHP_SELF']) == 'food.php' ? 'text-blue-600 bg-blue-50 font-semibold' : '' ?>">
                        <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 text-xs flex items-center justify-center font-bold">3</span>
                        <span>Food & Daily</span>
                    </a>
                    <a href="scam-shield.php" class="px-3 py-2 rounded-lg hover:text-red-600 hover:bg-red-50 transition-colors flex items-center gap-1.5 <?= basename($_SERVER['PHP_SELF']) == 'scam-shield.php' ? 'text-red-600 bg-red-50 font-semibold' : '' ?>">
                        <i data-lucide="shield-alert" class="w-4 h-4 text-red-600"></i>
                        <span>Scam Shield</span>
                    </a>
                </nav>

                <!-- SOS Emergency Action Button -->
                <div class="flex items-center gap-2">
                    <button onclick="openSosModal()" class="flex items-center gap-1.5 bg-red-600 hover:bg-red-700 text-white font-semibold text-xs sm:text-sm px-3.5 py-2 rounded-lg shadow-sm shadow-red-500/30 transition-all hover:scale-105 active:scale-95 animate-pulse">
                        <i data-lucide="phone-call" class="w-4 h-4"></i>
                        <span>SOS Helplines</span>
                    </button>

                    <!-- Mobile Menu Button -->
                    <button id="mobileMenuBtn" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 focus:outline-none">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu Dropdown -->
        <div id="mobileMenu" class="hidden md:hidden border-t border-slate-200 bg-white px-4 pt-2 pb-4 space-y-1">
            <a href="index.php" class="block px-3 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium text-sm flex items-center gap-2">
                <i data-lucide="compass" class="w-4 h-4"></i> Roadmap Overview
            </a>
            <a href="travel.php" class="block px-3 py-2.5 rounded-lg text-slate-700 hover:bg-blue-50 hover:text-blue-600 font-medium text-sm flex items-center gap-2">
                <span class="w-5 h-5 rounded-full bg-blue-100 text-blue-700 text-xs flex items-center justify-center font-bold">1</span>
                Step 1: Travel & Arrival (Stations, Metro & Fare)
            </a>
            <a href="stays.php" class="block px-3 py-2.5 rounded-lg text-slate-700 hover:bg-emerald-50 hover:text-emerald-600 font-medium text-sm flex items-center gap-2">
                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold">2</span>
                Step 2: Room & PG (Safe deposits & Rent guides)
            </a>
            <a href="food.php" class="block px-3 py-2.5 rounded-lg text-slate-700 hover:bg-amber-50 hover:text-amber-600 font-medium text-sm flex items-center gap-2">
                <span class="w-5 h-5 rounded-full bg-amber-100 text-amber-700 text-xs flex items-center justify-center font-bold">3</span>
                Step 3: Food & Essentials (Tiffin, Mess, Water & Laundry)
            </a>
            <a href="scam-shield.php" class="block px-3 py-2.5 rounded-lg text-red-600 bg-red-50 font-medium text-sm flex items-center gap-2">
                <i data-lucide="shield-alert" class="w-4 h-4"></i>
                Scam Shield & Community Fraud Radar
            </a>
        </div>
    </header>
