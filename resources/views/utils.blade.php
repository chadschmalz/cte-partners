@extends('layout.app')

@section('content')


<div class="container-fluid">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Utilities</h1>
      </div>
        <div class="row mb-2">

              <div class="col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <h5>Create Cluster</h5>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(isset($clusterCreatemessage ))<div class="row">
                      <div class="col-md-6 col-lg-6">
                        <div class="container pt-1">
                          <div class="alert alert-success">
                          {{$clusterCreatemessage}}
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="row">
                      <form action='clusterstore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='clusterform' >
                        @csrf
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Cluster Description:</label>
                                  <input type="text" class="form-control cdesc" id="cdesc" name="cdesc" placeholder="Cluster Description" required>
                                </div>
                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Notes:</label>
                                  <textarea class="form-control cnotes" id="cnotes"></textarea>
                                </div><br />
                                <button type="submit" class="btn btn-success save" id="submitForm">Add Cluster</button>

                              </form>

                    </div>
                  </div>
                </div>
              </div>
                <div class="col-md-6 col-lg-6">
                <div class="card">
                  <div class="card-header">
                    <div class="row">
                      <h5>Create Pathway</h5>
                    </div>
                  </div>
                  <div class="card-body">
                    @if(isset($pathwayCreatedmessage ))<div class="row">
                      <div class="col-md-6 col-lg-6">
                        <div class="container pt-1">
                          <div class="alert alert-success">
                          {{$pathwayCreatedmessage}}
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                    <div class="row">
    <form action='pathwaystore'  method='POST' enctype='multipart/form-data' autocomplete='off' id='pathwayform' >
      @csrf
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Pathway Description:</label>
                                  <input type="text" class="form-control pathdesc" id="pathdesc" name="pathdesc" placeholder="Pathway Description">
                                </div>
                                <div class="form-group">
                                  <label for="recipient-name" class="col-form-label">Cluster:</label>
                                  <select class="form-select cluster" id="cluster" name="cluster">
                                    <option value="active"></option>
                                    @foreach($clusters as $cluster)
                                       <option value="{{$cluster->id}}">{{$cluster->cluster_desc}}</option>
                                   @endforeach
                                  </select>
                                </div>

                                <div class="form-group">
                                  <label for="message-text" class="col-form-label">Notes:</label>
                                  <textarea class="form-control pathnotes" id="pathnotes" name="notes"></textarea>
                                </div><br />
                                <button type="submit" class="btn btn-success save" id="submitForm">Add Pathway</button>

                              </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mb-2">

                  <div class="col-md-6 col-lg-6">
                    <div class="card">
                      <div class="card-header">
                        <div class="row">
                          <h5>Create Activity</h5>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="row">

                        </div>
                      </div>
                    </div>
                  </div>


                </div>
                <div class="row mb-2">

                      <div class="col-md-6 col-lg-6">
                        <div class="card">
                          <div class="card-header">
                            <div class="row">
                              <h5>Upload Partners</h5>
                            </div>
                          </div>
                          <div class="card-body">
                            @if(isset($uploadMessage))
                            <div class="row">
                              <div class="col-md-4 col-lg-4">
                                <div class="form-control btn btn-outline-success">
                                  {{$uploadMessage}}
                                </div>
                              </div>
                            </div>
                            @endif
                            @if(isset($uploadFailed))
                            <div class="row">
                              <div class="col-md-8 col-lg-8">
                                <div class="form-control btn btn-outline-danger">
                                  {{$uploadFailed}}
                                </div>
                              </div>
                            </div>
                            @endif
                            <div class="row">

                              <div class="col-md-12 col-lg-12">
                                This Utility can add a list of Businesses from a file.<br /><br />
                                <strong>These the fields it expects:</strong><br />

                                Business Name(name), Business Safety Agreement (Y or blank) (safety_agreement),<br /> Next Semester for Participation(next_internship), Notes(notes),<br />POC Name(pocname), POC Phone(pocphone), POC Email(pocemail)
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-md-3 col-lg-3">
                                <br />
                              <a href="/downloadSamplePartner" class="btn btn-sm btn-outline-secondary" target="blank"> Sample File</a>
                              <br /><br />
                            </div>
                              <?php //return Storage::download('samplePartner.csv');?>
                              <form action="/addPartners" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  File:
                                  <br />
                                  <input class="form-control" type="file" name="partnersfile" />
                                  <br /><br /><br />
                                  <input class="btn btn-sm btn-primary" type="submit" value=" Import " />
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6 col-lg-6">
                        <div class="card">
                          <div class="card-header">
                            <div class="row">
                              <h5>Upload Pathways</h5>
                            </div>
                          </div>
                          <div class="card-body">
                            @if(isset($bizuploadMessage))
                            <div class="row">
                              <div class="col-md-4 col-lg-4">
                                <div class="form-control alert alert-success">
                                  {{$bizuploadMessage}}
                                </div>
                              </div>
                            </div>
                            @endif
                            @if(isset($uploadFailed))
                            <div class="row">
                              <div class="col-md-8 col-lg-8">
                                <div class="form-control alert alert-danger">
                                  {{$uploadFailed}}
                                </div>
                              </div>
                            </div>
                            @endif
                            <div class="row">

                              <div class="col-md-12 col-lg-12">
                                This Utility can add a list of Pathways<br /><br />
                                <strong>These the fields it expects:</strong><br />

                                Cluster Desc(cluster), Pathway Desc (pathway)
                              </div>

                            </div>
                            <div class="row">
                              <div class="col-md-3 col-lg-3">
                                <br />
                              <a href="/sampleuploadpathwaysfile" class="btn btn-sm btn-outline-secondary" target="blank"> Sample File</a>
                              <br /><br />
                            </div>
                              <?php //return Storage::download('samplePartner.csv');?>
                              <form action="/uploadPathways" method="POST" enctype="multipart/form-data">
                                  @csrf

                                  File:
                                  <br />
                                  <input class="form-control" type="file" name="upload" />
                                  <br /><br /><br />
                                  <input class="btn btn-sm btn-primary" type="submit" value=" Import " />
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>


</div>


@endsection