-- Seed data for Delhi NCR (Pilot City)

INSERT INTO cities (id, name, state, tagline, description, metro_system_name, is_active) VALUES
(1, 'Delhi NCR', 'Delhi / Haryana / UP', 'Your Complete Survival & Safety Guide for India''s Capital', 'Delhi NCR welcomes hundreds of thousands of students, job seekers, and professionals every year. Navigate transit, find honest housing, enjoy safe food, and stay shielded from notorious touts and rental fraud.', 'Delhi Metro (DMRC)', 1);

-- Arrival Points
INSERT INTO arrival_points (id, city_id, name, type, code, nearest_metro, exit_gate_tip, scam_warning, safe_transport_options) VALUES
(1, 1, 'New Delhi Railway Station (NDLS)', 'Railway Station', 'NDLS', 'New Delhi Metro (Yellow Line & Airport Express)', 'ALWAYS EXIT via AJMERI GATE (Platform 16 side) for direct air-conditioned skywalk to Delhi Metro and Prepaid Taxi. Avoid exiting towards Paharganj (Platform 1) at night if you are a newcomer.', 'Beware of touts claiming "All hotels in Paharganj are sealed/curfewed" or claiming to be official tourism counters. Never board unmetered private autos parked outside gate.', 'Delhi Metro Yellow Line, Airport Express Line, Official Delhi Police Prepaid Auto Booth.'),

(2, 1, 'IGI Airport Terminal 3 (T3)', 'Airport', 'DEL', 'IGI Airport Metro Station (Airport Express Line)', 'Follow the orange indoor transit signs directly to the underground Airport Express Metro station. For cabs, use official App Cab pickup zones (P3 parking) or Delhi Police Prepaid Taxi.', 'Avoid unauthorized "private airport taxi representatives" who approach you inside arrival corridors claiming cabs are on strike or your hotel has burnt down.', 'Airport Express Orange Line (Reaches Central Delhi in 19 mins for ₹60), Uber/Ola Pillar Pickup, Prepaid Black & Yellow Taxi.'),

(3, 1, 'Anand Vihar Railway Station & ISBT', 'Bus Terminal / Railway Station', 'ANVT', 'Anand Vihar ISBT Metro (Blue & Pink Line interchange)', 'Use the direct foot overbridge connecting platform 1 to the elevated Metro station. Do not cross the road at ground level with heavy luggage.', 'Private bus agents outside ISBT terminal quote inflated prices for Uttarakhand/UP buses. Always buy tickets from government counter inside.', 'Delhi Metro Blue Line (directly to CP/Rajiv Chowk) or Pink Line (Ring Road).'),

(4, 1, 'Hazrat Nizamuddin Railway Station', 'Railway Station', 'NZM', 'Sarai Kale Khan - Nizamuddin (Pink Line)', 'Take the dedicated pedestrian footbridge from Platform 1 side towards Sarai Kale Khan metro station or use the prepaid auto counter near the main porch.', 'Touts offering "cheap shared autos" often drop passengers mid-way or demand double fare upon arrival.', 'Pink Line Metro, Prepaid Auto Booth, Uber/Ola pickups.');

-- Transit Routes
INSERT INTO transit_routes (id, city_id, arrival_point_id, destination_area, transit_mode, approx_cost, travel_time, route_details, scam_tip, is_recommended) VALUES
(1, 1, 1, 'North Campus / Hudson Lane (DU Students)', 'Metro', '₹30', '18 mins', 'Board Yellow Line Metro from New Delhi Metro Station (Platform 2 towards Samaypur Badli). De-board at Vishwavidyalaya or GTB Nagar Station. Exit Gate 3 for Hudson Lane.', 'Do not take private autos from NDLS asking ₹250. Metro is ₹30, direct, and traffic-free.', 1),

(2, 1, 1, 'Mukherjee Nagar (UPSC Coaching Hub)', 'Metro + E-Rickshaw', '₹30 + ₹10', '25 mins', 'Yellow Line Metro from New Delhi to GTB Nagar Metro Station. From Gate 2, hop on a shared E-rickshaw to Batra Cinema / Mukherjee Nagar for exactly ₹10.', 'E-rickshaws have fixed ₹10 fare. Do not pay more than ₹10 per seat.', 1),

