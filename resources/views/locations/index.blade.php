@extends('layout.app')

@section('content')

@include('locations.modals')

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Locations</h1>

      </div>




      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row pb-2">
              <div class="col-2  btn btn-success" data-bs-toggle="modal" data-bs-target="#addlocationModal">Add location</div>
                <div class="col-8 ">
                </div>
              <div class="col-2"><a href="/locationimport"><div class=" btn btn-secondary">Import Locations</div></a></div>
            <div class="row">



                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Location #</th>
                                                <th scope="col" >Location Desc</th>
                                                <th scope="col" >Address</th>
                                                <th scope="col" >Phone</th>
                                                <th scope="col" >Conesite</th>
                                                <th scope="col" >Action</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($locations))
                               @foreach($locations as $location)
                               <tr>
                                 <td><a   href="#">{{$location->location_num}}</a></td>
                                     <td>{{$location->location_desc}}</td>
                                     <td>{{$location->address1 . " " .$location->city . " " . $location->state . " " . $location->zip }}</td>
                                     <td>{{$location->phone}}</td>
                                     <td>{{isset($location->conesite) ? $location->conesite->conesite_desc :""}}</td>
                                     <td>              <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addlocationModal" 
                                      data-bs-location_num="{{$location->location_num}}"
                                     data-bs-locationid="{{$location->id}}"
                                     data-bs-desc="{{$location->location_desc}}"
                                     data-bs-desc="{{$location->location_desc}}"
                                     data-bs-address1="{{$location->address1}}"
                                     data-bs-city="{{$location->city}}"
                                     data-bs-state="{{$location->state}}"
                                     data-bs-zip="{{$location->zip}}"
                                     data-bs-phone="{{$location->phone}}"
                                     data-bs-grades="{{$location->grades}}"
                                     data-bs-conesite="{{$location->conesite_id}}"
                                                              data-bs-action="locationupdate">Edit</div>

                                                              <div class=" btn btn-danger" data-bs-toggle="modal" data-bs-target="#removeLocationModal" data-bs-id="{{$location->id}}" data-bs-desc="{{$location->location_desc}}">X</div></a>

                                                            </td>

                                  </tr>
                               @endforeach
                             @endif

                              </tbody>

                          </table>






            </div>
          </div>
        </div>
      </div>

</div>


@endsection
