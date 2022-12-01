<div class="row">
@if(session('success'))
<div class="container pt-1 message">
      <div class="alert alert-success">
      {{session('success')}}
      </div>
    </div>
@elseif(session('error'))
    <div class="container pt-1 message">
          <div class="alert alert-danger">
          {{session('error')}}
          </div>
        </div>
@elseif(isset($success))
    <div class="container pt-1 message">
          <div class="alert alert-success">
          {{$success}}
          </div>
        </div>
@elseif(session('info'))
    <div class="container pt-1 message">
          <div class="alert alert-warning">
          {{session('info')}}
          </div>
        </div>

@endif
</div>