@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Assessment</div>

                <div class="panel-body" style="padding-top: 0; padding-bottom: 0;">

                    <div class="row">

                        <div class="col-lg-2">

                            <div class="row padding-row">
                                <div class="col-lg-12">

                                    <div class="assessment-users-icon">
                                        <i class="fa fa-users"  data-toggle="tooltip" title="Actors"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="row padding-row">
                                <div class="col-lg-12">

                                    <div class="assessment-devices-icon">
                                        <i class="fa fa-laptop"  data-toggle="tooltip" title="Devices"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="row padding-row">
                                <div class="col-lg-12">

                                    <div class="assessment-assets-icon">
                                        <i class="fa fa-diamond" data-toggle="tooltip" title="Assets"></i>
                                    </div>

                                </div>
                            </div>

                            <div class="row padding-row">
                                <div class="col-lg-12">

                                    <div class="assessment-policies-icon">
                                        <i class="fa fa-cogs"  data-toggle="tooltip" title="Policies"></i>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-8">

                            <div id="svgContainer">

                                <div class="row padding-row">

                                    @foreach($assessment->actors as $actor)
                                        <div class="col-lg-2">

                                            <div class="assessment-box" id="actor-{{ $actor->id }}">
                                                <div class="assessment-box-options">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-warning open-edit-actor" data-id="{{ $actor->id }}"><i class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger delete-element" data-href="{{ url('actor/' . $actor->id . '') }}"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </div>
                                                <i class="main-icon fa fa-{{ $actor->actortype->icon }}"></i>
                                                {{ $actor->name }}
                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="col-lg-2">
                                        <a href="#" class="add-box" id="open-add-actor"><i class="fa fa-plus"></i></a>
                                    </div>

                                </div>

                                <div class="row padding-row">

                                    @foreach($assessment->devices as $device)
                                        <div class="col-lg-2">

                                            <div class="assessment-box" id="device-{{ $device->id }}">
                                                <div class="assessment-box-options">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-warning open-edit-device" data-id="{{ $device->id }}"><i class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger delete-element" data-href="{{ url('device/' . $device->id . '') }}"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </div>
                                                <i class="main-icon fa fa-{{ $device->devicetype->icon }}"></i>
                                                {{ $device->name }}
                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="col-lg-2">
                                        <a href="#" class="add-box" id="open-add-device"><i class="fa fa-plus"></i></a>
                                    </div>

                                </div>

                                <div class="row padding-row">

                                    @foreach($assessment->assets as $asset)
                                        <div class="col-lg-2">

                                            <div class="assessment-box" id="asset-{{ $asset->id }}">
                                                <div class="assessment-box-options">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-warning open-edit-asset" data-id="{{ $asset->id }}"><i class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger delete-element" data-href="{{ url('asset/' . $asset->id . '') }}"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </div> 
                                                <i class="main-icon fa fa-{{ $asset->assettype->icon }}"></i>
                                                {{ $asset->name }}
                                            </div>

                                        </div>
                                    @endforeach

                                    <div class="col-lg-2">
                                        <a href="#" class="add-box" id="open-add-asset"><i class="fa fa-plus"></i></a>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-lg-2">

                            @foreach($assessment->policies as $policy)

                                    <div class="row padding-row">
                                        <div class="col-lg-12">

                                            <div class="assessment-box" id="policy-{{ $policy->id }}">
                                                <div class="assessment-box-options">
                                                    <div class="btn-group">
                                                        <a class="btn btn-sm btn-warning open-edit-policy" data-id="{{ $policy->id }}"><i class="fa fa-pencil"></i></a>
                                                        <a class="btn btn-sm btn-danger delete-element" data-href="{{ url('policy/' . $policy->id . '') }}"><i class="fa fa-trash-o"></i></a>
                                                    </div>
                                                </div> 
                                                <i class="main-icon fa fa-{{ $policy->policytype->icon }}"></i>
                                                {{ $policy->name }}
                                            </div>

                                        </div>
                                    </div>
                            @endforeach

                            <div class="row padding-row">
                                <div class="col-lg-12">
                                    <a href="#" class="add-box" id="open-add-policy"><i class="fa fa-plus"></i></a>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Button trigger modal -->

<!-- Modal -->
<div aria-labelledby="myModalLabel" class="modal fade" id="add-element-modal" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
            </div>
            <?php /*<div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal" type="button">Close</button>
            </div>*/?>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
<script src="{{ asset('js/jquery.html-svg-connect.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.2.9/jsplumb.js"></script>
<script type="text/javascript">


jsPlumb.ready(function() {
    jsPlumb.setContainer(document.getElementById("svgContainer"));
    jsPlumb.connect({
        anchor:"AutoDefault",
        source:"device-4", 
        target:"actor-1",
        endpoint:"Blank",
        endpointStyle:{ fill: "#f00", },
        paintStyle:{ stroke:"blue", strokeWidth:2 },
        connector: ["Straight"]
    });
});


/*

    $(document).ready(function() {
        $("#svgContainer").HTMLSVGconnect({
            stroke: '#3097D0',
            class: 'dashed-line',
            strokeWidth: 4,
            orientation: 'horizontal',
            paths: [
                { start: "#device-4", end: "#actor-1" },
                { start: "#device-1", end: "#actor-1" },
                { start: "#device-1", end: "#asset-2" },
                { start: "#device-4", end: "#asset-2" },
                { start: "#policy-3", end: "#device-1", class: 'policy-line' },
            ]
        });
    });


*/






    $('#open-add-device').click(function(){
        $('.modal-body').load('{{ url('device/create') }}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('#open-add-actor').click(function(){
        $('.modal-body').load('{{ url('actor/create') }}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('#open-add-policy').click(function(){
        $('.modal-body').load('{{ url('policy/create') }}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('#open-add-asset').click(function(){
        $('.modal-body').load('{{ url('asset/create') }}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('.open-edit-actor').click(function(){
        var id = $(this).data('id');
        $('.modal-body').load('{!! url("actor/' + id + '/edit") !!}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('.open-edit-device').click(function(){
        var id = $(this).data('id');
        $('.modal-body').load('{!! url("device/' + id + '/edit") !!}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('.open-edit-policy').click(function(){
        var id = $(this).data('id');
        $('.modal-body').load('{!! url("policy/' + id + '/edit") !!}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $('.open-edit-asset').click(function(){
        var id = $(this).data('id');
        $('.modal-body').load('{!! url("asset/' + id + '/edit") !!}?assessment={{ $assessment->id }}',function(result){
            $('#add-element-modal').modal({show:true});
        });
        
    });

    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $('.delete-element').click(function() {
        $('.modal-body').html('<h3>Are you sure you want to remove this element?</h3><div class="text-center"><form action="' + $(this).data('href') + '" method="post"><button class="btn btn-success" data-dismiss="modal" type="button">No, take me back!</button> <input type="hidden" name="_method" value="delete">{{ csrf_field() }}<input type="submit" class="btn btn-danger" value="Yes please!"></fprm></div>');
        $('#add-element-modal').modal({show:true});
    });
</script>
@endsection