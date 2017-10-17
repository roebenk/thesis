@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Assessment</div>

                <div class="panel-body" id="panel-to-set-height" style="padding-top: 0; height: 500px; padding-bottom: 0; position: relative;">

                    <a href="#" class="cancel-connect btn btn-danger">Stop connecting</a>

                        <div id="svgContainer">

                            <div class="row" id="row-with-height">

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
                                </div>

                                <div class="col-lg-8">

                                    <div class="row padding-row">

                                        @foreach($assessment->actors as $actor)
                                            <div class="col-lg-2">

                                                <div class="assessment-box" id="actor-{{ $actor->id }}" data-test="bkaat">
                                                    
                                                    <i class="main-icon fa fa-{{ $actor->actortype->icon }}"></i>
                                                    {{ $actor->name }}
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="row padding-row">

                                        @foreach($assessment->devices as $device)
                                            <div class="col-lg-2">

                                                <div class="assessment-box" id="device-{{ $device->id }}">
                                                    <i class="main-icon fa fa-{{ $device->devicetype->icon }}"></i>
                                                    {{ $device->name }}
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="row padding-row">

                                        @foreach($assessment->assets as $asset)
                                            <div class="col-lg-2">

                                                <div class="assessment-box" id="asset-{{ $asset->id }}">
                                                    <i class="main-icon fa fa-{{ $asset->assettype->icon }}"></i>
                                                    {{ $asset->name }}
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-2">

                                    @foreach($assessment->policies as $policy)

                                            <div class="row padding-row" style="padding-right: 20px">
                                                <div class="col-lg-12">

                                                    <div class="assessment-box" id="policy-{{ $policy->id }}">
                                                        <i class="main-icon fa fa-{{ $policy->policytype->icon }}"></i>
                                                        {{ $policy->name }}
                                                    </div>

                                                </div>
                                            </div>
                                    @endforeach
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Button trigger modal -->

@endsection

@section('footer-scripts')
<script src="{{ asset('js/jquery.html-svg-connect.js') }}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.2.9/jsplumb.js"></script>
<script type="text/javascript">


<?php
function parseConnection($sourceId, $sourceType, $targetId, $targetType, $color = 'blue') {
    $r = 'var connection = jsPlumb.connect({
                anchor:"AutoDefault",
                source:"' . $sourceType . '-' . $sourceId . '", 
                target:"' . $targetType . '-' . $targetId . '",
                endpoint:"Blank",
                endpointStyle:{ fill: "#f00", },
                paintStyle:{ stroke:"' . $color . '", strokeWidth:2 },
                connector: ["Straight"],
                hoverPaintStyle:{ stroke:"purple" },
                parameters: {
                    sourceId: ' . $sourceId . ',
                    sourceType: "' . $sourceType . '",
                    targetType: "' . $targetType . '",
                    targetId: ' . $targetId . '
                }
            });


            connection.bind("click", function() {
                var sourceId = this.getParameter("sourceId");
                var targetId = this.getParameter("targetId");
                var sourceType = this.getParameter("sourceType");
                var targetType = this.getParameter("targetType");

                removeConnection(sourceId, sourceType, targetId, targetType);

            });';

    return $r;
}
?>

jsPlumb.ready(function() {
    jsPlumb.setContainer(document.getElementById("svgContainer"));
    @foreach($assessment->devices as $device) 
        @foreach($device->actors as $actor)

            {!! parseConnection($actor->id, 'actor', $device->id, 'device') !!}

        @endforeach

        @foreach($device->assets as $asset)

            {!! parseConnection($device->id, 'device', $asset->id, 'asset') !!}

        @endforeach

    @endforeach

    @foreach($assessment->policies as $policy) 

        @foreach($policy->devices as $device)
            {!! parseConnection($policy->id, 'policy', $device->id, 'device', 'red') !!}
        @endforeach

    @endforeach

});

    
    $(function() {
        $('#panel-to-set-height').height($('#row-with-height').height());
    });

</script>
@endsection