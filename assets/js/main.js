/**
 * CityShield Frontend Interactive Utilities
 */

// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', () => {
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileBtn && mobileMenu) {
        mobileBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    }

    // Auto fare calculator auto-init if present
    initAutoCalculator();

    // Scam detector auto-init if present
    initScamDetector();
});

// SOS Emergency Modal
function openSosModal() {
    const modal = document.getElementById('sosModal');
    if (modal) {
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeSosModal() {
    const modal = document.getElementById('sosModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

// Close SOS modal on outside click
window.addEventListener('click', (e) => {
    const modal = document.getElementById('sosModal');
    if (modal && e.target === modal) {
        closeSosModal();
    }
});

/**
 * Delhi Official Auto Fare Benchmark Calculator
 * Rule: First 1.5 km = ₹30 base fare
 * Subsequent km = ₹11 per km
 * Night charges (11:00 PM to 5:00 AM) = 25% extra
 */
function initAutoCalculator() {
    const calcBtn = document.getElementById('calcAutoFareBtn');
    const distanceInput = document.getElementById('autoDistanceInput');
    const nightToggle = document.getElementById('autoNightToggle');
    const fareResult = document.getElementById('autoFareResult');
    const breakdownResult = document.getElementById('autoBreakdownResult');

    if (!calcBtn || !distanceInput) return;

    function calculateFare() {
        const km = parseFloat(distanceInput.value);
        if (isNaN(km) || km <= 0) {
            if (fareResult) fareResult.textContent = '₹--';
            return;
        }

        let fare = 30; // base fare for first 1.5 km
        if (km > 1.5) {
            fare += (km - 1.5) * 11;
        }

        const isNight = nightToggle && nightToggle.checked;
        if (isNight) {
            fare = fare * 1.25;
        }

        fare = Math.round(fare);

        if (fareResult) fareResult.textContent = '₹' + fare;
        if (breakdownResult) {
            breakdownResult.innerHTML = `Official Govt. Rate: ₹30 (first 1.5km) + ${km > 1.5 ? '₹' + Math.round((km - 1.5) * 11) + ' (' + (km - 1.5).toFixed(1) + 'km @ ₹11)' : '0'} ${isNight ? ' + 25% Night Charge' : ''}. <span class="text-emerald-700 font-semibold block mt-1">If driver asks more than ₹${fare + 40}, use Delhi Traffic Police helpline or book via App!</span>`;
        }
    }

    calcBtn.addEventListener('click', calculateFare);
    distanceInput.addEventListener('input', calculateFare);
    if (nightToggle) nightToggle.addEventListener('change', calculateFare);
}

/**
 * Interactive "Am I Being Scammed?" Checker Tool
 */
const scamScenarios = {
    'gate_pass': {
        risk: 'CRITICAL',
        badgeColor: 'bg-red-600',
        title: '100% FRAUD: The Fake "Gate Pass / Visiting Fee" Trap',
        verdict: 'DO NOT PAY A SINGLE RUPEE! This is an active cyber fraud syndicate.',
        explanation: 'Scammers on OLX/Facebook/Instagram pose as Army Officers, CISF personnel, or NRI property owners. They ask for ₹1,000–₹2,500 via QR code claiming it is a "refundable society visitor slip" or "military ID pass". In reality, no genuine landlord or society ever asks for a digital pass before letting you inspect the flat.',
        action: '1. Do not scan any QR code or enter UPI PIN.<br>2. Block the phone number.<br>3. Report to Cyber Crime at 1930 or cybercrime.gov.in.'
    },
    'station_hotel': {
        risk: 'CRITICAL',
        badgeColor: 'bg-red-600',
        title: '100% FRAUD: The "Hotel Closed / Curfewed / Burned" Scam',
        verdict: 'SCAM DETECTED: Do NOT trust the tout or driver!',
        explanation: 'Touts and rogue auto drivers at New Delhi Railway Station or Airport routinely claim your booked hotel is closed, under police curfew, or demolished. They offer to take you to an "official tourism counter" or another hotel where they charge ₹4,000-₹8,000 for a third-rate room.',
        action: '1. Call your hotel yourself on your phone.<br>2. If at New Delhi Station, walk directly to the Yellow Line Metro station at Ajmeri Gate.<br>3. Never let the tout dial the hotel on his phone (he connects to his partner).'
    },
    'auto_nometer': {
        risk: 'HIGH',
        badgeColor: 'bg-amber-600',
        title: 'HIGH RISK: Unmetered Auto Overcharging',
        verdict: 'OVERCHARGING EXPLOITATION: Refuse flat extortionate rates.',
        explanation: 'Delhi law strictly requires three-wheelers to run on electronic meters (Fare: ₹30 first 1.5 km, ₹11/km after). Quoting ₹400 for a 4 km ride is a direct violation of Delhi Transport regulations.',
        action: '1. Use the official Delhi Police Prepaid Auto Booth outside the station.<br>2. Book via Uber/Ola/Rapido Auto for a fixed upfront price.<br>3. Note the vehicle registration number (e.g., DL-1RA-XXXX) and complain on Traffic Police WhatsApp 8750871493.'
    },
    'electricity_trap': {
        risk: 'HIGH',
        badgeColor: 'bg-amber-600',
        title: 'HIGH RISK: Sub-Meter Electricity Extortion',
        verdict: 'COMMON RENTAL TRAP: Unreasonable unit markup.',
        explanation: 'Many rogue PG owners charge students ₹12 to ₹16 per unit on private sub-meters when standard domestic electricity in Delhi is heavily subsidized (often under ₹6-8/unit). This turns a ₹7,000 rent into a ₹13,000 monthly burden in summer.',
        action: '1. Ask the exact electricity per unit rate BEFORE paying any deposit.<br>2. Insist that the electricity rate is explicitly written on the stamped rental agreement.<br>3. Take a photograph of the sub-meter reading on your move-in date.'
    },
    'no_agreement': {
        risk: 'CRITICAL',
        badgeColor: 'bg-red-600',
        title: 'CRITICAL RISK: "No Agreement Needed, Just Verbal Trust" Trap',
        verdict: 'ALARM BELLS: 90% chance of losing your security deposit.',
        explanation: 'Landlords who refuse to provide a signed rental agreement on non-judicial stamp paper almost never return the security deposit when you move out, blaming "painting damage" or "breakage".',
        action: '1. Never pay more than 1 month security deposit.<br>2. Demand a signed written agreement with: a) Deposit refund terms (within 7 days), b) Notice period (30 days), c) Unit cost of electricity.<br>3. Take video of the room before moving in.'
    },
    'telegram_job': {
        risk: 'CRITICAL',
        badgeColor: 'bg-red-600',
        title: '100% FRAUD: "Hotel Review / Like YouTube Videos" Part-Time Job',
        verdict: 'CYBER FINANCIAL SCAM: Will drain your bank balance.',
        explanation: 'Newcomers looking to cover their monthly rent are lured with promises of earning ₹3,000/day simply by clicking likes or writing fake reviews. After paying ₹200 initially, they ask you to deposit ₹10,000 to "unlock VIP task commission".',
        action: '1. Never deposit money to earn a job.<br>2. Immediately block and report on WhatsApp / Telegram.<br>3. Report the scammer\'s UPI ID to 1930.'
    }
};

function initScamDetector() {
    const scenarioSelect = document.getElementById('scamScenarioSelect');
    const analyzeBtn = document.getElementById('analyzeScamBtn');
    const resultBox = document.getElementById('scamAnalysisResult');

    if (!scenarioSelect || !analyzeBtn || !resultBox) return;

    analyzeBtn.addEventListener('click', () => {
        const val = scenarioSelect.value;
        if (!val || !scamScenarios[val]) {
            alert('Please select a scenario from the list to analyze.');
            return;
        }

        const data = scamScenarios[val];
        resultBox.classList.remove('hidden');
        resultBox.innerHTML = `
            <div class="p-6 rounded-2xl bg-white border border-slate-200 shadow-lg">
                <div class="flex items-center gap-3 mb-3">
                    <span class="${data.badgeColor} text-white font-black text-xs px-3 py-1 rounded-full uppercase tracking-wider">${data.risk} RISK</span>
                    <h4 class="font-bold text-lg text-slate-900">${data.title}</h4>
                </div>
                <div class="p-4 rounded-xl bg-red-50 border border-red-200 text-red-900 font-bold text-sm mb-4 flex items-center gap-2">
                    <i data-lucide="alert-octagon" class="w-5 h-5 text-red-600 shrink-0"></i>
                    <span>${data.verdict}</span>
                </div>
                <div class="text-sm text-slate-700 space-y-3 leading-relaxed">
                    <div>
                        <strong class="text-slate-900 block mb-1">How This Trick Works:</strong>
                        <p>${data.explanation}</p>
                    </div>
                    <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700">
                        <strong class="text-slate-900 text-sm block mb-1">Immediate Shield Action:</strong>
                        ${data.action}
                    </div>
                </div>
            </div>
        `;

        if (window.lucide) {
            lucide.createIcons();
        }

        resultBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
}

// Copy text utility with toast notification
function copyText(text, label = 'Copied') {
    navigator.clipboard.writeText(text).then(() => {
        showToast(label + ' to clipboard!');
    }).catch(err => {
        console.error('Copy failed: ', err);
    });
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = 'fixed bottom-6 right-6 bg-slate-900 text-white text-xs font-semibold px-4 py-3 rounded-xl shadow-xl z-50 flex items-center gap-2 transition-all transform translate-y-2 opacity-0';
    toast.innerHTML = `<i data-lucide="check" class="w-4 h-4 text-emerald-400"></i> <span>${message}</span>`;
    document.body.appendChild(toast);

    if (window.lucide) lucide.createIcons();

    setTimeout(() => {
        toast.classList.remove('translate-y-2', 'opacity-0');
    }, 50);

    setTimeout(() => {
        toast.classList.add('translate-y-2', 'opacity-0');
        setTimeout(() => toast.remove(), 300);
    }, 2500);
}
