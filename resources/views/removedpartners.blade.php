@extends('layout.app')

@section('content')

@include('modals.business.add')

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <div class="fs-2 btn btn-outline-danger">Removed Business Partners</div>
        <div class="btn-toolbar mb-2 mb-md-0">
          <ul class="nav nav-pills">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle btn btn-outline-secondary " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Links</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addBizModal">Add Partner</a></li>
        <li><a class="dropdown-item" href="#">View Removed Partners</a></li>
      </ul>
    </li>
  </ul>
        </div>
      </div>
      <div class="row mb-3">
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Cluster:</label>
        <select class="form-select" id="businessCluster" aria-label="Default select example"  onchange=" return refreshBusinessList()">
          <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
          @if(isset($clusters))
            @foreach($clusters as $cluster)
              <option value="{{$cluster->id}}" {{ $selectedCluster==$cluster->id  ?'selected':''}}>{{$cluster->cluster_desc}}</option>
            @endforeach
          @endif
        </select>
      </div>
      <div class="col-md-3 col-lg-3">
        <label for="recipient-name" class="col-form-label">Pathway:</label>
      <select class="form-select" id="businessPathway" aria-label="Default select example" onchange=" return refreshBusinessList()">
        <option value="all" {{!isset($selectedPathway)?'selected':''}}></option>
        @if(isset($pathways))
          @foreach($pathways as $path)
                  <option value="{{$path->id}}" {{ $selectedPathway==$path->id?'selected':''}}>{{$path->pathway_desc}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="col-md-3 col-lg-3">
      <label for="recipient-name" class="col-form-label">Involvement:</label>
      <select class="form-select" id="businessInvolve" aria-label="Default select example" onchange=" return refreshBusinessList()">
        <option value="all" {{!isset($selectedActivity)?'selected':''}}></option>
        @if(isset($activitys))
          @foreach($activitys as $activity)
                  <option value="{{$activity->id}}" {{ $selectedActivity==$activity->id?'selected':''}}>{{$activity->activity_desc}}</option>
          @endforeach
        @endif
      </select>
    </div>
    <div class="col-md-1 col-lg-1">
      <label for="recipient-name" class="col-form-label">&nbsp;</label>
      <a href="/"><button type="button" class="form-control btn btn-secondary">Reset</button></a>
    </div>
      </div>

      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

                      <div class="databuttons mb-1">
                        Toggle column:
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0"> ID</a>
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Business</a>
                      					<a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Safety Agreement</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">POC</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Email</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Phone</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">Note</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="7">Involvement</a>
                      				</div>

                      <table class="table table-sm table-striped display allBizDataTable" id="allBizDataTable" w>
                                          <thead>
                                              <tr>
                                                <th scope="col" > ID</th>
                                                <th scope="col" >Business</th>
                                                <th scope="col" >Safety Agreement</th>
                                                <th scope="col" >POC</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >Phone</th>
                                                <th scope="col" >Note</th>
                                                <th scope="col" >Involvement</th>
                                                <th scope="col" ></th>
                                              </tr>
                                              </thead>
                                              <tbody >
                                                @if(isset($businesses))
                                                   @foreach($businesses as $biz)
                                                   <tr>
                                                     <td><a   href="#">{{$biz->id}}</a></td>
                                                     <td><a   href="/businessdetail/{{$biz->id}}">{{$biz->name}}</a></td>
                                                   <td>{{$biz->safety_agreement}}</td>
                                                         <td>{{$biz->pocs[0]->name}}</td>
                                                         <td>{{$biz->pocs[0]->email}}</td>
                                                         <td>{{$biz->pocs[0]->phone}}</td>
                                                         <td>{{$biz->notes}}</td>
                                                         <?PHP
                                                         $activities = '';
                                                         foreach($biz->activities as $act)
                                                            $activities .= $act->activity->activity_desc.", ";

                                                            //
                                                            // @if(isset($businesses))
                                                            // @foreach($businesses as $business)
                                                            // @foreach($business->pocs as $poc)
                                                            //    <tr>
                                                            //          <td>{{$poc->name}}</td>
                                                            //          <td>{{$poc->email}}</td>
                                                            //          <td>{{$poc->phone}}</td>
                                                            //          <td>{{$poc->notes}}</td>
                                                            //          <td>{{$poc->mentor}}</td>
                                                            //          <td>
                                                            //            <div class=" btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPOCModal" data-bs-action="/pocupdate"
                                                            //              data-bs-pocid="{{$poc->id}}" data-bs-name="{{$poc->name}}" data-bs-email="{{$poc->email}}" data-bs-phone="{{$poc->phone}}" data-bs-notes="{{$poc->notes}}" data-bs-mentor="{{$poc->mentor}}"
                                                            //              >Edit</div>
                                                            //            <div class=" btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#POCremoveModal" data-bs-pocname="{{$poc->name}}" data-bs-pocid="{{$poc->id}}">Remove</div>
                                                            //           </td>
                                                            //       </tr>
                                                            //       @endforeach
                                                            //       @endforeach
                                                            //  @endif

                                                         ?>
                                                         <td>{{$activities}}</td>
                                                         <td>
                                                           <div class=" btn btn-sm btn-outline-success " data-bs-toggle="modal" data-bs-target="#RestoreBizModal" data-bs-bizname="{{$biz->name}}" data-bs-bizid="{{$biz->id}}">Restore</div>
                                                          </td>
                                                      </tr>
                                                   @endforeach
                                                 @endif


                              </tbody>
                              <tfoot>
                                <tr>
                                  <th scope="col" >Record ID</th>
                                  <th scope="col" >Business</th>
                                  <th scope="col" >Safety Agreement</th>
                                  <th scope="col" >POC</th>
                                  <th scope="col" >Category</th>
                                  <th scope="col" >Email</th>
                                  <th scope="col" >Note</th>
                                </tr>
                              </tfoot>
                          </table>






            </div>
          </div>
        </div>
      </div>

</div>


@endsection
