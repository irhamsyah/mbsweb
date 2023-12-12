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
          <input type="text" name="inputnilaiagunan" class="form-control">
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
              <input type="text" name="inputpersenlikuidasi" class="form-control">
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
      <input type="file" accept="image/jpeg, image/png, image/jpg" onchange="setImagePicked(event)">
      <output></output>
      <br>
      <br>
      <div class="form-group-lbl">
        <img id="path_foto_agunan" src="img\foto\default.jpg" style="justify-content: center; align-items: center;max-width:100%; max-height:400px;"/>
      </div>
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

//remove bottom row from table on button click
document.getElementById("reactivity-delete").addEventListener("click", function(){
    tableagunan.deleteRow(selectedindex);
    resetAgunan();
});

</script>