(3, 1, 1, 'Laxmi Nagar (CA / SSC Coaching Hub)', 'Metro', '₹30', '22 mins', 'Yellow Line from New Delhi to Rajiv Chowk (1 stop) -> Interchange to Blue Line towards Vaishali/Noida -> De-board at Laxmi Nagar Station.', 'Auto drivers will ask ₹300 citing "Yamuna bridge jam". Metro takes 20 minutes for ₹30.', 1),

(4, 1, 1, 'Noida Sector 62 (IT Hub)', 'Metro', '₹50', '48 mins', 'Yellow Line to Rajiv Chowk -> Interchange to Blue Line towards Electronic City -> De-board directly at Noida Sector 62 Station.', 'Avoid unauthorized private shared cabs near NDLS outside gate; they make multiple detours.', 1),

(5, 1, 2, 'New Delhi Central / Connaught Place', 'Airport Express Metro', '₹60', '19 mins', 'Board Orange Line Airport Express from T3 terminal -> Direct non-stop run to Shivaji Stadium / New Delhi station.', 'Private cabs charge ₹600-₹900 plus toll. Airport Express is ₹60 and super fast.', 1),

(6, 1, 1, 'Gurugram Cyber City (Corporate Hub)', 'Metro', '₹60', '52 mins', 'Yellow Line from New Delhi directly towards Millennium City Centre -> De-board at Sikanderpur -> Interchange to Rapid Metro for Cyber City.', 'Cabs during peak rush hour take 2 hours and cost ₹700+. Metro is predictable and clean.', 1);

-- Neighborhoods
INSERT INTO neighborhoods (id, city_id, name, category, avg_rent_single, avg_rent_sharing, nearest_metro, safety_rating, vibe_description, pros, cons) VALUES
(1, 1, 'North Campus (Hudson Lane / Vijay Nagar / Kamla Nagar)', 'Student Hub', '₹12,000 - ₹18,000', '₹7,000 - ₹11,000', 'GTB Nagar & Vishwavidyalaya (Yellow Line)', 4.6, 'Lively student hotspot filled with cafes, bookstores, libraries, and college energy. High pedestrian footfall day and night.', 'Extremely safe, 2-minute walk to metro, endless food joints, student discounts everywhere.', 'Rooms can be compact, high broker demand in July-August.'),

(2, 1, 'Mukherjee Nagar', 'Student Hub', '₹8,000 - ₹14,000', '₹4,500 - ₹7,500', 'GTB Nagar (Yellow Line)', 4.4, 'The epicentre of civil services and competitive exam prep. Quiet study atmosphere, countless 24/7 reading libraries and print shops.', 'Affordable rent, pocket-friendly home-style mess, study-oriented peer group.', 'Crowded lanes, water pressure issues in older buildings.'),

(3, 1, 'Laxmi Nagar & Nirman Vihar', 'Budget Residential', '₹7,000 - ₹12,000', '₹4,000 - ₹6,500', 'Laxmi Nagar / Nirman Vihar (Blue Line)', 4.2, 'East Delhi''s most popular student and entry-level professional hub. Inexpensive street food and low living expenses.', 'Lowest security deposits, 5-minute metro access, very budget friendly.', 'Densely populated, narrow streets, parking is difficult.'),

(4, 1, 'Satya Niketan (South Campus)', 'Student Hub', '₹10,000 - ₹16,000', '₹6,500 - ₹9,500', 'Durgabai Deshmukh South Campus (Pink Line)', 4.5, 'Primary hub for South Delhi university students. Trendy cafes, modern PGs, and great connectivity across South Delhi.', 'Safe residential vibe, excellent cafe culture, proximity to Ring Road.', 'Prices peak right before university semester starts.'),

(5, 1, 'Noida Sector 62 & 63', 'IT Hub', '₹11,000 - ₹17,000', '₹6,000 - ₹9,500', 'Noida Electronic City / Sector 62 (Blue Line)', 4.4, 'Spacious corporate and engineering college zone with modern gated apartment complexes and co-living spaces.', 'Wide clean roads, power backup guaranteed in almost all PGs, peaceful.', 'Requires e-rickshaw for interior sectors, food delivery dependent.'),

