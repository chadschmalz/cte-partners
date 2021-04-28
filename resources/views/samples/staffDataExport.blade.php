@extends('layout.app')

@section('content')
<div class="container-fluid">
  <div id="staffMessage"></div>
  <div class="row my-3">
    <div class="col-md-12 col-lg-12">

    <h4>Staffing Data Export:</h4>

  </div>
    <div class="w-100 ">    </div>

            <div class="col-md-3 col-lg-3">
              Fiscal Year:
              <select class="form-control" id="staffFiscalYear" name="fiscalyear"  onchange=" return updateRequisitionsExport()">
                @if(count($fiscalyears) > 0)
                  @foreach($fiscalyears as $fiscalyear)
                        <option value="{{$fiscalyear->id}}" {{ $selectedFiscalYear->id == $fiscalyear->id ? 'selected':''}}>{{$fiscalyear->fiscal_year}}</option>
                  @endforeach

                @else
                  <option>No Fiscal Years - Select a location</option>

                @endif
              </select>
            </div>
            <div class="col-md-4 col-lg-4">
              <div class="form-group">
                Location:
                <select class="form-control" id="staffLocation" name="location_unique_id" onchange="return updateRequisitionsExport()">
                  @if(count($locations) > 0 && $selectedLocation != '' && $selectedLocation != 'all')
                  <option value="all" selected>All Locations</option>

                    @foreach($locations as $loc)
                      <option value="{{$loc->UNIQUE_ID}}"  {{ $loc->UNIQUE_ID == $selectedLocation->UNIQUE_ID ? 'selected':''}}>{{$loc->LOCATION}}&nbsp;{{$loc->LONG_DESC}}</option>
                    @endforeach
                  @elseif(count($locations) > 0)
                    <option value="notselected">Select location</option>
                    @if($selectedLocation == 'all')
                      <option value="all" selected>All Locations</option>
                    @endif
                      @foreach($locations as $loc)
                        <option value="{{$loc->UNIQUE_ID}}" >{{$loc->LOCATION}}&nbsp;{{$loc->LONG_DESC}}</option>
                      @endforeach
                  @else
                    <option>No Locations Available</option>
                    <option value="all" selected>All Locations</option>
                  @endif
                </select>
              </div>
                </div>
            <div class="col-md-4 col-lg-4">
              <div class="form-group">
                Category:
                <select class="form-control" id="category" name="category" onchange="return updateRequisitionsExport()">

                      <option value="CERT" {{ $category == 'CERT' ? 'selected':''}}>CERTIFIED</option>
                      <option value="CLAS" {{ $category == 'CLAS' ? 'selected':''}}>CLASSIFIED</option>
                      <option value="ADMN" {{ $category == 'ADMN' ? 'selected':''}}>ADMIN</option>

                </select>
              </div>
                </div>
              <div class="col-md-4 col-lg-4">
              </div>

              <div class="w-100 ">    </div>
              <div class="col-md-12 col-lg-12">

<div class="card ">

<div class="card-body pb-0">
    @if($selectedLocation == 'all')
                        <h2>Staff for All Locations</h2>
    @elseif($selectedLocation!= '' && $selectedLocation != 'all')
                        <h2>Staff for {{$selectedLocation->LONG_DESC}}</h2>

    @else
      <h2> Select a location ↑</h2>
    @endif
    @include('inc.submitmessages')


        <div class="databuttons mb-1">
          Toggle column: <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0">Location</a>
          <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Employee ID</a>
        					<a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Employee</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">SalIndex</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Position</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Category</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">Account</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="7">FTE</a>
                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="8">Funding Source</a>
        				</div>

        <table class="table table-sm table-striped display allReqsDataTable" id="allReqsDataTable" w>
                            <thead>
                                <tr>
                                  <th scope="col" >Location</th>
                                  <th scope="col" >Employee ID</th>
                                  <th scope="col" >Employee</th>
                                  <th scope="col" >SalIndex</th>
                                  <th scope="col" >Position</th>
                                  <th scope="col" >Category</th>
                                  <th scope="col" >Account</th>
                                  <th scope="col" >FTE</th>
                                  <th scope="col">Funding Source</th>
                                </tr>
                                </thead>
                                <tbody >
              @if($personList)
                 @foreach($personList as $req)
                 <tr><td>{{$req->location}}</td>
                   <td><a   href="#">{{$req->employee_id}}</a></td>
                   <td><a   href="#">{{$req->name}}</a></td>
                 <td>{{$req->current_salary_index}}</td>
                       <td>{{$req->position_assgno}} {{$req->position_desc}} {{$req->has_been_copied}}</td>
                       <td>{{$req->category}}</td>
                       <td>{{$req->account_dist}}</td>
                       <td>{{$req->FTE}}</td>
                       <td>{{trim($req->funding_source_code)}}</td>
                    </tr>
                 @endforeach
               @endif

                </tbody>
                <tfoot>
                  <tr>
                    <th scope="col" >Employee</th>
                    <th scope="col" >Position</th>
                    <th scope="col" >Category</th>
                    <th scope="col" >Account</th>
                    <th scope="col" >FTE</th>
                    <th scope="col">Funding Source</th>
                    <th scope="col">Replacing</th>

                  </tr>
                </tfoot>
            </table>



</div>
</div>
</div>
</div>


</div>


@endsection
