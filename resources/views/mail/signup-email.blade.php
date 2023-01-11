Hello {{$email_data['name']}}
<br><br>
Welcome to Bahtera Group!
<br>
Please click the below link to verify your email and activate your account!
<br><br>

<a href="http://bahterasetiagroup.com/verify?code={{$email_data['verification_code']}}">Click Here!</a>

{{-- <a href="http://localhost/my_tuts/send-emails/blog/public/verify?code={{$email_data['verification_code']}}">Click Here!</a> --}}

<br><br>
Thank you!
<br>
Bahtera Group