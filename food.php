<?php
require_once __DIR__ . '/config/db.php';
define('PAGE_TITLE', 'Step 3: Food & Daily Essentials');

$pdo = getDBConnection();

// Fetch food services
$filterType = isset($_GET['type']) ? $_GET['type'] : null;

if ($filterType) {
    $stmt = $pdo->prepare("SELECT f.*, n.name AS neighborhood_name 
                           FROM food_services f 
                           LEFT JOIN neighborhoods n ON f.neighborhood_id = n.id 
                           WHERE f.city_id = 1 AND f.service_type = ? 
                           ORDER BY f.id ASC");
    $stmt->execute([$filterType]);
    $services = $stmt->fetchAll();
} else {
    $services = $pdo->query("SELECT f.*, n.name AS neighborhood_name 
                             FROM food_services f 
                             LEFT JOIN neighborhoods n ON f.neighborhood_id = n.id 
                             WHERE f.city_id = 1 
                             ORDER BY f.id ASC")->fetchAll();
}

// Food and daily scams
$foodScams = $pdo->query("SELECT * FROM scam_alerts WHERE city_id = 1 AND phase_category = 'Food & Living'")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<main class="flex-grow py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                <a href="index.php" class="hover:text-blue-600">Home</a>
                <span>&rarr;</span>
                <span class="text-amber-600">Phase 3: Food & Essentials</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Food, Water & Daily Life Essentials
            </h1>
            <p class="text-slate-600 text-sm mt-1 max-w-2xl">
                Clean, reliable student mess services, doorstep 20L RO water delivery, laundromats, and health safety tips for new arrivals.
            </p>
        </div>

        <!-- Quick Filter Pills -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-10 flex flex-wrap gap-2">
            <a href="food.php" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= empty($filterType) ? 'bg-amber-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                All Daily Services
            </a>
            <a href="food.php?type=Tiffin+Service" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $filterType == 'Tiffin Service' ? 'bg-amber-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                Tiffin Services
            </a>
            <a href="food.php?type=Student+Mess" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $filterType == 'Student Mess' ? 'bg-amber-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                Student Mess
            </a>
            <a href="food.php?type=RO+Water+Supply" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $filterType == 'RO Water Supply' ? 'bg-amber-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                RO Water Supply (20L Cans)
            </a>
            <a href="food.php?type=Laundry+Hub" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $filterType == 'Laundry Hub' ? 'bg-amber-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                Laundromats & Pressing
            </a>
        </div>

        <!-- Daily Living Benchmark Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Tiffin Standard -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center mb-3">
                    <i data-lucide="utensils" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1">Monthly Tiffin Benchmark</h3>
                <div class="text-2xl font-black text-amber-700 mb-2">₹2,600 – ₹3,500 <span class="text-xs text-slate-500 font-normal">/ mo</span></div>
                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                    Standard monthly subscription covers 2 meals (Lunch + Dinner) with 4 rotis, dal, subzi, rice & salad.
                </p>
                <div class="p-2.5 rounded-xl bg-amber-50 text-[11px] text-amber-900 font-medium">
                    &bull; Always take a 2-day paid trial (₹80-100/meal) before paying 1 full month advance.
                </div>
            </div>

            <!-- RO Water Standard -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center mb-3">
                    <i data-lucide="droplet" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1">20-Litre RO Water Can</h3>
                <div class="text-2xl font-black text-sky-700 mb-2">₹30 – ₹40 <span class="text-xs text-slate-500 font-normal">/ refill</span></div>
                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                    Doorstep delivered 20L chilled or regular RO water cans. Initial refundable jar deposit is usually ₹150.
                </p>
                <div class="p-2.5 rounded-xl bg-sky-50 text-[11px] text-sky-900 font-medium">
                    &bull; Never drink tap water directly in Delhi without a certified RO or boiling.
                </div>
            </div>

            <!-- Laundry Standard -->
            <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm">
                <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center mb-3">
                    <i data-lucide="shirt" class="w-5 h-5"></i>
                </div>
                <h3 class="font-bold text-base text-slate-900 mb-1">Laundry & Steam Ironing</h3>
                <div class="text-2xl font-black text-indigo-700 mb-2">₹60 – ₹80 <span class="text-xs text-slate-500 font-normal">/ kg wash</span></div>
                <p class="text-xs text-slate-600 leading-relaxed mb-3">
                    Local laundromats offer wash, dry & fold services by weight, or steam ironing at ₹6-8 per garment.
                </p>
                <div class="p-2.5 rounded-xl bg-indigo-50 text-[11px] text-indigo-900 font-medium">
                    &bull; Always collect a receipt or take a photo of the clothes bag handed over.
                </div>
            </div>
        </div>

        <!-- Services Grid -->
        <div class="mb-14">
            <h2 class="text-2xl font-black text-slate-900 mb-6">Directory of Verified Local Services</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($services as $srv): ?>
                <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm transition-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                <?= htmlspecialchars($srv['service_type']) ?>
                            </span>
                            <?php if (!empty($srv['food_type'])): ?>
                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full <?= $srv['food_type'] == 'Pure Veg' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800' ?>">
                                    <?= htmlspecialchars($srv['food_type']) ?>
                                </span>
                            <?php endif; ?>
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 mb-1"><?= htmlspecialchars($srv['name']) ?></h3>
                        <p class="text-xs text-slate-500 flex items-center gap-1 mb-3">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                            <span><?= htmlspecialchars($srv['address']) ?> (<?= htmlspecialchars($srv['neighborhood_name']) ?>)</span>
                        </p>

                        <div class="p-3 rounded-2xl bg-amber-50/50 border border-amber-200/60 mb-4">
                            <div class="text-xs font-bold text-slate-900"><?= htmlspecialchars($srv['pricing_info']) ?></div>
                            <p class="text-xs text-slate-600 mt-1"><?= htmlspecialchars($srv['highlights']) ?></p>
                        </div>

                        <?php if (!empty($srv['safety_hygiene_tip'])): ?>
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 mb-4">
                            <strong class="text-slate-900 block mb-0.5 flex items-center gap-1">
                                <i data-lucide="shield" class="w-3.5 h-3.5 text-emerald-600"></i> Newcomer Hygiene Tip:
                            </strong>
                            <span><?= htmlspecialchars($srv['safety_hygiene_tip']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>

                    <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                        <a href="tel:<?= htmlspecialchars($srv['contact_phone']) ?>" class="flex-1 py-2.5 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs text-center flex items-center justify-center gap-1.5 transition-colors">
                            <i data-lucide="phone" class="w-3.5 h-3.5"></i> Call <?= htmlspecialchars($srv['contact_phone']) ?>
                        </a>
                        <button onclick="copyText('<?= htmlspecialchars($srv['contact_phone']) ?>', 'Service Phone')" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs" title="Copy Number">
                            <i data-lucide="copy" class="w-4 h-4"></i>
                        </button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Food & Living Scams Warning -->
        <?php if (!empty($foodScams)): ?>
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-red-200 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                    <i data-lucide="shield-alert" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Food & Daily Living Traps</h3>
                    <p class="text-xs text-slate-500">Unregulated vendors targeting unassisted newcomers.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($foodScams as $scam): ?>
                <div class="p-5 rounded-2xl bg-red-50/50 border border-red-200 flex flex-col justify-between">
                    <div>
                        <span class="text-[10px] font-black uppercase px-2 py-0.5 rounded bg-red-600 text-white mb-2 inline-block"><?= htmlspecialchars($scam['severity']) ?></span>
                        <h4 class="font-bold text-base text-slate-900 mb-2"><?= htmlspecialchars($scam['title']) ?></h4>
                        <p class="text-xs text-slate-600 leading-relaxed mb-3"><?= htmlspecialchars($scam['modus_operandi']) ?></p>
                    </div>

                    <div class="p-3 rounded-xl bg-white border border-red-200 text-xs text-slate-800">
                        <strong class="text-red-700 block mb-0.5">Protection Rule:</strong>
                        <?= htmlspecialchars($scam['protection_steps']) ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
