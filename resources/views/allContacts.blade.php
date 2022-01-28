@extends('layout.app')

@section('content')

@include('modals.business.add')

<div class="container-fluid">
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



                      <table class="table table-sm table-striped display allContactsBizDataTable" id="allContactsBizDataTable" w>
                                          <thead>
                                            <tr>
                                             <th scope="col" >Business</th>
                                             <th scope="col" >Address</th>
                                             <th scope="col" >POC</th>
                                             <th scope="col" >Email</th>
                                             <th scope="col" >Phone</th>
                                             <th scope="col" >Note</th>
                                           </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($businesses))
                               @foreach($businesses as $biz)
                                @foreach($biz->pocs as $poc)
                                     <tr>
                                       <td><a   href="/businessdetail/{{$biz->id}}">{{$biz->name}}</a></td>
                                       <td>{{$biz->address}} {{$biz->city}} {{$biz->state}} {{$biz->zip}}</td>
                                       <td>{{$poc->name}}</td>
                                       <td>{{$poc->email}}</td>
                                       <td>{{$poc->phone}}</td>
                                       <td>{{$biz->notes}}</td>
                                    </tr>
                                  @endforeach
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
