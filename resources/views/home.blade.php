@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    
                    <a href="#" class="btn btn-block btn-success">New assessment</a>

                    <h3>Continue with assessment</h3>

                    <div class="assessment-in-progress">
                        <a href="#" class="btn btn-success pull-right">Continue</a>
                        <span class="assessment-title">Testassessment</span>
                        <span class="assessment-description">50%</span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
