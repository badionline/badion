<body style="font-family: Arial, sans-serif;">
    <div class="container"
        style="justify-content: center;align-items:center;text-align:center;width: 80%;margin-top: 5%;padding: 40px;border: 1px solid #CB6242;border-radius: 20px;background-color: transparent;color:#ffffff;">
        <div class="container"
            style="justify-content: center;align-items:center;text-align:center;padding: 20px;border: 1px solid #CB6242;background: #303030;border-radius:15px;box-shadow:6px 6px 12px #0d0d0d, -6px -6px 12px #353535">
            <a href="{{ env('APP_URL_DOMAIN') }}/login">

                <img style="width:50%;" src="https://badion.w3spaces.com/badion.png" alt="Logo">
            </a>
            <h1 style="color: #CB6242;">Hey</h1>
            <h1 style="color: #CB6242;">Hi {{ $mailData['name'] }} Welcome To BadiOn</h1>
            <h3 style="color: #CB6242;">Your OTP is <label style="color:white">{{ $mailData['otp'] }}</label></h3>
            <code style="color: #CB6242;">Note:- This is an Autogenerated OTP, Do not share with anyone</code>
        </div>
    </div>
</body>