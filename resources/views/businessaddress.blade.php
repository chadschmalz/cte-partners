@extends('layout.app')

@section('content')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Business Address List</h1>

      </div>
      <div class="row mb-3">
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Cluster:</label>
        <select class="form-select" id="businessCluster" aria-label="Default select example"  onchange=" return refreshBusinessAddressList()">
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
      <select class="form-select" id="businessPathway" aria-label="Default select example" onchange=" return refreshBusinessAddressList()">
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
      <select class="form-select" id="businessInvolve" aria-label="Default select example" onchange=" return refreshBusinessAddressList()">
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
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Business</a>
                      					<a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">address</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">city</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">state</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">zip</a>
                      				</div>

                      <table class="table table-sm table-striped display allBizDataTable" id="allBizDataTable" w>
                                          <thead>
                                              <tr>
                                                <th scope="col" >Business</th>
                                                <th scope="col" >address</th>
                                                <th scope="col" >city</th>
                                                <th scope="col" >state</th>
                                                <th scope="col" >zip</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($businesses))
                               @foreach($businesses as $biz)
                               <tr>
                                 <td><a   href="/businessdetail/{{$biz->id}}">{{$biz->name}}</a></td>
                               <td>{{$biz->address}}</td>
                               <td>{{$biz->city}}</td>
                               <td>{{$biz->state}}</td>
                               <td>{{$biz->zip}}</td>
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
