<?php 

/**
 * @ Display Errors, Dev Only ::
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once __DIR__ . '/../iio/InstanceIO.php';

echo (new IIO('live'))->Go();