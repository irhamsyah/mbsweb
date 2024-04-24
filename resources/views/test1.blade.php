<!DOCTYPE html>
<html>

<head>
    <title>
        How to add table row in jQuery?
    </title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <style>
        table {
            margin: 25px 0;
            width: 200px;
        }

        table th,
        table td {
            padding: 10px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid;
        }
    </style>
    <script>
        let xline = 1; 
    $(document).ready(function(){
      $("#btn1").click(function(){
        $("p").append(" <b>Appended text</b>.");
      });
      $("#btn2").click(function(){
        var xvalue = document.getElementById('idnilai').value; 

        $("#1").append("<div class='row'><input type='text' name='jumlah"+xline+"' class='form-control' value='"+xvalue+"'></div>");
        xline++;

      });
    });
    </script>

</head>

<body>
    <h1 style="color: green">
        GeeksForGeeks
    </h1>

    <b>How to add table row in jQuery?</b>

    <p>
        Click on the button below to
        add a row to the table
    </p>

    <button class="add-row">
        Add row
    </button>
    <button class="btn-lg btn-danger" id="btn2">Tambah Text</button>

    <form method="POST" action="ngarang">
        @csrf
        <label for="idnilai">Nilai</label>
        <div class="row">
            <input type="text" name="nilai" id="idnilai">
        </div>
        <table>
            <thead>
                <tr>
                    <th>Rows</th>
                    <th>Rows</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>This is row 0</td>
                    <td>This is row 0</td>
                </tr>
            </tbody>
        </table>
        <div class="form-group" id="1">
        </div>
        <button type="submit" class="btn-lg btn-danger">Submit</button>
    </form>
    <!-- Script to add table row -->
    <script>
        let lineNo = 1; 
		$(document).ready(function () { 
			$(".add-row").click(function () { 
				markup = "<tr><td>This is row " 
					+ lineNo + "</td><td>Hasil tambahan " 
					+ lineNo + "</td></tr>"; 
				tableBody = $("table tbody"); 
				tableBody.append(markup); 
				lineNo++; 
			}); 
		}); 

    </script>
</body>

</html>