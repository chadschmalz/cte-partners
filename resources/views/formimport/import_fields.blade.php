@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row m-2">
            <div class="col-md-12 ">
                <div class="card ">
                    <div class="card-header">Form Import Review</div>

                    <div class="card-body">
                      <div class="h3">Map Database Fields</div>

                        <form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />

                            <table class="table table-sm table-striped" >
                                <tr> 
                                    <th>Heading Description</th>
                                    <th>Value</th>
                                    <th>Mapped Column</th>
                                </tr>
                                <?php $row = $csv_data[1]; ?>
                                  @foreach ($csv_data[0] as $key => $value)
                                  <tr>
                                  @if (isset($csv_header_fields))
                                        <td>{{ $csv_header_fields[$key] }}</td>
                                @endif
                                      
                                     <td>
                                  @if (isset($row[$key]))
                                        {{ $row[$key]}}
                                    @endif
                                </td>
                                <td>
                                          <select class="form-select" name="fields[]">
                                              @foreach (config('app.student_fields') as $db_field)
                                                  <option value="{{$db_field}}"
                                                      {{trim($value) == trim($db_field) ? 'selected':''}}>{{ $db_field }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                    </tr>
                              </tr>
                                  @endforeach


                            </table>

                            <button type="submit" class="btn btn-primary">
                                Import Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
