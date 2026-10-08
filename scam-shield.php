<?php
require_once __DIR__ . '/config/db.php';
define('PAGE_TITLE', 'Phase 4: Anti-Scam Shield & Fraud Radar');

$pdo = getDBConnection();

// Success or error messages from form submission
$successMsg = isset($_GET['success']) ? 'Thank you! Your scam report has been logged and published to help fellow newcomers.' : null;
$errorMsg = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

// Filter for scams
$categoryFilter = isset($_GET['cat']) ? $_GET['cat'] : null;

if ($categoryFilter) {
    $stmt = $pdo->prepare("SELECT * FROM scam_alerts WHERE city_id = 1 AND phase_category = ? ORDER BY severity DESC, id ASC");
    $stmt->execute([$categoryFilter]);
    $scams = $stmt->fetchAll();
} else {
    $scams = $pdo->query("SELECT * FROM scam_alerts WHERE city_id = 1 ORDER BY severity DESC, id ASC")->fetchAll();
}

// Community Reports
$communityReports = $pdo->query("SELECT * FROM community_reports WHERE city_id = 1 ORDER BY date_reported DESC LIMIT 10")->fetchAll();

// Emergency contacts
$contacts = $pdo->query("SELECT * FROM emergency_contacts WHERE city_id = 1 ORDER BY id ASC")->fetchAll();

require_once __DIR__ . '/includes/header.php';
?>

