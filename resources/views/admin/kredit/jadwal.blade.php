<style>
.container {
    height: 65%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: large;
    margin-bottom: 10px;
}
.labeljudul {
    height: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: small;
    margin-top: 10px;
}
.tableheader {
    height: 45%;
    text-align: center !important;
    font-size: small;
}
</style>
<div class="tab-pane" id="form_jadwal_kredit">
  <div class="bottomlinesolid">
    <span class="judulOrange">Tunggakan</span>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <br>
      <span class="labeljudul">Tunggakan Pokok</span>
    </div>
    <div class="col-lg-6">
      <div class="row">              
        <div class="col-lg-10">
          <div class="row">
            <div class="col-lg-3 col-sm-12">
              <label for="inputsaldoawaltp">Saldo Awal</label>
              <input type="text" name="inputsaldoawaltp" class="form-control" value="0" readonly>
            </div>
            <div class="col-lg-3 col-sm-12">
              <label for="inputdebettp">Debet</label>
              <input type="text" name="inputdebettp" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <label for="inputkredittp">Kredit</label>
              <input type="text" name="inputkredittp" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <label for="inputsaldoakhirtp">Saldo Akhir</label>
              <input type="text" name="inputsaldoakhirtp" value="0" readonly class="form-control">
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-sm-12">
          <label for="inputfreqtp">Freq</label>
          <input type="text" name="inputfreqtp" value="0" readonly class="form-control">
        </div>
      </div>
    </div>
    <div class="col-lg-4"></div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudul">Tunggakan Bunga</span>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-10">
          <div class="row">            
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputsaldoawaltb" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputdebettb" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputkredittb" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputsaldoakhirtb" value="0" readonly class="form-control">
            </div>
          </div>          
        </div>  
        <div class="col-lg-2 col-sm-12">
            <input type="text" name="inputfreqtb" value="0" readonly class="form-control">
          </div>      
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-4">
          <span class="labeljudul">Tagihan saat jatuh tempo</span>
        </div>
        <div class="col-lg-8 col-sm-12">
          <input type="text" name="inputtagihanjt" value="0" class="form-control">
        </div>
      </div>
    </div>
  </div>
  <div class="form-group row">    
    <div class="col-lg-2">
      <span class="labeljudul">Tunggakan Denda</span>
    </div>
    <div class="col-lg-6">
      <div class="row">
        <div class="col-lg-10">
          <div class="row">            
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputsaldoawaltd" readonly class="form-control" value="0">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputdebettd" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputkredittd" value="0" readonly class="form-control">
            </div>
            <div class="col-lg-3 col-sm-12">
              <input type="text" name="inputsaldoakhirtd" value="0" readonly class="form-control">
            </div>
          </div>          
        </div>  
        <div class="col-lg-2 col-sm-12">
            <input type="text" name="inputfreqtd" value="0" readonly class="form-control">
          </div>      
      </div>
    </div>
    <div class="col-lg-4">
      <div class="row">
        <div class="col-lg-4">
          <span class="labeljudul">Mulai angsuran</span>
        </div>
        <div class="col-lg-8 col-sm-12">
          <input type="text" name="inputmulaiangsuran"  class="form-control">
        </div>
      </div>
    </div>
  </div>
  <div class="bottomlinesolid"></div>
  <div class="form-group row">    
    <div class="container">      
        <b>JADWAL PEMBAYARAN</b>
    </div>
    <div id="myDynamicTable"></div> 
  </div>  
  <button tabindex="-1" class="btn btn-primary" onclick="event.preventDefault();resetJadwal();">
    Reset Jadwal
  </button>
