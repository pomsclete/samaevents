<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title ?? config('app.name') }} | EPF ONLINE</title>

    <!-- Style Css -->
    <link rel="stylesheet" id="stylesheet" href="{{ asset('admin/src/css/style.css')}}">
    <link rel="stylesheet" id="colors" href="{{ asset('admin/src/css/colors.css') }}">
     @vite(['resources/css/app.css','resources/js/app.js'])
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700&display=swap" rel="stylesheet">
    <!-- Icons  -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

    @stack('styles')
    <!-- Favicon  -->
    <link rel="icon" href="{{ asset('admin/src/img/favicon.png') }}">
</head>
<body id="body-layout" class="text-body-lg relative font-sans font-medium text-gray-700 dark:text-gray-300 bg-surface-500 dark:bg-surfacedark-500  red-theme">
    {{ $slot }}

 <p class="alert alert-warning" wire:offline>
    Oups, votre appareil a perdu la connexion. La page Web que vous consultez est hors ligne.
</p>

<script src="{{ asset('admin/src/js/tailmater.js') }}"></script>
@livewireScripts
@stack('scripts')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<x-livewire-alert::scripts />
</body>
</html>
