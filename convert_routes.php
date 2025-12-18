<?php

/**
 * Laravel 5.0 to Laravel 11 Routes Converter
 * This script converts old routes syntax to new syntax
 */

$oldRoutesFile = __DIR__ . '/app/Http/routes.php';
$newRoutesFile = __DIR__ . '/routes/web_converted.php';

if (!file_exists($oldRoutesFile)) {
    die("Old routes file not found!\n");
}

$content = file_get_contents($oldRoutesFile);

// Conversion patterns
$patterns = [
    // Input::get() -> $request->input()
    "/Input::get\('([^']+)'\)/i" => "\$request->input('$1')",
    "/Input::hasFile\('([^']+)'\)/i" => "\$request->hasFile('$1')",
    "/Input::file\('([^']+)'\)/i" => "\$request->file('$1')",
    
    // Redirect::to() -> redirect()->to()
    "/Redirect::to\(/i" => "redirect()->to(",
    "/Redirect::back\(\)/i" => "redirect()->back()",
    
    // View::make() -> view()
    "/View::make\(/i" => "view(",
    
    // Auth::user() stays the same but add use statement
    
    // Route::group -> Route::middleware()->group
    "/Route::group\(\['middleware' => '([^']+)'\], function \(\) \{/i" => "Route::middleware(['$1'])->group(function () {",
    
    // Route::resource stays mostly the same but needs controller class
    "/Route::resource\('([^']+)', '([^']+)'\)/i" => "Route::resource('$1', \\App\\Http\\Controllers\\$2::class)",
    
    // Route::get/post with controller@method -> [Controller::class, 'method']
    "/Route::(get|post|put|delete|patch)\('([^']+)', '([^@]+)@([^']+)'\)/i" => "Route::$1('$2', [\\App\\Http\\Controllers\\$3::class, '$4'])",
];

// Apply conversions
foreach ($patterns as $pattern => $replacement) {
    $content = preg_replace($pattern, $replacement, $content);
}

// Add use statements at the top
$useStatements = "<?php\n\n";
$useStatements .= "use Illuminate\\Support\\Facades\\Route;\n";
$useStatements .= "use Illuminate\\Http\\Request;\n";
$useStatements .= "use Illuminate\\Support\\Facades\\Auth;\n";
$useStatements .= "use Carbon\\Carbon;\n";
$useStatements .= "use App\\Helpers\\GeoHelper;\n";
$useStatements .= "use App\\Helpers\\StringHelper;\n\n";

// Remove old <?php and use statements
$content = preg_replace('/<\?php\s*/', '', $content, 1);
$content = preg_replace('/use [^;]+;\\n*/i', '', $content);

// Combine
$finalContent = $useStatements . trim($content);

// Save
file_put_contents($newRoutesFile, $finalContent);

echo "✅ Conversion complete!\n";
echo "📁 Output: routes/web_converted.php\n";
echo "📊 Please review and test the converted routes.\n";