</div>
<script>
function resetJadwal(){
  var table = document.getElementsByName("tablejadwal")[0];
  table.remove();
  setJadwalAngsuran();
  addTable(tglangsuran);  
}
const roundOffTo = (num, factor = 1) => {
   const quotient = num / factor;
   const res = Math.round(quotient) * factor;
   return res;
};
var tglangsuran = [];
var angsuranpokok = [];
var angsuranbunga = [];
function setJadwalAngsuran(){
  if(document.getElementsByName("inputsatuanwaktuangsuran")[0].value=='B'){
    var parts =document.getElementsByName("inputmulaiangsuran")[0].value.split('/');
    var mydate = new Date(parts[2], parts[1] - 1, parts[0]); 
    tglangsuran = [];
    for (var i = 0; i < jumlahangsuran; i++) {          
      mydate.setMonth(mydate.getMonth() + 1); 
      let yyyy = mydate.getFullYear();
      let mm = mydate.getMonth() + 1; // Months start at 0!
      let dd = mydate.getDate();

      if (dd < 10) dd = '0' + dd;
      if (mm < 10) mm = '0' + mm;

      tglangsuran.push(dd + '/' + mm + '/' + yyyy);
      if(i==(jumlahangsuran-1)){
        var angsuranakhir = pokok - (roundOffTo(pokok/jumlahangsuran,100)*(jumlahangsuran-1));
        angsuranpokok.push(angsuranakhir);
      }else{
        angsuranpokok.push(roundOffTo(pokok/jumlahangsuran,100));
      }
      
      angsuranbunga.push(roundOffTo(bunga/jumlahangsuran,100));
    }
  }  
}
function addTable(rows) {
  var myTableDiv = document.getElementById("myDynamicTable");

  var table = document.createElement('TABLE');
  table.setAttribute("name","tablejadwal");
  table.border = '1';
  table.nodeName = "table";

  var tableBody = document.createElement('TBODY');
  table.appendChild(tableBody);

  var th1 = document.createElement('TH');
  th1.appendChild(document.createTextNode("Tgl. Trans"));
  th1.width = '120';
  th1.classList.add("tableheader");
  tableBody.appendChild(th1);
  
  var th2 = document.createElement('TH');
  th2.appendChild(document.createTextNode("Ke"));
  th2.width = '75';
  th2.classList.add("tableheader");
  tableBody.appendChild(th2);

  var th3 = document.createElement('TH');
  th3.appendChild(document.createTextNode("Floating Rate"));
  th3.width = '120';
  th3.classList.add("tableheader");
  tableBody.appendChild(th3);

  var th4 = document.createElement('TH');
  th4.appendChild(document.createTextNode("Angs. Pokok"));
  th4.width = '120';
  th4.classList.add("tableheader");
  tableBody.appendChild(th4);

  var th5 = document.createElement('TH');
  th5.appendChild(document.createTextNode("Angs. Bunga"));
  th5.width = '120';
  th5.classList.add("tableheader");
  tableBody.appendChild(th5);

  var th6 = document.createElement('TH');
  th6.appendChild(document.createTextNode("Angs. Admin"));
  th6.width = '120';
  th6.classList.add("tableheader");
  tableBody.appendChild(th6);

  var th7 = document.createElement('TH');
  th7.appendChild(document.createTextNode("Amr. Provisi"));
  th7.width = '120';
  th7.classList.add("tableheader");
  tableBody.appendChild(th7);

  var th8 = document.createElement('TH');
  th8.appendChild(document.createTextNode("Amr. Biaya"));
  th8.width = '120';
  th8.classList.add("tableheader");
  tableBody.appendChild(th8);

  var th9 = document.createElement('TH');
  th9.appendChild(document.createTextNode("Amr. Admin"));
  th9.width = '120';
  th9.classList.add("tableheader");
  tableBody.appendChild(th9);

  for (var i = 0; i < rows.length; i++) {
    var tr = document.createElement('TR');
    tableBody.appendChild(tr);

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "tglangsuran[]");
    input.setAttribute("value", tglangsuran[i]);
    document.getElementById("myDynamicTable").appendChild(input);

    var input2 = document.createElement("input");
    input2.setAttribute("type", "hidden");
    input2.setAttribute("name", "angsuranpokok[]");
    input2.setAttribute("value", angsuranpokok[i]);
    document.getElementById("myDynamicTable").appendChild(input2);

    var input3= document.createElement("input");
    input3.setAttribute("type", "hidden");
    input3.setAttribute("name", "angsuranbunga[]");
    input3.setAttribute("value", angsuranbunga[i]);
    document.getElementById("myDynamicTable").appendChild(input3);

    for (var j = 0; j < 9; j++) {
      var td = document.createElement('TD');
      td.width = '75';
      if(j==0){
        td.appendChild(document.createTextNode(rows[i]));
        tr.appendChild(td);
      }
      if(j==1){
        td.appendChild(document.createTextNode(i+1));
        tr.appendChild(td);
      }
      if(j==2){
        td.appendChild(document.createTextNode('0'));
        tr.appendChild(td);
      }
      if(j==3){
        td.appendChild(document.createTextNode(angsuranpokok[i]));
        tr.appendChild(td);
      }
      if(j==4){
        td.appendChild(document.createTextNode(angsuranbunga[i]));
        tr.appendChild(td);
      }
      if(j==5){
        td.appendChild(document.createTextNode('0'));
        tr.appendChild(td);
      }
      if(j==6){
        td.appendChild(document.createTextNode('0'));
        tr.appendChild(td);
      }
      if(j==7){
        td.appendChild(document.createTextNode('0'));
        tr.appendChild(td);
      }
      if(j==8){
        td.appendChild(document.createTextNode('0'));
        tr.appendChild(td);
      }
    }
  }
  myTableDiv.appendChild(table);
}
function setMulaiAngsuran(){
  document.getElementsByName("inputmulaiangsuran")[0].value = document.getElementsByName("inputtanggalrealisasi")[0].value;
}
addTable(5);
</script>