<main class="flex-grow py-10 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Breadcrumb & Header -->
        <div class="mb-8">
            <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                <a href="index.php" class="hover:text-blue-600">Home</a>
                <span>&rarr;</span>
                <span class="text-red-600">Phase 4: Scam Shield & Safety Radar</span>
            </div>
            <h1 class="text-3xl sm:text-4xl font-black text-slate-900 tracking-tight">
                Anti-Fraud Shield & Blacklist
            </h1>
            <p class="text-slate-600 text-sm mt-1 max-w-2xl">
                Unmasking touts, fake brokers, unmetered auto drivers, and advance fee scams in Delhi NCR before they can touch your money.
            </p>
        </div>

        <?php if ($successMsg): ?>
            <div class="mb-8 p-4 rounded-2xl bg-emerald-100 border border-emerald-300 text-emerald-800 text-sm font-semibold flex items-center gap-2">
                <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                <span><?= $successMsg ?></span>
            </div>
        <?php endif; ?>

        <?php if ($errorMsg): ?>
            <div class="mb-8 p-4 rounded-2xl bg-red-100 border border-red-300 text-red-800 text-sm font-semibold flex items-center gap-2">
                <i data-lucide="alert-octagon" class="w-5 h-5 text-red-600"></i>
                <span><?= $errorMsg ?></span>
            </div>
        <?php endif; ?>

        <!-- Interactive Diagnostic Tool -->
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-red-950 text-white rounded-3xl p-6 sm:p-10 shadow-xl mb-12 border border-red-500/20">
            <div class="max-w-3xl">
                <div class="flex items-center gap-3 mb-3">
                    <span class="px-3 py-1 rounded-full text-xs font-black uppercase bg-red-600 text-white flex items-center gap-1.5">
                        <i data-lucide="shield-alert" class="w-3.5 h-3.5"></i> Instant Risk Diagnostic
                    </span>
                </div>
                <h2 class="text-2xl sm:text-3xl font-black">"Am I Being Scammed Right Now?"</h2>
                <p class="text-slate-300 text-xs sm:text-sm mt-2 mb-6 leading-relaxed">
                    If someone is asking you for money, telling you strange stories about hotel closures, or offering suspicious easy jobs, select your situation below for an immediate risk verdict:
                </p>

                <div class="space-y-4">
                    <div>
                        <select id="scamScenarioSelect" class="w-full p-3.5 rounded-2xl border border-slate-600 text-sm text-slate-900 bg-white focus:ring-2 focus:ring-red-500 focus:outline-none">
                            <option value="">-- Choose what the person is telling or asking you --</option>
                            <option value="gate_pass">A broker or "Army Officer" demands ₹1,500–₹2,500 QR pass before showing the PG/flat</option>
                            <option value="station_hotel">Driver or person at railway station insists: "Your booked hotel is sealed or under police curfew"</option>
                            <option value="auto_nometer">Auto driver refuses to start electronic meter and demands a flat ₹300-₹500</option>
                            <option value="electricity_trap">PG owner avoids writing down electricity rate and says "sub-meter bill later"</option>
                            <option value="no_agreement">Landlord says: "No need for written agreement, we don't do agreements here"</option>
                            <option value="telegram_job">Received WhatsApp message for part-time "Hotel Review / YouTube Like" task</option>
                        </select>
                    </div>

                    <button id="analyzeScamBtn" class="px-6 py-3 rounded-xl bg-red-600 hover:bg-red-500 text-white font-bold text-sm flex items-center justify-center gap-2 transition-transform hover:-translate-y-0.5 shadow-lg shadow-red-600/30">
                        <i data-lucide="activity" class="w-4 h-4"></i>
                        <span>Scan This Scenario</span>
                    </button>

                    <div id="scamAnalysisResult" class="hidden mt-6 text-slate-800"></div>
                </div>
            </div>
        </div>

        <!-- Category Filter Tabs -->
        <div class="bg-white p-4 rounded-2xl border border-slate-200 shadow-sm mb-8 flex flex-wrap gap-2">
            <a href="scam-shield.php" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= empty($categoryFilter) ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                All Scam Radar Alerts
            </a>
            <a href="scam-shield.php?cat=Travel" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $categoryFilter == 'Travel' ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                1. Travel & Station Scams
            </a>
            <a href="scam-shield.php?cat=Accommodation" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $categoryFilter == 'Accommodation' ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                2. PG & Rental Deposit Scams
            </a>
            <a href="scam-shield.php?cat=Food+%26+Living" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $categoryFilter == 'Food & Living' ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                3. Food & Daily Life Traps
            </a>
            <a href="scam-shield.php?cat=Job+%26+Money" class="px-4 py-2 rounded-xl text-xs sm:text-sm font-bold transition-all <?= $categoryFilter == 'Job & Money' ? 'bg-red-600 text-white shadow-sm' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' ?>">
                4. Job & Financial Frauds
            </a>
        </div>

        <!-- The Scams Radar Grid -->
        <div class="mb-14">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php foreach ($scams as $scam): ?>
                <div class="bg-white rounded-3xl p-6 sm:p-7 border border-slate-200 shadow-sm transition-card flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-[10px] font-black uppercase px-2.5 py-1 rounded-full <?= $scam['severity'] == 'Critical' ? 'bg-red-600 text-white' : 'bg-amber-500 text-white' ?>">
                                <?= htmlspecialchars($scam['severity']) ?> Threat
                            </span>
                            <span class="text-xs font-semibold text-slate-400">
                                Phase: <?= htmlspecialchars($scam['phase_category']) ?>
                            </span>
                        </div>

                        <h3 class="font-bold text-lg text-slate-900 mb-3"><?= htmlspecialchars($scam['title']) ?></h3>

                        <div class="space-y-3 text-xs leading-relaxed text-slate-600 mb-4">
                            <div>
                                <strong class="text-slate-900 block mb-0.5">The Modus Operandi (How it happens):</strong>
                                <p><?= htmlspecialchars($scam['modus_operandi']) ?></p>
                            </div>

                            <div class="p-3 rounded-xl bg-red-50/70 border border-red-200 text-red-900">
                                <strong class="text-red-900 block mb-0.5">Red Flags to Watch:</strong>
                                <p><?= htmlspecialchars($scam['red_flags']) ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100 space-y-3">
                        <div class="p-3 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-800">
                            <strong class="text-emerald-700 block mb-0.5">How To Shield Yourself:</strong>
                            <p><?= htmlspecialchars($scam['protection_steps']) ?></p>
                        </div>

                        <?php if (!empty($scam['victim_helpline'])): ?>
                        <div class="flex items-center justify-between text-xs text-slate-500">
                            <span>Direct Helpline:</span>
                            <span class="font-bold text-slate-800"><?= htmlspecialchars($scam['victim_helpline']) ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Community Reports & Submission Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-14" id="report">
            
            <!-- Left: Community Blacklist Feed -->
            <div class="lg:col-span-2 bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <div class="flex items-center gap-2">
                            <i data-lucide="shield-alert" class="w-5 h-5 text-red-600"></i>
                            <h3 class="text-xl font-bold text-slate-900">Community Fraud Reports</h3>
                        </div>
                        <p class="text-xs text-slate-500 mt-0.5">Real-time alerts submitted by newcomers in Delhi NCR</p>
                    </div>
                    <span class="text-xs font-bold px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
                        <?= count($communityReports) ?> Active Reports
                    </span>
                </div>

                <div class="space-y-4">
                    <?php if (empty($communityReports)): ?>
                        <p class="text-xs text-slate-400 py-6 text-center">No community reports submitted yet. Be the first to warn others!</p>
                    <?php else: ?>
                        <?php foreach ($communityReports as $rep): ?>
                        <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 text-xs">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-red-700 uppercase tracking-wider text-[10px] bg-red-50 border border-red-200 px-2 py-0.5 rounded-full">
                                    <?= htmlspecialchars($rep['scam_category']) ?>
                                </span>
                                <span class="text-slate-400 text-[11px]"><?= date('d M Y', strtotime($rep['date_reported'])) ?></span>
                            </div>

                            <div class="text-slate-900 font-bold mb-1">
                                <?= htmlspecialchars($rep['location_area']) ?>
                                <?php if (!empty($rep['financial_loss'])): ?>
                                    <span class="text-red-600 font-extrabold ml-1">(Lost: <?= htmlspecialchars($rep['financial_loss']) ?>)</span>
                                <?php endif; ?>
                            </div>

                            <p class="text-slate-600 leading-relaxed mb-2"><?= htmlspecialchars($rep['description']) ?></p>

                            <?php if (!empty($rep['scammer_identity']) || !empty($rep['scammer_contact'])): ?>
                            <div class="p-2 rounded-lg bg-white border border-slate-200 text-[11px] flex flex-wrap items-center justify-between text-slate-700">
                                <div>
                                    <span class="text-slate-400">Scammer:</span> <strong><?= htmlspecialchars($rep['scammer_identity'] ?? 'Unknown') ?></strong>
                                </div>
                                <?php if (!empty($rep['scammer_contact'])): ?>
                                <div>
                                    <span class="text-slate-400">Contact/Plate:</span> <strong class="text-red-700"><?= htmlspecialchars($rep['scammer_contact']) ?></strong>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Submit A Scam Report Form -->
            <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm flex flex-col justify-between">
                <div>
                    <div class="flex items-center gap-2 mb-2">
                        <i data-lucide="megaphone" class="w-5 h-5 text-blue-600"></i>
                        <h3 class="text-xl font-bold text-slate-900">Warn Newcomers</h3>
                    </div>
                    <p class="text-xs text-slate-500 mb-6">
                        Encountered a fake broker, an extortionate auto driver, or a fake PG listing? Report it anonymously to protect others.
                    </p>

                    <form action="report-scam.php" method="POST" class="space-y-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Category *</label>
                            <select name="scam_category" required class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                <option value="Accommodation">Accommodation / Room Deposit</option>
                                <option value="Travel">Travel & Station Auto/Taxi</option>
                                <option value="Food & Living">Food / Tiffin / Daily Life</option>
                                <option value="Job & Financial">Job / Telegram Task / Financial</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Location of Incident *</label>
                            <input type="text" name="location_area" required placeholder="e.g. Hudson Lane or NDLS Exit" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Fraudster Name / Pseudo Name</label>
                            <input type="text" name="scammer_identity" placeholder="e.g. Fake broker 'Rajesh' on OLX" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Fraudster Mobile / Vehicle Plate</label>
                            <input type="text" name="scammer_contact" placeholder="e.g. +91 98765 43210 or DL-1RA-XXXX" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">Amount Lost or Demanded</label>
                            <input type="text" name="financial_loss" placeholder="e.g. ₹2,000" class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1">What Happened? *</label>
                            <textarea name="description" required rows="3" placeholder="Briefly describe the trick they used..." class="w-full p-2.5 rounded-xl border border-slate-300 text-xs bg-slate-50 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                        </div>

                        <button type="submit" class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-1.5">
                            <i data-lucide="send" class="w-4 h-4"></i> Submit Warning
                        </button>
                    </form>
                </div>
            </div>

        </div>

        <!-- Emergency Directory Section -->
        <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-sm mb-10">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-slate-900">Delhi NCR Emergency & Grievance Directory</h3>
                    <p class="text-xs text-slate-500">Keep these numbers saved on your phone while staying in the capital.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <?php foreach ($contacts as $contact): ?>
                <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-blue-100 text-blue-800">
                                <?= htmlspecialchars($contact['category']) ?>
                            </span>
                            <span class="text-[11px] font-semibold text-emerald-700"><?= htmlspecialchars($contact['hours']) ?></span>
                        </div>
                        <h4 class="font-bold text-sm text-slate-900 mb-1"><?= htmlspecialchars($contact['department']) ?></h4>
                        <p class="text-xs text-slate-500 mb-3"><?= htmlspecialchars($contact['description']) ?></p>
                    </div>

                    <div class="flex items-center justify-between pt-2 border-t border-slate-200">
                        <div class="font-black text-slate-900 text-base"><?= htmlspecialchars($contact['helpline_number']) ?></div>
                        <a href="tel:<?= preg_replace('/[^0-9]/', '', $contact['helpline_number']) ?>" class="px-3 py-1.5 rounded-lg bg-blue-600 hover:bg-blue-700 text-white font-bold text-xs flex items-center gap-1">
                            <i data-lucide="phone" class="w-3 h-3"></i> Call
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
</main>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
