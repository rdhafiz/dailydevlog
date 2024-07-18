<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Dev Blog</title>
    <!--Stylesheets-->
    @vite('resources/scss/style.scss')
    <!--JS-->
    <script src="{{'/js/theme.js'}}"></script>
    <script src="{{'/js/header.js'}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {{-- vuejs --}}
    <script src="{{asset('/js/vue.min.js')}}"></script>
</head>
