# php-terbilang

php-terbilang adalah sebuah pustaka yang berfungsi untuk mengubah angka menjadi huruf terbilang. php-terbilang ditulis dengan PHP dan dapat menerima masukan angka hingga 108 digit (999+ miliar [untrigintiliun](https://id.wikipedia.org/wiki/Daftar_bilangan_di_atas_triliun)). php-terbilang merupakan hasil port / adaptasi
dari [Python Terbilang](https://github.com/nggit/terbilang).

## Instalasi

```
composer require nggit/php-terbilang
```

## Penggunaan

```php
require __DIR__ . '/vendor/autoload.php';
use Nggit\PHPTerbilang\Terbilang;

$t = new Terbilang();

$t->parse('1.000,00');
echo $t->getResult(); # seribu koma nol nol

$t->parse('1001');
echo $t->getResult(); # seribu satu

$t->parse('121001');
echo $t->getResult(); # seratus dua puluh satu ribu satu
```

php-terbilang dibuat agar memiliki jangkauan yang lebar, tetapi diharapkan dapat membaca angka dengan lebih *luwes*. Sebagai contoh, "1000 triliun" tidak dibaca sebagai "satu
kuadriliun" tetapi "seribu triliun". Sedangkan "1000 juta"
tentu akan dibaca sebagai "satu miliar". php-terbilang akan menampilkan tanda koma jika bilangan sudah mencapai triliunan atau lebih untuk meningkatkan keterbacaan:

```php
$t->parse('19000000000000000000071000002011000000');
echo $t->getResult(); # sembilan belas undesiliun, tujuh puluh satu ribu triliun, dua miliar sebelas juta
```
