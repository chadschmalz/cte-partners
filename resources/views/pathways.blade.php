@extends('layout.app')

@section('content')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Pathways </h1>

      </div>




      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

              <form method="post" action="/updatepathways" id="updateform" >
                @csrf
                      <table class="table table-sm table-striped "  id="" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >Pathway ID #</th>
                                                <th scope="col" width="33%">Pathway Desc</th>
                                                <th scope="col" >Cluster </th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($pathways))
                               @foreach($pathways as $pathway)
                               <tr>
                                 <td><a   href="#">{{$pathway->id}}<input type="hidden" class="form-control" name="pathwayid[]" value="{{$pathway->id}}"></a></td>
                                 <td><input type="text" class="form-control" name="pathway_desc[]" value="{{$pathway->pathway_desc}}"></td>
                                 <td><select class="form-select"  name="cluster_id[]" aria-label="Default select example"  >
                                   <option value="all" {{!isset($selectedCluster)?'selected':''}}></option>
                                   @if(isset($clusters))
                                     @foreach($clusters as $cluster)
                                       <option value="{{$cluster->id}}" {{ $cluster->id==$pathway->cluster->id  ?'selected':''}}>{{$cluster->cluster_desc}}</option>
                                     @endforeach
                                   @endif
                                 </select></td>


                                  </tr>
                               @endforeach
                             @endif

                              </tbody>

                          </table>
                          <button class="col-2  btn btn-success" >Save Changes</button>

</form>




            </div>
        </div>
      </div>

</div>


@endsection