(6, 1, 'DLF Phase 3 & Sikanderpur (Gurugram)', 'IT Hub', '₹14,000 - ₹22,000', '₹8,000 - ₹13,000', 'Sikanderpur (Yellow Line & Rapid Metro)', 4.3, 'Adjacent to Cyber City, Cyber Hub, and corporate headquarters. Fast-paced working professional culture.', 'Walking distance to major IT parks, 24/7 delivery and grocery availability.', 'Electricity bills charged on private meter slabs; always verify rates before signing.');

-- Accommodations
INSERT INTO accommodations (id, city_id, neighborhood_id, name, type, sharing_type, monthly_rent, security_deposit, food_included, ac_available, wifi_included, power_backup, address, landmark, contact_phone, verified, inspection_tip) VALUES
(1, 1, 1, 'Greenwood Scholars Co-living', 'Co-living', 'Double', 8500, 8500, 1, 1, 1, 1, 'Plot 42, Hudson Lane, Kingsway Camp', 'Near GTB Nagar Gate 3', '+91 98110 24510', 1, 'Inspect the 3-meal menu, water dispenser filter date, and check if electricity is fixed or sub-metered.'),

(2, 1, 1, 'Shree Durga Girls Premium Residency', 'Girls PG', 'Double', 9500, 9500, 1, 1, 1, 1, 'H-Block, Vijay Nagar Single Storey', 'Behind Batra Sweets', '+91 98730 19283', 1, 'Confirm curfew timing, biometric access, and whether guest parents are allowed visiting hours.'),

(3, 1, 2, 'Sankalp Boys Hostel & Study PG', 'Boys PG', 'Triple', 5500, 5500, 1, 0, 1, 1, 'B-12, Commercial Complex, Mukherjee Nagar', 'Behind Batra Cinema', '+91 98912 34091', 1, 'Ask for electricity unit rate. Government domestic rate is ₹6-8/unit; do not accept ₹14/unit.'),

(4, 1, 3, 'Bright Future Student Nest', 'Boys PG', 'Double', 6000, 6000, 1, 0, 1, 1, 'Street No. 4, Guru Ram Dass Nagar, Laxmi Nagar', 'Near Laxmi Nagar Metro Gate 1', '+91 98104 55192', 1, 'Ensure rent agreement is on paper with 1-month notice clause clearly specified.'),

(5, 1, 4, 'South Point Executive Stays', 'Co-living', 'Single', 13500, 13500, 1, 1, 1, 1, 'House 114, Satya Niketan', 'Opposite Venkateswara College', '+91 97118 66201', 1, 'Check Wi-Fi speed and verify that laundry machine usage has no hidden extra tokens.'),

(6, 1, 5, 'TechPark Living PG', 'Boys PG', 'Double', 7500, 7500, 1, 1, 1, 1, 'C-Block, Sector 62, Noida', 'Near JSS Academy & Stellar IT Park', '+91 99991 88472', 1, 'Ask if power backup covers AC during summer cuts or only fans and lights.');

-- Food Services & Daily Essentials
INSERT INTO food_services (id, city_id, neighborhood_id, name, service_type, pricing_info, food_type, contact_phone, address, highlights, safety_hygiene_tip) VALUES
(1, 1, 1, 'Maa Annapurna Daily Tiffin Express', 'Tiffin Service', '₹2,800 / month (Lunch + Dinner)', 'Pure Veg', '+91 98112 33490', 'Hudson Lane, Kingsway Camp', 'Homestyle 4 rotis, seasonal subzi, dal, rice & salad. Stainless steel thermal dabbas.', 'Always ask for a 2-day paid trial before committing to full month advance payment.'),

(2, 1, 2, 'Bhojanam Homestyle Mess', 'Student Mess', '₹3,200 / month (3 Meals Unlimited)', 'Pure Veg', '+91 98188 77610', 'Main Market, Mukherjee Nagar', 'Unlimited thali system, pure ghee tadka, special Sunday feast (Paneer/Kheer).', 'Check kitchen hygiene in the afternoon when peak cooking occurs.'),

