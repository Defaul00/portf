<?php
/**
 * Seeder Helper untuk Vercel
 * Akses via: https://your-domain.vercel.app/api/seed.php
 * 
 * PERINGATAN: Hapus file ini setelah seeding selesai untuk keamanan!
 */

require __DIR__.'/../public/index.php';

use Illuminate\Support\Facades\Artisan;

// Hanya izinkan jika ada token keamanan (opsional, bisa dihapus setelah seeding)
$token = $_GET['token'] ?? '';
$allowedToken = getenv('MIGRATION_TOKEN') ?: 'your-secret-token-here';

if ($token !== $allowedToken) {
    http_response_code(403);
    die('Unauthorized. Please provide valid token: ?token=your-secret-token-here');
}

header('Content-Type: text/plain');

try {
    echo "Starting database seeding...\n\n";
    
    // Run seeders
    Artisan::call('db:seed', ['--force' => true]);
    echo Artisan::output();
    
    echo "\n\nSeeding completed successfully!\n";
    echo "⚠️  IMPORTANT: Delete this file (api/seed.php) after seeding for security!\n";
    
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
}

