@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit policy</div>

                <div class="panel-body">
                    
                    Policy name: {{ $policytype->name }}<br>
                    This policy works on type: {{ $policytype->works_on }}

                    <h3>Variants</h3>
                    <table class="table table-condensed table-striped">
                        <tr>
                            <th>Name</th>
                            <th>Impact value</th>
                        </tr>
                        @foreach($policytype->policyvalues as $p)
                            <tr>
                                <td>{{ $p->variant }}</td>
                                <td>{{ $p->value }}</td>
                            </tr>
                        @endforeach
                    </table>
                    <a href="#" class="btn btn-success pull-right">Add variant</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