(3, 1, 3, 'Ganga Pure RO Water 20L Supply', 'RO Water Supply', '₹35 per 20-Litre Can', 'Mineral Water', '+91 98711 00412', 'Vikas Marg, Laxmi Nagar', 'Doorstep delivery up to 4th floor, sealed caps with ISI mark.', 'Never drink tap water directly in old areas without a purifier or boiled.'),

(4, 1, 5, 'QuickWash Laundromat & Pressing', 'Laundry Hub', '₹70 / kg (Wash, Dry & Iron)', 'Daily Laundry', '+91 99105 44820', 'Market Block B, Sector 62 Noida', '24-hour turnaround, antibacterial wash, eco-friendly detergents.', 'Count clothes and get a physical/digital receipt before leaving.');

-- Scam Alerts (Categorized by Phase)
INSERT INTO scam_alerts (id, city_id, phase_category, title, severity, modus_operandi, red_flags, protection_steps, victim_helpline) VALUES
(1, 1, 'Travel', 'The "Paharganj Hotel Sealed / Road Curfew" Scam', 'Critical', 'When you arrive at New Delhi Railway Station (Platform 1) or Airport, fake auto drivers, touts, or men posing as "Government Tourism Officers" tell you that your hotel is demolished, under curfew, or burned down. They steer you to an overpriced partner hotel where they charge ₹5,000/night for a dingy room.', 'Tout approaches without being asked, insists on calling a fake hotel number on his own phone, claims road is shut.', 'Call your booked hotel directly on your phone. Insist on being taken to the exact destination or take the Delhi Metro directly.', 'Delhi Police Helpline: 112 / 011-23340000'),

(2, 1, 'Travel', 'Auto Meter Tampering & Flat "Rain/Night" Fare Fraud', 'High', 'Auto drivers outside railway stations and metro stations refuse to use electronic fare meters, asking ₹300-₹500 for a ₹70-₹120 distance, claiming high traffic, night surcharge, or broken meter.', 'Driver refuses to start the digital meter; quotes flat round number before you sit.', 'Use the official Delhi Police Prepaid Auto Booth located right outside the exit gate, or book through Rapido/Uber/Ola auto where fares are capped.', 'Delhi Traffic Police WhatsApp: 8750871493'),

(3, 1, 'Accommodation', 'The "Visiting Pass / Gate Entry Pass" OLX & Social Media Deposit Scam', 'Critical', 'Scammer posts photos of a luxury, fully-furnished flat or PG at an impossibly low rent (e.g. 2BHK in South Delhi for ₹10,000). When you message, they claim to be an Indian Army Officer, CISF, or NRI owner. They tell you: "Before coming for visit, you must pay ₹1,500-₹2,000 for a digital gate entry pass via QR code which will be refunded immediately". Once you pay, they block you.', 'Rent is 50% below market average; Landlord refuses physical meeting; Requests any amount of money before you physically step inside the room.', 'RULE OF GOLD: NEVER transfer a single rupee (no token, no visiting charge, no gate pass) without meeting the landlord physically inside the room.', 'National Cyber Crime Helpline: 1930 (cybercrime.gov.in)'),

(4, 1, 'Accommodation', 'The Sub-Meter Electricity Overcharge Trap', 'High', 'Landlord promises low monthly rent, but at the end of the month slaps an electricity bill of ₹12 to ₹16 per unit on a private sub-meter, resulting in unexpected ₹4,000-₹7,000 bills for a single room.', 'No commercial/domestic bill shown; landlord casually says "bill as per meter" without writing unit price.', 'Demand in writing on the agreement that electricity will be charged strictly at standard government domestic slab or a fixed agreed rate (max ₹7-8/unit).', 'Delhi Electricity Regulatory Commission (DERC)'),

