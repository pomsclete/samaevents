<!DOCTYPE html>
<html lang="fr">
<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Title  -->
  <title>EPF | EPF ONLINE</title>

  <!-- Style Css -->
  <link rel="stylesheet" id="stylesheet" href="{{ asset('admin/src/css/style.css')}}">
  <link rel="stylesheet" id="colors" href="{{ asset('admin/src/css/colors.css') }}">
  @vite(['resources/css/app.css','resources/js/app.js'])

  <!-- Google font -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;600;700&display=swap" rel="stylesheet">
  <!-- Icons  -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">

  <!-- Favicon  -->
  <link rel="icon" href="{{ asset('admin/src/img/favicon.png') }}">
</head>
<body id="body-layout" class="text-body-md relative font-sans font-normal text-gray-700 dark:text-gray-300 bg-surface-500 dark:bg-surfacedark-500 show">
    <!-- preloader -->
    <div class="preloader fixed inset-0 z-50 bg-gray-50 dark:bg-gray-900">
      <div class="w-full h-screen flex justify-center items-center">
        <!-- loader -->
        <svg class="circular-loader relative w-[100px] h-[100px]">
          <circle class="path stroke-primary-600 dark:stroke-primary-200" cx="50" cy="50" r="20" fill="none" stroke-width="5" stroke-miterlimit="10"></circle>
        </svg>
      </div>
    </div>
   @include('extends.side-bar')
        <main class="lg:flex">
            @include('extends.aside')
             @yield('content')
        </main>
    <script src="{{ asset('admin/src/js/tailmater.js') }}"></script>
</body>
</html>
