@extends('layout.app')

@section('content')

@include('inc.results')
@include('event.modals')
<!-- Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="errorModalLabel">ERROR UPDATING</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body ">
        <div class="errorbody alert alert-danger">

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Events</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <ul class="nav nav-pills">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle btn btn-outline-secondary " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Links</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="/eventadd">Add events</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>


      <div class="row mb-3">
        <div class="col-md-2 col-lg-2">
          <label for="recipient-name" class="col-form-label">Semester:</label>
          <select class="form-select" id="eventsSemester" aria-label="Default select example" onchange=" return refreshEvents()">
            @if(isset($semesters))
            <option value="dropped">Dropped</option>
            <option value="unassigned" {{ $selectedSemester=='unassigned'?'selected':''}}>Unassigned</option>
            <option value="all" {{ $selectedSemester=='%'?'selected':''}}>All</option>
              @foreach($semesters as $semester)
                      <option value="{{$semester->id}}" {{ $selectedSemester==$semester->id?'selected':''}}>{{ $semester->status=="active"  ?'Current: ':($semester->semester_enddt < now()  ?'Prev: ':'')}}{{$semester->semester_desc}}</option>
              @endforeach

            @endif
          </select>
        </div>
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Location:</label>
          <select class="form-select" id="eventsLocation" aria-label="Default select example" onchange="return refreshEvents()">
            @if(isset($locations))
            <option value="all" {{ $selectedLocation=='all'?'selected':''}}>All</option>
              @foreach($locations as $location)
                      <option value="{{$location->id}}" {{ $selectedLocation==$location->id?'selected':''}}>{{$location->conesite_desc}}</option>
              @endforeach

            @endif
          </select>
        </div>

      
    <div class="col-md-3 col-lg-3">
        <label for="recipient-name" class="col-form-label">Cluster:</label>
      <select class="form-select eventsCluster" id="eventsCluster" aria-label="Default select example" onchange="return refreshEvents()">
        <option value="all" {{ $selectedCluster==NULL  ?'selected':''}}>All</option>
        @if(isset($clusters))
          @foreach($clusters as $c)
                  <option value="{{$c->id}}" {{ $selectedCluster==$c->id?'selected':''}}>{{$c->cluster_desc}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="col-md-1 col-lg-1">
      <label for="recipient-name" class="col-form-label">&nbsp;</label>
      <a href="/events"><button type="button" class="form-control btn btn-secondary">Reset</button></a>
    </div>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">
            <div class=" col-md-10 col-lg-10 text-end ml-auto">
            </div>

              <div class=" col-md-2 col-lg-2 text-end ml-auto">
                    <a href="/eventadd"><div class="form-control btn btn-sm btn-success " >Add</div></a>
              </div>
          </div>
            <div class="row">
                      <table class="table table-sm table-striped display alleventsDataTable" id="alleventsDataTable" >
                        <thead>
                            <tr>
                              <th scope="col" >Event</th>
                              <th scope="col" >Event Desc</th>
                              <th scope="col" >Event Date</th>
                              <th scope="col" >Location</th>
                              <th scope="col" >Business</th>
                              <th scope="col" >Cluster</th>
                              <th scope="col" >Pathway</th>
                              <th scope="col" >action</th>
                            </tr>
                          </thead>
                        <tbody >
                      @if(isset($events))
                        @foreach($events as $event)
                          <tr 
                            title="Notes: {{$event->notes}}"
                            data-toggle="popover" 
                            data-content="{{$event->notes}}"
                            data-container="body"
                            data-placement="bottom"
                          >
                            <td>{{$event->activity->activity_desc}}</td>
                            <td>
                              <a   href="/eventedit/{{$event->id}}" >
                                {{$event->event_desc}}
                              </a> 
                            </td>
                            <td>{{date('m/d/Y',strtotime($event->event_dt))}}</td>
                            <td>{{trim($event->location->location_desc)}}</td>
                            <td>@if(isset($event->business)){{$event->business->name}}@endif</td>
                            <td>{{$event->cluster->cluster_desc}}</td>
                            <td>{{$event->pathway->pathway_desc}}</td>
                            <td>              
                              <a href="/eventedit/{{$event->id}}"><div class="form-control btn btn-sm btn-primary "  >Edit</div></a>
                            </td>
                          </tr>
                        @endforeach
                      @endif
                      </tbody>
                  </table>
                  {{  $events->links() }}
            </div>
          </div>
        </div>
      </div>

</div>


@endsection
