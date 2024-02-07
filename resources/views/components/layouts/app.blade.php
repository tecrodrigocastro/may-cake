<head>
    @vite('resources/css/app.css')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;700&display=swap');
      </style>
    @livewireStyles


</head>
<body>
    {{ $slot }}

    @livewireScripts
</body>
