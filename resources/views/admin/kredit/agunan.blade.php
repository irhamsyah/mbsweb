<div class="tab-pane" id="form_agunan">
  <div class="form-group row"> 
    <div class="col-lg-7 col-sm-12">
      <div class="form-group row">
        <div class="col-lg-2">
          <span class="labeljudulright">Jenis Agunan</span>
        </div>
        <div class="col-lg-10">
          <select class="form-control" name="inputjenisagunan">
            @foreach($jenisagunan as $jenisagunan)
              <option value="{{ $jenisagunan->KODE_AGUNAN }}" <?php if($jenisagunan->KODE_AGUNAN=='213'){echo 'selected';}?>>{{ $jenisagunan->KODE_AGUNAN.' - '.$jenisagunan->DESKRIPSI_AGUNAN }}</option>
            @endforeach                                  
          </select>
        </div> 
      </div>
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputnilaiagunan" class="form-control" onchange="setNilaiAgunanBI()">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright">Pemilik Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputpemilikagunan" class="form-control">
        </div>
      </div>  
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Agunan BI</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputnilaiagunanbi" class="form-control">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright">Alamat Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputalamatagunan" class="form-control">
        </div>
      </div>  
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">% Likuidasi</span>
        </div>
        <div class="col-lg-4 col-sm-12"> 
          <div class="row">             
            <div class="col-lg-6 col-sm-12">          
              <input type="text" name="inputpersenlikuidasi" class="form-control" onchange="setNilaiLikuidasi()">
            </div>
            <div class="col-lg-1">
              <span class="labeljudulright">%</span>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright">Bukti Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputbuktiagunan" class="form-control">
        </div>
      </div>  
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Likuidasi</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputnilailikuidasi" class="form-control">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright" style="font-size:11px;">J Tempo Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputjtempoagunan" class="form-control">
        </div>          
      </div>  
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">ID. Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12"> 
          <input type="text" name="inputidagunan" class="form-control">
        </div> 
        <div class="col-lg-2">
            <span class="labeljudulright">No. Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputnoagunan" class="form-control">
        </div> 
      </div>
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">Uraian Agunan</span>
        </div>
        <div class="col-lg-10 col-sm-12"> 
          <input type="text" name="inputuraianagunan" class="form-control">
        </div>        
      </div>
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">Rincian</span>
        </div>
        <div class="col-lg-10 col-sm-12"> 
          <textarea id="w3review" name="inputrincianagunan" value='' rows="3" cols="70">
          
          </textarea>
        </div>        
      </div>
      <div class="form-group row">  
        <div class="col-lg-12 col-sm-12"> 
          <div id="hiddenInput"></div> 
        </div>
      </div>  
      <div class="form-group row"> 
        <div class="col-lg-12 col-sm-12"> 
          <div id="agunan-table"></div>
          <div>
              <button id="reactivity-add" onclick="event.preventDefault();setAgunan();">Simpan</button>              
              <button id="reactivity-delete">Hapus Agunan</button>
          </div>
        </div>
      </div>      
    </div>
    <div class="col-lg-1 col-sm-12"></div> 
    <div class="col-lg-4 col-sm-12">
      <input type="file" name="agunanimage" accept="image/jpeg, image/png, image/jpg" onchange="setImagePicked(event)">
      <output></output>
      <br>
      <br>
      <div class="form-group-lbl">
        <img id="path_foto_agunan" src="img\foto\default.jpg" style="justify-content: center; align-items: center;max-width:100%; max-height:400px;"/>
      </div>
    </div>
  </div>
  <div class="form-group row"> 
    <div class="col-lg-2">
      <br>
    </div>
    <div class="col-lg-3 col-sm-12"> 
      <div class="bottomlinesolid">
        <span class="judulOrange">Tab Hold Dana</span>
      </div>
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <div class="bottomlinesolid">
        <span class="judulOrange">Titipan Tab Notariel</span>
      </div>
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <div class="bottomlinesolid">
        <span class="judulOrange">Titipan Tab Premi Asuransi</span>
      </div>
    </div>        
  </div>
  <div class="form-group row"> 
    <div class="col-lg-2">
      <span class="labeljudulright">No.Rek. Tabungan</span>
    </div>
    <div class="col-lg-3 col-sm-12"> 
      <div class="input-group mb-2 autocomplete">                                  
        <input type="text" class="form-control" name="inputtabholddana" onchange="setHoldDana()" >
        <div class="input-group-prepend">
          <div class="input-group-text"><span class="input-group-addon">
            <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
      </div> 
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <div class="input-group mb-2 autocomplete">                                  
        <input type="text" class="form-control" name="inputtabnotariel" onchange="setNotariel()">
        <div class="input-group-prepend">
          <div class="input-group-text"><span class="input-group-addon">
            <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
      </div> 
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <div class="input-group mb-2 autocomplete">                                  
        <input type="text" class="form-control" name="inputtabasuransi" onchange="setAsuransi()">
        <div class="input-group-prepend">
          <div class="input-group-text"><span class="input-group-addon">
            <i class="fa fa-search"></i>
            </span>
          </div>
        </div>
      </div> 
    </div>        
  </div>
  <div class="form-group row"> 
    <div class="col-lg-2">
      <span class="labeljudulright">Perkiraan GL</span>
    </div>
    <div class="col-lg-3 col-sm-12"> 
      <input type="text" name="inputperkiraanglholddana" class="form-control">
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <input type="text" name="inputperkiraanglnotariel" class="form-control">
    </div> 
    <div class="col-lg-3 col-sm-12"> 
      <input type="text" name="inputperkiraanglasuransi" class="form-control">
    </div>        
  </div>
  <div class="form-group row"> 
    <div class="col-lg-2">
      <span class="labeljudulright">Jumlah</span>
    </div>
    <div class="col-lg-3 col-sm-12"> 
      <input type="text" name="inputjumlahagunan" value="0" class="form-control">
    </div> 
  </div>
