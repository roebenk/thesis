@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    <a href="{{ url('assessment/create') }}" class="btn btn-block btn-success">New assessment</a>

                    <h3>Continue with assessment</h3>


                    @foreach($assessments as $assessment) 
                        <div class="assessment-in-progress">
                            <span class="assessment-title">{{ $assessment->name }}</span>
                            <span class="assessment-description"><i class="fa fa-clock-o"></i> Created on {{ $assessment->created_at->format('d-m-Y') }} <i class="fa fa-sitemap"></i> 15 nodes</span>

                            <div class="option-buttons">
                                <a href="#" class="button-red"><i class="fa fa-trash-o"></i></a>
                                <a href="{{ url('assessment/' . $assessment->id . '/edit') }}" class="button-green"><i class="fa fa-edit"></i></a>
                            </div>

                        </div>
                    @endforeach

                    

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
