<?php

require_once __DIR__ . '/vendor/autoload.php';

use CryptoCoin\CoinAddress;

$coin = CoinAddress::bitcoin();

var_dump($coin);