</div>

<script>
  function setImagePicked(e) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("img").fadeIn("fast").attr('src',tmppath);  
  }

  function resetAgunan(){
    if(document.getElementById("agunanTable") !== null){
      var table = document.getElementById("agunanTable");
      table.remove();
    } 
    addInputTable(dataagunan);    
  }

  var dataagunan = [];
  function setAgunan(){
    var data = 
      {
        "id":dataagunan.length+1,
        "jenisagunan":document.getElementsByName('inputjenisagunan')[0].value,
        "nilaiagunan":document.getElementsByName('inputnilaiagunan')[0].value,
        "pemilikagunan":document.getElementsByName('inputpemilikagunan')[0].value,
        "nilaiagunanbi":document.getElementsByName('inputnilaiagunanbi')[0].value,
        "alamatagunan":document.getElementsByName('inputalamatagunan')[0].value,
        "persenlikuidasi":document.getElementsByName('inputpersenlikuidasi')[0].value,
        "buktiagunan":document.getElementsByName('inputbuktiagunan')[0].value,
        "nilailikuidasi":document.getElementsByName('inputnilailikuidasi')[0].value,
        "jtempoagunan":document.getElementsByName('inputjtempoagunan')[0].value,
        "idagunan":document.getElementsByName('inputidagunan')[0].value,
        "noagunan":document.getElementsByName('inputnoagunan')[0].value,
        "uraianagunan":document.getElementsByName('inputuraianagunan')[0].value,
        "rincianagunan":document.getElementsByName('inputrincianagunan')[0].value,
      };
    dataagunan.push(data);
    resetAgunan();
  }

  function addInputTable(rows) {
  var myTableDiv = document.getElementById("hiddenInput");
  table = document.createElement('div');
  table.setAttribute("id", "agunanTable");
  for (var i = 0; i < rows.length; i++) {
    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "jenisagunan[]");
    input.setAttribute("value", rows[i].jenisagunan);
    table.appendChild(input);

    var input2 = document.createElement("input");
    input2.setAttribute("type", "hidden");
    input2.setAttribute("name", "nilaiagunan[]");
    input2.setAttribute("value", rows[i].nilaiagunan);
    table.appendChild(input2);

    var input3= document.createElement("input");
    input3.setAttribute("type", "hidden");
    input3.setAttribute("name", "pemilikagunan[]");
    input3.setAttribute("value", rows[i].pemilikagunan);
    table.appendChild(input3);

    var input4= document.createElement("input");
    input4.setAttribute("type", "hidden");
    input4.setAttribute("name", "nilaiagunanbi[]");
    input4.setAttribute("value", rows[i].nilaiagunanbi);
    table.appendChild(input4);

    var input5= document.createElement("input");
    input5.setAttribute("type", "hidden");
    input5.setAttribute("name", "alamatagunan[]");
    input5.setAttribute("value", rows[i].alamatagunan);
    table.appendChild(input5);

    var input6 = document.createElement("input");
    input6.setAttribute("type", "hidden");
    input6.setAttribute("name", "persenlikuidasi[]");
    input6.setAttribute("value", rows[i].persenlikuidasi);
    table.appendChild(input6);

    var input7 = document.createElement("input");
    input7.setAttribute("type", "hidden");
    input7.setAttribute("name", "buktiagunan[]");
    input7.setAttribute("value", rows[i].buktiagunan);
    table.appendChild(input7);

    var input8= document.createElement("input");
    input8.setAttribute("type", "hidden");
    input8.setAttribute("name", "nilailikuidasi[]");
    input8.setAttribute("value", rows[i].nilailikuidasi);
    table.appendChild(input8);

    var input9= document.createElement("input");
    input9.setAttribute("type", "hidden");
    input9.setAttribute("name", "jtempoagunan[]");
    input9.setAttribute("value", rows[i].jtempoagunan);
    table.appendChild(input9);

    var input10= document.createElement("input");
    input10.setAttribute("type", "hidden");
    input10.setAttribute("name", "idagunan[]");
    input10.setAttribute("value", rows[i].idagunan);
    table.appendChild(input10);

    var input11= document.createElement("input");
    input11.setAttribute("type", "hidden");
    input11.setAttribute("name", "noagunan[]");
    input11.setAttribute("value", rows[i].noagunan);
    table.appendChild(input11);

    var input12= document.createElement("input");
    input12.setAttribute("type", "hidden");
    input12.setAttribute("name", "uraianagunan[]");
    input12.setAttribute("value", rows[i].uraianagunan);
    table.appendChild(input12);

    var input13= document.createElement("input");
    input13.setAttribute("type", "hidden");
    input13.setAttribute("name", "rincianagunan[]");
    input13.setAttribute("value", rows[i].rincianagunan);
    table.appendChild(input13);

  }
  myTableDiv.appendChild(table);
}

