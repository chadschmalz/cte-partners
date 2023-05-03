@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"></h1>
    </div>
    <div class="row mb-3">
      <div class="col-md-3 col-lg-3">
        <label for="recipient-name" class="col-form-label">Semester:</label>
        <select class="form-select" id="calYear" aria-label="Default select example"  onchange=" return refreshClusterReport()">
          @if(isset($semesters))
            @foreach($semesters as $sem)
              <option value="{{$sem->id}}" >{{$sem->semester_desc}}</option>
            @endforeach
          @endif
        </select>
      </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12 col-lg-12">
    <div class="card">
      <div class="card-header">
          <h4>Event Count by Clusters/Conesite</h4>
          
      </div>
      

        <table class="table table-sm table-striped display allDataTable"  id="allDataTable">
          <thead>
          <tr>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>
            <th scope="col" ></th>

          </tr>
              </thead>
              <tbody >
              <tr>
            <td scope="col" ><strong>Conesite</strong></td>
            @foreach($clusters as $key => $c)
              <td scope="col" colspan='2' ><strong>{{$c->cluster_desc}}</strong></td>
            @endforeach
            <td scope="col" ><strong>Total</strong></td>
          </tr>
          @if(isset($semestertotals))
            @foreach($semestertotals as $key => $locationclustertotal)
            <?php $loctotal = 0;?>
                    <tr>
                        <td><a  >{{$locations[$key]->conesite_desc}}</a></td>
                      @foreach($clusters as $c)
                            <?PHP 
                                if(!isset($locationclustertotal[$c->id]))
                                    $locationclustertotal[$c->id] = 0;
                            ?>
                        <td style="text-align:center"><a href="/events/{{$selectedsemester}}/{{$key}}/{{$c->id}}" target="_blank">{{$locationclustertotal[$c->id]}} </a></td><td>({{ $clustertotals[$c->id] > 0 ? number_format($locationclustertotal[$c->id]/$clustertotals[$c->id] *100, 0, '.', '') : '0'}}%)</td>
                        
                        <?php
                            if(!isset($semtotal[$c->id]))
                                $semtotal[$c->id] = 0;  
                            $semtotal[$c->id] += $locationclustertotal[$c->id]; 
                            $loctotal += $locationclustertotal[$c->id];
                        ?>

                    @endforeach
                        <td>{{$loctotal}}</td>
                        
                        </tr>
            @endforeach
            
          @endif

              </tbody>
              <tfooter>
              <tr><td><strong>Total:</strong></td>
            <?php $loctotal = 0; ?>
            @foreach($clusters as $c)
            <?PHP 
                if(!isset($semtotal[$c->id]))
                    $semtotal[$c->id] = 0;
            ?>
                <td style="text-align:center"><a href="/events/{{$selectedsemester}}/all/{{$c->id}}" target="_blank">{{$semtotal[$c->id]}}<a href="/students/{{$selectedsemester}}/{{$key}}/all/{{$c->id}}" target="_blank"></td>
                <td>({{ $semtotal[$c->id] > 0 ? number_format($semtotal[$c->id]/array_sum($semtotal) *100, 0, '.', '') : '0'}}%)</td>
            <?php $loctotal += $semtotal[$c->id]; ?>

            @endforeach
            <td>{{$loctotal}}</td>
            </tr>
                </tfooter>
        </table>
      </div>
  </div>

    </div>
    
</div>



@endsection
