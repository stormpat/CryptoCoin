<?php namespace CryptoCoin\Utils;

class GmpUtils
{
    public static function gmp_mod2($n, $d)
    {
        if (extension_loaded('gmp') && USE_EXT == 'GMP')
        {
            $res = gmp_div_r($n, $d);
            if (gmp_cmp(0, $res) > 0)
            {
                $res = gmp_add($d, $res);
            }
            return gmp_strval($res);
        }
        else
        {
            throw new Exception("PLEASE INSTALL GMP");
        }
    }
    public static function gmp_random($n)
    {
        if (extension_loaded('gmp') && USE_EXT == 'GMP')
        {
            $random = gmp_strval(gmp_random());
            $small_rand = rand();
            while (gmp_cmp($random, $n) > 0)
            {
                $random = gmp_div($random, $small_rand, GMP_ROUND_ZERO);
            }
            return gmp_strval($random);
        }
        else
        {
            throw new Exception("PLEASE INSTALL GMP");
        }
    }
    public static function gmp_hexdec($hex)
    {
        if (extension_loaded('gmp') && USE_EXT == 'GMP')
        {
            $dec = gmp_strval(gmp_init($hex), 10);
            return $dec;
        }
        else
        {
            throw new Exception("PLEASE INSTALL GMP");
        }
    }
    public static function gmp_dechex($dec)
    {
        if (extension_loaded('gmp') && USE_EXT == 'GMP')
        {
            $hex = gmp_strval(gmp_init($dec), 16);
            return $hex;
        }
        else
        {
            throw new Exception("PLEASE INSTALL GMP");
        }
    }
}