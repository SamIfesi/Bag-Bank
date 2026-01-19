<?php

/**
 * Load environment variables from .env file or Railway environment
 * This allows the app to work with both local and hosting databases
 */
function loadEnv($filePath)
{
    // If .env file doesn't exist, we're likely on a hosting platform
    // that sets environment variables directly (like Railway)
    if (!file_exists($filePath)) {
        return;
    }

    $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse KEY=VALUE
        if (strpos($line, '=') !== false) {
            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Remove quotes if present
            if ((strpos($value, '"') === 0 && strrpos($value, '"') === strlen($value) - 1) ||
                (strpos($value, "'") === 0 && strrpos($value, "'") === strlen($value) - 1)
            ) {
                $value = substr($value, 1, -1);
            }

            $_ENV[$key] = $value;
            putenv("$key=$value");
        }
    }
}

// Load .env from project root (local development)
loadEnv(__DIR__ . '/../.env');

// On hosting platforms like Railway, environment variables are already available
// They'll be automatically loaded into $_ENV and accessible via getenv()
// No additional action needed - they're already available!
