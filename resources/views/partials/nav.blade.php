
<nav id="navigation">
    <ul class="pas txtcenter">

        <li class="pas inbl"><a href="/">Accueil</a></li>

        @forelse($categories as $category)
            <li class="pas inbl"><a href="/cat/{{$category->id}}">{{$category->title}}</a></li>
        @empty
            <li>{{trans('app.noCategory')}}</li>
        @endforelse

        <li class="pas inbl"><a href="/contact/">Contact</a></li>


       @if(Auth::check())
        @if(Auth::user()->role=='administrator')
           <li class="pas inbl"><a href="/logout/">Logout</a></li>
           <li class="pas inbl"><a href="/product/">Dashboard</a></li>
           <li class="pas inbl"><a href="/orderList/">Commandes</a></li>
        @else(Auth::user()->role=='visitor')
            <li class="pas inbl"><a href="/logout/">Logout</a></li>
            <li class="pas inbl"><a href="/order/">Espace privé</a></li>
        @endif
       @else
            <li class="pas inbl"><a href="/login/">Login</a></li>

       @endif


        <li class="panier pas inbl fr"><a href="/shopping/" class="right"><img src={{url("assets/imgTheme/pictoPanier.png")}}></a></li>
        <p class="txtright">{{$number}} produits</p>


    </ul>
</nav>