<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{Request::is('/') ? 'active':''}}" aria-current="page" href="/" style="{{Auth::user()->hasAnyRole(['superuser'])?'':'display:none'}}">
          <span data-feather="home"></span>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/students" >
          <span data-feather="users"></span>
          Students
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{Request::is('business') ? 'active':''}}" href="/business">
          <span data-feather="briefcase"></span>
          Business Partners
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{Request::is('allpocs') ? 'active':''}}" href="/allpocs">
          <span data-feather="list"></span>
          All POC List
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/events" >
          <span data-feather="calendar"></span>
          Events
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link  {{Request::is('seatallocation') ? 'active':''}}" href="/seatallocation/{{count(App\Models\semester::where('status','active')->get()) > 0 ? App\Models\semester::where('status','active')->get()[0]->id : ''}}" >
          <span data-feather="sliders"></span>
          Assigned Seats
        </a>
      </li>
      <li class="nav-item" style="display:none">
        <a class="nav-link" href="#">
          <span data-feather="bar-chart-2"></span>
          Reports
        </a>
      </li>
      <li class="nav-item" style="display:none">
        <a class="nav-link" href="#">
          <span data-feather="layers"></span>
          Integrations
        </a>
      </li>
      @if(Auth::user()->hasAnyRole(['superuser','fulledit']))

      <li class="nav-item">
        <a class="nav-link  d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#system-collapse" aria-expanded="false" href="/utils">
          <span data-feather="layers"></span>
          System Management
        </a>
        <div class="collapse " id="system-collapse">
          <ul class="nav flex-column mx-1">
            <li class="nav-item mx-4 {{Request::is('/utils') ? 'active':''}}"><a href="/utils" class="nav-link">Utilities</a></li>
            <li class="nav-item mx-4 {{Request::is('counselors') ? 'active':''}}"><a href="/counselors" class="nav-link">Manage Counselors</a></li>
            <li class="nav-item mx-4 {{Request::is('semesters') ? 'active':''}}"><a href="/semesters" class="nav-link">Manage Semesters</a></li>
            <li class="nav-item mx-4 {{Request::is('locations') ? 'active':''}}"><a href="/locations" class="nav-link">Manage Locations</a></li>
            <li class="nav-item mx-4 {{Request::is('pathways') ? 'active':''}}"><a href="/pathways" class="nav-link">Manage Pathways</a></li>
            <li class="nav-item mx-4 {{Request::is('pathwayseats') ? 'active':''}}"><a href="/pathwayseats/{{count(App\Models\semester::where('status','active')->get()) > 0 ? App\Models\semester::where('status','active')->get()[0]->id : ''}}" class="nav-link">Manage Seats</a></li>
          </ul>
        </div>
      </li>
    @endif
    @if(Auth::user()->hasAnyRole(['superuser','fulledit']))

<li class="nav-item">
  <a class="nav-link  d-inline-flex align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#reports-collapse" aria-expanded="false" href="/utils">
    <span data-feather="layers"></span>
    Reports
  </a>
  <div class="collapse " id="reports-collapse">
    <ul class="nav flex-column mx-1">
      <li class="nav-item mx-4 {{Request::is('/studentapplications') ? 'active':''}}"><a href="/studentapplications" class="nav-link">Applications Report</a></li>
      <li class="nav-item mx-4 {{Request::is('/studentclusters') ? 'active':''}}"><a href="/studentclusters" class="nav-link">Student Clusters Report</a></li>
      <li class="nav-item mx-4 {{Request::is('/eventreport') ? 'active':''}}"><a href="/eventreport" class="nav-link">Event Report</a></li>
    @if(Auth::user()->hasAnyRole(['superuser']))
@endif
    </ul>
  </div>
</li>
@endif

    </ul>
</nav>
