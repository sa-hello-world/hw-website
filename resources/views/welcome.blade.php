<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hello World – Welcome</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Bayon&family=Crafty+Girls&family=Public+Sans:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-hwblack text-white font-text">
<!-- Navbar -->
<x-layouts.app.navigation />

<!-- Home/Greeting -->
<x-layouts.greeting />

<!-- About Us / Description -->
<x-layouts.about-us />

<!-- Events -->
<x-layouts.event-list :events="$events" />

<!-- Member Benefits -->
<x-layouts.join-us />

<!-- Sponsors -->
<x-layouts.sponsors-grid :sponsors="$sponsors" />

<!-- Footer -->
<x-layouts.app.footer />
</body>
</html>
