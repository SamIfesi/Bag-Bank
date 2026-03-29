<?php

class Session
{
    /**
     * Inactivity threshold in seconds.
     * 600 = 10 minutes.  Change this single constant to adjust for the
     * whole application.
     */
    private const TIMEOUT_SECONDS = 600;

    public static function start(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        self::check_timeout();
    }

    /**
     * Destroy the current session completely, clearing all stored data.
     */
    public static function stop(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        session_unset();
        session_destroy();
    }

    /**
     * Remove a single value from the session.
     */
    public static function delete(string $session_name): void
    {
        unset($_SESSION[$session_name]);
    }

    /**
     * Store a value in the session.
     */
    public static function set(string $key, mixed $value): void
    {
        $_SESSION[$key] = $value;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return $_SESSION[$key] ?? $default;
    }

    public static function has(string $key): bool
    {
        return isset($_SESSION[$key]);
    }

    public static function check_timeout(): void
    {
        if (isset($_SESSION['last_activity'])) {
            $inactive = time() - (int) $_SESSION['last_activity'];

            if ($inactive > self::TIMEOUT_SECONDS) {
                // Wipe session data before destroying so nothing leaks
                session_unset();
                session_destroy();
                header('Location: /views/login.php?timeout=1');
                exit;
            }
        }

        // Refresh the inactivity clock
        $_SESSION['last_activity'] = time();
    }
}