// addTable(inputjenisagunan);

</script>

<link rel="stylesheet" href="{{ asset('dist/css/tabulator.min.css') }}">
<script type="text/javascript" src="{{ asset('dist/js/tabulator.min.js') }}"></script>

<script>

//Build Tabulator
var tableagunan = new Tabulator("#agunan-table", {
    height:"311px",
    layout:"fitColumns",
    selectable:1,
    reactiveData:true, //turn on data reactivity
    data:dataagunan, //load data into table
    columns:[
        {title:"No Agunan", field:"noagunan", sorter:"string", width:200},
        {title:"Agunan", field:"uraianagunan", sorter:"string"},
        {title:"Nilai Agunan", field:"nilaiagunan", sorter:"string"},
    ],
});

var selectedindex = 0;
tableagunan.on("rowClick", function(e, row){
  selectedindex=row.getIndex();
  document.getElementsByName('inputjenisagunan')[0].value = dataagunan[selectedindex-1].jenisagunan;
  document.getElementsByName('inputnilaiagunan')[0].value = dataagunan[selectedindex-1].nilaiagunan;
  document.getElementsByName('inputpemilikagunan')[0].value = dataagunan[selectedindex-1].pemilikagunan;
  document.getElementsByName('inputnilaiagunanbi')[0].value = dataagunan[selectedindex-1].nilaiagunanbi;
  document.getElementsByName('inputalamatagunan')[0].value = dataagunan[selectedindex-1].alamatagunan;
  document.getElementsByName('inputpersenlikuidasi')[0].value = dataagunan[selectedindex-1].persenlikuidasi;
  document.getElementsByName('inputbuktiagunan')[0].value = dataagunan[selectedindex-1].buktiagunan;
  document.getElementsByName('inputnilailikuidasi')[0].value = dataagunan[selectedindex-1].nilailikuidasi;
  document.getElementsByName('inputjtempoagunan')[0].value = dataagunan[selectedindex-1].jtempoagunan;
  document.getElementsByName('inputidagunan')[0].value = dataagunan[selectedindex-1].idagunan;
  document.getElementsByName('inputnoagunan')[0].value = dataagunan[selectedindex-1].noagunan;
  document.getElementsByName('inputuraianagunan')[0].value = dataagunan[selectedindex-1].uraianagunan;
  document.getElementsByName('inputrincianagunan')[0].value = dataagunan[selectedindex-1].rincianagunan;
});

