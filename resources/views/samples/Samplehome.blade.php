@extends('layout.app')

@section('content')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>

        <div class="btn-toolbar mb-2 mb-md-0" style="display:none">
          <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary">Share</button>
            <button class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            This week
          </button>
        </div>
      </div>
@include('inc.submitmessages')
      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="row ">
              <div class="col-sm-5">
                @if(Auth::user()->hasAnyRole(['superuser' ,'business']) )
                <h4 class="card-title mb-0 "><a href="/requesttable">Requests</a></h4>
                @else
                  <h4 class="card-title mb-0 ">Requests</h4>
                @endif
                <div class="small text-muted">{{date('l, F jS, Y')}}</div>
              </div>
            </div>
            <div class="row">



              @if(Auth::user()->hasAnyRole(['superuser' ,'business','principal']) )

  <div class="accordion col-md-12 col-lg-12" id="accordionExample">
              @if(count($requestsByLocation) > 0)
                @foreach($requestsByLocation as $key => $location)
                <div class="card mb-0 ">

                <div class="card-header mb-0 " id="headingOne" data-toggle="collapse" data-target="#collapse{{$location['location']->LOCATION}}" aria-expanded="true" aria-controls="collapse{{$location['location']->LOCATION}}">
                      {{$location['location']->LONG_DESC}} &nbsp;&nbsp;&nbsp;&nbsp;Pending Requests: {{$location['location']->requestCount}}
                </div>

                  <div id="collapse{{$location['location']->LOCATION}}" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                    <div class="card-body">
                      <table class="table">
                        <tr>
                          <th>
                            Request ID
                          </th>
                          <th>
                            Assignments in Request
                          </th>
                          <th>
                            Request Date
                          </th>
                        </tr>
                      @foreach($requests as $myrequest)
                      @if($myrequest->location_unique_id == $location['location']->location_unique_id)
                        <tr class='clickable-row' data-href='/changereview/{{$myrequest->id}}'>
                          <td>
                            {{$myrequest->id}}
                          </td>
                          <td>
                            {{count($myrequest->assignmentgroups)}}
                          </td>

                          <td>
                            {{date('m/d/Y',strtotime($myrequest->created_at))}}
                          </td>
                        </tr>
                        @endif
                      @endforeach
                    </table>

                    </div>
                  </div>

              </div>

                @endforeach

              @endif
            </div>
            @endif

            </div>
          </div>
        </div>
      </div>

</div>


@endsection
