@extends('layout.app')

@section('content')
    <div class="container-fluid">
        <div class="row m-2">
            <div class="col-md-12 ">
                <div class="card ">
                    <div class="card-header">Student Import Review</div>

                    <div class="card-body">
                      <div class="h3">Does the header and drop down fields match?</div>

                        <form class="form-horizontal" method="POST" action="{{ route('import_process') }}">
                            {{ csrf_field() }}
                            <input type="hidden" name="csv_data_file_id" value="{{ $csv_data_file->id }}" />

                            <table class="table table-sm" >
                              @if (isset($csv_header_fields))
                                <tr>
                                    @foreach ($csv_header_fields as $csv_header_field)
                                        <th>{{ $csv_header_field }}</th>
                                    @endforeach
                                </tr>
                                @endif
                                  <tr>
                                  @foreach ($csv_data[0] as $key => $value)
                                      <td>
                                          <select class="form-select" name="fields[]">
                                              @foreach (config('app.db_fields') as $db_field)
                                                  <option value="{{$db_field}}"
                                                      {{trim($value) == trim($db_field) ? 'selected':''}}>{{ $db_field }}</option>
                                              @endforeach
                                          </select>
                                      </td>
                                  @endforeach
                              </tr>

                                @foreach ($csv_data as $row)
                                @if($row[0] == 'Timestamp')
                                <?PHP continue;?>
                                @endif


                                    <tr>
                                    @foreach ($row as $key => $value)

                                        <td>{{ $value }}</td>
                                    @endforeach
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
