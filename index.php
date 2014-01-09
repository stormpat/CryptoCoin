<?php

require_once __DIR__ . '/vendor/autoload.php';

use CryptoCoin\CoinAddress;

$coin = CoinAddress::litecoin();

var_dump($coin);