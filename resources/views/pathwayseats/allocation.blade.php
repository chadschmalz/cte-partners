@extends('layout.app')

@section('content')


<div class="container-fluid">
        <div class="row p-3">
          <div class="col-md-3">
            <h1 class="h2">Assigned Seats</h1>
          </div>
          <div class="col-3">
            <label for="recipient-name" class="col-form-label">Semester:</label>
 <select class="form-select" id="semester"  onchange=" return refreshPathwayAllocationList()">
          <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
          @if(isset($semesters))
            @foreach($semesters as $semester)
              <option value="{{$semester->id}}" {{ $activesemester==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
            @endforeach
          @endif
        </select>
      </div>
      <div class="col-4 " style="display:none">        <label for="recipient-name" class="col-form-label">&nbsp;</label>

        <a href="/pathwayseats/{{$activesemester}}"><div class="form-control  btn btn-secondary" >Edit Seats</div></a>

      </div>
      <div class="col-2 " >

        <!-- Location Remove Modal -->
        <div class="modal fade" id="copySeatsModal" tabindex="-1" aria-labelledby="copySeatsModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="copySeatsModalLabel">Copy to Semester</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body ">

                              <form method="post" action="/copypathwayseats" id="copyseatsform" >
                                @csrf

                <div class="row p-3">
                  <div class="col">
                    <label for="recipient-name" class="col-form-label">From Semester:</label>
         <select class="form-select" id="fromsemester" name="fromsemester" >
                  <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
                  @if(isset($semesters))
                    @foreach($semesters as $semester)
                      <option value="{{$semester->id}}" {{ $activesemester==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
                    @endforeach
                  @endif
                </select>
              </div>
              <div class="col">
                <label for="recipient-name" class="col-form-label">To Semester:</label>
     <select class="form-select" id="tosemester" name="tosemester">
              <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
              @if(isset($semesters))
                @foreach($semesters as $semester)
                  <option value="{{$semester->id}}" {{ $activesemester+1==$semester->id  ?'selected':''}}>{{$semester->semester_desc}}</option>
                @endforeach
              @endif
            </select>
          </div>
            </div>


              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-success" >Copy</button>
              </form>

                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

              </div>
            </div>
          </div>
        </div>
        <label for="recipient-name" class="col-form-label">&nbsp;</label>
        <div class="form-control  btn btn-success" data-bs-toggle="modal" data-bs-target="#copySeatsModal">Copy to Semester</div>
      </div>
    </div>

<hr>
<div class="row ">

<div class="col-md-3 col-lg-3">
</div>

      <div class="col-md-6 col-lg-6">
        <div class="card">
          <div class="card-body">
            <div class="row">

<?php $allocation= 0; $assigned=0;?>
                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Pathway Desc</th>
                                                <th scope="col" >Business Seats</th>
                                                <th scope="col" >Assigned</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(count($pathwayseats) > 0)
                               @foreach($pathwayseats as $pathwayseat)
                               <tr  style="@if($businesspathwayseats[$pathwayseat->pathway_id] < $pathwayseat->allocation) color:red;font-weight:bold @endif @if($businesspathwayseats[$pathwayseat->pathway_id] == $pathwayseat->allocation && $businesspathwayseats[$pathwayseat->pathway_id] != 0 && $pathwayseat->allocation != 0) color:blue;font-weight:bold @endif">
                                 <td onclick="return location = this.getAttribute('href');" href="/business/all/{{$pathwayseat->pathway->id}}/all?Status=">{{$pathwayseat->pathway_desc}} (id: {{$pathwayseat->pathway->id}})</td>
                                 <td style="text-align:center" onclick="return location = this.getAttribute('href');" href="/businessActivePathway/all/{{$pathwayseat->pathway->id}}/all/{{$activesemester}}">{{$businesspathwayseats[$pathwayseat->pathway_id]}}</td>
                                 <td style="text-align:center" onclick="return location = this.getAttribute('href');" href="/students/{{$activesemester}}/all/{{$pathwayseat->pathway_id}}">{{$pathwayseat->allocation}}</td>
                                  </tr>
                                  <?php $allocation += $pathwayseat->seats; $assigned+=$pathwayseat->allocation;?>

                               @endforeach
                             @endif

                             <tr style="font-weight:bold"><td>Total Seats:</td><td> {{$allocation}}</td><td> {{$assigned}}</td>

                             </tr>

                              </tbody>
                          </table>

                        </form>



            </div>
        </div>
      </div>
    </div>

      <div class="col-md-3 col-lg-3">
        <div class="card">
          <div class="card-body">
            <div class="row" style="color:red;font-weight:bold">
             Red = Overallocated<br />
           </div>
               <div class="row" style="color:blue;font-weight:bold">
              Blue = Pathway Full<br />
            </div>
                <div class="row" style="color:#198754;font-weight:regular"><br />
                Click assigned number to view student list.<br />
              </div>
              <div class="row" style="color:#198754;font-weight:regular"><br />
              Click pathway to view business list.<br />
            </div>
        </div>
      </div>
</div>



@endsection
