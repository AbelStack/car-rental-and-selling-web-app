<?php
echo "<h2>🎉 Car Rental System - Test Page</h2>";
echo "<p>✅ PHP is working! (Version: " . PHP_VERSION . ")</p>";
echo "<p>✅ Current directory: " . __DIR__ . "</p>";

// Test database connection
try {
    $pdo = new PDO('mysql:host=127.0.0.1;dbname=rental_project', 'root', '');
    echo "<p>✅ Database connection successful!</p>";
    
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM vehicles');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✅ Vehicles in database: " . $result['count'] . "</p>";
    
    $stmt = $pdo->query('SELECT COUNT(*) as count FROM users');
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<p>✅ Users in database: " . $result['count'] . "</p>";
    
} catch (Exception $e) {
    echo "<p>❌ Database error: " . $e->getMessage() . "</p>";
}

echo "<hr>";
echo "<h3>🚀 Ready to Launch!</h3>";
echo "<p><strong><a href='/rental-project/public' style='color: blue; font-size: 18px;'>🏠 Go to Home Page</a></strong></p>";
echo "<p><a href='/rental-project/public/rent' style='color: green;'>🚗 View Rental Cars</a></p>";
echo "<p><a href='/rental-project/public/buy' style='color: orange;'>🛒 View Cars for Sale</a></p>";
echo "<p><a href='/rental-project/public/login' style='color: purple;'>🔐 Login</a></p>";
echo "<p><a href='/rental-project/public/register' style='color: red;'>📝 Register</a></p>";

echo "<hr>";
echo "<h3>🎬 Animation System Features:</h3>";
echo "<ul>";
echo "<li>✨ Hero section with staggered text animations</li>";
echo "<li>🎯 Vehicle cards with entrance animations (100ms stagger)</li>";
echo "<li>🎮 3D car viewer with Three.js (drag to rotate, zoom)</li>";
echo "<li>📊 Dashboard counter animations (count up effect)</li>";
echo "<li>🎨 Micro-interactions (ripple effects, hover animations)</li>";
echo "<li>📱 Mobile-responsive with touch controls</li>";
echo "<li>♿ Accessibility support (reduced motion)</li>";
echo "</ul>";

echo "<p><em>The complete animation system is ready! Visit the pages above to see the animations in action.</em></p>";
?>