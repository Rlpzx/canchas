<?php
require 'vendor/autoload.php';

$app = require 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$reflection = new ReflectionClass($kernel);

// Revisar middlewares globales
$property = $reflection->getProperty('middleware');
$property->setAccessible(true);
$middleware = $property->getValue($kernel);

echo "\n=== Middlewares Globales ===\n";
print_r($middleware);

// Revisar middlewares de rutas
if ($reflection->hasProperty('routeMiddleware')) {
    $property = $reflection->getProperty('routeMiddleware');
    $property->setAccessible(true);
    $routeMiddleware = $property->getValue($kernel);

    echo "\n=== Middlewares de Rutas ===\n";
    print_r($routeMiddleware);
} else {
    echo "\nNo se encontró la propiedad 'routeMiddleware' en Kernel.\n";
}
