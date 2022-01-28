@extends('layout.app')

@section('content')

@include('modals.business.involvement')
@include('modals.business.edit')
@include('modals.business.remove')
@include('modals.business.addinternship')
@include('modals.business.removeInternship')
@include('modals.poc.add')
@include('modals.poc.remove')

<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Business Detail</h1>
      </div>
      <div class="row">
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-md-4 col-lg-4">
            <div class="h2">{{$business->name}}</div>
          </div>
          <div class="col-md-6 col-lg-6">
            <div class="row">
              <div class="col-md-4 col-lg-4">
                @if($business->safety_agreement=="Y")
                Safety Agreement &nbsp;&nbsp; &#9989;
                @else
                 Safety Agreement&nbsp;&nbsp;&#10060;
               @endif</div>
               <div class="col-md-8 col-lg-8">
                <span style="text-decoration-line: underline;">Next Internship:</span> {{$business->next_internship}}
              </div>
            </div>
            <div class="row">
               <div class="col-md-12 col-lg-12">
                <span style="text-decoration-line: underline;">Address:</span> {{$business->address}}, {{$business->city}}, {{$business->state}} {{$business->zip}}
              </div>
            </div>
          </div>
            <div class=" col-md-1 col-lg-1 text-end">
              <div class="form-control btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#editBizModal"
              data-bs-action="/bizupdate"
                data-bs-bizid="{{$business->id}}" data-bs-name="{{$business->name}}" data-bs-address="{{$business->address}}" data-bs-city="{{$business->city}}" data-bs-state="{{$business->state}}" data-bs-zip="{{$business->zip}}" data-bs-notes="{{$business->notes}}" data-bs-agreement="{{$business->safety_agreement}}"
              >Edit</div>
            </div>
            <div class=" col-md-1 col-lg-1 text-end">
              <div class=" btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#bizremoveModal">Remove</div>
            </div>
          </div>

            <div class="row">
                      <table class="table table-sm table-striped display" id="BizData" >
                                          <thead>
                                              <tr>
                                                <th scope="col" >POC</th>
                                                <th scope="col" >Email</th>
                                                <th scope="col" >Phone</th>
                                                <th scope="col" >Note</th>
                                                <th scope="col" >Mentor</th>
                                                <th scope="col" >Action</th>
                                              </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($business))
                            @foreach($business->pocs as $poc)
                               <tr>
                                     <td>{{$poc->name}}</td>
                                     <td>{{$poc->email}}</td>
                                     <td>{{$poc->phone}}</td>
                                     <td>{{$poc->notes}}</td>
                                     <td>{{$poc->mentor}}</td>
                                     <td>
                                       <div class=" btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addPOCModal" data-bs-action="/pocupdate"
                                         data-bs-pocid="{{$poc->id}}" data-bs-name="{{$poc->name}}" data-bs-email="{{$poc->email}}" data-bs-phone="{{$poc->phone}}" data-bs-notes="{{$poc->notes}}" data-bs-mentor="{{$poc->mentor}}"
                                         >Edit</div>
                                       <div class=" btn btn-sm btn-danger " data-bs-toggle="modal" data-bs-target="#POCremoveModal" data-bs-pocname="{{$poc->name}}" data-bs-pocid="{{$poc->id}}">Remove</div>
                                      </td>
                                  </tr>
                                  @endforeach
                             @endif
                              </tbody>
                          </table>
                        </div>
                          <div class="row">
                            <div class="col-md-12 col-lg-12 text-end">
                          <div class=" btn btn-sm btn-success " data-bs-toggle="modal" data-bs-target="#addPOCModal">Add POC</div>
                        </div>
                        </div>

                          <div class="row mt-2">
                            <div class="col-md-12 col-lg-12">
                              <div class="card">
                                <div class="card-header">
                                  <div class="h5">Notes</div>
                                </div>
                                <div class="card-body">
                                            {{$business->notes}}
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="row mt-2">
                          <div class=" col-md-6 col-lg-6">
                            <div class="card">
                            <div class="card-header">
                              <div class="row d-flex justify-content-between ">
                                <div class="h6 col-md-8 col-lg-8">
                                    Clusters & Pathways
                                  </div>
                                    <div class=" col-md-2 col-lg-2 text-end">
                                      <div class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#pathwayModal">Edit</div>

                                    </div>
                                  </div>
                                </div>
                                    <div class="card-body">
                                      <?php $curCluster = 0;?>
                                      <div class="row">
                                        @foreach($business->pathways as $pathway)
                                        @if($curCluster != $pathway->cluster_id)
                                        <div class="h6 pt-1">{{$pathway->cluster->cluster_desc}}</div>
                                            <?php $curCluster = $pathway->cluster_id?>
                                        @endif
                                            <div class="mx-3">-{{$pathway->pathway->pathway_desc}}</div>
                                       @endforeach

                              </div>
                            </div>
                          </div>
                        </div>
                        <div class=" col-md-6 col-lg-6">
                          <div class="card">
                          <div class="card-header">

                                <div class="row d-flex justify-content-between ">
                                  <div class="h6 col-md-8 col-lg-8">
                                      Program Involvement
                                    </div>
                                      <div class=" col-md-2 col-lg-2 text-end">
                                        <div class="btn btn-sm btn-primary " data-bs-toggle="modal" data-bs-target="#involveModal">Edit</div>

                                      </div>
                                    </div>
                              </div>
                                  <div class="card-body">
                                    <div class="row">
                                      @foreach($business->activities as $activity)
                                          <div class="mx-3">-{{$activity->activity->activity_desc}}</div>
                                     @endforeach


                            </div>
                          </div>
                        </div>
                      </div>
                        </div>
            </div>




          </div>
        </div>
      </div>


      <div class="row mt-2">
        <div class="col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <div class="row">
              <div class="col-md-10 col-lg-10">
              <h1 class="h5">Internship Opportunities</h1>
            </div>
              <div class="col-md-2 col-lg-2 text-end">
              <div class="btn btn-sm btn-success ml-auto" data-bs-toggle="modal" data-bs-target="#InternshipAddModal">Add</div>
            </div>
          </div>
            </div>
            <div class="card-body">
              <div class="row">

                        <div class="databuttons mb-1">
                          Toggle column:
                          <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="0">Record ID</a>
                          <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="1">Internship Opportunity</a>
                                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="2">Tier</a>
                                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="3">Entry Point </a>
                                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="4">Length of internship</a>
                                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="5">Contact Method</a>
                                  <a class="toggle-vis btn btn-sm btn-outline-primary" data-column="6">Note</a>
                                </div>

                        <table class="table table-sm table-striped display allInternshipsDataTable" id="allInternshipsDataTable" >
                                            <thead>
                                                <tr>
                                                  <th scope="col" >Record ID</th>
                                                  <th scope="col" >Internship Opportunity</th>
                                                  <th scope="col" >Min. Tier</th>
                                                  <th scope="col" >Entry Point</th>
                                                  <th scope="col" >Length of internship</th>
                                                  <th scope="col" >Contact Method</th>
                                                  <th scope="col" >Note</th>
                                                  <th scope="col" >Action</th>
                                                </tr>
                                                </thead>
                                                <tbody >
                              @if(isset($business))
                                 @foreach($business->internships as $internship)
                                 <tr>
                                   <td>{{$internship->id}}</td>
                                   <td><a   href="#" data-bs-toggle="modal" data-bs-target="#InternshipAddModal" data-bs-action="/internshipupdate"
                                     data-bs-internid="{{$internship->id}}" data-bs-interntitle="{{$internship->position_title}}" data-bs-tier="{{$internship->tier}}" data-bs-entry_point="{{$internship->entry_point}}" data-bs-intern_length="{{$internship->intern_length}}" data-bs-notes="{{$internship->notes}}" data-bs-contact_method="{{$internship->contact_method}}"
                                     >{{$internship->position_title}}</a></td>
                                 <td>{{$internship->tier}}</td>
                                       <td>{{$internship->entry_point}}</td>
                                       <td>{{$internship->intern_length}}</td>
                                       <td>{{$internship->contact_method}}</td>
                                       <td>{{$internship->notes}}</td>
                                       <td>
                                         <div class=" btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#InternshipAddModal" data-bs-action="/internshipupdate"
                                           data-bs-internid="{{$internship->id}}" data-bs-interntitle="{{$internship->position_title}}" data-bs-tier="{{$internship->tier}}" data-bs-entry_point="{{$internship->entry_point}}" data-bs-intern_length="{{$internship->intern_length}}" data-bs-notes="{{$internship->notes}}" data-bs-contact_method="{{$internship->contact_method}}"
                                           >Edit</div>
                                         <div class=" btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#internshipremoveModal" data-bs-interntitle="{{$internship->position_title}}" data-bs-internshipid="{{$internship->id}}" data-bs-bizid="{{$internship->business_id}}">Remove</div>
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


</div>


@endsection
