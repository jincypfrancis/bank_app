<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ABC Bank</title>
        <!-- Include any JavaScript files or external scripts here -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Include any CSS files or external stylesheets here -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body >
        <div id="app">

            <main class="py-4">
                @yield('content')
            </main>
        </div>
    </body>
</html>




