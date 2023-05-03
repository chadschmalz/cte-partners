@extends('layout.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class=" pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{$mode == "edit" ? "Event Edit" : "Event Add" }}</h1>
        </div>
    </div>
    <form action='{{$mode == "edit" ? "/eventupdate" : "/eventstore" }}'  method='POST' enctype='multipart/form-data' autocomplete='off' id='eventform'>
    @csrf
    <div class="row" id="EventModal">
    <input type="hidden" class="form-contro" name="event_id" value="{{isset($event) ? $event->id : ''}}" required>

        <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Event Desc:</label>
            <input type="text" class="form-control event_desc" name="event_desc" value="{{isset($event) ? $event->event_desc : ''}}" placeholder="Description" required>
        </div>
        <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Event Date:</label>
            <input type="date" class="form-control event_dt" name="event_dt" value="{{isset($event) ? date('Y-m-d',strtotime($event->event_dt))  : date('Y-m-d') }}" >
        </div>

        <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Activity:</label>
            <select class="form-select activity_id" id="activity_id" name="activity_id" aria-label="Default select example" required>
                <option value="" ></option>
                @if(isset($activities))
                    @foreach($activities as $act)
                        <option value="{{$act->id}}" {{isset($event) && $event->activity_id == $act->id ? 'selected' : '' }} >{{$act->activity_desc}}</option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">Pathway:</label>
            <select class="form-select pathway_id" id="pathway_id" name="pathway_id" aria-label="Default select example" required>
                <option value="" ></option>
                @if(isset($pathways))
                    @foreach($pathways as $path)
                        <option value="{{$path->id}}" {{isset($event) && $event->pathway_id == $path->id ? 'selected' : '' }}>{{$path->pathway_desc}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 col-lg-6">
            <label for="recipient-name" class="col-form-label">School:</label>
            <select class="form-select location_id" id="location_id" name="location_id" aria-label="Default select example" required>
                <option value="" {{!isset($selectedPathway)?'selected':''}}></option>
                @if(isset($locations))
                    @foreach($locations as $location)
                        <option value="{{$location->id}}"  {{isset($event) && $event->location_id == $location->id ? 'selected' : '' }}>{{$location->location_desc}}</option>
                    @endforeach
                @endif
            </select>
        </div>

        <div class="col-md-6 col-lg-6 ">
            <label for="recipient-name" class="col-form-label">Employer:</label>
            <select class="form-control employer_search2" name='business_id' id="InternERlookup" required>
                @if(isset($event->business_id))
                <option value="{{$event->business_id}}" selected>{{$event->business->name}}</option>
                @endif
            </select>
        </div>
        <div class="row ">
            <div class="col-md-3 col-lg-3 ">
                
            </div>
            <div class="col-md-3 col-lg-3 ">
                Grades:
            </div>
            
        </div>
        <div class="row ">
        <div class="col-md-3 col-lg-3 ">
                
                </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" value="K" name="grades[]" {{isset($event->grades) && in_array("K",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">K</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="1" name="grades[]" {{isset($event->grades) && in_array("1",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">1</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="2" name="grades[]" {{isset($event->grades) && in_array("2",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">2</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="3" name="grades[]" {{isset($event->grades) && in_array("3",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">3</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" value="4"  name="grades[]" {{isset($event->grades) && in_array("4",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">4</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="5" name="grades[]" {{isset($event->grades) && in_array("5",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">5</label>
                </div> 
            </div>
            
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="6" name="grades[]" {{isset($event->grades) && in_array("6",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">6</label>
                </div> 
            </div>
            </div>
        <div class="row ">
        <div class="col-md-3 col-lg-3 ">
                
                </div>
        <div class="col-md-1 col-lg-1 ">
                
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="7"  name="grades[]" {{isset($event->grades) && in_array("7",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">7</label>
                </div> 
            </div>
            
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="8"  name="grades[]" {{isset($event->grades) && in_array("8",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1" >8</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="9" name="grades[]" {{isset($event->grades) && in_array("9",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">9</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="10" name="grades[]" {{isset($event->grades) && in_array("10",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">10</label>
                </div> 
            </div>
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="11" name="grades[]" {{isset($event->grades) && in_array("11",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">11</label>
                </div> 
            </div> 
            <div class="col-md-1 col-lg-1 ">
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input"  value="12" name="grades[]" {{isset($event->grades) && isset($event->grades) && in_array("12",explode(",",$event->grades)) ? "checked":""}}>
                    <label class="form-check-label" for="exampleCheck1">12</label>
                </div> 
            </div>
        </div>

        <div class="mb-3">
            <label for="message-text" class="col-form-label">Notes:</label>
            <textarea class="form-control notes" id="message-text" name="notes" rows="10">{{isset($event) ? $event->notes : ''}}</textarea>
        </div>

        <div class="modal-footer">
            <a href="/events"><div class="btn btn-secondary">Cancel</button></div></a>
            <button type="submit" class="btn btn-success">Save</button>
        </div>
    </div>
    </form>
</div>
@endsection
