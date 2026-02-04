<!DOCTYPE html>
<html>
<head>
    <style>
        @font-face {
            font-family: 'Exo2';
            src: url('{{ storage_path("fonts/exo2/Exo2-Black.ttf") }}') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Exo2';
            src: url('{{ storage_path("fonts/exo2/Exo2-Black.ttf") }}') format('truetype');
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: 'Exo2';
            src: url('{{ storage_path("fonts/exo2/Exo2-BlackItalic.ttf") }}') format('truetype');
            font-weight: 900;
            font-style: normal;
    }
        @page {
            margin: 0;
            size: A3 landscape;
        }

        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
        }

        body {
            font-family: 'Exo2', sans-serif;
            background-image: url('{{ public_path("img/" . 'landscape_poster_100.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }
        h1{

            font-family: 'Exo2', sans-serif;
            color:rgb(198, 40, 0);
            font-weight: 900;
            font-size: 60px;
        }
        .content {
            position: absolute;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            margin-top: 160px;
            /* margin-bottom:200px; */
        }

        .content img {
            width: 360px;
            margin-bottom:60px;
        }
    </style>
</head>
<body>
    <div class="content">
        <img src="{{ $qr }}">

        @php
            $fontSize = auth()->user()->poster_contact_2 ? '200px' : '220px';
        @endphp

        @if(auth()->user()->poster_contact_1)
            <h1 class="poster-number" style="margin-top: 0;
                line-height: .5;
                margin-bottom:0;

                margin-top: 32px;
                font-family: 'Exo2', sans-serif;
                color:rgb(198, 40, 0);
                font-weight: 900;
                font-size: {{ $fontSize }};">
                {{ str_replace('+233', '0', auth()->user()->poster_contact_1) }}
            </h1>
        @endif

        @if(auth()->user()->poster_contact_2)
            <h1 class="poster-number" style="margin-top: 0;
                line-height: .5;
                margin-bottom:0;
                margin-top: 16px;
                font-family: 'Exo2', sans-serif;
                color:rgb(198, 40, 0);
                font-weight: 900;
                font-size: {{ $fontSize }};">
                {{ str_replace('+233', '0', auth()->user()->poster_contact_2) }}
            </h1>
        @endif

        @if(!auth()->user()->poster_contact_1 && !auth()->user()->poster_contact_2)
            <h1 class="poster-number" style="margin-top: 0;
                line-height: .5;
                margin-bottom:0;
                font-family: 'Exo2', sans-serif;
                color:rgb(198, 40, 0);
                font-weight: 900;
                font-size: {{ $fontSize }};">
                {{ $contact }}
            </h1>
        @endif

    </div>
    
</body>
</html>
