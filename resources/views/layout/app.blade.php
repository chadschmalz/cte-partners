
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="generator" content="Hugo 0.79.0">
    <title>@if(isset($page)) {{$page}} @else {{env('APP_TITLE','WBL')}} @endif</title>


    <!-- Bootstrap core CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">

	<link rel="stylesheet" href="{{asset('css/custom.css')}}">
	<link rel="stylesheet" href="{{asset('css/select2.min.css')}}">
	<link rel="stylesheet" href="{{asset('css/select2-bootstrap.css')}} ">
    <!-- Favicons -->
<link rel="icon" href="/favicon.ico" sizes="32x32" type="image/png">

<meta name="theme-color" content="#7952b3">
<script>
    window.thePage = '{{ Route::currentRouteName() }}';
</script>

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .dataTables_filter {
   float: left !important;
}
    </style>


    <!-- Custom styles for this template -->
    <link href="https://getbootstrap.com/docs/5.0/examples/dashboard/dashboard.css" rel="stylesheet">
  </head>
  <body>
    @include('layout.header')

<div class="container-fluid">
	

  <div class="row">
    @include('layout.sidebar')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

    @yield('content')

    </main>
  </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script>
      <script src="{{asset('js/jquery-3.2.1.min.js')}} " ></script>
      <script type="text/javascript" src="{{asset('js/datatables.min.js')}}"></script>
<script src="{{asset('js/feather.min.js')}}" ></script>
<script src="{{asset('js/select2.full.js')}} "></script><script src="{{asset('js/bootstrap.bundle.min.js')}} "></script>

<script>

			// Set the "bootstrap" theme as the default theme for all Select2
			// widgets.
			//
			// @see https://github.com/select2/select2/issues/2927
			$.fn.select2.defaults.set( "theme", "bootstrap" );

			var placeholder = "Select a State";

			$( ".select2-single, .select2-multiple" ).select2( {
				placeholder: placeholder,
				width: null,
				containerCssClass: ':all:'
			} );

			$( ".select2-allow-clear" ).select2( {
				allowClear: true,
				placeholder: placeholder,
				width: null,
				containerCssClass: ':all:'
			} );

			// @see https://select2.github.io/examples.html#data-ajax
			function formatRepo( repo ) {
				if (repo.loading) return repo.text;

				var markup = "<div class='select2-result-repository clearfix'>" +
					"<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
					"<div class='select2-result-repository__meta'>" +
						"<div class='select2-result-repository__title'>" + repo.full_name + "</div>";

				if ( repo.description ) {
					markup += "<div class='select2-result-repository__description'>" + repo.description + "</div>";
				}

				markup += "<div class='select2-result-repository__statistics'>" +
							"<div class='select2-result-repository__forks'><span class='glyphicon glyphicon-flash'></span> " + repo.forks_count + " Forks</div>" +
							"<div class='select2-result-repository__stargazers'><span class='glyphicon glyphicon-star'></span> " + repo.stargazers_count + " Stars</div>" +
							"<div class='select2-result-repository__watchers'><span class='glyphicon glyphicon-eye-open'></span> " + repo.watchers_count + " Watchers</div>" +
						"</div>" +
					"</div></div>";

				return markup;
			}

			function formatRepoSelection( repo ) {
				return repo.full_name || repo.text;
			}

			$( ".js-data-example-ajax" ).select2({
				width : null,
				containerCssClass: ':all:',
				ajax: {
					url: "https://api.github.com/search/repositories",
					dataType: 'json',
					delay: 250,
					data: function (params) {
						return {
							q: params.term, // search term
							page: params.page
						};
					},
					processResults: function (data, params) {
						// parse the results into the format expected by Select2
						// since we are using custom formatting functions we do not need to
						// alter the remote JSON data, except to indicate that infinite
						// scrolling can be used
						params.page = params.page || 1;

						return {
							results: data.items,
							pagination: {
								more: (params.page * 30) < data.total_count
							}
						};
					},
					cache: true
				},
				escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
				minimumInputLength: 1,
				templateResult: formatRepo,
				templateSelection: formatRepoSelection
			});

			$( "button[data-select2-open]" ).click( function() {
				$( "#" + $( this ).data( "select2-open" ) ).select2( "open" );
			});

			$( ":checkbox" ).on( "click", function() {
				$( this ).parent().nextAll( "select" ).prop( "disabled", !this.checked );
			});

			// copy Bootstrap validation states to Select2 dropdown
			//
			// add .has-waring, .has-error, .has-succes to the Select2 dropdown
			// (was #select2-drop in Select2 v3.x, in Select2 v4 can be selected via
			// body > .select2-container) if _any_ of the opened Select2's parents
			// has one of these forementioned classes (YUCK! ;-))
			$( ".select2-single, .select2-multiple, .select2-allow-clear, .js-data-example-ajax" ).on( "select2:open", function() {
				if ( $( this ).parents( "[class*='has-']" ).length ) {
					var classNames = $( this ).parents( "[class*='has-']" )[ 0 ].className.split( /\s+/ );

					for ( var i = 0; i < classNames.length; ++i ) {
						if ( classNames[ i ].match( "has-" ) ) {
							$( "body > .select2-container" ).addClass( classNames[ i ] );
						}
					}
				}
			});
      feather.replace()

		</script>
      <script src="{{asset('js/custom.js')}}?date={{date('m/d/y')}}"></script>
  </body>
</html>
