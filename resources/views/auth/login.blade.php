<html lang="en" class="gr__coreui_io"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Partners</title>

  <link href="https://coreui.io/docs/assets/css/coreui-docs.min.css" rel="stylesheet">
  <link href="https://coreui.io/docs/assets/css/coreui-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<link href="{{asset('css/typeahead.css')}}" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css">
  <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/select2-bootstrap.css">
  <link rel="stylesheet" href="https://select2.github.io/select2-bootstrap-theme/css/gh-pages.css">

  <link rel="icon" href="{{asset('favicon.ico')}}">

</head>
<body class="app">
<div class="container h-100 " id="app">
  <div class="row justify-content-center mt-5">
    <div class="col-md-8 ">
      @if(Session::has('logged_out'))
      <div class="alert alert-primary" role="alert">
        {{ Session::get('logged_out') }}
      </div>
      @endif
      <div class="card-group">
        <div class="card p-4 ">
          <div class="card-body">
            <h1>Partners Login</h1>
            <p class="text-muted">Click the button below to log in</p>
            <a href="{{ url('/googlelogin') }}"><img src="/img/btn_google_signin_dark_normal_web.png"></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('js/app.js')}}" ></script>

<script src="{{asset('js/custom.js')}}"></script>
<script src="{{asset('js/feather.min.js')}}" ></script>
<script src="{{asset('js/coreui.min.js')}}" ></script>
<script src="{{asset('js/bootstrap3typeahead.js')}}" ></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.full.js"></script>
<script src="https://select2.github.io/select2-bootstrap-theme/js/anchor.min.js"></script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
</body>
</html>