(5, 1, 'Accommodation', 'Security Deposit Forfeiture & Fake Maintenance Deductions', 'High', 'When moving out, landlord invents fake paint damage, plumbing leaks, or demands 2-month notice instead of agreed 1 month, refusing to return the ₹10,000-₹20,000 security deposit.', 'Landlord refuses to sign a written stamp-paper agreement; promises to "adjust later verbally".', 'Always get a signed rent agreement stating: 1. Exact deposit amount, 2. Refund timeline (max 7 days of moving out), 3. Video record the room condition on day 1 as proof.', 'Delhi Rent Control / Consumer Forum Helpline: 1915'),

(6, 1, 'Food & Living', 'Advance Tiffin Disappearance Scam', 'Medium', 'Fly-by-night tiffin operators distribute pamphlets offering cheap ₹2,000/month 3-meal subscriptions. They collect 1 month in advance, deliver food for 3-4 days, then shut their phone and vanish.', 'Operator has no physical kitchen address, only a mobile number on WhatsApp; demands cash or full month advance on day 1.', 'Only order from established tiffin centers; take a 3-day paid trial; never pay more than 7-15 days in advance initially.', 'National Consumer Helpline: 1915'),

(7, 1, 'Job & Money', 'Fake "Part-Time Hotel Review / Telegram Task" Scam', 'Critical', 'Newcomers in student hubs receive WhatsApp messages offering ₹3,000/day for writing Google reviews or liking YouTube videos. Scammers pay ₹200 initially to build trust, then trap the victim into "prepaid investment tasks" wiping out thousands of rupees.', 'Unsolicited WhatsApp message from international or unknown number offering instant easy money.', 'Legitimate companies NEVER ask you to deposit money to earn salary. Block and report immediately.', 'National Cyber Crime Helpline: 1930');

-- Community Reports
INSERT INTO community_reports (id, city_id, scam_category, scammer_identity, scammer_contact, location_area, financial_loss, description, status) VALUES
(1, 1, 'Accommodation', 'Fake Broker posing as "Captain Rajesh Sharma"', '+91 99882 12399', 'North Campus / Hudson Lane', '₹2,500', 'Posted a luxury 1BHK on Facebook Marketplace for ₹8,000. Asked for ₹2,500 "Army Cantonment Visitor Pass" to enter gate. Phone went switched off right after UPI payment.', 'Approved'),

(2, 1, 'Travel', 'Auto Driver DL-1RA-8492', 'DL-1RA-8492', 'New Delhi Railway Station (Paharganj Exit)', '₹450', 'Demanded ₹500 for dropping to Connaught Place (1.5 km). Refused meter and became aggressive. Police kiosk at Ajmeri gate intervened.', 'Approved'),

(3, 1, 'Accommodation', 'Private PG Landlord in Chhatarpur', '+91 98114 99012', 'Chhatarpur Enclave', '₹12,000', 'Refused to return 1-month security deposit when moving out after 6 months with proper 30-day notice. Claimed whole room needed fresh paint.', 'Approved');

-- Emergency Contacts
INSERT INTO emergency_contacts (id, city_id, department, helpline_number, category, hours, description) VALUES
(1, 1, 'National Emergency Response System', '112', 'Police', '24/7', 'Unified emergency number for immediate Police, Fire, and Ambulance response.'),
(2, 1, 'Delhi Police Control Room', '100 / 112', 'Police', '24/7', 'Direct PCR van dispatch across National Capital Region.'),
(3, 1, 'Delhi Police Women Safety Helpline', '1091', 'Women Safety', '24/7', 'Toll-free dedicated assistance for female students, working women, and travelers in distress.'),
(4, 1, 'National Cyber Crime Helpline', '1930', 'Cybercrime', '24/7', 'Immediate financial fraud reporting (freeze unauthorized UPI/bank transfers within golden hour).'),
(5, 1, 'Delhi Metro Rail Corporation (DMRC) Helpline', '155370', 'Transit', '06:00 AM - 11:00 PM', 'Metro route info, lost-and-found, harassment reporting on trains or platforms.'),
(6, 1, 'National Consumer Helpline (NCH)', '1915', 'Helpline', '08:00 AM - 08:00 PM', 'File legal consumer grievances against defaulting PG landlords, brokers, or fraudulent services.');
