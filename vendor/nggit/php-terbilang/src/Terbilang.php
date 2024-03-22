<?php

# PHP Terbilang - Mengubah Angka Menjadi Huruf Terbilang.
# https://github.com/nggit/php-terbilang
# Copyright (c) 2021 nggit.

namespace Nggit\PHPTerbilang;

use Exception;

class Terbilang
{
    /**
     * @var string[]
     */
    protected $num_str = ['', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 'sepuluh', 'sebelas'];
    
    /**
     * @var array
     */
    protected $suffixes = [
        'belas', 'puluh', ['', 'ratus'], ['', 'ribu', 'juta', 'miliar'],
        ['', 'triliun', 'septiliun', 'undesiliun', 'kuindesiliun', 'novemdesiliun', 'trevigintiliun', 'septenvigintiliun', 'untrigintiliun'],
    ];
    
    /**
     * @var array
     */
    protected $result = [];
    
    /**
     * @var string[]
     */
    protected $separators = [',', '.'];

    /**
     * @var string
     */
    public $separator;
    
    /**
     * Terbilang constructor.
     * @param  string $num
     * @param  string $sep
     * @throws Exception
     */
    public function __construct($num = '', $sep = ',')
    {
        $this->separator = $sep;
        $this->parse($num);
    }
    
    /**
     * @param  array $result
     * @return string
     */
    public function getResult($result = [])
    {
        return $result ? strtr(
            rtrim(implode(' ', array_filter($result, 'strlen')), ' ,'),
            ['satu ratus' => 'seratus', 'satu ribu' => 'seribu', ';' => '']
        ) : implode(' ', $this->result);
    }
    
    /**
     * @param  string $num
     * @return array|string|string[]
     */
    public function filter_num($num = '')
    {
        for ($n = 0; $n < strlen($num); $n++) {
            if (ord($num[$n]) < 48 || ord($num[$n]) > 57) {
                $num[$n] = ' ';
            }
        }
        
        return str_replace(' ', '', $num);
    }
    
    /**
     * @param  string $num
     * @return $this
     */
    public function spell($num = '')
    {
        $this->result = [];
        for ($n = 0; $n < strlen($num); $n++) {
            if (ord($num[$n]) >= 48 && ord($num[$n]) <= 57) {
                $this->result[] = $num[$n] == '0' ? 'nol' : $this->num_str[(int) $num[$n]];
            }
        }
        
        return $this;
    }
    
    /**
     * @param  string $num
     * @param  string $sep
     * @return $this
     * @throws Exception
     */
    public function parse($num = '', $sep = '')
    {
        if ($num == '') {
            return $this;
        }

        if ($sep == '') {
            $sep = $this->separator;
        }

        if (! in_array($sep, $this->separators)) {
            throw new Exception('Harap gunakan koma atau titik sebagai pemisah');
        }
        
        $result = [];
        $num = trim((string) $num, ' ,.');
        if (strpos($num, '-') === 0 && trim($num, ',-.0') != '') {
            $result[] = 'minus';
        }
        
        if (($sep_pos = strrpos($num, $sep))) {
            $result[] = $this->getResult($this->read(substr($num, 0, $sep_pos))->result);
            $result[] = 'koma';
            $result[] = $this->spell(substr($num, $sep_pos))->getResult();
        } else {
            $sep_alt = $this->separators[array_search($sep, $this->separators) ^ 1];
            $sep_alt_pos = strpos($num, $sep_alt);
    
            if ($sep_alt_pos && strpos($num, '0') === 0 || substr_count($num, $sep_alt) == 1 && strlen(substr($num, $sep_alt_pos)) != 4) {
                $result[] = $this->getResult($this->read(substr($num, 0, $sep_alt_pos))->result);
                $result[] = 'koma';
                $result[] = $this->spell(substr($num, $sep_alt_pos))->getResult();
            } else {
                $result[] = $this->getResult($this->read($num)->result);
            }
        }
    
        $this->result = $result;
        
        return $this;
    }
    
    /**
     * @param  string $num
     * @return $this
     * @throws Exception
     */
    protected function read($num = '')
    {
        $num = $this->filter_num($num);
        if (strpos($num, '0') === 0) {
            return $this->spell($num);
        }
    
        if (strlen($num) > 108) {
            throw new Exception('Maaf, angka yang anda masukkan terlalu besar');
        }
        
        $this->result = [];
        
        while (($len = strlen($num)) > 0) {
            $s_index = (int) floor(($len - 1) / 12);
            $num_ = substr($num, 0, $len - $s_index * 12);
            while (($len_ = strlen($num_)) > 0) {
                $s_index_ = (int) floor(($len_ - 1) / 3);
                $num__ = substr($num_, 0, $len_ - $s_index_ * 3);
                
                while (($len__ = strlen($num__)) > 0) {
                    $s_index__ = (int) floor(($len__ - 1) / 2);
                    $num___ = substr($num__, 0, $len__ - $s_index__ * 2);
    
                    if (isset($this->num_str[(int) $num___])) {
                        $this->result[] = rtrim($this->num_str[(int) $num___] . ' ' . $this->suffixes[2][$s_index__]); // ratus
                    } else {
                        $this->result[] = $num___[0] == 1 ? $this->num_str[(int) $num___[1]] . ' ' . $this->suffixes[0] // belas
                            : rtrim($this->num_str[(int) $num___[0]] . ' ' . $this->suffixes[1] .
                                ' ' . $this->num_str[(int) $num___[1]]) . ';'; // puluh
                    }
    
                    $num__ = ltrim(substr($num__, $len__ - $s_index__ * 2), '0');
                }
                
                $this->result[] = $this->suffixes[3][$s_index_]; // ribu, juta, miliar
                $num_ = ltrim(substr($num_, $len_ - $s_index_ * 3), '0');
            }
            
            $this->result[] = $this->suffixes[4][$s_index] . ','; // triliun, septiliun, ..., untrigintiliun
            $num = ltrim(substr($num, $len - $s_index * 12), '0');
        }
        
        return $this;
    }
}
