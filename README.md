# CityShield (SafarSaathi) 🛡️
### The Honest Newcomer Survival & Anti-Fraud Kit for Any City (Delhi NCR Pilot)

Built with **PHP & SQL** (supports both zero-config **SQLite** and **MySQL/XAMPP**).

---

## 🌟 What This Platform Solves
When a newcomer (student, job seeker, intern, or migrant) arrives in a new city, they are most vulnerable during their first 7 days:
1. **Travel & Arrival Extortion:** Rogue auto drivers refuse electronic meters, station touts falsely claim booked hotels are "sealed or burned down," and airport cabs charge 4x.
2. **Housing & Deposit Fraud:** Fraudsters on OLX/Facebook demand ₹1,000–₹2,500 for a fake "gate visiting pass" before disappearing; landlords forfeit security deposits or charge ₹14/unit for electricity on domestic sub-meters.
3. **Food & Daily Life Pitfalls:** Fly-by-night tiffin operators take 1-month advance and vanish; newcomers drink unsafe tap water without knowing 20L RO delivery standards.

**CityShield** provides a step-by-step chronological roadmap from arrival to settled living with built-in scam shields at every turn.

---

## 🗺️ The Newcomer 4-Step Roadmap

| Step | Module | File | Key Features |
|---|---|---|---|
| **1** | **Travel & Arrival** | `travel.php` | • Railway station exit guides (e.g. NDLS Ajmeri Gate skywalk vs Paharganj touts)<br>• Official Delhi Govt. Auto Fare Calculator (₹30 base + ₹11/km)<br>• WhatsApp Metro QR Ticketing shortcut (+91 96508 55800)<br>• Station tout scam alerts |
| **2** | **Room & PG Navigator** | `stays.php` | • Filter verified PGs & Hostels by budget, sharing, AC, food<br>• Neighborhood price benchmarks (North Campus, Mukherjee Nagar, Laxmi Nagar, Noida, Gurugram)<br>• **10-Point Pre-Signing Room Inspection Checklist**<br>• Defense against the "Visiting Pass" deposit scam |
| **3** | **Food & Daily Essentials** | `food.php` | • Student mess & daily tiffin services with price standards (₹2,600–₹3,500/mo)<br>• 20-Litre RO water can delivery pricing (₹30–₹40 standard)<br>• Local laundromats & daily hygiene tips |
| **4** | **Anti-Scam Shield** | `scam-shield.php` | • **Interactive "Am I Being Scammed?" Checker Tool**<br>• Modus operandi & red flags for top 8 city scams<br>• Live Community Fraud Blacklist feed<br>• **"Report a Scam" Form** (saves to SQL database)<br>• Direct 1-touch Emergency SOS Hotlines (112, 1091, 1930) |

---

## 🚀 How to Run the Website

### Option 1: Instant Run via PHP Built-in Server (Zero Configuration!)
1. Open PowerShell or Command Prompt.
2. Navigate to the project directory:
   ```powershell
   cd "C:\Users\adimu\.gemini\antigravity\scratch\citycompanion"
   ```
3. Start the PHP server:
   ```powershell
   C:\xampp\php\php.exe -S localhost:8000
   ```
   *(Or if PHP is in your PATH, simply `php -S localhost:8000`)*
4. Open your browser and go to:
   ```
   http://localhost:8000
   ```
*Note: SQLite is configured by default. The database (`database/cityshield.sqlite`) and seed data will be created automatically on your first visit!*

---

### Option 2: Run via XAMPP (Apache & MySQL)
1. Copy or create a symlink of the project folder into your XAMPP `htdocs` directory:
   - Target: `C:\xampp\htdocs\citycompanion`
2. Start **Apache** and **MySQL** in the **XAMPP Control Panel**.
3. Visit the automated setup link in your browser:
   ```
   http://localhost/citycompanion/database/setup_mysql.php
   ```
   *(This creates the `cityshield` database and seeds all Delhi NCR data automatically).*
4. In `config/db.php`, change the driver to MySQL:
   ```php
   define('DB_DRIVER', 'mysql');
   ```
5. Open the website:
   ```
   http://localhost/citycompanion/index.php
   ```

---

## 🗄️ Database Architecture (`database/schema.sql`)
- `cities`: Multi-city ready schema with pilot data for Delhi NCR.
- `arrival_points`: Terminals (Airport, NDLS, Anand Vihar, Nizamuddin) with safe exit gates and tout warnings.
- `transit_routes`: Direct metro, bus, and prepaid routes with fare comparisons.
- `neighborhoods`: Student and IT hub pricing benchmarks, safety ratings, and pros/cons.
- `accommodations`: PG & Hostel directory with amenities, verified status, and inspection tips.
- `food_services`: Tiffin services, student mess centers, RO water, and laundromats.
- `scam_alerts`: Categorized fraud database with modus operandi, red flags, and defense rules.
- `community_reports`: User-submitted fraud reports with scammer contact/vehicle plate and loss amounts.
- `emergency_contacts`: Official 24/7 helplines (Police 112, Women Safety 1091, Cyber Crime 1930).
