<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     
</head>
<body>
    <p>Dear <strong>{{$data['user']}}</strong>,</p> 
    <p>You are receiving this email because we received a password reset request for your account.</p>

    <p>Please click on the following link to reset your password:</p>

    {{-- <a href="{{  route('reset-password')}}">Reset Password</a>  --}}

    <p>Warm regards,<br> 
    <!-- <strong>[Your Title]</strong><br> -->
    <strong>Attendance Admin</strong><br>
</body>
</html>