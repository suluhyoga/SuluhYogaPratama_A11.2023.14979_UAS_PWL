<?php
echo "<h2>Cek Extension GD</h2>";

if (extension_loaded('gd')) {
    echo "<p style='color: green;'><strong>✓ GD Extension SUDAH TERINSTALL</strong></p>";
    echo "<h3>Info GD:</h3>";
    print_r(gd_info());
} else {
    echo "<p style='color: red;'><strong>✗ GD Extension BELUM TERINSTALL</strong></p>";
    echo "<p>Anda perlu mengaktifkan extension GD di php.ini</p>";
}

echo "<hr>";
echo "<h3>Info PHP:</h3>";
echo "PHP Version: " . phpversion() . "<br>";
echo "Memory Limit: " . ini_get('memory_limit') . "<br>";
echo "Max Execution Time: " . ini_get('max_execution_time') . "<br>";

echo "<hr>";
echo "<h3>Loaded Extensions:</h3>";
$extensions = get_loaded_extensions();
if (in_array('gd', $extensions)) {
    echo "<p style='color: green;'>GD ditemukan dalam daftar extension!</p>";
} else {
    echo "<p style='color: red;'>GD TIDAK ditemukan dalam daftar extension!</p>";
}
?>