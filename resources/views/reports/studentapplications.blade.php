@extends('layout.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Applications by month</h1>
    </div>
    <div class="row mb-3">
        <div class="col-md-3 col-lg-3">
          <label for="recipient-name" class="col-form-label">Year:</label>
        <select class="form-select" id="calYear" aria-label="Default select example"  onchange=" return refreshApplicationReport()">
           @if(isset($years))
            @foreach($years as $y)
              <option value="{{$y->year}}" {{ $selectedyear== $y->year  ?'selected':''}}>{{$y->year}}</option>
            @endforeach
          @endif
        </select>
    </div>
    
    <table class="table table-sm table-striped display "  >
                                          <thead>
                                            <tr>
                                             <th scope="col" >School</th>
                                             <th scope="col" >Jan</th>
                                             <th scope="col" >Feb</th>
                                             <th scope="col" >Mar</th>
                                             <th scope="col" >Apr</th>
                                             <th scope="col" >May</th>
                                             <th scope="col" >Jun</th>
                                             <th scope="col" >Jul</th>
                                             <th scope="col" >Aug</th>
                                             <th scope="col" >Sep</th>
                                             <th scope="col" >Oct</th>
                                             <th scope="col" >Nov</th>
                                             <th scope="col" >Dec</th>
                                             <th scope="col" >Total</th>
                                           </tr>
                                              </thead>
                                              <tbody >
                            @if(isset($schooltotals))
                               @foreach($schooltotals as $t)
                               
                               <tr>
                                 <td><a  >{{$locations[$t->location_id]->location_desc}}</a></td>
                                 <td><a  >{{$t->JanCount}}</a></td>
                                 <td><a  >{{$t->FebCount}}</a></td>
                                 <td><a  >{{$t->MarCount}}</a></td>
                                 <td><a  >{{$t->AprCount}}</a></td>
                                 <td><a  >{{$t->MayCount}}</a></td>
                                 <td><a  >{{$t->JunCount}}</a></td>
                                 <td><a  >{{$t->JulCount}}</a></td>
                                 <td><a  >{{$t->AugCount}}</a></td>
                                 <td><a  >{{$t->SepCount}}</a></td>
                                 <td><a  >{{$t->OctCount}}</a></td>
                                 <td><a  >{{$t->NovCount}}</a></td>
                                 <td><a  >{{$t->DecCount}}</a></td>
                                 <td><a  ><strong>{{$t->JanCount
                                    +$t->FebCount
                                 +$t->MarCount
                                 +$t->AprCount
                                 +$t->MayCount
                                 +$t->JunCount
                                 +$t->JulCount
                                 +$t->AugCount
                                 +$t->SepCount
                                 +$t->OctCount
                                 +$t->NovCount
                                 +$t->DecCount}}</strong></a></td>
                                  </tr>
                               @endforeach
                               <tr><td></td>
                                 <td><strong  >{{$totals[0]->JanCount}}</strong></td>
                                 <td><strong>{{$totals[0]->FebCount}}</strong></td>
                                 <td><strong>{{$totals[0]->MarCount}}</strong></td>
                                 <td><strong>{{$totals[0]->AprCount}}</strong></td>
                                 <td><strong>{{$totals[0]->MayCount}}</strong></td>
                                 <td><strong>{{$totals[0]->JunCount}}</strong></td>
                                 <td><strong>{{$totals[0]->JulCount}}</strong></td>
                                 <td><strong>{{$totals[0]->AugCount}}</strong></td>
                                 <td><strong>{{$totals[0]->SepCount}}</strong></td>
                                 <td><strong>{{$totals[0]->OctCount}}</strong></td>
                                 <td><strong>{{$totals[0]->NovCount}}</strong></td>
                                 <td><strong>{{$totals[0]->DecCount}}</strong></td>
                                 <td><strong  >{{$totals[0]->JanCount
                                    +$totals[0]->FebCount
                                 +$totals[0]->MarCount
                                 +$totals[0]->AprCount
                                 +$totals[0]->MayCount
                                 +$totals[0]->JunCount
                                 +$totals[0]->JulCount
                                 +$totals[0]->AugCount
                                 +$totals[0]->SepCount
                                 +$totals[0]->OctCount
                                 +$totals[0]->NovCount
                                 +$totals[0]->DecCount}}</strong></td>
                                  </tr>
                             @endif

                              </tbody>
                              
                          </table>

    </div>
    <div class="row">
        <div class="col-md-6 col-lg-6">
        <div class="card">
        <div class="card-header">
            <h4>Placed Students</h4>
    </div>
        <table class="table table-sm table-striped display "  >
                                          <thead>
                                            <tr>
                                             <th scope="col" >School</th>
                                    @foreach($semesters as $key => $semester)

                                             <th scope="col" >{{$semester->semester_desc}}</th>
                                    @endforeach
                                             
                                             <th scope="col" >Total</th>
                                           </tr>
                                              </thead>
                                              <tbody >
                                              <?php $semtotal = []; ?>
                            @if(isset($semestertotals))
                                @foreach($semestertotals as $key => $location)
                                <?php $loctotal = 0;?>
                                        <tr>
                                            <td><a  >{{$locations[$key]->location_desc}}</a></td>
                                         @foreach($semesters as $semester)
                                                <?PHP 
                                                    if(!isset($location[$semester->id]))
                                                        $location[$semester->id] = 0;
                                                ?>
                                            <td><a href="/students/{{$semester->id}}/{{$key}}/all" target="_blank">{{$location[$semester->id]}}</a></td>
                                           
                                            <?php
                                                if(!isset($semtotal[$semester->id]))
                                                    $semtotal[$semester->id] = 0;  
                                                $semtotal[$semester->id] += $location[$semester->id]; 
                                                $loctotal += $location[$semester->id];
                                            ?>

                                        @endforeach
                                            <td>{{$loctotal}}</td>
                                            
                                            </tr>
                                @endforeach
                               <tr><td></td>
                               <?php $loctotal = 0; ?>
                                @foreach($semesters as $semester)
                                <?PHP 
                                    if(!isset($semtotal[$semester->id]))
                                        $semtotal[$semester->id] = 0;
                                ?>
                                    <td><a href="/students/{{$semester->id}}/all/all" target="_blank">{{$semtotal[$semester->id]}}<a href="/students/{{$semester->id}}/{{$key}}/all" target="_blank"></td>
                               <?php $loctotal += $semtotal[$semester->id]; ?>

                                @endforeach
                                <td>{{$loctotal}}</td>
                                </tr>
                             @endif

                              </tbody>
                              
                          </table>
    </div>
    </div>
</div>



@endsection
