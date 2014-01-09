<?php

require_once __DIR__ . '/vendor/autoload.php';

use CryptoCoin\CoinAddress;



$time_start = microtime(true);

$coin = CoinAddress::litecoin();

echo 'Total execution time in seconds: ' . (microtime(true) - $time_start);