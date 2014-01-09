<?php namespace CryptoCoin\Interfaces;

use CryptoCoin\Point;
use CryptoCoin\CurveFp;

interface PointInterface
{
    public function __construct(CurveFp $curve, $x, $y, $order = null);
    public static function cmp($p1, $p2);
    public static function add($p1, $p2);
    public static function mul($x2, Point $p1);
    public static function leftmost_bit($x);
    public static function rmul(Point $p1, $m);
    public function __toString();
    public static function double(Point $p1);
    public function getX();
    public function getY();
    public function getCurve();
    public function getOrder();
}