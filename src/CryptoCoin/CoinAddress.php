<?php namespace CryptoCoin;

use CryptoCoin\Utils\BcmathUtils;

if (defined('MAX_BASE') && MAX_BASE != 256)
{
    print 'ERROR: MAX_BASE must be 256.';
    exit;
}
else
{
    define('MAX_BASE', 256);
}
if (!defined('USE_EXT'))
{
    if (extension_loaded('gmp'))
    {
        define('USE_EXT', 'GMP');
    }
    else if (extension_loaded('bcmath'))
    {
        define('USE_EXT', 'BCMATH');
    }
    else
    {
        die('GMP or BCMATH required');
    }
}

class CoinAddress
{

    public static $debug;
    public static $reuse_keys;
    public static $secp256k1;
    public static $secp256k1_G;
    public static $key_pair_private;
    public static $key_pair_private_hex;
    public static $key_pair_public;
    public static $key_pair_public_hex;
    public static $key_pair_compressed_private;
    public static $key_pair_compressed_private_hex;
    public static $key_pair_compressed_public;
    public static $key_pair_compressed_public_hex;
    public static $prefix_private;
    public static $prefix_public;

    public static function set_debug($s = '')
    {
        if ($s)
        {
            self::$debug = true;
        }
        else
        {
            self::$debug = false;
        }
    }

    public static function set_reuse_keys($s = '')
    {
        if ($s)
        {
            self::$reuse_keys = true;
            self::debug('set_reuse_keys: true');
        }
        else
        {
            self::$reuse_keys = false;
        }
    }

    public static function bitcoin()
    {
        self::$prefix_public  = '0x00';
        self::$prefix_private = '0x80';
        return self::get_address();
    }

    public static function bbqcoin()
    {
        self::$prefix_public  = '0x05';
        self::$prefix_private = '0xD5';
        return self::get_address();
    }

    public static function bitbar()
    {
        self::$prefix_public  = '0x19';
        self::$prefix_private = '0x99';
        return self::get_address();
    }

    public static function bytecoin()
    {
        self::$prefix_public  = '0x12';
        self::$prefix_private = '0x80';
        return self::get_address();
    }

    public static function chncoin()
    {
        self::$prefix_public  = '0x1C';
        self::$prefix_private = '0x9C';
        return self::get_address();
    }

    public static function devcoin()
    {
        return self::bitcoin();
    }

    public static function feathercoin()
    {
        self::$prefix_public  = '0x0E';
        self::$prefix_private = '0x8E';
        return self::get_address();
    }

    public static function freicoin()
    {
        return self::bitcoin();
    }

    public static function junkcoin()
    {
        self::$prefix_public  = '0x10';
        self::$prefix_private = '0x90';
        return self::get_address();
    }

    public static function litecoin()
    {
        self::$prefix_public  = '0x30';
        self::$prefix_private = '0xB0';
        return self::get_address();
    }

    public static function mincoin()
    {
        self::$prefix_public  = '0x32';
        self::$prefix_private = '0xB2';
        return self::get_address();
    }

    public static function namecoin()
    {
        self::$prefix_public  = '0x34';
        self::$prefix_private = '0xB4';
        return self::get_address();
    }

    public static function novacoin()
    {
        self::$prefix_public  = '0x08';
        self::$prefix_private = '0x88';
        return self::get_address();
    }

    public static function onecoin()
    {
        self::$prefix_public  = '0x73';
        self::$prefix_private = '0xF3';
        return self::get_address();
    }

    public static function ppcoin()
    {
        self::$prefix_public  = '0x37';
        self::$prefix_private = '0xB7';
        return self::get_address();
    }

    public static function smallchange()
    {
        self::$prefix_public  = '0x3E';
        self::$prefix_private = '0xBE';
        return self::get_address();
    }

    public static function terracoin()
    {
        return self::bitcoin();
    }

    public static function yacoin()
    {
        self::$prefix_public  = '0x4D';
        self::$prefix_private = '0xCD';
        return self::get_address();
    }

    public static function bitcoin_testnet()
    {
        self::$prefix_public  = '0x6F';
        self::$prefix_private = '0xEF';
        return self::get_address();
    }

    public static function bbqcoin_testnet()
    {
        self::$prefix_public  = '0x19';
        self::$prefix_private = '0x99';
        return self::get_address();
    }

    public static function bitbar_testnet()
    {
        self::$prefix_public  = '0x73';
        self::$prefix_private = '0xF3';
        return self::get_address();
    }

    public static function bytecoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function chncoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function devcoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function feathercoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function freicoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function junkcoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function litecoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function mincoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function namecoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function novacoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function onecoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function ppcoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function smallchange_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function terracoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function yacoin_testnet()
    {
        return self::bitcoin_testnet();
    }

    public static function generic($prefix_public = '', $prefix_private = '')
    {
        self::debug("generic: public:$prefix_public private:$prefix_private");
        if (!$prefix_public || !$prefix_private)
        {
            print 'ERROR';
            exit;
        }
        self::$prefix_public  = $prefix_public;
        self::$prefix_private = $prefix_private;
        return self::get_address();
    }

