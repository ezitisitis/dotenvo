<?php

if (!isset($argv[3])) {
    echo "Missing arguments";
    die();
}

$envFile = file($argv[1]);
$envArray = [];

foreach ($envFile as $line) {
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    $values = explode('=', $line, 2);
    if (isset($values[1])) {
        $envArray[$values[0]] = $values[1];
    }
}


$newEnvFile = file($argv[2]);
$newEnvArray = [];

foreach ($newEnvFile as $line) {
    $line = trim(preg_replace('/\s\s+/', ' ', $line));
    $values = explode('=', $line, 2);
    if (isset($values[1])) {
        $newEnvArray[$values[0]] = $values[1];
    }
}

$merged = array_merge($envArray, $newEnvArray);

foreach ($merged as $key => $value) {
    file_put_contents($argv[3], $key . '=' . $value . PHP_EOL, FILE_APPEND);
}
