

<head>
    <meta charset="UTF-8">
    <title>Star Wars</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{url('assets/css/app.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/css/knacss.min.css')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/sass/app.scss')}}" media="all">
    <link rel="stylesheet" href="{{url('assets/knacss/sass/knacss.scss')}}" media="all">
</head>



<body>

<header id="header" role="banner" class="line pam">
    <h1>DASHBOARD</h1>
    <nav id="navigation">
        <ul class="pam txtcenter">

            <li class="pam inbl"><a href="/">Site Public</a></li>
            <li class="pam inbl"><a href="/logout/">Logout</a></li>
            <li class="pam inbl"><a href="/product/">Dashboard</a></li>
            <li class="pam inbl"><a href="/orderList/">Commandes</a></li>
        </ul>
    </nav>
</header>



<div id="admin" role="main" class="line pam">
    @yield('content', 'default value')
</div>



</body>

