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
            margin-bottom: 1rem;
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
        .full-width-line {
            display: block;
            border-top: 0.5px solid #009879;
            width: 100%;
            margin: 20px 0;
            height: 0;
            /* border-top: 4px solid #FF5733; */
            border-top: 2px solid #6A0DAD;
        }
        .pdf-data-layout {
            display: inline-block;
            box-sizing: border-box;
            width: 100%;
            margin-top: 4rem;
        }
        .column{
            width: 48%;
            display: inline-block;
        }
        .highlight-text-label {
            font-family: 'Poppins', sans-serif;
            color: #6A0DAD;
            font-size: 18px;
            font-weight: 500;
        }
        .important-note {
            font-family: 'Poppins', sans-serif;
            color: #ff0000;
            font-size: 16px;
            font-weight: 500;
        }
        .sub-header-label {
            font-family: 'Poppins', sans-serif;
            color: #6A0DAD;
            font-size: 20px;
            font-weight: 500;
            line-height: 1px;
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
        <span class="full-width-line"></span>
        <div class="pdf-data-layout">
            <div class="column">
                <img src="../public/storage/{{ $ImagePath }}" width="320" height="360" />
            </div>
            <div class="column">
                <p><span class="highlight-text-label">Rescue ID Number :</span>      {{$RescueId}} </p>
                <p><span class="highlight-text-label">Address :</span>               {{$Address}} </p>
                <p><span class="highlight-text-label">Color :</span>                 {{$PetColorId}} </p>
                <p><span class="highlight-text-label">Gender :</span>                {{$PetSexId}} </p>
                <p><span class="important-note">Important Note :</span>              {{$ImportantNote}} </p>
                <p><span class="highlight-text-label">Posted By :</span>             {{$created_by}} </p>
                <p><span class="highlight-text-label">Posted On :</span>             {{$created_at}} </p>
                <p><span class="highlight-text-label">Approved  On :</span>          {{$updated_at}} </p>
                <p><span class="highlight-text-label">Approve & Rescued By :</span>  {{$updated_by}} </p>
                <p><span class="highlight-text-label">Rescue Status :</span>         {{$RescueStatus}} </p>
            </div>
        </div>
        <p class="sub-header-label">Description</p>
        <p>{{ $Description }}</p>
    </div>
</body>
</html>
