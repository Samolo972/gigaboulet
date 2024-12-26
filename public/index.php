<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Favicon -->
    <link rel="icon" type="image/png"href="https://gigaboulet.org/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="https://gigaboulet.org/favicon/favicon.svg" />
    <link rel="shortcut icon" href="https://gigaboulet.org/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="https://gigaboulet.org/favicon/apple-touch-icon.png" />
    <link rel="manifest" href="https://gigaboulet.org/favicon/site.webmanifest" />
    <title>Gigaboulet</title>

</head>
<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