tableagunan.on("rowContext", function(e, row){
    alert("Row " + row.getIndex() + " Context Clicked!!!!")
});

document.getElementById("reactivity-delete").addEventListener("click", function(){
    tableagunan.deleteRow(selectedindex);
    resetAgunan();
});

function setHoldDana(){
  if(document.getElementsByName("inputtabholddana")[0].value!=""){
    document.getElementsByName("inputperkiraanglholddana")[0].value = "2040101";
  }else{
    document.getElementsByName("inputperkiraanglholddana")[0].value = "";
  }  
};
function setNotariel(){
  if(document.getElementsByName("inputtabnotariel")[0].value!=""){
    document.getElementsByName("inputperkiraanglnotariel")[0].value = "2040101";
  }else{
    document.getElementsByName("inputperkiraanglnotariel")[0].value = "";
  }  
};
function setAsuransi(){
  if(document.getElementsByName("inputtabasuransi")[0].value!=""){
    document.getElementsByName("inputperkiraanglasuransi")[0].value = "2040101";
  }else{
    document.getElementsByName("inputperkiraanglasuransi")[0].value = "";
  }  
};
function setNilaiAgunanBI(){
  if(document.getElementsByName("inputnilaiagunan")[0].value!=""){
    document.getElementsByName("inputnilaiagunanbi")[0].value = document.getElementsByName("inputnilaiagunan")[0].value * 0.8;
  }else{
    document.getElementsByName("inputnilaiagunanbi")[0].value = "";
  }  
};
function setNilaiLikuidasi(){
  if(document.getElementsByName("inputpersenlikuidasi")[0].value!=""){
    document.getElementsByName("inputnilailikuidasi")[0].value = document.getElementsByName("inputnilaiagunanbi")[0].value * (document.getElementsByName("inputpersenlikuidasi")[0].value/100);
  }else{
    document.getElementsByName("inputnilailikuidasi")[0].value = "";
  }  
};

</script>

<script>
function autocomplete2(inp, arr, nama, alamat, tabungans) {
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
          b.innerHTML += arr[i].substr(val.length) + ' - ' + nama[i];
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value.trim();  
              // tabungans.forEach(findIndex);
              // function findIndex(value, index, array) {
              //   if(value.NO_REKENING.trim()==inp.value.trim()){
              //     inpnama.value=nama[index];
              //     inpalamat.value=alamat[index]; 
              //   } 
              // }  
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
          // inpnama.value=nama[currentFocus];
          // inpalamat.value=alamat[currentFocus];
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

var tabungans = {!! json_encode($tabungans) !!};

var rekening=[];
var  nasabahnama=[];
var nasabahalamat=[];
tabungans.forEach(splitData);
function splitData(value, index, array) {
  rekening.push(value.NO_REKENING);
  nasabahnama.push(value.nama_nasabah);
  nasabahalamat.push(value.alamat);  
}

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete2(document.getElementsByName("inputtabholddana")[0], rekening, nasabahnama, nasabahalamat, tabungans);
autocomplete2(document.getElementsByName("inputtabnotariel")[0], rekening, nasabahnama, nasabahalamat, tabungans);
autocomplete2(document.getElementsByName("inputtabasuransi")[0], rekening, nasabahnama, nasabahalamat, tabungans);

</script>