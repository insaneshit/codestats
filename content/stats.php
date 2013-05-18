<?php
$username = htmlspecialchars(trim(system::$currentPage));

echo "<pre>";
print_r(system::$api->getAllData($username));
echo "</pre>";
?>