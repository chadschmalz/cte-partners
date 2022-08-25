@extends('layout.app')

@section('content')

@include('counselors.modals')

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Counselors</h1>

      </div>




      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row pb-2">
              <div class="col-2 btn btn-success" data-bs-toggle="modal" data-bs-target="#addCounselorModal">Add Counselor</div>
            </div>
            <div class="row">



                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Name</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >School</th>
                                                <th scope="col" >Student Range</th>
                                                <th scope="col" >Action</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($counselors))
                               @foreach($counselors as $counselor)
                               <tr>
                                 <td>{{$counselor->name}}</td>
                                 <td>{{$counselor->email}}</td>
                                 <td><a   href="#">{{$counselor->school}}</a></td>
                                     <td>{{$counselor->assignment}}</td>
                                     <td>              <div class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCounselorModal" data-bs-id="{{$counselor->id}}" data-bs-name="{{$counselor->name}}" data-bs-school="{{$counselor->school}}"
                                                             data-bs-assignment="{{$counselor->assignment}}" data-bs-email="{{$counselor->email}}"
                                                              data-bs-action="counselorupdate">Edit</div>&nbsp;<div class="btn btn-danger " data-bs-toggle="modal" data-bs-target="#counselorremoveModal" data-bs-id="{{$counselor->id}}" data-bs-name="{{$counselor->name}}">X</div></td>

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
