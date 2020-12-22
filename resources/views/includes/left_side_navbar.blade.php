<li class="nav-item">
    <a class="nav-link {{ request()->path() == '/' ? 'active' : '' }}" href="/">Home <span class="sr-only">(current)</span></a>
</li>
{{-- <li class="nav-item">
    <a class="nav-link {{ request()->path() == 'posts' ? 'active' : '' }}" href="{{ url('/posts') }}">Post</a>
</li> --}}
<li class="nav-item">
    <a class="nav-link {{ request()->path() == 'posts' ? 'active' : '' }}" href="{{ url('/posts') }}">All Post</a>
</li>