@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Knowledge base</div>

                <div class="panel-body">
                    
                    <a href="{{ url('assessment/create') }}" class="btn btn-block btn-success">New policy</a>

                    <h3>Manage current policies</h3>
                    <table class="table table-condensed table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Works on</th>
                            <th>&nbsp;</th>
                        </tr>
                        @foreach($policytypes as $pt)
                            <tr>
                                <td>{{ $pt->name }}</td>
                                <td>{{ $pt->works_on }}</td>
                                <td><a href="{{ url('policytype/' . $pt->id . '/edit') }}">edit</a></td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
