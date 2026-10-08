<?php
require_once __DIR__ . '/config/db.php';
define('PAGE_TITLE', 'Step 1: Travel & Arrival Guide');

$pdo = getDBConnection();

// Fetch arrival points
$arrivalPoints = $pdo->query("SELECT * FROM arrival_points WHERE city_id = 1")->fetchAll();

// Selected arrival point filter
$selectedPointId = isset($_GET['point']) ? intval($_GET['point']) : 1;

// Fetch routes
$stmt = $pdo->prepare("SELECT * FROM transit_routes WHERE city_id = 1 AND (arrival_point_id = ? OR arrival_point_id IS NULL)");
$stmt->execute([$selectedPointId]);
$routes = $stmt->fetchAll();

// Fetch travel scams
$travelScams = $pdo->query("SELECT * FROM scam_alerts WHERE city_id = 1 AND phase_category = 'Travel'")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<main class="flex-grow py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb & Title -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                <a href="index.php" class="hover:text-blue-600">Home</a>
                <span>&rarr;</span>
                <span class="text-blue-600">Phase 1: Travel & Arrival</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Arrival & Transit Survival Guide
            </h1>
            <p class="text-slate-600 text-sm mt-1 max-w-2xl">
                How to get from the Railway Station, Airport, or Bus Terminal to your destination safely, without falling for rogue auto drivers or fake hotel touts.
            </p>
        </div>

        <!-- Station / Airport Tabs -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-8">
            <div class="text-xs font-bold uppercase tracking-wider text-slate-500 mb-3 flex items-center gap-2">
                <i data-lucide="map-pin" class="w-4 h-4 text-blue-600"></i> Select Your Arrival Point in Delhi:
            </div>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($arrivalPoints as $point): ?>
                    <a href="travel.php?point=<?= $point['id'] ?>" class="px-4 py-2.5 rounded-xl text-xs sm:text-sm font-bold transition-all flex items-center gap-2 <?= $selectedPointId == $point['id'] ? 'bg-blue-600 text-white shadow-md shadow-blue-500/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                        <i data-lucide="<?= $point['type'] == 'Airport' ? 'plane' : 'train' ?>" class="w-4 h-4"></i>
                        <span><?= htmlspecialchars($point['name']) ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Station Specific Safety Advisory Card -->
        <?php 
        $activePoint = null;
        foreach ($arrivalPoints as $p) {
            if ($p['id'] == $selectedPointId) {
                $activePoint = $p;
                break;
            }
        }
        if ($activePoint):
        ?>
        <div class="bg-gradient-to-br from-blue-900 to-indigo-950 text-white rounded-3xl p-6 sm:p-8 shadow-xl mb-10 relative overflow-hidden">
            <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
                <div class="md:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="px-3 py-1 rounded-full text-xs font-black uppercase bg-blue-500/30 text-blue-200 border border-blue-400/30">
                            <?= htmlspecialchars($activePoint['type']) ?> Guide
                        </span>
                        <h2 class="text-2xl font-bold text-white"><?= htmlspecialchars($activePoint['name']) ?></h2>
                    </div>

                    <div class="p-4 rounded-2xl bg-white/10 backdrop-blur-md border border-white/15 text-sm space-y-2">
                        <div class="flex items-start gap-2.5">
                            <i data-lucide="compass" class="w-5 h-5 text-emerald-400 shrink-0 mt-0.5"></i>
                            <div>
                                <strong class="text-emerald-300 block text-xs uppercase font-bold tracking-wider">Crucial Exit Gate Advice:</strong>
                                <p class="text-slate-200 text-xs sm:text-sm leading-relaxed"><?= htmlspecialchars($activePoint['exit_gate_tip']) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 rounded-2xl bg-red-950/60 border border-red-500/30 text-sm">
                        <div class="flex items-start gap-2.5">
                            <i data-lucide="shield-alert" class="w-5 h-5 text-red-400 shrink-0 mt-0.5"></i>
                            <div>
                                <strong class="text-red-300 block text-xs uppercase font-bold tracking-wider">Scam Warning for this Station:</strong>
                                <p class="text-red-100 text-xs sm:text-sm leading-relaxed"><?= htmlspecialchars($activePoint['scam_warning']) ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white/10 backdrop-blur-md p-5 rounded-2xl border border-white/15 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-blue-200 flex items-center gap-1.5">
                        <i data-lucide="check-circle" class="w-4 h-4 text-emerald-400"></i> Safe Transport Options
                    </h3>
                    <p class="text-xs text-slate-300 leading-relaxed"><?= htmlspecialchars($activePoint['safe_transport_options']) ?></p>
                    <div class="pt-2 border-t border-white/10 text-xs text-blue-200">
                        <span class="block font-semibold">Direct Metro:</span>
                        <span class="text-white"><?= htmlspecialchars($activePoint['nearest_metro']) ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Transit Route Navigator -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Recommended Routes to Common Hubs</h2>
                    <p class="text-xs text-slate-500">Fastest and safest transit options with real fare benchmarks.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php if (empty($routes)): ?>
                    <div class="col-span-2 bg-white p-8 rounded-2xl border border-slate-200 text-center text-slate-500">
                        No direct routes listed for this arrival station yet. Delhi Metro connects all major junctions.
                    </div>
                <?php else: ?>
                    <?php foreach ($routes as $route): ?>
                    <div class="bg-white rounded-2xl p-6 border border-slate-200 shadow-sm transition-card flex flex-col justify-between">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-bold px-2.5 py-1 rounded-lg bg-blue-50 text-blue-700 border border-blue-200 flex items-center gap-1.5">
                                    <i data-lucide="<?= $route['transit_mode'] == 'Metro' ? 'train' : 'bus' ?>" class="w-3.5 h-3.5"></i>
                                    <span><?= htmlspecialchars($route['transit_mode']) ?></span>
                                </span>
                                <div class="text-right">
                                    <span class="text-base font-black text-emerald-700"><?= htmlspecialchars($route['approx_cost']) ?></span>
                                    <span class="text-xs text-slate-400 block"><?= htmlspecialchars($route['travel_time']) ?></span>
                                </div>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 mb-2">
                                Destination: <?= htmlspecialchars($route['destination_area']) ?>
                            </h3>

                            <div class="p-3.5 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 leading-relaxed mb-4">
                                <strong class="text-slate-900 block mb-1">Step-by-Step Directions:</strong>
                                <?= htmlspecialchars($route['route_details']) ?>
                            </div>
                        </div>

                        <?php if (!empty($route['scam_tip'])): ?>
                        <div class="p-3 rounded-xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-start gap-2">
                            <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-600 shrink-0 mt-0.5"></i>
                            <div>
                                <strong class="font-bold">Scam Alert on this route:</strong>
                                <span><?= htmlspecialchars($route['scam_tip']) ?></span>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

        <!-- Delhi Metro Lifehack Guide & Fare Benchmark -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-12">
            
            <!-- WhatsApp Metro QR Ticketing Hack -->
            <div class="bg-gradient-to-br from-emerald-900 to-teal-950 text-white rounded-3xl p-6 sm:p-8 shadow-sm">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/20 text-emerald-400 flex items-center justify-center border border-emerald-400/30">
                        <i data-lucide="qr-code" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <span class="text-xs uppercase font-black text-emerald-400 tracking-wider">Top Newcomer Lifehack</span>
                        <h3 class="text-xl font-bold">Skip Station Lines: WhatsApp Metro Ticket</h3>
                    </div>
                </div>

                <p class="text-xs sm:text-sm text-slate-200 leading-relaxed mb-6">
                    Never wait in long token queues at New Delhi Station or Rajiv Chowk. DMRC officially supports booking QR tickets directly via WhatsApp in 30 seconds!
                </p>

                <div class="space-y-3 bg-white/10 backdrop-blur-md p-4 rounded-2xl border border-white/15 text-xs text-slate-200">
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white text-[11px] font-bold flex items-center justify-center shrink-0">1</span>
                        <span>Save official DMRC WhatsApp number: <strong class="text-white">+91 96508 55800</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white text-[11px] font-bold flex items-center justify-center shrink-0">2</span>
                        <span>Send <strong>"Hi"</strong> and select your origin and destination station.</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-5 h-5 rounded-full bg-emerald-500 text-white text-[11px] font-bold flex items-center justify-center shrink-0">3</span>
                        <span>Pay via UPI (GPay, PhonePe, Paytm). Scan the generated QR code directly at the AFC gate.</span>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between text-xs text-emerald-300">
                    <span>* Smart Card users get 10% to 20% off during off-peak hours.</span>
                    <button onclick="copyText('+919650855800', 'DMRC WhatsApp Number')" class="underline hover:text-white font-bold">
                        Copy Number
                    </button>
                </div>
            </div>

            <!-- Auto & Taxi Fair Benchmark Tool -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center">
                            <i data-lucide="calculator" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <span class="text-xs uppercase font-black text-blue-600 tracking-wider">Fare Protection Tool</span>
                            <h3 class="text-xl font-bold text-slate-900">Delhi Auto Fare Benchmark</h3>
                        </div>
                    </div>

                    <p class="text-xs text-slate-600 mb-5">
                        Calculate the legal government-mandated fare so auto drivers cannot fleece you by claiming flat rates.
                    </p>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase tracking-wider mb-2">Estimated Distance (KM)</label>
                            <div class="relative">
                                <input type="number" id="autoDistanceInput" placeholder="e.g. 8" min="1" max="60" step="0.5" class="w-full p-3 rounded-xl border border-slate-300 text-sm focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10 bg-slate-50">
                                <i data-lucide="navigation" class="w-4 h-4 text-slate-400 absolute left-3.5 top-3.5"></i>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="autoNightToggle" class="w-4 h-4 rounded text-blue-600 focus:ring-blue-500 border-slate-300">
                            <label for="autoNightToggle" class="text-xs font-medium text-slate-700">Night Surcharge (11:00 PM – 5:00 AM, +25%)</label>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <div class="p-4 rounded-xl bg-blue-50 border border-blue-200 flex items-center justify-between mb-3">
                        <div>
                            <span class="text-xs text-blue-700 font-semibold uppercase">Legal Meter Estimate</span>
                            <div id="autoFareResult" class="text-3xl font-black text-blue-900">₹--</div>
                        </div>
                        <button id="calcAutoFareBtn" class="px-5 py-2.5 rounded-xl bg-blue-600 text-white font-bold text-xs hover:bg-blue-700 transition-colors shadow-sm">
                            Calculate Fare
                        </button>
                    </div>

                    <div id="autoBreakdownResult" class="text-[11px] text-slate-500 leading-relaxed">
                        Official Govt. Rate: ₹30 for first 1.5 km + ₹11/km after.
                    </div>
                </div>
            </div>

        </div>

        <!-- Travel Scams Radar Section -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-red-200 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                    <i data-lucide="alert-octagon" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Station & Airport Scam Alerts</h3>
                    <p class="text-xs text-slate-500">Know how touts operate before you step out of the station doors.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($travelScams as $scam): ?>
                <div class="p-5 rounded-2xl bg-red-50/50 border border-red-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded bg-red-600 text-white"><?= htmlspecialchars($scam['severity']) ?></span>
                            <span class="text-xs font-semibold text-slate-500"><?= htmlspecialchars($scam['victim_helpline']) ?></span>
                        </div>
                        <h4 class="font-bold text-base text-slate-900 mb-2"><?= htmlspecialchars($scam['title']) ?></h4>
                        <p class="text-xs text-slate-600 leading-relaxed mb-3"><strong>The Trick:</strong> <?= htmlspecialchars($scam['modus_operandi']) ?></p>
                        <p class="text-xs text-red-700 leading-relaxed mb-3"><strong>Red Flags:</strong> <?= htmlspecialchars($scam['red_flags']) ?></p>
                    </div>

                    <div class="p-3 rounded-xl bg-white border border-red-200 text-xs text-slate-800">
                        <strong class="text-slate-900 block mb-0.5">What to do:</strong>
                        <?= htmlspecialchars($scam['protection_steps']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
