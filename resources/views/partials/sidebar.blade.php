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
      <a href="{{ route('jobList.index') }}"
        class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'jobList.index') === 0) ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        Lista Job
      </a>
    </li>
    <li>
      <a href="{{ route('jobResult.index') }}"
         class="nav-link text-white {{ (strpos(Route::currentRouteName(), 'jobResult.index') === 0) ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        Risultati Job Completati
      </a>
    </li>
  </ul>

</div>
