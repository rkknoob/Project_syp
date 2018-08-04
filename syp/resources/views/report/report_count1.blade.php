@extends('layouts.endless5')

@section('content')
    <meta http-equiv="refresh" content="30">


    <div class="panel panel-danger ">

        @foreach($count_re2 as $cout_re2)
            <div class="panel-body">
                <div class="form-group">
                    <div class ="col-md-4">
                        @foreach($sssss as $sssss2)


                            <label for="depart_no" class="control-label"><h1>Count 1 :</h1></label>
                            <label for="depart_no" class="control-label"><h1>{{$sssss2->total}} %</h1></label>
                        @endforeach
                    </div>
                    <div class ="col-md-4">
                        <label for="depart_no" class="control-label"><h1>Total :</h1></label>
                        <label for="depart_no" class="control-label"><h1>{{$cout_re2->total}}</h1></label>
                    </div>
                    <div class ="col-md-4">
                        <label for="depart_no" class="control-label"><h1>Return :</h1></label>
                        <label for="depart_no" class="control-label"><h1>{{$cout_re2->total2}}</h1></label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>



    <div class="panel panel-danger" >

        <div class="panel-body">

            <div class="table-responsive">
                <div class="panel-body">


                    {!! $chart->html() !!}
                    {!! Charts::scripts() !!}
                    {!! $chart->script() !!}

                </div>
            </div>

        </div>
    </div>

    <div class="panel panel-danger ">

        @foreach($dura1 as $dura2)
            <div class="panel-body">
                <div class="form-group">
                    <div class ="col-md-4">
                        <label for="depart_no" class="control-label"><h1>Start :</h1></label>

                        <label for="depart_no" class="control-label"><h1>{{$dura2->dd_date}}</h1></label>

                    </div>
                    <div class ="col-md-6">
                        <label for="depart_no" class="control-label"><h1>Duration :</h1></label>
                        <label for="depart_no" class="control-label"><h1>{{$dura2->HH_mm}}</h1></label>
                        <label for="depart_no" class="control-label"><h1>Hour</h1></label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>





@endsection


@section('javascript')


    <script>

    </script>

@endsection
