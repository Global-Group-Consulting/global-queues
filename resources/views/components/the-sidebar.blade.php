<div class="d-flex flex-column flex-shrink-0 p-3 text-white bg-dark"
     style="width: 280px;">
  <a href="/"
     class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
    <span class="fs-4">Global Queues</span>
  </a>
  <hr>
  <ul class="nav nav-pills flex-column mb-auto">
    @foreach($links as $link)
      @php
        $class = "";

        if(key_exists("divider", $link)){
          $direction = $link['divider'];

          if($direction === "top"){
            $class = "mt-3 pt-3 border-top";
          }else{
            $class = "mb-3 pb-3 border-bottom";
          }
        }
      @endphp

      <li class="nav-item {{ $class }}">
        <a href=" {{$link["url"] }}"
           class="nav-link text-white {{ $link['active'] ? 'active' : '' }}"
           aria-current="page">
          <i class="fas {{$link['icon']}} me-2"></i>
          {{$link["text"]}}
        </a>
      </li>
    @endforeach
  </ul>

</div>