    public static function get_address()
    {
        if (!self::$prefix_public || !self::$prefix_private)
        {
            print 'ERROR';
            exit;
        }
        self::debug('get_address: prefix: public:' . self::$prefix_public . ' private:' . self::$prefix_private);
        self::setup();
        if (!self::$key_pair_public || !self::$key_pair_private)
        {
            self::create_key_pair();
        }
        elseif (!self::$reuse_keys)
        {
            self::create_key_pair();
        }
        return array(
            'public' => self::base58check_encode(self::$prefix_public, self::$key_pair_public),
            'public_hex' => self::$key_pair_public_hex,
            'private' => self::base58check_encode(self::$prefix_private, self::$key_pair_private),
            'private_hex' => self::$key_pair_private_hex,

            'public_compressed' => self::base58check_encode(self::$prefix_public, self::$key_pair_compressed_public),
            'public_compressed_hex' => self::$key_pair_compressed_public_hex,
            'private_compressed' => self::$key_pair_compressed_private,
            'private_compressed_hex' => self::$key_pair_compressed_private_hex
        );
    }

    public static function debug($m = '')
    {
        if (!self::$debug)
        {
            return;
        }
        echo "DEBUG: ", print_r($m, 1), "\n";
    }

    public static function setup()
    {
        self::debug('setup: USE_EXT: ' . USE_EXT);
        if (!isset(self::$secp256k1))
        {
            self::$secp256k1 = new CurveFp('115792089237316195423570985008687907853269984665640564039457584007908834671663', '0', '7');
        }
        if (!isset(self::$secp256k1_G))
        {
            self::$secp256k1_G = new Point(self::$secp256k1, '55066263022277343669578718895168534326250603453777594175500187360389116729240', '32670510020758816978083085130507043184471273380659243275938904335757337482424', '115792089237316195423570985008687907852837564279074904382605163141518161494337');
        }
    }

    public static function create_key_pair()
    {

        do
        {
             $privBin = openssl_random_pseudo_bytes(32, $crypto_strong);

             if (!$crypto_strong)
             {
                 throw new RuntimeException('crypto-strong RNG not available!');
             }

             $secretMultiplier = BcmathUtils::bin2bc("\x00" . $privBin);

             if (USE_EXT == 'GMP')
             {
                 $lessThanOrderG = gmp_cmp(self::$secp256k1_G->getOrder(), $secretMultiplier) > 0;
             }
             else if (USE_EXT == 'BCMATH')
             {
                 $lessThanOrderG = bccomp(self::$secp256k1_G->getOrder(), $secretMultiplier) > 0;
             }
             else
             {
                 throw new RuntimeException('USE_EXT not configured correctly');
             }
        } while (!$lessThanOrderG);

       $point = Point::mul($secretMultiplier, self::$secp256k1_G);

        $pubBinStr = "\x04" . str_pad(BcmathUtils::bc2bin($point->getX()), 32, "\x00", STR_PAD_LEFT) . str_pad(BcmathUtils::bc2bin($point->getY()), 32, "\x00", STR_PAD_LEFT);

        $pubBinStrCompressed = (intval(substr($point->getY(), -1, 1)) % 2 == 0 ? "\x02" : "\x03") . str_pad(BcmathUtils::bc2bin($point->getX()), 32, "\x00", STR_PAD_LEFT);

        self::$key_pair_public      = hash('ripemd160', hash('sha256', $pubBinStr, true), true);
        self::$key_pair_public_hex  = bin2hex($pubBinStr);
        self::$key_pair_private     = $privBin;
        self::$key_pair_private_hex = bin2hex($privBin);

        self::$key_pair_compressed_public      = hash('ripemd160', hash('sha256', $pubBinStrCompressed, true), true);
        self::$key_pair_compressed_public_hex  = bin2hex($pubBinStrCompressed);
        self::$key_pair_compressed_private     = self::base58check_encode(self::$prefix_private, $privBin, 0x01);
        self::$key_pair_compressed_private_hex = self::$key_pair_private_hex;

    }

    public static function base58check_encode($leadingByte, $bin, $trailingByte = null)
    {
        $bin = chr($leadingByte) . $bin;
        if ($trailingByte !== null)
        {
            $bin .= chr($trailingByte);
        }
        $checkSum = substr(hash('sha256', hash('sha256', $bin, true), true), 0, 4);
        $bin .= $checkSum;
        $base58 = self::base58_encode(BcmathUtils::bin2bc($bin));
        for ($i = 0; $i < strlen($bin); $i++)
        {
            if ($bin[$i] != "\x00")
            {
                break;
            }
            $base58 = '1' . $base58;
        }
        return $base58;
    }

    public static function base58_encode($num)
    {
        return BcmathUtils::dec2base($num, 58, '123456789ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnopqrstuvwxyz');
    }

}