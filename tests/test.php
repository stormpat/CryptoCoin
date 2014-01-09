<?php

require_once __DIR__ . '/../vendor/autoload.php';

use CryptoCoin\CoinAddress;

CoinAddress::set_debug(false);
CoinAddress::set_reuse_keys(true);

print "Math library: " . USE_EXT . "\n";
print "Reuse keys: " . ( CoinAddress::$reuse_keys ? 'true' : 'false' ) . "\n";
print "Debug: " . ( CoinAddress::$debug? 'true' : 'false' ) . "\n";

$start = microtime(1);

// START TEST

$coin = CoinAddress::bitcoin();          coin_info('Bitcoin', $coin);
$coin = CoinAddress::bbqcoin();          coin_info('BBQcoin', $coin);
$coin = CoinAddress::bitbar();           coin_info('Bitbar', $coin);
$coin = CoinAddress::bytecoin();         coin_info('Bytecoin', $coin);
$coin = CoinAddress::chncoin();          coin_info('CHNcoin', $coin);
$coin = CoinAddress::devcoin();          coin_info('Devcoin', $coin);
//$coin = CoinAddress::fairbrix();       coin_info('Fairbrix', $coin);
$coin = CoinAddress::feathercoin();      coin_info('Feathercoin', $coin);
$coin = CoinAddress::freicoin();         coin_info('Freicoin', $coin);
//$coin = CoinAddress::ixcoin();         coin_info('IXcoin', $coin);
$coin = CoinAddress::junkcoin();         coin_info('Junkcoin', $coin);
$coin = CoinAddress::litecoin();         coin_info('Litecoin', $coin);
$coin = CoinAddress::mincoin();          coin_info('Mincoin', $coin);
$coin = CoinAddress::namecoin();         coin_info('Namecoin', $coin);
$coin = CoinAddress::novacoin();         coin_info('Novacoin', $coin);
$coin = CoinAddress::onecoin();          coin_info('Onecoin', $coin);
$coin = CoinAddress::ppcoin();           coin_info('PPCoin', $coin);
//$coin = CoinAddress::royalcoin();      coin_info('Royalcoin', $coin);
$coin = CoinAddress::smallchange();      coin_info('Smallchange', $coin);
$coin = CoinAddress::terracoin();        coin_info('Terracoin', $coin);
$coin = CoinAddress::yacoin();           coin_info('Yacoin', $coin);

$coin = CoinAddress::bitcoin_testnet();     coin_info('Bitcoin Testnet', $coin);
$coin = CoinAddress::bbqcoin_testnet();     coin_info('BBQcoin Testnet', $coin);
$coin = CoinAddress::bitbar_testnet();      coin_info('Bitbar Testnet', $coin);
// all other coin testnets uses Bitcoin prefixes

$public_prefix  = '0x' . dechex( mt_rand(0,255) );
$private_prefix = '0x' . dechex( mt_rand(0,255) );
$coin = CoinAddress::generic( $public_prefix, $private_prefix);  coin_info('Random', $coin);

// END TEST

$end = microtime(1);
$duration = $end - $start;
$duration = round($duration,8);
print "\nTest Time: $duration seconds\n";
exit;


//////////////////////////////////////////////
function coin_info($name,$coin) {
    print "<br><strong>" . $name . "</strong>";
    print " [ prefix_public: " . CoinAddress::$prefix_public;
    print "  prefix_private: " . CoinAddress::$prefix_private . " ]<br>";
    print "uncompressed:<br>";
    print 'public (base58): ' . $coin['public'] . "<br>";
    print 'public (Hex)   : ' . $coin['public_hex'] . "<br>";
    print 'private (WIF)  : ' . $coin['private'] . "<br>";
    print 'private (Hex)  : ' . $coin['private_hex'] . "<br>";
    print "compressed:<br>";
    print 'public (base58): ' . $coin['public_compressed'] . "<br>";
    print 'public (Hex)   : ' . $coin['public_compressed_hex'] . "<br>";
    print 'private (WIF)  : ' . $coin['private_compressed'] . "<br>";
    print 'private (Hex)  : ' . $coin['private_compressed_hex'] . "<br>";
}

