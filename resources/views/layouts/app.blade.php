<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vira | Notes</title>
    <!-- <script src="https://unpkg.com/alpinejs" defer></script> -->
    <link href="https://cdn.jsdelivr.net/gh/rastikerdar/vazirmatn@v33.003/Vazirmatn-font-face.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://unpkg.com/persian-datepicker@1.2.0/dist/css/persian-datepicker.min.css">
    <script src="https://cdn.tailwindcss.com"></script>

    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js" type="text/javascript"></script>
    <script src=" https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    @livewireStyles
    <style>
        [x-cloak] {
            display: none !important;
        }
        body {
            font-family: Vazirmatn, sans-serif;
        }
    </style>
</head>

<body class="bg-white text-base text-black">
    <div class="container-lg mx-auto p-6 pt-8">
        @yield('content')
    </div>
    @livewireScripts
</body>
</html>