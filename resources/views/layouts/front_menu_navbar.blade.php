<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #2E86C1  
; border-bottom:1px solid lime;" >
  <div class="container-fluid">
    <a class="navbar-brand" href="#"></a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNav">
      <ul class="navbar-nav ">
        @foreach($categories as $key => $ctg) 
          <li class="nav-item">
            <a class="nav-link text-white" href="/online-store/{{$ctg->_id}}">{{$ctg->name}}</a>
          </li>
        @endforeach
      </ul>
    </div>

  </div>
</nav>

