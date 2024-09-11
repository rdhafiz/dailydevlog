<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title> @yield('title') </title>
    <meta name="keywords" content="Daily Dev Log, programming blog, IT tutorials, technology articles, web development, mobile app development, coding tips, software development, tech news, programming insights, developer resources"/>
    <meta name="description" content="Daily Dev Log is your go-to resource for the latest insights, tutorials, and news on programming, IT, technology, web, and mobile app development. Stay updated with expert articles, coding tips, and in-depth guides designed to help developers and tech enthusiasts enhance their skills and knowledge."/>
    <meta name="subject" content="@yield('title')">
    <meta name="revised" content="{{date('D F d, Y, h:i A')}}" />
    <meta name="summary" content="Daily Dev Log is your go-to resource for the latest insights, tutorials, and news on programming, IT, technology, web, and mobile app development. Stay updated with expert articles, coding tips, and in-depth guides designed to help developers and tech enthusiasts enhance their skills and knowledge.">
    <meta name="url" content="{{url()->current()}}">
    <meta name="identifier-URL" content="{{url()->current()}}">
    <meta name="category" content="website,portfolio,service,team,it,programing,algorithm,development">
    <meta name="og:title" content="@yield('title')"/>
    <meta name="og:type" content="Daily Dev Log, programming blog, IT tutorials, technology articles, web development, mobile app development, coding tips, software development, tech news, programming insights, developer resources"/>
    <meta name="og:url" content="{{url()->current()}}"/>
    <meta name="og:image" content="{{asset('/images/daily-dev-log.jpg')}}"/>
    <meta name="og:site_name" content="@yield('title')"/>
    <meta name="og:description" content="Daily Dev Log is your go-to resource for the latest insights, tutorials, and news on programming, IT, technology, web, and mobile app development. Stay updated with expert articles, coding tips, and in-depth guides designed to help developers and tech enthusiasts enhance their skills and knowledge."/>

    <!--Stylesheets-->
    @vite('resources/scss/style.scss')

    <!--JS-->
    <script src="{{asset('/js/theme.js')}}"></script>

    {{-- axios --}}
    <script src="{{asset('/js/axios/dist/axios.min.js')}}"></script>

    {{-- vuejs --}}
    <script src="{{asset('/js/vue.min.js')}}"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{--select2--}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- editor js cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>

    <script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/simple-image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/image@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/checklist@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/quote@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/warning@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/marker@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/delimiter@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/inline-code@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/link@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/embed@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/@editorjs/table@latest"></script>

</head>
