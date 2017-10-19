@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Create a new assessment</div>

                <div class="panel-body">

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form method="post" action="{{ url('assessment') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label>Name of assessment</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label>Are there multiple user groups in the company? Name them below:</label>
                            <input type="text" class="form-control" name="name">
                        </div>


                        <input type="submit" class="btn btn-block btn-success" value="Create new assessment">

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
