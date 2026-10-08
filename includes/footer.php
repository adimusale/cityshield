    <!-- Emergency SOS Modal -->
    <div id="sosModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-red-100 relative animate-in fade-in zoom-in duration-150">
            <button onclick="closeSosModal()" class="absolute top-4 right-4 p-2 text-slate-400 hover:text-slate-600 rounded-full hover:bg-slate-100">
                <i data-lucide="x" class="w-5 h-5"></i>
            </button>

            <div class="flex items-center gap-3 text-red-600 mb-4">
                <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                    <i data-lucide="phone-call" class="w-6 h-6"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Emergency & Helplines</h3>
                    <p class="text-xs text-slate-500">Official 24/7 emergency numbers for Delhi NCR</p>
                </div>
            </div>

            <p class="text-sm text-slate-600 mb-5">
                If you are feeling unsafe, being harassed by an aggressive driver/tout, or facing online cyber fraud, call these immediate toll-free numbers:
            </p>

            <div class="space-y-3">
                <a href="tel:112" class="flex items-center justify-between p-3.5 rounded-xl bg-red-50 hover:bg-red-100 border border-red-200 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-red-600 text-white flex items-center justify-center font-bold text-sm">
                            112
                        </div>
                        <div>
                            <div class="font-bold text-sm text-slate-900 group-hover:text-red-700">Police / Unified Emergency</div>
                            <div class="text-xs text-slate-500">PCR van arrives in 5-10 minutes</div>
                        </div>
                    </div>
                    <span class="text-xs font-semibold bg-red-600 text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                        <i data-lucide="phone" class="w-3 h-3"></i> Call 112
                    </span>
                </a>

                <a href="tel:1091" class="flex items-center justify-between p-3.5 rounded-xl bg-purple-50 hover:bg-purple-100 border border-purple-200 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-purple-600 text-white flex items-center justify-center font-bold text-sm">
                            1091
                        </div>
                        <div>
                            <div class="font-bold text-sm text-slate-900 group-hover:text-purple-700">Women Safety Helpline</div>
                            <div class="text-xs text-slate-500">24/7 dedicated Delhi Police women cell</div>
                        </div>
                    </div>
                    <span class="text-xs font-semibold bg-purple-600 text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                        <i data-lucide="phone" class="w-3 h-3"></i> Call 1091
                    </span>
                </a>

                <a href="tel:1930" class="flex items-center justify-between p-3.5 rounded-xl bg-amber-50 hover:bg-amber-100 border border-amber-200 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-amber-600 text-white flex items-center justify-center font-bold text-sm">
                            1930
                        </div>
                        <div>
                            <div class="font-bold text-sm text-slate-900 group-hover:text-amber-700">Cyber Crime Financial Fraud</div>
                            <div class="text-xs text-slate-500">Report UPI / deposit scams to freeze funds</div>
                        </div>
                    </div>
                    <span class="text-xs font-semibold bg-amber-600 text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                        <i data-lucide="phone" class="w-3 h-3"></i> Call 1930
                    </span>
                </a>

                <a href="tel:155370" class="flex items-center justify-between p-3.5 rounded-xl bg-blue-50 hover:bg-blue-100 border border-blue-200 transition-colors group">
                    <div class="flex items-center gap-3">
                        <div class="w-9 h-9 rounded-lg bg-blue-600 text-white flex items-center justify-center font-bold text-sm">
                            DMRC
                        </div>
                        <div>
                            <div class="font-bold text-sm text-slate-900 group-hover:text-blue-700">Delhi Metro Rail Helpline</div>
                            <div class="text-xs text-slate-500">Station assistance, lost items, security (155370)</div>
                        </div>
                    </div>
                    <span class="text-xs font-semibold bg-blue-600 text-white px-3 py-1.5 rounded-lg flex items-center gap-1">
                        <i data-lucide="phone" class="w-3 h-3"></i> Call DMRC
                    </span>
                </a>
            </div>

            <div class="mt-5 text-center">
                <button onclick="closeSosModal()" class="w-full py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-sm transition-colors">
                    Close Helplines
                </button>
            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="bg-slate-900 text-slate-300 mt-auto border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Col 1: About & Mission -->
                <div class="md:col-span-1 space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-600 flex items-center justify-center text-white font-bold">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-xl text-white">City<span class="text-blue-400">Shield</span></span>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Dedicated to protecting students, interns, and newcomers arriving in Delhi NCR from broker fraud, transit scams, and misleading rentals.
                    </p>
                    <div class="pt-2">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-medium bg-slate-800 text-emerald-400 border border-slate-700">
                            <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span> Open Pilot Project
                        </span>
                    </div>
                </div>

                <!-- Col 2: The Newcomer Journey -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Newcomer Roadmap</h4>
                    <ul class="space-y-2 text-sm">
                        <li><a href="travel.php" class="hover:text-blue-400 transition-colors flex items-center gap-1.5"><i data-lucide="navigation" class="w-3.5 h-3.5 text-blue-400"></i> 1. Travel & Station Guide</a></li>
                        <li><a href="stays.php" class="hover:text-emerald-400 transition-colors flex items-center gap-1.5"><i data-lucide="home" class="w-3.5 h-3.5 text-emerald-400"></i> 2. Room & PG Navigator</a></li>
                        <li><a href="food.php" class="hover:text-amber-400 transition-colors flex items-center gap-1.5"><i data-lucide="utensils" class="w-3.5 h-3.5 text-amber-400"></i> 3. Food, Mess & Water</a></li>
                        <li><a href="scam-shield.php" class="hover:text-red-400 transition-colors flex items-center gap-1.5"><i data-lucide="alert-triangle" class="w-3.5 h-3.5 text-red-400"></i> 4. Anti-Scam Shield</a></li>
                    </ul>
                </div>

                <!-- Col 3: Safe Travel Rules -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">3 Golden Rules</h4>
                    <ul class="space-y-2.5 text-xs text-slate-400">
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                            <span><strong>No Cash Before Visit:</strong> Never pay visiting fees or digital gate pass tokens.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                            <span><strong>Ajmeri Gate Exit:</strong> At New Delhi Station, always exit via Platform 16 skywalk to Metro.</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-400 shrink-0 mt-0.5"></i>
                            <span><strong>Written Agreement:</strong> Fix electricity rate per unit on paper before paying security deposit.</span>
                        </li>
                    </ul>
                </div>

                <!-- Col 4: Rapid Assistance -->
                <div>
                    <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-3">Instant Help</h4>
                    <div class="space-y-2 text-xs">
                        <div class="p-2.5 rounded-lg bg-slate-800 border border-slate-700">
                            <div class="text-slate-400">Police Emergency:</div>
                            <div class="font-bold text-white text-base">Dial 112</div>
                        </div>
                        <div class="p-2.5 rounded-lg bg-slate-800 border border-slate-700">
                            <div class="text-slate-400">Cyber Crime Helpline:</div>
                            <div class="font-bold text-amber-400 text-base">Dial 1930</div>
                        </div>
                        <a href="scam-shield.php#report" class="inline-block w-full text-center py-2 px-3 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-semibold text-xs transition-colors">
                            Report a Fraud Broker / Scam
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-slate-800 flex flex-col sm:flex-row items-center justify-between text-xs text-slate-500 gap-4">
                <p>&copy; <?= date('Y') ?> CityShield. Built for newcomer safety & empowerment in Delhi NCR.</p>
                <div class="flex items-center gap-4">
                    <a href="scam-shield.php" class="hover:text-slate-400">Scam Directory</a>
                    <a href="travel.php" class="hover:text-slate-400">Transit Benchmarks</a>
                    <a href="stays.php" class="hover:text-slate-400">Verified PGs</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Scripts -->
    <script src="assets/js/main.js"></script>
    <script>
        // Render lucide icons
        lucide.createIcons();
    </script>
</body>
</html>
