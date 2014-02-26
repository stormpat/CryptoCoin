<?php

require_once __DIR__ . '/vendor/autoload.php';

use CryptoCoin\CoinAddress;

$coin = CoinAddress::litecoin();

echo 'public  ' . '<strong>' . $coin['public'] . '<br></strong>';
echo 'private  ' . '<strong>' .$coin['private']. '</strong>';