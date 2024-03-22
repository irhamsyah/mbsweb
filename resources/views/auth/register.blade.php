<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">

<div class="container">

<br>  <p class="text-center">Register User </p>
<hr>
<div class="flash-message">
    @foreach (['danger', 'warning', 'success', 'info'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
    @endforeach
</div>

<div class="card bg-light">
<article class="card-body mx-auto" style="max-width: 400px;">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="name" class="form-control" placeholder="Full name" type="text" value="{{ old('name') }}" required autocomplete="name" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i> </span>
            </div>
            <input name="username" class="form-control" placeholder="User Name" type="text" value="{{ old('username') }}" required autocomplete="username">
            @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div> 
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-building"></i> </span>
            </div>
            <select name="privilege" class="form-control">
                <option selected=""> Select Privilege</option>
                <option value="admin">Admin</option>
                <option value="teller">Teller</option>
                <option value="kredit">Kredit</option>
                <option value="deposito">Deposito</option>
            </select>
        </div> <!-- form-group end.// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password" placeholder="Create New Password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        </div> <!-- form-group// -->
        <div class="form-group input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
            </div>
            <input class="form-control" placeholder="Repeat password" type="password">
        </div> <!-- form-group// -->                                      
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block"> Create Account  </button>
        </div> <!-- form-group// -->      
        <p class="text-center">Have an account? <a href="{{route('login')}}">Log In</a> </p>                                                                 
</form>
</article>
</div> <!-- card.// -->

</div> 
<!--container end.//-->

<br><br>
<article class="bg-secondary mb-3">  
<div class="card-body text-center">
    <h3 class="text-white mt-3">Bahtera Group</h3>
<p class="h5 text-white">Company engaged in loading and unloading services  <br> at the Gresik port to support the activities of National Shipping companies</p>   <br>
<p><a class="btn btn-warning" target="_blank" href="http://bahterasetiagroup.com/"> bahterasetiagroup.com<i class="fa fa-window-restore "></i></a></p>
</div>
<br><br>
</article>