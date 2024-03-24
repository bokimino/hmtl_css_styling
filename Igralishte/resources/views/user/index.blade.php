<h1>Welcome to User Dashboard</h1>

<a href="{{ route('logout') }}" class="d-flex align-items-center logoutBorder  link-dark text-decoration-none " id="dropdownUser3" data-bs-toggle="dropdown" aria-expanded="false" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
    <div class="logoutIconBorder p-2"><x-logout-button /></div>
    <p class="d-none d-md-flex ml-2 mb-0 font-weight-bold text-secondary">Одјави се</p>
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>