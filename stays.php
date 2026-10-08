<?php
require_once __DIR__ . '/config/db.php';
define('PAGE_TITLE', 'Step 2: Room, PG & Hostel Guide');

$pdo = getDBConnection();

// Fetch neighborhoods
$neighborhoods = $pdo->query("SELECT * FROM neighborhoods WHERE city_id = 1 ORDER BY id ASC")->fetchAll();

// Build filter query for accommodations
$whereConditions = ["a.city_id = 1"];
$params = [];

$filterNeighborhood = isset($_GET['neighborhood']) && $_GET['neighborhood'] !== '' ? intval($_GET['neighborhood']) : null;
$filterType = isset($_GET['type']) && $_GET['type'] !== '' ? $_GET['type'] : null;
$filterSharing = isset($_GET['sharing']) && $_GET['sharing'] !== '' ? $_GET['sharing'] : null;
$filterMaxRent = isset($_GET['max_rent']) && $_GET['max_rent'] !== '' ? intval($_GET['max_rent']) : null;
$filterFood = isset($_GET['food']) && $_GET['food'] === '1' ? 1 : null;

if ($filterNeighborhood) {
    $whereConditions[] = "a.neighborhood_id = ?";
    $params[] = $filterNeighborhood;
}
if ($filterType) {
    $whereConditions[] = "a.type = ?";
    $params[] = $filterType;
}
if ($filterSharing) {
    $whereConditions[] = "a.sharing_type = ?";
    $params[] = $filterSharing;
}
if ($filterMaxRent) {
    $whereConditions[] = "a.monthly_rent <= ?";
    $params[] = $filterMaxRent;
}
if ($filterFood !== null) {
    $whereConditions[] = "a.food_included = 1";
}

$sql = "SELECT a.*, n.name AS neighborhood_name, n.category AS neighborhood_category 
        FROM accommodations a 
        LEFT JOIN neighborhoods n ON a.neighborhood_id = n.id 
        WHERE " . implode(' AND ', $whereConditions) . " 
        ORDER BY a.monthly_rent ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$accommodations = $stmt->fetchAll();

