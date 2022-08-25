<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link {{Request::is('/') ? 'active':''}}" aria-current="page" href="/" style="display:none">
          <span data-feather="home"></span>
          Dashboard
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
        <a class="nav-link" href="/students" >
          <span data-feather="users"></span>
          Students
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link  {{Request::is('seatallocation') ? 'active':''}}" href="/seatallocation/{{App\Models\semester::where('status','active')->get()[0]->id}}" >
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
            <li class="nav-item mx-4 {{Request::is('pathwayseats') ? 'active':''}}"><a href="/pathwayseats/{{App\Models\semester::where('status','active')->get()[0]->id}}" class="nav-link">Manage Seats</a></li>
          </ul>
        </div>
      </li>

    </ul>

<div style="display:none">
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"  >
      <span>Saved reports</span>
      <a class="link-secondary" href="#" aria-label="Add a new report">
        <span data-feather="plus-circle"></span>
      </a>
    </h6>
  </div>
    <ul class="nav flex-column mb-2" style="display:none">
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Current month
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Last quarter
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Social engagement
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <span data-feather="file-text"></span>
          Year-end sale
        </a>
      </li>
    </ul>
  </div>
</nav>
