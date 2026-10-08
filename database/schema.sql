-- Schema for CityShield / Newcomer Companion Platform
-- Compatible with SQLite and MySQL / MariaDB

CREATE TABLE IF NOT EXISTS cities (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    name VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    tagline VARCHAR(255),
    description TEXT,
    metro_system_name VARCHAR(100),
    is_active INTEGER DEFAULT 1
);

CREATE TABLE IF NOT EXISTS arrival_points (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    name VARCHAR(150) NOT NULL,
    type VARCHAR(50) NOT NULL, -- Airport, Railway Station, Bus Terminal
    code VARCHAR(20),
    nearest_metro VARCHAR(150),
    exit_gate_tip TEXT,
    scam_warning TEXT,
    safe_transport_options TEXT
);

CREATE TABLE IF NOT EXISTS transit_routes (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    arrival_point_id INTEGER,
    destination_area VARCHAR(150) NOT NULL,
    transit_mode VARCHAR(50) NOT NULL, -- Metro, Bus, Auto, Prepaid Cab, Shared Auto
    approx_cost VARCHAR(100) NOT NULL,
    travel_time VARCHAR(50) NOT NULL,
    route_details TEXT NOT NULL,
    scam_tip TEXT,
    is_recommended INTEGER DEFAULT 0
);

CREATE TABLE IF NOT EXISTS neighborhoods (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    name VARCHAR(150) NOT NULL,
    category VARCHAR(50) NOT NULL, -- Student Hub, IT Hub, Budget Residential, Central
    avg_rent_single VARCHAR(50),
    avg_rent_sharing VARCHAR(50),
    nearest_metro VARCHAR(150),
    safety_rating DECIMAL(2,1) DEFAULT 4.5,
    vibe_description TEXT,
    pros TEXT,
    cons TEXT
);

CREATE TABLE IF NOT EXISTS accommodations (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    neighborhood_id INTEGER,
    name VARCHAR(150) NOT NULL,
    type VARCHAR(50) NOT NULL, -- Boys PG, Girls PG, Co-living, Student Hostel, 1RK/Flat
    sharing_type VARCHAR(50) NOT NULL, -- Single, Double, Triple
    monthly_rent INTEGER NOT NULL,
    security_deposit INTEGER NOT NULL,
    food_included INTEGER DEFAULT 0,
    ac_available INTEGER DEFAULT 0,
    wifi_included INTEGER DEFAULT 1,
    power_backup INTEGER DEFAULT 1,
    address TEXT NOT NULL,
    landmark VARCHAR(150),
    contact_phone VARCHAR(50),
    verified INTEGER DEFAULT 1,
    inspection_tip TEXT
);

CREATE TABLE IF NOT EXISTS food_services (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    neighborhood_id INTEGER,
    name VARCHAR(150) NOT NULL,
    service_type VARCHAR(50) NOT NULL, -- Tiffin Service, Student Mess, RO Water Supply, Laundry Hub
    pricing_info VARCHAR(100) NOT NULL,
    food_type VARCHAR(50), -- Pure Veg, Veg/Non-Veg
    contact_phone VARCHAR(50),
    address TEXT,
    highlights TEXT,
    safety_hygiene_tip TEXT
);

CREATE TABLE IF NOT EXISTS scam_alerts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    phase_category VARCHAR(50) NOT NULL, -- Travel, Accommodation, Food & Living, Job & Money
    title VARCHAR(200) NOT NULL,
    severity VARCHAR(20) DEFAULT 'High', -- Critical, High, Medium
    modus_operandi TEXT NOT NULL,
    red_flags TEXT NOT NULL,
    protection_steps TEXT NOT NULL,
    victim_helpline VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS community_reports (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL DEFAULT 1,
    scam_category VARCHAR(50) NOT NULL,
    scammer_identity VARCHAR(150),
    scammer_contact VARCHAR(100),
    location_area VARCHAR(150) NOT NULL,
    financial_loss VARCHAR(50),
    description TEXT NOT NULL,
    date_reported DATETIME DEFAULT CURRENT_TIMESTAMP,
    status VARCHAR(20) DEFAULT 'Approved'
);

CREATE TABLE IF NOT EXISTS emergency_contacts (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    city_id INTEGER NOT NULL,
    department VARCHAR(100) NOT NULL,
    helpline_number VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL, -- Police, Women Safety, Cybercrime, Medical, Helpline
    hours VARCHAR(50) DEFAULT '24/7',
    description TEXT
);