// Accommodation scams
$rentalScams = $pdo->query("SELECT * FROM scam_alerts WHERE city_id = 1 AND phase_category = 'Accommodation'")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<main class="flex-grow py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                <a href="index.php" class="hover:text-blue-600">Home</a>
                <span>&rarr;</span>
                <span class="text-emerald-600">Phase 2: Room & PG Navigator</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Honest PG, Hostel & Room Guide
            </h1>
            <p class="text-slate-600 text-sm mt-1 max-w-2xl">
                Find verified budget housing without losing your deposit to sneaky sub-meters or fake OLX "visiting pass" fraudsters.
            </p>
        </div>

        <!-- Critical Deposit Shield Banner -->
        <div class="bg-red-600 text-white p-6 rounded-3xl shadow-lg shadow-red-500/20 mb-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div class="flex items-start gap-4">
                <div class="w-12 h-12 rounded-2xl bg-white/20 flex items-center justify-center shrink-0">
                    <i data-lucide="shield-alert" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <span class="text-xs uppercase font-black tracking-widest text-red-200">Anti-Scam Golden Rule #1</span>
                    <h3 class="text-xl font-bold text-white mt-0.5">Never Pay A Single Rupee Before Visiting</h3>
                    <p class="text-xs sm:text-sm text-red-100 mt-1 max-w-2xl leading-relaxed">
                        Fraudsters pose as Army Officers or NRI owners asking for ₹1,000–₹2,500 "Society Gate Passes" or "Viewing Tokens" on UPI. Real landlords NEVER charge a fee to show you a room.
                    </p>
                </div>
            </div>
            <a href="scam-shield.php" class="shrink-0 px-4 py-2.5 rounded-xl bg-white text-red-600 font-bold text-xs sm:text-sm hover:bg-red-50 transition-colors shadow-sm">
                Read Scam Details &rarr;
            </a>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm mb-10">
            <form method="GET" action="stays.php" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                <!-- Neighborhood -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Neighborhood</label>
                    <select name="neighborhood" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm bg-slate-50 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="">All Areas</option>
                        <?php foreach ($neighborhoods as $n): ?>
                            <option value="<?= $n['id'] ?>" <?= $filterNeighborhood == $n['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($n['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Type -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Stay Type</label>
                    <select name="type" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm bg-slate-50 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="">All Types</option>
                        <option value="Boys PG" <?= $filterType == 'Boys PG' ? 'selected' : '' ?>>Boys PG</option>
                        <option value="Girls PG" <?= $filterType == 'Girls PG' ? 'selected' : '' ?>>Girls PG</option>
                        <option value="Co-living" <?= $filterType == 'Co-living' ? 'selected' : '' ?>>Co-living</option>
                        <option value="Student Hostel" <?= $filterType == 'Student Hostel' ? 'selected' : '' ?>>Student Hostel</option>
                    </select>
                </div>

                <!-- Sharing -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Room Sharing</label>
                    <select name="sharing" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm bg-slate-50 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                        <option value="">Any Sharing</option>
                        <option value="Single" <?= $filterSharing == 'Single' ? 'selected' : '' ?>>Single (Private)</option>
                        <option value="Double" <?= $filterSharing == 'Double' ? 'selected' : '' ?>>Double Sharing</option>
                        <option value="Triple" <?= $filterSharing == 'Triple' ? 'selected' : '' ?>>Triple Sharing</option>
                    </select>
                </div>

                <!-- Max Budget -->
                <div>
                    <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">Max Budget / mo</label>
                    <input type="number" name="max_rent" placeholder="e.g. 9000" value="<?= $filterMaxRent ? htmlspecialchars($filterMaxRent) : '' ?>" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm bg-slate-50 focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                </div>

                <!-- Actions -->
                <div class="flex items-end gap-2">
                    <button type="submit" class="w-full py-2.5 px-4 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-xs sm:text-sm transition-colors flex items-center justify-center gap-1.5 shadow-sm">
                        <i data-lucide="filter" class="w-4 h-4"></i> Apply
                    </button>
                    <a href="stays.php" class="p-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-600 text-xs flex items-center justify-center" title="Reset Filters">
                        <i data-lucide="rotate-ccw" class="w-4 h-4"></i>
                    </a>
                </div>
            </form>
        </div>

        <!-- Accommodations Grid -->
        <div class="mb-14">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Verified Stays & PGs (<?= count($accommodations) ?> Found)</h2>
                    <p class="text-xs text-slate-500">Every listing includes an inspection tip to ask the landlord.</p>
                </div>
            </div>

            <?php if (empty($accommodations)): ?>
                <div class="bg-white p-12 rounded-3xl border border-slate-200 text-center">
                    <i data-lucide="home" class="w-12 h-12 text-slate-300 mx-auto mb-3"></i>
                    <h3 class="font-bold text-slate-800 text-lg">No stays match your criteria</h3>
                    <p class="text-xs text-slate-500 mt-1 mb-4">Try relaxing your budget or choosing 'All Areas'.</p>
                    <a href="stays.php" class="px-4 py-2 rounded-xl bg-emerald-600 text-white text-xs font-bold">Reset Filters</a>
                </div>
            <?php else: ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($accommodations as $stay): ?>
                    <div class="bg-white rounded-3xl p-6 border border-slate-200 shadow-sm transition-card flex flex-col justify-between">
                        <div>
                            <!-- Header tags -->
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-[11px] font-bold px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                    <?= htmlspecialchars($stay['type']) ?> &bull; <?= htmlspecialchars($stay['sharing_type']) ?>
                                </span>
                                <?php if ($stay['verified']): ?>
                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-100 text-emerald-800 flex items-center gap-1 border border-emerald-200">
                                        <i data-lucide="badge-check" class="w-3 h-3 text-emerald-600"></i> Verified
                                    </span>
                                <?php endif; ?>
                            </div>

                            <h3 class="font-bold text-lg text-slate-900 mb-1"><?= htmlspecialchars($stay['name']) ?></h3>
                            <p class="text-xs text-slate-500 flex items-center gap-1 mb-4">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-slate-400"></i>
                                <span><?= htmlspecialchars($stay['address']) ?></span>
                            </p>

                            <!-- Pricing box -->
                            <div class="p-3 rounded-2xl bg-emerald-50/60 border border-emerald-100 mb-4 flex items-center justify-between">
                                <div>
                                    <span class="text-[10px] font-bold uppercase text-emerald-800">Monthly Rent</span>
                                    <div class="text-xl font-black text-emerald-900">₹<?= number_format($stay['monthly_rent']) ?> <span class="text-xs font-normal text-emerald-700">/mo</span></div>
                                </div>
                                <div class="text-right">
                                    <span class="text-[10px] font-bold uppercase text-slate-500">Security Deposit</span>
                                    <div class="text-xs font-bold text-slate-700">₹<?= number_format($stay['security_deposit']) ?> (1 Mo)</div>
                                </div>
                            </div>

                            <!-- Amenities -->
                            <div class="grid grid-cols-2 gap-2 text-[11px] text-slate-600 mb-4">
                                <span class="flex items-center gap-1.5 <?= $stay['food_included'] ? 'text-emerald-700 font-semibold' : 'text-slate-400 line-through' ?>">
                                    <i data-lucide="utensils" class="w-3.5 h-3.5"></i> <?= $stay['food_included'] ? 'Food Included' : 'No Food' ?>
                                </span>
                                <span class="flex items-center gap-1.5 <?= $stay['ac_available'] ? 'text-emerald-700 font-semibold' : 'text-slate-400 line-through' ?>">
                                    <i data-lucide="wind" class="w-3.5 h-3.5"></i> <?= $stay['ac_available'] ? 'AC Room' : 'Non-AC' ?>
                                </span>
                                <span class="flex items-center gap-1.5 <?= $stay['wifi_included'] ? 'text-emerald-700 font-semibold' : 'text-slate-400 line-through' ?>">
                                    <i data-lucide="wifi" class="w-3.5 h-3.5"></i> Wi-Fi Available
                                </span>
                                <span class="flex items-center gap-1.5 <?= $stay['power_backup'] ? 'text-emerald-700 font-semibold' : 'text-slate-400 line-through' ?>">
                                    <i data-lucide="zap" class="w-3.5 h-3.5"></i> Power Backup
                                </span>
                            </div>

                            <!-- Landlord Tip -->
                            <?php if (!empty($stay['inspection_tip'])): ?>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-[11px] text-slate-700 mb-4">
                                <strong class="text-slate-900 block mb-0.5 flex items-center gap-1">
                                    <i data-lucide="eye" class="w-3 h-3 text-blue-600"></i> Newcomer Question to Ask:
                                </strong>
                                <span><?= htmlspecialchars($stay['inspection_tip']) ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="pt-3 border-t border-slate-100 flex items-center gap-2">
                            <a href="tel:<?= htmlspecialchars($stay['contact_phone']) ?>" class="flex-1 py-2 rounded-xl bg-slate-900 hover:bg-slate-800 text-white font-bold text-xs text-center flex items-center justify-center gap-1.5 transition-colors">
                                <i data-lucide="phone" class="w-3.5 h-3.5"></i> Call Landlord
                            </a>
                            <button onclick="copyText('<?= htmlspecialchars($stay['contact_phone']) ?>', 'Landlord Phone')" class="p-2 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs" title="Copy Number">
                                <i data-lucide="copy" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>

        <!-- 10-Point Room Inspection Checklist -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-12">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <i data-lucide="clipboard-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <span class="text-xs uppercase font-black text-emerald-600 tracking-wider">Crucial Pre-Signing Audit</span>
                    <h3 class="text-xl font-bold text-slate-900">The 10-Point Newcomer Room Inspection Checklist</h3>
                </div>
            </div>

            <p class="text-xs sm:text-sm text-slate-600 mb-6">
                Never sign a rent agreement or pay a security deposit until you have verified these 10 items in person:
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-xs text-slate-700">
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">1</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Electricity Unit Rate (Most Common Trap):</strong>
                        <span>Ask: "Is electricity charged at domestic government slab (~₹7-8) or commercial ₹12-16/unit?" Get the exact per-unit price written on the agreement.</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">2</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Deposit Refund Timeline:</strong>
                        <span>Ensure agreement clearly states the deposit will be returned within 7 days of moving out via bank transfer, with deductions only for actual unpaid bills.</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">3</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Notice Period Clause:</strong>
                        <span>Standard is 30 days. Avoid landlords who demand 60 or 90 days notice, or who state deposits are non-refundable during the first 6 months.</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">4</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Day-1 Video Evidence:</strong>
                        <span>On the day you take the keys, take a continuous 3-minute video showing the condition of the walls, fan, taps, and mirror. Send this to the landlord on WhatsApp as baseline proof.</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">5</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Water Timing & RO Filter:</strong>
                        <span>Check the tap water in the bathroom. Ask if water runs 24/7 or only 2 hours in the morning/evening. Inspect the date on the RO water filter cartridge.</span>
                    </div>
                </div>

                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex items-start gap-3">
                    <span class="w-6 h-6 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center shrink-0 text-xs">6</span>
                    <div>
                        <strong class="text-slate-900 block mb-0.5">Mobile Network Strength:</strong>
                        <span>Basement and ground-floor rooms often have zero Airtel/Jio signal. Test calling your family from inside the room before finalizing.</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rental Scams Shield -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-red-200 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-red-100 text-red-600 flex items-center justify-center">
                    <i data-lucide="shield-alert" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Rental & Accommodation Fraud Warnings</h3>
                    <p class="text-xs text-slate-500">Documented scams in Delhi NCR housing markets.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <?php foreach ($rentalScams as $scam): ?>
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

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
