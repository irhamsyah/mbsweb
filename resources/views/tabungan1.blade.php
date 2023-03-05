<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    {{-- <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://code.jquery.com/jquery-3.6.3.js"></script> --}}
    <script>
$(document).ready(function () {
    $('#modalForm').modal({
        backdrop: 'static',
        keyboard: false
      })
    
   
    $("#submit, #close").click(function() {
        // Validation
        var form = $("#inputs")

        if (form[0].checkValidity() === false) {
            event.preventDefault()
            event.stopPropagation()
        }
        form.addClass('was-validated')

        //Declare and initialize variable for display inputs in div
        var code = "";
        $("#inputs").each(function() {
            var text1 = $(this).find("#firstname").val();
            var text2 = $(this).find("#lastname").val();
            code += text1 + " " + text2;
        });

        $("#results").html(code);
        
    });
});        
</script>

<style>
  html, body {
    height: 100%;
    width: 100%;
}

h1 {
    font-size: 45px !important;
}

.justify {
    text-align: justify;
}

.text-14 {
    font-size: 14px;
}

/* MODAL */

.bg-image {
    background-position: center center;
    background-repeat: no-repeat;
}

.modal-content {
    border: none;
    border-radius: 0px !important;
}

.form-control {
    border-radius: 0px !important;
    border: 0px;
    border-bottom: 1.3px solid #0069d9;
}

.form-control:valid {
    border-color: #0069d9 !important;
}

.was-validated .form-control:valid:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.modal-footer {
    padding: 0;
}

@media (min-width: 425px) {
    .modal-content {
        margin: 0 50px;
    }
    .modal-header {
        padding-top: 20px !important;
        padding-bottom: 20px !important;
        padding-left: 35px;
    }
    .modal-body {
        padding-top: 50px !important;
        padding-bottom: 50px !important;
        margin: 0 10px;
    }
}

@media (max-width: 424px) {
    .modal-content {
        margin: 0 20px;
    }
    .modal-header {
        padding: 20px auto;
        padding-left: 18px;
    }
    .modal-title {
        font-size: 17px;
    }
    .modal-body {
        padding-top: 30px !important;
        padding-bottom: 30px !important;
        padding-left: 0px !important;
        padding-right: 0px !important;
        margin: 0 10px;
    }
}

.close {
    color: #0069d9da;
    opacity: 6;
    text-shadow: 1px 1px 1px rgb(228, 228, 228);
    outline: 0 !important;
}

.close:hover {
    color: #0069d9;
    opacity: 6;
}

.btn-primary {
    height: 100%;
    width: 100%;
    padding: 20px 0;
    color: white;
    background-color: #0069d9da;
    border-color: #0069d9d3;
    border-radius: 0px !important;
}

.btn-primary:hover {
    color: #fff;
    background-color: #0069d9;
    border-color: #0066d3;
}

.btn-primary:not(:disabled):not(.disabled):active {
    color: white;
    background-color: #0069d9;
    border-color: #0066d3;
}

.btn-primary:focus {
    box-shadow: 0 0 0 !important;
}

.shadow {
    border-radius: 0px !important;
    box-shadow: 0 0rem 1rem rgba(0, 0, 0, 0.808)!important;;
}

/* SECTION */

.section {
    background-color: #0069d9c0;
    color: white;
}
  </style>
</head>
  <body>
    <div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content shadow">
              <div class="modal-header">
                  <h5 class="modal-title">Please tell us your name</h5>
                  <button type="button" id="close" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body bg-image" style="background-image: url()">
                  <form id="inputs" class="needs-validation" novalidate="">
                      <div class="form-group mx-2 mb-3">
                          <label for="firstname">First Name</label>
                          <input type="text" class="form-control" id="firstname" placeholder="First name" required="">
                      </div>
                      <div class="form-group mx-2">
                          <label for="lastname">Last Name</label>
                          <input type="text" class="form-control" id="lastname" placeholder="Last name" required="">
                      </div>
                  </form>
              </div>  
              <div class="modal-footer justify text-14">
                  <button id="submit" type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modalForm">Submit</button>
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid h-100 section">
      <div class="row h-100 d-flex">
          <div class="col-sm-12 align-self-center text-center text-50">
              <h1>HELLO</h1>
              <h1 id="results"></h1>
          </div>
      </div>
  </div>  

  </body>
</html>

