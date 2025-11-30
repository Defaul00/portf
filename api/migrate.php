<?php
/**
 * Migration Helper untuk Vercel
 * Akses via: https://your-domain.vercel.app/api/migrate.php
 * 
 * PERINGATAN: Hapus file ini setelah migration selesai untuk keamanan!
 */

require __DIR__.'/../public/index.php';

use Illuminate\Support\Facades\Artisan;

// Hanya izinkan jika ada token keamanan (opsional, bisa dihapus setelah migration)
$token = $_GET['token'] ?? '';
$allowedToken = getenv('MIGRATION_TOKEN') ?: 'your-secret-token-here';

if ($token !== $allowedToken) {
    http_response_code(403);
    die('Unauthorized. Please provide valid token: ?token=your-secret-token-here');
}

header('Content-Type: text/plain');

try {
    echo "Starting migration...\n\n";
    
    // Run migrations
    Artisan::call('migrate', ['--force' => true]);
    echo Artisan::output();
    
    echo "\n\nMigration completed successfully!\n";
    echo "⚠️  IMPORTANT: Delete this file (api/migrate.php) after migration for security!\n";
    
} catch (Exception $e) {
    http_response_code(500);
    echo "Error: " . $e->getMessage() . "\n";
    echo "\nStack trace:\n" . $e->getTraceAsString();
}

