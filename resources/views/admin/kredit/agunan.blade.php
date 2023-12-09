<div class="tab-pane" id="form_agunan">
  <div class="form-group row"> 
    <div class="col-lg-7 col-sm-12">
      <div class="form-group row">
        <div class="col-lg-2">
          <span class="labeljudulright">Jenis Agunan</span>
        </div>
        <div class="col-lg-10">
          <select class="form-control" name="inputkodegorup1">
            @foreach($kodegroup1kredit as $kodegroup1kredit)
              <option value="{{ $kodegroup1kredit->KODE_GROUP1 }}">{{ $kodegroup1kredit->KODE_GROUP1.' - '.$kodegroup1kredit->DESKRIPSI_GROUP1 }}</option>
            @endforeach                                  
          </select>
        </div> 
      </div>
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright">Pemilik Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
      </div>  
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Agunan BI</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright">Alamat Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
      </div>  
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">% Likuidasi</span>
        </div>
        <div class="col-lg-4 col-sm-12"> 
          <div class="row">             
            <div class="col-lg-6 col-sm-12">          
              <input type="text" name="inputtglanalisa" class="form-control">
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
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
      </div>  
      <div class="form-group row">    
        <div class="col-lg-2">
          <span class="labeljudulright">Nilai Likuidasi</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>
        <div class="col-lg-2">
          <span class="labeljudulright" style="font-size:11px;">J Tempo Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>          
      </div>  
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">ID. Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12"> 
          <input type="text" name="inputtglanalisa" class="form-control">
        </div> 
        <div class="col-lg-2">
            <span class="labeljudulright">No. Agunan</span>
        </div>
        <div class="col-lg-4 col-sm-12">          
          <input type="text" name="inputtglanalisa" class="form-control">
        </div> 
      </div>
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">Uraian Agunan</span>
        </div>
        <div class="col-lg-10 col-sm-12"> 
          <input type="text" name="inputtglanalisa" class="form-control">
        </div>        
      </div>
      <div class="form-group row"> 
        <div class="col-lg-2">
          <span class="labeljudulright">Rincian</span>
        </div>
        <div class="col-lg-10 col-sm-12"> 
          <textarea id="w3review" name="w3review" rows="3" cols="70">
          
          </textarea>
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

<style>

</style>

<script>
  function setImagePicked(e) {
    var tmppath = URL.createObjectURL(event.target.files[0]);
    $("img").fadeIn("fast").attr('src',tmppath);  
  }

</script>