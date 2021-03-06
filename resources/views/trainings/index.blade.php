@extends('templates.dashboard-master')

@section('body')

    <main class="container-fluid">
        <section class="container">
            <div class="row crud-page-top">
                <h1 class="crud-page-title">All Training Sessions</h1>
                <div class="text-right">
                    <button class="btn crud-main-cta" type="button" data-toggle="modal" data-target="#createModal">&#43; Add Training Session</button>
                    
                </div>             
            </div>

            <!-- if there are creation errors, they will show here -->
            {{ Html::ul($errors->all()) }}

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif

            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Date</td>
                        <td>Starting Time</td>  
                        <td>Ending Time</td>            
                        <td>Speaker</td>
                        <td>Venue</td>
                        <td class="no-stretch">Actions</td>
                    </tr>
                </thead>
                <tbody>
                @foreach($trainings as $key => $value)
                    <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->title }}</td>
                        <td>{{ date('F d, Y', strtotime($value->date)) }}</td>
                        <td>{{ date('h:i a', strtotime($value->starting_time)) }}</td>
                        <td>{{ date('h:i a', strtotime($value->ending_time)) }}</td>
                        
                        <td>{{ $value->speaker }}</td>
                        <td>{{ $value->venue }}</td>

                        <td class="table-actions no-stretch">

                            <!-- show the employee (uses the show method found at GET /employees/{id} -->
                            <a class="btn show-btn" data-toggle="tooltip" data-placement="bottom" title="View training session" href="{{ URL::to('trainings/' . $value->id) }}">
                                <i class="fa fa-user fa-lg"></i>
                            </a>

                            <!-- edit this employee (uses the edit method found at GET /employees/{id}/edit -->
                            <a class="btn edit-btn" data-toggle="tooltip" data-placement="bottom" title="Edit training session" href="{{ URL::to('trainings/' . $value->id . '/edit') }}">
                                <i class="fa fa-pencil fa-lg"></i>
                            </a>

                                {{ Form::open(array('url' => 'trainings/' . $value->id, 'class' => 'pull-right')) }}
                                {{ Form::hidden('_method', 'DELETE') }}
                                <div data-toggle="tooltip" data-placement="bottom" title="Remove training session">
                                    {{ Form::button('<i class="fa fa-trash-o fa-lg"></i>', array('type' => 'submit', 'class' => 'btn delete-btn')) }}
                                </div>
                             {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>

        <!-- Modal -->
        <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Training Session</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                {{ Form::open(array('url' => 'trainings')) }}
                
                <div class="form-group">
                    {{ Form::label('title', 'Title') }}
                    {{ Form::text('title', Request::old('title'), array('class' => 'form-control', 'autofocus')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('date', 'Date') }}
                    {{ Form::date('date', Request::old('date'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('starting_time', 'Starting Time') }}
                    {{ Form::time('starting_time', Request::old('starting_time'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('ending_time', 'Ending Time') }}
                    {{ Form::time('ending_time', Request::old('ending_time'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('speaker', 'Speaker') }}
                    {{ Form::text('speaker', Request::old('speaker'), array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('venue', 'Venue') }}
                    {{ Form::text('venue', Request::old('venue'), array('class' => 'form-control')) }}
                </div>
              </div>
              <div class="modal-footer create-bottom-wrapper">
                <a href="{{ URL::to('trainings') }}" class="btn cancel-btn" data-dismiss="modal">Cancel</a>
                {{ Form::submit('Create training session', array('class' => 'btn btn-primary create-btn text-center')) }}
              </div>
              {{ Form::close() }}
            </div>
          </div>
        </div>

    </main>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('training-sessions');
        a.classList.toggle("active");
    });

    // enables Bootstrap tooltips
    $(function () {
      $('[data-toggle="tooltip"]').tooltip();
    });

</script>