@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Assessment</div>

                <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">
                    
                    <div class="row assessment-users">

                        <div class="col-lg-3">

                            <div class="assessment-users-icon">
                                <i class="fa fa-users"></i>
                            </div>

                        </div>

                        <div class="col-lg-3">
                            <a href="#" class="add-box"><i class="fa fa-plus"></i></a>
                        </div>

                    </div>

                    <div class="row assessment-devices">

                        <div class="col-lg-3">

                            <div class="assessment-devices-icon">
                                <i class="fa fa-laptop"></i>
                            </div>

                        </div>

                        <div class="col-lg-3">
                            <a href="#" class="add-box"><i class="fa fa-plus"></i></a>
                        </div>

                    </div>


                    <div class="row assessment-policies">

                        <div class="col-lg-3">

                            <div class="assessment-policies-icon">
                                <i class="fa fa-cogs"></i>
                            </div>

                        </div>

                        <div class="col-lg-3">
                            <a href="#" class="add-box"><i class="fa fa-plus"></i></a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
