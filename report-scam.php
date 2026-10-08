<?php
/**
 * Backend Handler for Submitting Scam Reports
 */
require_once __DIR__ . '/config/db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: scam-shield.php');
    exit;
}

$category = trim($_POST['scam_category'] ?? '');
$location = trim($_POST['location_area'] ?? '');
$identity = trim($_POST['scammer_identity'] ?? '');
$contact = trim($_POST['scammer_contact'] ?? '');
$loss = trim($_POST['financial_loss'] ?? '');
$description = trim($_POST['description'] ?? '');

// Validation
if (empty($category) || empty($location) || empty($description)) {
    header('Location: scam-shield.php?error=' . urlencode('Category, location, and description are required.'));
    exit;
}

try {
    $pdo = getDBConnection();
    $stmt = $pdo->prepare("INSERT INTO community_reports 
        (city_id, scam_category, scammer_identity, scammer_contact, location_area, financial_loss, description, status) 
        VALUES (1, ?, ?, ?, ?, ?, ?, 'Approved')");

    $stmt->execute([
        $category,
        $identity ?: 'Anonymous Scammer',
        $contact ?: 'Not Provided',
        $location,
        $loss ?: 'N/A',
        $description
    ]);

    header('Location: scam-shield.php?success=1#report');
    exit;
} catch (Exception $e) {
    header('Location: scam-shield.php?error=' . urlencode('Failed to submit report: ' . $e->getMessage()));
    exit;
}
