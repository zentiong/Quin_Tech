@extends('templates.dashboard-master')

@section('body')

    <main class="container create-page">
        <section class="crud-page-top">
            <h1 class="crud-page-title">Currently taking quiz</h1>
            <h6>{{ $quiz->topic }}</h6>
        </section>
        <section>
            <!-- 

            Take Quiz Implementation:

            1) Each input should be assigned to answer_attempt() array
            2) Answer Attempt ought to be compared to corresponding answer item
                -(test via popout)

            <h5> Number of Questions: {{ count($questions) }} </h5>

            {{ Auth::user()->id}}
            -->

            <!-- will be used to show any messages -->
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif


             <!-- {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }} -->

                {{ Form::open(array('url' => 'quizzes/'.$quiz->quiz_id.'/record')) }}

                {{ Form::hidden('quiz_id', $value = $quiz->quiz_id) }}

                <?php
                    $var = 0; 
                ?>   
                
             
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <td>Question</td>
                            <td>Answer</td>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $key => $value)
                        <tr>
                            <td>{{ $value->question_item }}</td>
                            <!-- we will also add show, edit, and delete buttons -->
                            <td>
                                {{ Form::text('answer_attempt[]', Request::old('DEFAULT AA'), array('class' => 'form-control')) }}
                                <?php 
                                    $var ++;
                                ?>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="form-group text-center create-bottom-wrapper">
                    <a href="{{ URL::to('levels') }}" class="btn cancel-btn">Cancel</a>
                    {{ Form::submit('Submit Answers', array('class' => 'btn btn-primary create-btn text-center')) }}
                </div>

               {{ Form::close() }}
        </section>
    </main>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        var a = document.getElementById('quizzes');
        a.classList.toggle("active");
    });
</script>