#CryptoCoin

###Hightlights

- Generate public / private keys for a [variety](https://github.com/stormpat/CryptoCoin#about) of cryptocurrencies.
- Extreamly easy to use. (Just one method to call)
- [No use of mt_rand](http://phpsecurity.readthedocs.org/en/latest/Insufficient-Entropy-For-Random-Values.html), instead this lib uses [openssl_random_pseudo_bytes](http://us3.php.net/openssl_random_pseudo_bytes) for more security.

###Requirements

Requires [GMP](http://www.php.net/manual/en/book.gmp.php) or [BcMath](http://www.php.net/manual/en/book.bc.php) extension (GMP preferred for better performance)

**Benchmarks**

***Test setup: 2.2Ghz Core i7, 8GB DDR3, OSX 10.9.1***

The algorythm is quite slow with bcmath on older PHP versions. Its highly recommended
that you use PHP 5.5.x. The benchmark is not tested on PHP 5.3.x yet, it does work, but the speed
can be slow. I will add benchmarks when i do the tests.

*With BcMath*

- **PHP 5.4.21**
- ~6.3 sec
- **PHP 5.5.7**
- ~1.5 sec

*With GMP*

- **PHP 5.5.7**
- ~0.02 sec

As you can see in the above benchmarks, i strongly suggest GMP with a new PHP version.
Otherwise you should probably try using some sort of queue service for the generation.

For additional info please read: [BcMath vs GMP](http://phpseclib.sourceforge.net/math/intro.html)

###About

This lib generates public/private key pairs for various cryptocurrencies. Currently
supported currencies are:

- [Bitcoin](http://bitcoin.org/)
- [Litecoin](https://litecoin.org/)
- [Bbqcoin](http://bbqcoin.org/)
- [Bitbar](http://bitbar.biz/downloads)
- [Bytecoin](http://bytecoin.biz/)
- [Chncoin](http://chncoin.org/)
- [Devcoin](http://devcoin.org/)
- [Feathercoin](http://feathercoin.com/)
- [Freicoin](http://freico.in/)
- Junkcoin
- [Mincoin](http://www.min-coin.org/)
- [Namecoin](https://www.namecoin.org/)
- [Novacoin](http://novacoin.org/)
- Onecoin
- [Ppcoin](https://en.bitcoin.it/wiki/PPCoin)
- Smallchange
- [Terracoin](http://terracoin.org/)
- [Yacoin](http://www.yacoin.org/)

This library is a fork, and made because of my increased interest in cryptocurrencies,
and because the original libraries where not composer friendly, and not namespaced. So this library can be easily used
with other packages and frameworks. See credits for more info.

###Installation

**With composer**

Install [Composer](http://getcomposer.org/) and require the lib.

```bash
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
```

Then require the library.

```composer require stormpat/crypto-coin```

For the version constraint use ```dev-master```

Or just update your composer.json and run composer install.

```
require": {
    "stormpat/crypto-coin": "dev-master"
}
```

Install with ```composer install```

**Manually**

Just clone the repository, and set up your bootstrapping.

```git clone https://github.com/stormpat/CryptoCoin.git```
###Usage

Require the composer autoload file

```require_once __DIR__ . '/vendor/autoload.php';```

Use the library by importing the namespace.

```use CryptoCoin\CoinAddress;```

Finally get the generated data from the algorythm.

```php

$coin = CoinAddress::bitcoin(); // or ::litecoin etc.

var_dump($coin);

// dump looks like this

array (size=8)
  'public' => string '1L4LXsH5BWX1fjFJDteJ53h2W7FkJkVKW7' (length=34)
  'public_hex' => string '0474ec09bbbe2962fd0a9515a8665c6be71bd85da17f92b24d26999056a14787c4f6551b3d022ffd177ca99502d06fefb2280d2781eebfb22559f8cfc449420bc9' (length=130)
  'private' => string '5KaMAFrNeZhtRxxgJsq2GKDAhUq98S6EsVWAKd5hUCN5zzaMh3M' (length=51)
  'private_hex' => string 'e7be5bb61050630558d4b3f56c068a738961f7731f26911cb0935bfb6ef52dfe' (length=64)
  'public_compressed' => string '15HcvN6RxA1oN5vXKGv4F4Ch2b6rDqbDnu' (length=34)
  'public_compressed_hex' => string '0374ec09bbbe2962fd0a9515a8665c6be71bd85da17f92b24d26999056a14787c4' (length=66)
  'private_compressed' => string 'L4zByrYvYoMU1BzkVuLxabNhofqUsok8Droi9CFjd3A54kDdReK6' (length=52)
  'private_compressed_hex' => string 'e7be5bb61050630558d4b3f56c068a738961f7731f26911cb0935bfb6ef52dfe' (length=64)

```

###Licence

The MIT License (MIT)

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

###Credits

This lib is based on the work of [PHPCoinAddress](https://github.com/zamgo/PHPCoinAddress)
and [PHP Elliptic Curve DSA and DH](https://github.com/mdanter/phpecc) please see their repos
for additional info. Big salute!
