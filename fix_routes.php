<?php

/**
 * Fix Laravel 11 Routes - Add Request injection to closures
 */

$file = __DIR__ . '/routes/web_converted.php';
$content = file_get_contents($file);

// Fix Route::resource with wrong controller references
$content = preg_replace(
    "/Route::resource\('([^']+)', \\\\App\\\\Http\\\\Controllers\\\\\\\$2::class\)/",
    "Route::resource('$1', \\App\\Http\\Controllers\\DataBahanMaterialController::class)",
    $content,
    1
);

$content = preg_replace(
    "/Route::resource\('datajenispemesanan', \\\\App\\\\Http\\\\Controllers\\\\\\\$2::class\)/",
    "Route::resource('datajenispemesanan', \\App\\Http\\Controllers\\DataJenisPemesananController::class)",
    $content
);

$content = preg_replace(
    "/Route::resource\('datakategoritukang', \\\\App\\\\Http\\\\Controllers\\\\\\\$2::class\)/",
    "Route::resource('datakategoritukang', \\App\\Http\\Controllers\\DataKategoriTukangController::class)",
    $content
);

// Fix controller method routes
$content = preg_replace(
    "/Route::get\('databahanmaterial\/\{id\}\/ubahstatus', \[\\\\App\\\\Http\\\\Controllers\\\\\\\$3::class, 'ubahstatus'\]\)/",
    "Route::get('databahanmaterial/{id}/ubahstatus', [\\App\\Http\\Controllers\\DataBahanMaterialController::class, 'ubahstatus'])",
    $content
);

// Add Request injection to all closure functions
// Pattern: function() { or function($param) {
$content = preg_replace_callback(
    '/Route::(get|post|put|delete|patch)\(([^,]+),\s*function\s*\(([^)]*)\)\s*\{/',
    function($matches) {
        $method = $matches[1];
        $route = $matches[2];
        $params = trim($matches[3]);
        
        // If already has Request, skip
        if (strpos($params, 'Request') !== false) {
            return $matches[0];
        }
        
        // Add Request $request
        if (empty($params)) {
            $newParams = 'Request $request';
        } else {
            $newParams = $params . ', Request $request';
        }
        
        return "Route::{$method}({$route}, function({$newParams}) {";
    },
    $content
);

// Save
file_put_contents($file, $content);

echo "✅ Routes fixed!\n";
echo "📁 File: routes/web_converted.php\n";
echo "✨ Added Request injection to all closures\n";
echo "✨ Fixed controller class references\n";
