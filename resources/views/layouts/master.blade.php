



<html>

<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/js/app.js')}}" media="all">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

</head>

<body>
<header id="header" role="banner" class="line pam">
    <h1><img src={{url("assets/imgTheme/logo.png")}}>Store</h1>

    @include('partials.nav')

</header>

<div id="main" role="main" class="line pam">
    @yield('content', 'default value')
</div>

<footer id="footer" role="contentinfo" class="line pam txtcenter">
    <nav id="nav" role="nav">
        <ul class="pam">
            <li class="pam inbl"><a href="/">Accueil</a></li>
            <li class="pam inbl"><a href="/mention/">Mentions</a></li>
            <li class="pam inbl"><a href="/contact/">Contact</a></li>
        </ul>
    </nav>
</footer>

</body>
</html>