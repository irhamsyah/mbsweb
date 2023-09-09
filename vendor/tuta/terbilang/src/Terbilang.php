<?php

namespace Tuta\Terbilang;

class Terbilang {

  public static function angka($angka)
  {
      $bilang = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");

      if ($angka < 12)
        return " " . $bilang[$angka];
      elseif ($angka < 20)
        return Terbilang::angka($angka - 10) . "belas";
      elseif ($angka < 100)
        return Terbilang::angka($angka / 10) . " puluh" . Terbilang::angka($angka % 10);
      elseif ($angka < 200)
        return " seratus" . Terbilang::angka($angka - 100);
      elseif ($angka < 1000)
        return Terbilang::angka($angka / 100) . " ratus" . Terbilang::angka($angka % 100);
      elseif ($angka < 2000)
        return " seribu" . Terbilang::angka($angka - 1000);
      elseif ($angka < 1000000)
        return Terbilang::angka($angka / 1000) . " ribu" . Terbilang::angka($angka % 1000);
      elseif ($angka < 1000000000)
        return Terbilang::angka($angka / 1000000) . " juta" . Terbilang::angka($angka % 1000000);
      elseif ($angka >= 1000000000)
        return "Tidak Terhingga!!!";
  }
}

 ?>
