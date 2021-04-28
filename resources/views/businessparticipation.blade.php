
@extends('layout.app')

@section('content')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Business Involvement</h1>
      </div>
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="row">

                      <div class="databuttons mb-1">
                        Toggle column:
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0">Record ID</a>
                        <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Business</a>
                      					<a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Safety Agreement</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">POC</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Email</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Phone</a>
                                <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">Note</a>
                      				</div>

                      <table class="table table-sm table-striped display allBizDataTable" id="allBizDataTable" w>
                                          <thead>
                                              <tr>
                                                <th scope="col" >Record ID</th>
                                                <th scope="col" >Business</th>
                                                <th scope="col" >Safety Agreement</th>
                                                <th scope="col" >POC</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >Phone</th>
                                                <th scope="col" >Note</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if($businesses)
                               @foreach($businesses as $biz)
                               <tr>
                                 <td><a   href="#">{{$biz->id}}</a></td>
                                 <td><a   href="#">{{$biz->name}}</a></td>
                               <td>{{$biz->safety_agreement}}</td>
                                     <td>{{$biz->poc->name}}</td>
                                     <td>{{$biz->poc->email}}</td>
                                     <td>{{$biz->poc->phone}}</td>
                                     <td>{{$biz->poc->note}}</td>
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
