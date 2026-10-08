<?php
require_once __DIR__ . '/config/db.php';
define('PAGE_TITLE', 'CityShield - Delhi NCR Newcomer Survival & Anti-Fraud Kit');

$pdo = getDBConnection();

// Fetch sample data for homepage preview
$scams = $pdo->query("SELECT * FROM scam_alerts ORDER BY id ASC LIMIT 3")->fetchAll();
$routes = $pdo->query("SELECT * FROM transit_routes WHERE is_recommended = 1 LIMIT 3")->fetchAll();
$neighborhoods = $pdo->query("SELECT * FROM neighborhoods ORDER BY safety_rating DESC LIMIT 3")->fetchAll();
$reportsCount = $pdo->query("SELECT COUNT(*) FROM community_reports")->fetchColumn();

require_once __DIR__ . '/includes/header.php';
?>

<main class="flex-grow">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-b from-blue-900 via-indigo-900 to-slate-900 text-white py-16 sm:py-24 overflow-hidden">
        <!-- Background Grid Pattern -->
        <div class="absolute inset-0 opacity-10 bg-[radial-gradient(#fff_1px,transparent_1px)] [background-size:16px_16px]"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-blue-500/20 border border-blue-400/30 text-blue-200 text-xs font-semibold uppercase tracking-wider mb-6">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Verified Pilot City: Delhi NCR</span>
                </div>
                
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black tracking-tight leading-tight">
                    Arrived in Delhi NCR?<br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 via-sky-300 to-emerald-400">
                        Zero Scams. Zero Confusion.
                    </span>
                </h1>
                
                <p class="mt-5 text-base sm:text-lg text-slate-300 leading-relaxed font-normal">
                    The newcomer roadmap designed specifically for students, job seekers, and interns: 
                    From railway station transit without auto touts, to scam-free PG deposits, and clean daily food.
                </p>

                <!-- Quick Action Buttons -->
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="travel.php" class="px-6 py-3.5 rounded-xl bg-blue-600 hover:bg-blue-500 text-white font-bold text-sm shadow-lg shadow-blue-500/30 flex items-center gap-2 transition-transform hover:-translate-y-0.5">
                        <i data-lucide="navigation" class="w-4 h-4"></i>
                        <span>1. Just Landed? Route Guide</span>
                    </a>
                    <a href="stays.php" class="px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 border border-white/20 text-white font-bold text-sm backdrop-blur-sm flex items-center gap-2 transition-transform hover:-translate-y-0.5">
                        <i data-lucide="home" class="w-4 h-4"></i>
                        <span>2. Find Honest PG / Rooms</span>
                    </a>
                    <a href="scam-shield.php" class="px-6 py-3.5 rounded-xl bg-red-600/90 hover:bg-red-600 text-white font-bold text-sm shadow-lg shadow-red-600/30 flex items-center gap-2 transition-transform hover:-translate-y-0.5">
                        <i data-lucide="shield-alert" class="w-4 h-4"></i>
                        <span>Check Scam Radar</span>
                    </a>
                </div>
            </div>

            <!-- Quick Stat Banner -->
            <div class="mt-12 grid grid-cols-2 sm:grid-cols-4 gap-4 border-t border-slate-700/60 pt-8 text-center sm:text-left">
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-blue-400">₹30</div>
                    <div class="text-xs text-slate-400 mt-1">Official Delhi Auto Base Fare</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400">₹0</div>
                    <div class="text-xs text-slate-400 mt-1">Visit Pass Fee (Don't pay OLX touts!)</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-sky-400">19 mins</div>
                    <div class="text-xs text-slate-400 mt-1">Airport T3 to City via Metro (₹60)</div>
                </div>
                <div>
                    <div class="text-2xl sm:text-3xl font-extrabold text-red-400">112 / 1930</div>
                    <div class="text-xs text-slate-400 mt-1">24/7 Police & Cybercrime SOS</div>
                </div>
            </div>
        </div>
    </section>

    <!-- The 4-Step Newcomer Chronological Roadmap -->
    <section class="py-16 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-blue-600 bg-blue-50 px-3 py-1 rounded-full border border-blue-200">Survival Playbook</span>
                <h2 class="text-3xl font-black text-slate-900 mt-3">The Newcomer 4-Step Journey</h2>
                <p class="text-slate-600 text-sm mt-2">Follow these steps in chronological order to protect your wallet and peace of mind.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                <!-- Step 1 -->
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 relative transition-card flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-blue-100 text-blue-700 flex items-center justify-center font-black text-lg mb-4">
                            1
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Travel & Arrival</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Exit railway stations safely via Ajmeri Gate. Never board unmetered autos. Use Delhi Metro Airport Express & Yellow Line.
                        </p>
                        <ul class="text-xs text-slate-500 space-y-1.5 mb-4">
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-blue-600"></i> Station exit skywalk guides</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-blue-600"></i> Auto fare benchmark calculator</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-blue-600"></i> WhatsApp Metro QR ticket</li>
                        </ul>
                    </div>
                    <a href="travel.php" class="mt-4 text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        Explore Transit Guides &rarr;
                    </a>
                </div>

                <!-- Step 2 -->
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 relative transition-card flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center font-black text-lg mb-4">
                            2
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Room & PG Finder</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Explore North Campus, Mukherjee Nagar, Laxmi Nagar & Noida. Verify electricity unit rates before paying 1-month deposit.
                        </p>
                        <ul class="text-xs text-slate-500 space-y-1.5 mb-4">
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i> Zero-scam inspection checklist</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i> Neighborhood rent benchmarks</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i> Verified PG & Hostel directory</li>
                        </ul>
                    </div>
                    <a href="stays.php" class="mt-4 text-xs font-bold text-emerald-600 hover:text-emerald-800 flex items-center gap-1">
                        Search Safe Rooms &rarr;
                    </a>
                </div>

                <!-- Step 3 -->
                <div class="bg-slate-50 border border-slate-200 rounded-2xl p-6 relative transition-card flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center font-black text-lg mb-4">
                            3
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2">Food & Daily Living</h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Find clean student tiffin services, pure RO 20L water bottle suppliers, laundromats, and 24/7 pharmacies.
                        </p>
                        <ul class="text-xs text-slate-500 space-y-1.5 mb-4">
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-amber-600"></i> Monthly tiffin price checks</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-amber-600"></i> 20L RO water price standard (₹35)</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-amber-600"></i> Laundry & grocery hubs</li>
                        </ul>
                    </div>
                    <a href="food.php" class="mt-4 text-xs font-bold text-amber-600 hover:text-amber-800 flex items-center gap-1">
                        Find Food & Essentials &rarr;
                    </a>
                </div>

                <!-- Step 4 -->
                <div class="bg-slate-50 border border-red-200 rounded-2xl p-6 relative transition-card flex flex-col justify-between shadow-sm shadow-red-100">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-red-100 text-red-700 flex items-center justify-center font-black text-lg mb-4">
                            4
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-2 flex items-center gap-1.5">
                            <span>Scam Shield</span>
                            <span class="text-[10px] font-bold bg-red-100 text-red-700 px-1.5 py-0.5 rounded">Vital</span>
                        </h3>
                        <p class="text-xs text-slate-600 leading-relaxed mb-4">
                            Interactive diagnostic tool: Are you currently talking to a scammer? Learn the exact modus operandi of city fraudsters.
                        </p>
                        <ul class="text-xs text-slate-500 space-y-1.5 mb-4">
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-red-600"></i> "Am I being scammed?" quiz</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-red-600"></i> Broker scam blacklist</li>
                            <li class="flex items-center gap-1.5"><i data-lucide="check" class="w-3.5 h-3.5 text-red-600"></i> Instant 112 / 1930 helplines</li>
                        </ul>
                    </div>
                    <a href="scam-shield.php" class="mt-4 text-xs font-bold text-red-600 hover:text-red-800 flex items-center gap-1">
                        Open Scam Shield &rarr;
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Interactive Tools Highlight Section -->
    <section class="py-16 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-start">
                
                <!-- Tool 1: Interactive Scam Detector Wizard -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                            <i data-lucide="shield-alert" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">"Am I Being Scammed?" Checker</h3>
                            <p class="text-xs text-slate-500">Pick a situation you just encountered to get an instant safety verdict</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">What happened with you?</label>
                            <select id="scamScenarioSelect" class="w-full p-3 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none bg-slate-50">
                                <option value="">-- Choose a suspicious scenario --</option>
                                <option value="gate_pass">A broker/owner asked for ₹1,500 "Visiting Pass" before showing PG room</option>
                                <option value="station_hotel">Auto driver/tout at railway station says "Your hotel is closed/sealed"</option>
                                <option value="auto_nometer">Auto driver refused meter and asked ₹400 for a 4-5 km ride</option>
                                <option value="electricity_trap">PG owner mentions electricity "as per sub-meter" without fixed unit rate</option>
                                <option value="no_agreement">Landlord says "No need for written agreement, just trust me verbally"</option>
                                <option value="telegram_job">Got WhatsApp message for part-time "Hotel Review / YouTube like" job</option>
                            </select>
                        </div>

                        <button id="analyzeScamBtn" class="w-full py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-sm flex items-center justify-center gap-2 transition-colors">
                            <i data-lucide="search" class="w-4 h-4"></i>
                            <span>Analyze Situation Immediately</span>
                        </button>

                        <div id="scamAnalysisResult" class="hidden"></div>
                    </div>
                </div>

                <!-- Tool 2: Delhi Official Auto Fare Benchmark Tool -->
                <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i data-lucide="calculator" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Delhi Auto Fare Benchmark</h3>
                            <p class="text-xs text-slate-500">Never let auto drivers overcharge you at railway stations or metro exits</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Approximate Trip Distance (in Kilometers)</label>
                            <div class="relative">
                                <input type="number" id="autoDistanceInput" placeholder="e.g. 5" min="1" max="50" step="0.5" class="w-full p-3 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10 bg-slate-50">
                                <i data-lucide="map-pin" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="autoNightToggle" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                            <label for="autoNightToggle" class="text-xs font-medium text-slate-700">Night travel surcharge (11:00 PM – 5:00 AM, +25%)</label>
                        </div>

                        <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-between">
                            <div>
                                <span class="text-xs text-blue-700 font-semibold uppercase">Official Legal Meter Fare</span>
                                <div id="autoFareResult" class="text-3xl font-black text-blue-900 mt-0.5">₹--</div>
                            </div>
                            <button id="calcAutoFareBtn" class="px-4 py-2 rounded-lg bg-blue-600 text-white font-bold text-xs hover:bg-blue-700 transition-colors">
                                Calculate
                            </button>
                        </div>

                        <div id="autoBreakdownResult" class="text-xs text-slate-500 leading-relaxed">
                            Official Delhi Govt Rate: ₹30 base fare (first 1.5 km) + ₹11 per km thereafter.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Top Verified Neighborhoods Quick Preview -->
    <section class="py-16 bg-white border-t border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 bg-emerald-50 px-3 py-1 rounded-full border border-emerald-200">Housing Intelligence</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-2">Popular Newcomer Neighborhoods</h2>
                    <p class="text-slate-600 text-sm mt-1">Realistic rent expectations so brokers cannot inflate prices.</p>
                </div>
                <a href="stays.php" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                    View All Neighborhoods & PGs &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($neighborhoods as $n): ?>
                <div class="bg-slate-50 rounded-2xl p-6 border border-slate-200 transition-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-blue-100 text-blue-800 border border-blue-200"><?= htmlspecialchars($n['category']) ?></span>
                            <span class="text-xs font-semibold text-slate-500 flex items-center gap-1">
                                <i data-lucide="star" class="w-3.5 h-3.5 text-amber-500 fill-amber-500"></i> <?= $n['safety_rating'] ?> / 5.0
                            </span>
                        </div>
                        <h3 class="font-bold text-lg text-slate-900 mb-1"><?= htmlspecialchars($n['name']) ?></h3>
                        <p class="text-xs text-slate-600 mb-4"><?= htmlspecialchars($n['vibe_description']) ?></p>

                        <div class="space-y-1.5 p-3 rounded-xl bg-white border border-slate-200 text-xs mb-4">
                            <div class="flex justify-between">
                                <span class="text-slate-500">Single Room:</span>
                                <span class="font-bold text-slate-800"><?= htmlspecialchars($n['avg_rent_single']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-slate-500">Sharing PG:</span>
                                <span class="font-bold text-emerald-700"><?= htmlspecialchars($n['avg_rent_sharing']) ?></span>
                            </div>
                            <div class="flex justify-between border-t border-slate-100 pt-1.5 mt-1.5">
                                <span class="text-slate-500">Nearest Metro:</span>
                                <span class="font-semibold text-slate-700 truncate max-w-[150px]"><?= htmlspecialchars($n['nearest_metro']) ?></span>
                            </div>
                        </div>
                    </div>

                    <a href="stays.php?neighborhood=<?= $n['id'] ?>" class="text-xs font-bold text-blue-600 hover:text-blue-800 flex items-center gap-1">
                        Find PGs in this area &rarr;
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Top Scam Warnings Preview -->
    <section class="py-16 bg-red-50/50 border-t border-red-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-10 gap-4">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-red-600 bg-red-100 px-3 py-1 rounded-full border border-red-200">Scam Radar</span>
                    <h2 class="text-3xl font-black text-slate-900 mt-2">Active City Scams to Avoid</h2>
                    <p class="text-slate-600 text-sm mt-1">These trick 70% of newcomers within their first 7 days.</p>
                </div>
                <a href="scam-shield.php" class="text-xs font-bold text-red-600 hover:text-red-800 flex items-center gap-1">
                    View Complete Scam Radar (8+ alerts) &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($scams as $s): ?>
                <div class="bg-white rounded-2xl p-6 border border-red-200 shadow-sm transition-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded bg-red-600 text-white"><?= htmlspecialchars($s['severity']) ?></span>
                            <span class="text-xs text-slate-500 font-medium">Phase: <?= htmlspecialchars($s['phase_category']) ?></span>
                        </div>
                        <h4 class="font-bold text-base text-slate-900 mb-2"><?= htmlspecialchars($s['title']) ?></h4>
                        <p class="text-xs text-slate-600 leading-relaxed line-clamp-3 mb-4"><?= htmlspecialchars($s['modus_operandi']) ?></p>
                    </div>

                    <div class="pt-3 border-t border-slate-100">
                        <div class="text-[11px] font-semibold text-slate-900 mb-1">Defense Rule:</div>
                        <p class="text-xs text-red-700 bg-red-50 p-2.5 rounded-lg border border-red-100 line-clamp-2"><?= htmlspecialchars($s['protection_steps']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
