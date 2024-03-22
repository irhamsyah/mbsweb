<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
      #tbl1{
        font-size:100%;
      }
      br{
        content: "";
        margin: 0.5em;
        display: block;
        font-size: 24%;
      }
      </style>
  

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
        <title>Profil Nasabah</title>
      </head>
      <body>
    <div class="container">
      <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"/>
        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"/>
      </svg></button>
      
      @foreach($profilnasabah as $index => $key)
        @php 
            $idnasabah = $key->nasabah_id;
            $namanasabah = $key->nama_nasabah;
            $tabjenis = 'X';
            $counttab = 0;
            $depjenis = 'X';
            $countdep = 0;
            $krejenis = 'X';
            $countkre = 0;
        @endphp
      @endforeach
          <h4 class="text-left">PT. Bank Perkreditan Rakyat</h4>
          <h4 class="text-left">ARTHA SENAPATI</h4>
          <span class="text-left">NASABAH ID : {{ $idnasabah }}</span></br>
          <span class="text-left">NAMA NASABAH : {{ $namanasabah }}</span></br>
        @foreach($profilnasabahtab as $index => $tab)
            <?php if($tabjenis!=$tab->tabJenis){ ?>
            <table id="tbl1" class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA PRODUK</th>
                        <th>NO REKENING</th>
                        <th>SALDO AWAL</th>
                        <th>SALDO SAAT INI</th>
                    </tr>
                </thead>  
            <?php }?>  
                    <tr>
                        <td>{{ $tab->tabJenis }}</td>
                        <td>{{ $tab->tabNoRek }}</td>
                        <td style="text-align:right">{{ number_format($tab->tabSaldoAwal,2) }}</td>
                        <td style="text-align:right">{{ number_format($tab->tabSaldoAkhir,2) }}</td>
                    </tr> 
            @php
                $tabjenis = $tab->tabJenis;
                $counttab++;
            @endphp
            @foreach($profilnasabahtabcount as $index => $tabcount)
            <?php if($tabcount->countJenistab>0 and $tabcount->countJenistab==$counttab and $tabjenis==$tabcount->tabJenis){ ?>
                <tr>
                    <th colspan="2">Total {{ $tabcount->tabJenis}}</th>
                    <th style="text-align:right">{{ number_format($tabcount->sumtabSaldoAwal,2) }}</th>
                    <th style="text-align:right">{{ number_format($tabcount->sumtabSaldoAkhir,2) }}</th>
                </tr>
            <?php $counttab=0;  }?>
            @endforeach
        @endforeach
        


        @foreach($profilnasabahdep as $index => $dep)
            <?php if($depjenis!=$dep->depJenis){ ?>
            <table id="tbl2" class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA PRODUK</th>
                        <th>NO REKENING</th>
                        <th>SALDO AWAL</th>
                        <th>SALDO SAAT INI</th>
                    </tr>
                </thead>  
            <?php }?>  
                    <tr>
                        <td>{{ $dep->depJenis }}</td>
                        <td>{{ $dep->depNoRek }}</td>
                        <td style="text-align:right">{{ number_format($dep->depSaldoAwal,2) }}</td>
                        <td style="text-align:right">{{ number_format($dep->depSaldoAkhir,2) }}</td>
                    </tr> 
            @php
                $depjenis = $dep->depJenis;
                $countdep++;
            @endphp
            @foreach($profilnasabahdepcount as $index => $depcount)
            <?php if($depcount->countJenisdep>0 and $depcount->countJenisdep==$countdep and $depjenis==$depcount->depJenis){ ?>
                <tr>
                    <th colspan="2">Total {{ $depcount->depJenis}}</th>
                    <th style="text-align:right">{{ number_format($depcount->sumdepSaldoAwal,2) }}</th>
                    <th style="text-align:right">{{ number_format($depcount->sumdepSaldoAkhir,2) }}</th>
                </tr>
            <?php $countdep=0;  }?>
            @endforeach
        @endforeach

        @foreach($profilnasabahkre as $index => $kre)
            <?php if($krejenis!=$kre->kreJenis){ ?>
            <table id="tbl3" class="table table-bordered">
                <thead>
                    <tr>
                        <th>NAMA PRODUK</th>
                        <th>NO REKENING</th>
                        <th>SALDO AWAL</th>
                        <th>SALDO SAAT INI</th>
                    </tr>
                </thead>  
            <?php }?>  
                    <tr>
                        <td>{{ $kre->kreJenis }}</td>
                        <td>{{ $kre->kreNoRek }}</td>
                        <td style="text-align:right">{{ number_format($kre->kreSaldoAwal,2) }}</td>
                        <td style="text-align:right">{{ number_format($kre->kreSaldoAkhir,2) }}</td>
                    </tr> 
            @php
                $krejenis = $kre->kreJenis;
                $countkre++;
            @endphp
            @foreach($profilnasabahkrecount as $index => $krecount)
            <?php if($krecount->countJeniskre>0 and $krecount->countJeniskre==$countkre and $krejenis==$krecount->kreJenis){ ?>
                <tr>
                    <th colspan="2">Total {{ $krecount->kreJenis}}</th>
                    <th style="text-align:right">{{ number_format($krecount->sumkreSaldoAwal,2) }}</th>
                    <th style="text-align:right">{{ number_format($krecount->sumkreSaldoAkhir,2) }}</th>
                </tr>
            <?php $countkre=0;  }?>
            @endforeach
        @endforeach

    </div>
  </body>
</html>