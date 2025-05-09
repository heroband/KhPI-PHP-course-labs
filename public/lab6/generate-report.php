<?php

$cacheFile = 'cache/report.html';
$cacheTime = 600;
if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
    echo file_get_contents($cacheFile);
    echo "<!-- from cache -->";
} else {
    sleep(3);
    ob_start();
    echo "<table border='1'>";
    for ($i = 0; $i < 1000; $i++) {
        echo "<tr><td>Ім'я $i</td><td>" . rand(100, 9999) . "</td><td>" . date('Y-m-d') . "</td></tr>";
    }
    echo "</table>";
    $report = ob_get_clean();

    if (!is_dir('cache')) {
        mkdir('cache', 0777, true);
    }

    file_put_contents($cacheFile, $report);
    echo $report;
    echo "<!-- generated -->";
}
?>