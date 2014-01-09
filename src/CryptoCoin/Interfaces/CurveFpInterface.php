<?php namespace CryptoCoin\Interfaces;

use CryptoCoin\CurveFp;

interface CurveFpInterface
{
    public function __construct($prime, $a, $b);
    public function contains($x, $y);
    public function getA();
    public function getB();
    public function getPrime();
    public static function cmp(CurveFp $cp1, CurveFp $cp2);
}