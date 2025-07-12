<?php
/**
 * PHPMailer SPL autoloader.
 * PHP Version 5+
 * package PHPMailer
 * link https://github.com/PHPMailer/PHPMailer/ The PHPMailer GitHub project
 */

/**
 * PHPMailer SPL autoloader.
 * param string $classname The name of the class to load
 */
function PHPMailerAutoload($classname)
{
    $filename = __DIR__ . DIRECTORY_SEPARATOR . 'class.' . strtolower($classname) . '.php';
    if (is_readable($filename)) {
        require $filename;
    }
}

// Ensure SPL Autoloading is Available
if (version_compare(PHP_VERSION, '5.1.2', '>=')) {
    spl_autoload_register('PHPMailerAutoload', true, true);
} else {
    die("Error: PHP version too old for SPL autoloading.");
}
?>
