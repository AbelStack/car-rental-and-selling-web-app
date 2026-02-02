<?php

/**
 * Debug script to identify the source of the GET request to Chapa payment route
 */

echo "🔍 DEBUGGING PURCHASE FLOW ISSUE\n";
echo "================================\n\n";

// Check if there are any cached routes
echo "1. Checking Route Cache...\n";
if (file_exists('bootstrap/cache/routes-v7.php')) {
    echo "   ⚠️  Route cache exists - this might be causing issues\n";
    echo "   💡 Run: php artisan route:clear\n";
} else {
    echo "   ✅ No route cache found\n";
}

// Check if there are any cached views
echo "\n2. Checking View Cache...\n";
if (file_exists('storage/framework/views') && count(glob('storage/framework/views/*.php')) > 0) {
    echo "   ⚠️  Compiled views exist - might contain old code\n";
    echo "   💡 Run: php artisan view:clear\n";
} else {
    echo "   ✅ No compiled views found\n";
}

// Check if there are any cached configs
echo "\n3. Checking Config Cache...\n";
if (file_exists('bootstrap/cache/config.php')) {
    echo "   ⚠️  Config cache exists\n";
    echo "   💡 Run: php artisan config:clear\n";
} else {
    echo "   ✅ No config cache found\n";
}

// Check the current routes
echo "\n4. Checking Current Routes...\n";
echo "   📋 Purchase routes should be:\n";
echo "      GET  /purchase/{vehicle} → purchases.create\n";
echo "      POST /purchase/{vehicle} → purchases.store\n";
echo "      GET  /purchase-details/{purchase} → purchases.show\n";
echo "      POST /chapa/purchase/{purchase}/pay → chapa.purchase.pay\n";

// Check for potential issues in the purchase controller
echo "\n5. Checking PurchaseController...\n";
$controllerFile = 'app/Http/Controllers/PurchaseController.php';
if (file_exists($controllerFile)) {
    $content = file_get_contents($controllerFile);
    
    // Check for any direct redirects to chapa routes
    if (strpos($content, 'chapa.purchase.pay') !== false) {
        echo "   ⚠️  Found reference to chapa.purchase.pay in PurchaseController\n";
        echo "   💡 This might be causing the issue\n";
    } else {
        echo "   ✅ No direct chapa route references found\n";
    }
    
    // Check for proper redirect
    if (strpos($content, 'purchases.show') !== false) {
        echo "   ✅ Found redirect to purchases.show\n";
    } else {
        echo "   ❌ No redirect to purchases.show found\n";
    }
} else {
    echo "   ❌ PurchaseController not found\n";
}

// Check for browser cache issues
echo "\n6. Browser Cache Issues...\n";
echo "   💡 The error might be caused by:\n";
echo "      - Browser cached old JavaScript/HTML\n";
echo "      - Old service worker caching\n";
echo "      - Laravel route/view cache\n";
echo "      - Old compiled views\n";

echo "\n🔧 RECOMMENDED FIXES:\n";
echo "=====================\n";
echo "1. Clear all Laravel caches:\n";
echo "   php artisan route:clear\n";
echo "   php artisan view:clear\n";
echo "   php artisan config:clear\n";
echo "   php artisan cache:clear\n";
echo "\n";
echo "2. Clear browser cache:\n";
echo "   - Hard refresh (Ctrl+F5)\n";
echo "   - Clear browser cache and cookies\n";
echo "   - Try incognito/private mode\n";
echo "\n";
echo "3. Check for any remaining direct links:\n";
echo "   - Search for any <a href> tags pointing to chapa routes\n";
echo "   - Check for JavaScript redirects\n";
echo "   - Verify all forms use POST method\n";

echo "\n🎯 NEXT STEPS:\n";
echo "==============\n";
echo "1. Run the cache clearing commands above\n";
echo "2. Test in incognito mode\n";
echo "3. Check browser developer tools for the exact source of the GET request\n";
echo "4. If issue persists, check for any middleware redirects\n";

echo "\n✅ DEBUG COMPLETE\n";