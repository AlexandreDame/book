<nav class="navbar navbar-expand-lg bg-dark">
  <a class="navbar-brand text-white "><strong class="h2">B<span class="text-primary">OO</span>KS</strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link text-white" href="{{ url('/') }}">Accueil <span class="sr-only">(current)</span></a>
      </li>
      @if(Route::is('book.*') == false)
      @forelse($genres as $id =>$name)
      <li class="nav-item">
        <a class="nav-link text-white" href="{{ url('genre', $id) }}">{{ $name }}</a>
      </li>
      @empty
      @endforelse
      @endif
    </ul>
    <ul class="nav navbar-nav ml-auto ">
      @if(Auth::check())
                <li class="nav-item texte-white"><a class="nav-link" href="{{route('book.index')}}">Dashboard </a></li> 
                <li class="nav-item texte-white" ><a class="nav-link" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                             Logout
                </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>  
                @else 
                <li class="nav-item texte-white"><a class="nav-link" href="{{route('login')}}"> Login</a></li>   
                @endif         
    </ul>

  </div>
</nav>