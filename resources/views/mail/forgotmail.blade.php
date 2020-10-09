<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot</title>
    <style>
        .sansserif {
            font-family: Arial, Helvetica, sans-serif;
        }
        .monospace {
            font-family: "Lucida Console", Courier, monospace;
        }
    </style>
</head>
<body>
    <div>        
        <center><h1 class="sansserif">Lean Management System</h1></center>
    </div>
    <div>
        <center>
            <p class="sansserif">Hi, <b>{{ $checkuser->Fullname }}</b>. Here is your OTP Code.</p>
        </center>
    </div>
    <div>
        <center>
            <h2 class="monospace">{{ $code }}</h2>
        </center>
    </div>
    <div>
        <center>
            <b class="sansserif"><p>*Dont tell this OTP Code to anyone*</p></b>
        </center>
    </div>       
            
       
</body>
</html>