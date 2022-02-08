<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
  style="width: 280px;">
  <a href="/"
    class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <span class="fs-4">Global IAM</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    <li class="nav-item">
      <a href="/"
        class="nav-link text-white {{ Route::currentRouteName() === 'home' ? 'active' : '' }}"
        aria-current="page">
        <i class="fas fa-tachometer-alt"></i>
        Home
      </a>
    </li>
    <li>
      <a href="{{ route('users.index') }}"
        class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'users.') === 0) ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        Utenti
      </a>
    </li>
    <li>
      <a href="{{ route('apps.index') }}"
        class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'apps.') === 0) ? 'active' : '' }}">
        <i class="fas fa-laptop-house"></i>
        App
      </a>
    </li>
    <li>
      <a href="{{ route("roles.index") }}"
        class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'roles.') === 0) ? 'active' : '' }}">
        <i class="fas fa-user-tag"></i>
        Ruoli
      </a>
    </li>

    <li>
      <a href="{{ route("permissions.index") }}"
         class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'permissions.') === 0) ? 'active' : '' }}">
        <i class="fas fa-user-tag"></i>
        Permessi
      </a>
    </li>
  </ul>

</div>
