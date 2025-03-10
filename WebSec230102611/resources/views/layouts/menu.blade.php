<nav class="navbar navbar-expand-sm bg-light">
    <div class="container-fluid">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/even') }}">Even Numbers</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/prime') }}">Prime Numbers</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/multable') }}">Multiplication Table</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/factorial') }}">Factorial</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/minitest') }}">MiniTest</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('/transcript') }}">Transcript</a></li>
            <li class="nav-item"><a class="nav-link" href="{{route('products_list')}}">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="./users2">Users 2</a></li>
        </ul>
    </div>
</nav>
