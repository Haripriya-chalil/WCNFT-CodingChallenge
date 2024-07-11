<?php
$autoloadPath = dirname(__DIR__) . '/vendor/autoload.php';
function loadEnv($filePath) {
    if (!file_exists($filePath)) {
        throw new Exception('.env file not found');
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        // Remove surrounding quotes
        $value = trim($value, "'\"");
        
        $_ENV[$key] = $value;
    }
}

// Load the environment variables
loadEnv(__DIR__ . '/.env');
?>
