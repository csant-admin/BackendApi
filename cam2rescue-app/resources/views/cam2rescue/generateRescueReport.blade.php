<!DOCTYPE html>
<html>
<head>
    <title>Rescue Report</title>
    <style>
        body {
                font-family: 'Poppins', sans-serif;
                margin: 12px;
                padding: 0;
            }

            .container {
                width: 100%;
            }

            .logo {
                position: absolute;
                top: 0;
                left: 20;
                right: 0;
                bottom: 0;
            }

            .header-text {
                text-align: center;
                letter-spacing: 2px;
            }

            .header-text h1 {
                font-size: 24px;
                line-height: 2px;
            }

            .highlight-text {
                color: #6A0DAD;
            }

            .header-text p {
                font-size: 18px;
            }
    </style>
</head>
<body>
    <div class="container">
        <div class=" header-text">
            <img src="../public/images/logo3.png" width="80" height="80" class="logo" />
            <h1><span class="highlight-text">Cam</span>2Rescue</h1>
            <p>An online platform for pet rescue and shelter</p>
        </div>
    </div>
    <div>
        @foreach ($rescue as $r)
            <p>{{$r}}</p>
        @endforeach
    </div>
    <p>Test</p>
</body>
</html>
