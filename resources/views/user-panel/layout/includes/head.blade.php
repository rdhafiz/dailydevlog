<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Daily Dev Blog</title>

    <!--Stylesheets-->
    @vite('resources/scss/style.scss')

    <!--JS-->
    <script src="{{asset('/js/theme.js')}}"></script>

    {{-- axios --}}
    <script src="{{asset('/js/axios/dist/axios.min.js')}}"></script>

    {{-- vuejs --}}
    <script src="{{asset('/js/vue.min.js')}}"></script>

    {{-- rich text editor --}}
    <link rel="stylesheet" href="{{asset('/richtexteditor/rte_theme_default.css')}}" />
    <script type="text/javascript" src="{{asset('/richtexteditor/rte.js')}}"></script>
    <script type="text/javascript" src='{{asset('/richtexteditor/plugins/all_plugins.js')}}'></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

</head>
