<?php
declare(strict_types=1);
require __DIR__ . '/includes/bootstrap.php';
header('Content-Type: text/plain; charset=utf-8');
$b = BASE_URL;
echo "User-agent: *\n";
echo "Disallow: {$b}/admin/\n";
echo "Disallow: {$b}/includes/\n";
echo "Disallow: {$b}/database/\n";
echo "Disallow: {$b}/setup.php\n";
echo "Allow: {$b}/\n\n";
echo 'Sitemap: ' . abs_url($b . '/sitemap.xml') . "\n";
