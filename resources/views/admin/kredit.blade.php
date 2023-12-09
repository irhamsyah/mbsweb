@extends('layouts.admin_main')

@section('content')

@if($msgstatus!=''){
@if($msgstatus=='1'){
@php $statusmsg='success'; $titlemsg='Successfully'; $msgview='Proses Berhasil' @endphp;
}
@else{
@php $statusmsg='error'; $titlemsg='Error!'; $msgview='Proses Gagal!' @endphp;
}
@endif

<script>
  Swal.fire(
    '{{ $titlemsg }}',
    '{{ $msgview }}',
    '{{ $statusmsg }}'
  )
</script>

}
@endif
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card card-warning card-outline">
          <!-- form start -->
          <form method="POST" action="/bo_kr_de_kredit/add" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="idnasabah1">Id Nasabah</label>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="idnasabah1" name="idnasabah1" placeholder="Masukkan ID Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="namanasabah1">Nama Nasabah</label>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="namanasabah1" name="namanasabah1" data-action="getProfileNasabah.php" placeholder="Masukkan Nama Nasabah">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-lg-3 col-sm-12">
                  <label for="noktp1">No KTP</label>
                </div>
                <div class="col-lg-5 col-sm-12">
                  <input type="text" class="form-control" id="noktp1" name="noktp1" placeholder="Masukkan No KTP">
                </div>
              </div>
              <div class="row form-group">
                <div class="col-3"></div>
                <div class="col-3">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white"></i></button>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kredit" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Kredit yang sudah tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id='kreditTable' width='100%' class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td>Nama Nasabah</td>
                  <td>Produk</td>
                  <td>No Rekening</td>
                  <td>Saldo Awal</td>
                  <td>Saldo Saat Ini</td>
                  <td>Action</td>
                </tr>
              </thead>
            </table>

            <!-- Script -->
            <script type="text/javascript">
            $(document).ready(function(){

              // DataTable
              $('#kreditTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('Getkredits')}}",
                columns: [
                    { data: 'nama_nasabah' },
                    { data: 'DESKRIPSI_JENIS_KREDIT' },
                    { data: 'NO_REKENING' },
                    { data: 'POKOK_SALDO_REALISASI' },
                    { data: 'POKOK_SALDO_AKHIR' },
                    { title: "Action", 
                      "render": function(data, type, row, meta) {
                        console.log( 'in render function' );
                        return '<a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">' +
                                'Action <span class="caret"></span>' +
                                '</a>' +
                                '<div class="dropdown-menu">' +
                                  '<form method="post" action="/bo_cs_de_profil/kredit">' +
                                    '@csrf' +
                                    '<input type="hidden" name="jenisprofil" value="kredit" class="form-control">' +
                                    '<input type="hidden" name="idkredit" value="'+row['NO_REKENING']+'" class="form-control">' +                                    
                                    '<button type="submit" tabindex="-1" class="dropdown-item">' +
                                    ' Detail Kredit' +
                                    '</button>' +
                                  '</form>' +
                                '</div>';
                      }
                    },
                ]
              });

            });
            </script>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

  <div class="modal fade" id="modal-add-kredit">
    <div class="modal-dialog modal-xl">
      <form autocomplete="off" action="/bo_kr_de_kredit/add" method="post" enctype="multipart/form-data" id="formaddkredit">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Data Entry Kredit</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Custom Tabs -->
            <div class="card">
              <div class="card-header d-flex p-0">
                <ul class="nav nav-pills p-2">
                  <li class="nav-item"><a class="nav-link active" href="#form_master_kredit" data-toggle="tab">Form 1 [Master]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_jadwal_kredit" data-toggle="tab">Form 2 [Jadwal]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_lapbul" data-toggle="tab">Form 3 [Lapbul/SLIK]</a></li>
                  <li class="nav-item"><a class="nav-link" href="#form_agunan" data-toggle="tab">Form 4 [Agunan]</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                    @include('admin.kredit.master')
                    @include('admin.kredit.jadwal')
                    @include('admin.kredit.lapbul')
                    @include('admin.kredit.agunan')
                  </div>
               </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
      </form>
    </div>
  </div>

