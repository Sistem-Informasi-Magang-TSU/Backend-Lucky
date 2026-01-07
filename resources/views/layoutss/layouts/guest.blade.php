<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Magang TSU')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'tsu-teal': '#086375',
                        'tsu-teal-dark': '#064e5c',
                        'tsu-green': '#074755', 
                        'tsu-red': '#ef4444',
                        'tsu-blue': '#3b82f6',
                    },
                    fontFamily: {
                        'sans': ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        .full-page-gradient {
            background: linear-gradient(
                to top right, 
                #09697E 0%,
                #84B4BE 50%, 
                #FFFFFF 100%
            );
        }
    </style>
    
    @yield('styles') 
</head>
<body class="font-sans text-gray-800 full-page-gradient">

    @yield('content') 

</body>
</html>