<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Certificate</title>
    <style>
        @page {
            margin: 0;
            padding: 0;
            size: a4 landscape;
        }
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            font-family: 'Helvetica', 'Arial', sans-serif;
        }
        .certificate-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
            background-image: url('{{ $template }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        .certificate-field {
            position: absolute;
            font-weight: bold;
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="certificate-wrapper">
        @foreach($fields as $field)
            <div class="certificate-field" style="
                left: {{ $field['x'] }}%;
                top: {{ $field['y'] }}%;
                font-size: {{ $field['size'] }}px;
                color: {{ $field['color'] }};
                transform: translate(-50%, -50%);
            ">
                {{ $field['text'] }}
            </div>
        @endforeach
    </div>
</body>
</html>