</div>
<!-- /.content -->

<script>
function autocomplete(inp, inpnama, inpalamat, arr, nama, alamat, nasabahs) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value.trim();  
              nasabahs.forEach(findIndex);
              function findIndex(value, index, array) {
                if(value.nasabah_id.trim()==inp.value.trim()){
                  inpnama.value=nama[index];
                  inpalamat.value=alamat[index]; 
                } 
              }  
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");      
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
          inpnama.value=nama[currentFocus];
          inpalamat.value=alamat[currentFocus];
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active"); 
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {  
    closeAllLists(e.target);
  });
}

var nasabahs = {!! json_encode($nasabahs) !!};

var nasabahid=[];
var  nasabahnama=[];
var nasabahalamat=[];
nasabahs.forEach(splitData);
function splitData(value, index, array) {
  nasabahid.push(value.nasabah_id);
  nasabahnama.push(value.nama_nasabah);
  nasabahalamat.push(value.alamat);  
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementsByName("inputnasabahid")[0], document.getElementsByName("inputnasabahnama")[0], document.getElementsByName("inputnasabahalamat")[0], nasabahid, nasabahnama, nasabahalamat, nasabahs);

</script>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const inputs = Array.from(
      document.querySelectorAll('input[name=inputnorekening], input[name=inputnopklama]')
    );

    const inputListener = e => {
      inputs
        .filter(i => i !== e.target)
        .forEach(i => (i.required = !e.target.value.length));
    };

    inputs.forEach(i => i.addEventListener('input', inputListener));
  });
  var jumlahangsuran = 0;
  function hitungjmlangsuran(){
    jumlahangsuran = parseInt(document.getElementsByName("inputjmlangsuran")[0].value);
    if(document.getElementsByName("inputsatuanwaktuangsuran")[0].value=='B'){
      document.getElementsByName("inputjw")[0].value=Math.ceil(document.getElementsByName("inputjmlangsuran")[0].value * 1);
      var parts =document.getElementsByName("inputtanggalrealisasi")[0].value.split('/');
      var mydate = new Date(parts[2], parts[1] - 1, parts[0]); 
      mydate.setMonth(mydate.getMonth() + parseInt(document.getElementsByName("inputjmlangsuran")[0].value,10)); 
      let yyyy = mydate.getFullYear();
      let mm = mydate.getMonth() + 1; // Months start at 0!
      let dd = mydate.getDate();

      if (dd < 10) dd = '0' + dd;
      if (mm < 10) mm = '0' + mm;

      const tanggaljatuhtempo = dd + '/' + mm + '/' + yyyy;
      document.getElementsByName("inputtanggaljttempo")[0].value=tanggaljatuhtempo;
    }  
    if(document.getElementsByName("inputsatuanwaktuangsuran")[0].value=='M'){
      document.getElementsByName("inputjw")[0].value=Math.ceil(document.getElementsByName("inputjmlangsuran")[0].value / 4);
      var parts =document.getElementsByName("inputtanggalrealisasi")[0].value.split('/');
      var mydate = new Date(parts[2], parts[1] - 1, parts[0]); 
      mydate.setDate(mydate.getDate() + (parseInt(document.getElementsByName("inputjmlangsuran")[0].value,10)*7)); 
      let yyyy = mydate.getFullYear();
      let mm = mydate.getMonth() + 1; // Months start at 0!
      let dd = mydate.getDate();

      if (dd < 10) dd = '0' + dd;
      if (mm < 10) mm = '0' + mm;

      const tanggaljatuhtempo = dd + '/' + mm + '/' + yyyy;
      document.getElementsByName("inputtanggaljttempo")[0].value=tanggaljatuhtempo;
    }
    if(document.getElementsByName("inputsatuanwaktuangsuran")[0].value=='H'){
      document.getElementsByName("inputjw")[0].value=Math.ceil(document.getElementsByName("inputjmlangsuran")[0].value /(7*4));
      var parts =document.getElementsByName("inputtanggalrealisasi")[0].value.split('/');
      var mydate = new Date(parts[2], parts[1] - 1, parts[0]); 
      mydate.setDate(mydate.getDate() + (parseInt(document.getElementsByName("inputjmlangsuran")[0].value,10))); 
      let yyyy = mydate.getFullYear();
      let mm = mydate.getMonth() + 1; // Months start at 0!
      let dd = mydate.getDate();

      if (dd < 10) dd = '0' + dd;
      if (mm < 10) mm = '0' + mm;

      const tanggaljatuhtempo = dd + '/' + mm + '/' + yyyy;
      document.getElementsByName("inputtanggaljttempo")[0].value=tanggaljatuhtempo;
    }
    if(document.getElementsByName("inputsatuanwaktuangsuran")[0].value=='P'){
      document.getElementsByName("inputjw")[0].value=Math.ceil(document.getElementsByName("inputjmlangsuran")[0].value * 5 / 30);
      var parts =document.getElementsByName("inputtanggalrealisasi")[0].value.split('/');
      var mydate = new Date(parts[2], parts[1] - 1, parts[0]); 
      mydate.setDate(mydate.getDate() + (parseInt(document.getElementsByName("inputjmlangsuran")[0].value,10)*5)); 
      let yyyy = mydate.getFullYear();
      let mm = mydate.getMonth() + 1; // Months start at 0!
      let dd = mydate.getDate();

      if (dd < 10) dd = '0' + dd;
      if (mm < 10) mm = '0' + mm;

      const tanggaljatuhtempo = dd + '/' + mm + '/' + yyyy;
      document.getElementsByName("inputtanggaljttempo")[0].value=tanggaljatuhtempo;
    }  
  }
  var provisi = 0;
  function hitungprovisi(){
    provisi = parseInt(document.getElementsByName("inputprovisirp")[0].value);
  }
  var pokok = 0;
  var bunga = 0;
  
  function hitungbunga(){
    pokok = parseInt(document.getElementsByName("inputjumlahpinjaman")[0].value);    
    var sukubunga=(parseInt(document.getElementsByName("inputbungaperthn")[0].value) /12);
    document.getElementsByName("inputjumlahbungapinjaman")[0].value = parseInt(document.getElementsByName("inputjumlahpinjaman")[0].value) * parseInt(document.getElementsByName("inputjmlangsuran")[0].value) * sukubunga/100;
    document.getElementsByName("inputsukubunga")[0].value = sukubunga;
    bunga = parseInt(document.getElementsByName("inputjumlahbungapinjaman")[0].value);    
    var nilaiakhir = parseFloat(document.getElementsByName("inputjumlahpinjaman")[0].value)+parseFloat(document.getElementsByName("inputjumlahbungapinjaman")[0].value);
    var nilaiawal = parseFloat(document.getElementsByName("inputjumlahpinjaman")[0].value);
    var pembagi = document.getElementsByName("inputjmlangsuran")[0].value/12;
    var c4 = parseInt(document.getElementsByName("inputbungaperthn")[0].value);
    document.getElementsByName("inputbungaeffperthn")[0].value =(1+c4/pembagi)^pembagi-1;
    document.getElementsByName("inputangsuranblnpersen")[0].value = nilaiakhir/document.getElementsByName("inputjmlangsuran")[0].value;
    document.getElementsByName("inputbungaekiv")[0].value = document.getElementsByName("inputbungaperthn")[0].value;
    document.getElementsByName("inputbungaekivbln")[0].value = sukubunga;
    document.getElementsByName("inputangsuranfee1")[0].value = 0;
    document.getElementsByName("inputangsuranfee1rp")[0].value = 0;
    document.getElementsByName("inputangsuranfee2")[0].value = 0;
    document.getElementsByName("inputangsuranfee2rp")[0].value = sukubunga;



  }
</script>

<script>
  $(document).ready(function() {
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });
  });
</script>

<style>
.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}
</style>

@endsection