<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 text-center" href="/">
    <img class="navbar-brand-full" src="{{env('APP_LOGO','/img/logo.png')}}" height="30px"   alt="Logo">
  </a>
  <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <ul class="nav navbar-nav px-3 "><li class="nav-item text-light ">
<h5>{{env('APP_NAME','WBL')}}</h5></li>
</ul>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">

    <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <span>Welcome, {{ Auth::user()->name }} </span>

          </a>
          <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
            <li>
            <div class="dropdown-item">
              <label class="form-check-label" ><input type="checkbox" class="sessionPresent " id="sessionPresent"  {{session('presentation')=='1' ?'checked':''}} onchange="refreshPresentMode()">   Present Mode</label>
            </div>
            </li>
            <li><a class="dropdown-item" href="/logout">
            <i class="nav-icon icon-logout"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



</header>
