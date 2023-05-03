@extends('layout.app')

@section('content')

@include('modals.business.add')

<div class="container-fluid">
@include('inc.results')
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Business Partners</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <ul class="nav nav-pills">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle btn btn-outline-secondary " data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Links</a>
      <ul class="dropdown-menu">
        <li><a class="dropdown-item" href="/businessaddress" >Address List</a></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#addBizModal">Add Partner</a></li>
        <li><a class="dropdown-item" href="/removedpartners">View Removed Partners</a></li>
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
    <div class="col-md-2 col-lg-2">
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
      <label for="recipient-name" class="col-form-label">Status:</label>
      <select class="form-select" id="businessStatus" aria-label="Default select example" onchange=" return refreshBusinessList()">
        <option value="" {{!isset($selectedStatus)?'selected':''}}></option>
        <option value="Green" {{$selectedStatus=="Green"?'selected':''}} >Green</option>
        <option value="Yellow" {{$selectedStatus=="Yellow"?'selected':''}}>Yellow</option>
        <option value="Red" {{$selectedStatus=="Red"?'selected':''}}>Red</option>

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
               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0">Business</a>
               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Address</a>
               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Safety Agreement</a>
                                               <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">POC</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Email</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Phone</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">clusters</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="7">Note</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="8">Involvement</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="9">ID</a>
                       <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="10">Status</a>
                                       </div>

                      <table class="table table-sm table-striped display allBizDataTable" id="allBizDataTable" w>
                                          <thead>
                                            <tr>
                                             <th scope="col" >Business</th>
                                             <th scope="col" >Address</th>
                                             <th scope="col" >Safety Agreement</th>
                                             <th scope="col" >POC</th>
                                             <th scope="col" >Email</th>
                                             <th scope="col" >Phone</th>
                                             <th scope="col" >Clusters</th>
                                             <th scope="col" >Note</th>
                                             <th scope="col" >Involvement</th>
                                             <th scope="col" > ID</th>
                                             <th scope="col" style="text-align:center"> Status</th>
                                           </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($businesses))
                               @foreach($businesses as $biz)
                               <?php
                              //  $clusterIDs = array();
                              //  $bizclusters = '';
                              //  foreach ($biz->pathways as $key => $value) {
                              //    $clusterIDs[$value->cluster_id] = $value->cluster_id;
                              //  }
                              //  foreach ($clusterIDs as $key => $value) {
                              //    if($bizclusters == '')
                              //       $bizclusters .= $clusters[$value]->cluster_desc;
                              //   else
                              //      $bizclusters .= ',' . $clusters[$value]->cluster_desc ;
                              //  }
                               ?>
                               <tr>
                                 <td><a   href="/businessdetail/{{$biz->id}}" target="_blank">{{$biz->name}}</a></td>
                                 <td>{{$biz->address}} {{$biz->city}} {{$biz->state}} {{$biz->zip}}</td>
                               <td>{{$biz->safety_agreement}}</td>
                               @if($selectedCluster == ' all')
                                  <td>{{$biz->pocname}}</td>
                                  <td>{{$biz->pocsemail}}</td>
                                  <td>{{$biz->pocsphone}}</td>
                               @else
                                  <?php $b = $biz->pocs[0] ?>
                                    <td>{{$b->name}}</td>
                                    <td>{{$b->email}}</td>
                                    <td>{{$b->phone}}</td>
                                  
                              @endif
                                     <td>@if(isset($bizclusters[$biz->id])){{$bizclusters[$biz->id]}}@endif</td>
                                     <td>{{$biz->notes}}</td>
                                     <?PHP
                                     $activities = '';
                                    //  foreach($bizactivities as $act)
                                    //     $activities .= $act->activity->activity_desc.", ";
                                     ?>
                                     <td>@if(isset($bizactivities[$biz->id])){{$bizactivities[$biz->id]}}@endif</td>

                                     <td><a   href="/businessdetail/{{$biz->id}}">{{$biz->id}}</a></td>
                                     <td style="text-align:center"><div class=" btn btn-sm @if($biz->next_internship=='Yellow')btn-warning @elseif($biz->next_internship=='Red') btn-danger @elseif($biz->next_internship=='Green') btn-success @endif"> {{$biz->next_internship}}</div></td>

                                  </tr>
                               @endforeach
                             @endif

                              </tbody>
                              <tfoot>
                                <tr>
                                     <th scope="col" >Business</th>
                                     <th scope="col" >Address</th>
                                     <th scope="col" >Safety Agreement</th>
                                     <th scope="col" >POC</th>
                                     <th scope="col" >Email</th>
                                     <th scope="col" >Phone</th>
                                     <th scope="col" >Note</th>
                                     <th scope="col" >Involvement</th>
                                     <th scope="col" > ID</th>
                                   </tr>
                              </tfoot>
                          </table>






            </div>
          </div>
        </div>
      </div>

</div>


@endsection
