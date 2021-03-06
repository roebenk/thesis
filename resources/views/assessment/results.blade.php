@extends('layouts.app')

@section('help-text')
    In the visual representation box, the structure of the company as created can be seen.
    For every component, the breach probability (or for the asset the risk severity) is displayed.
    This severity corresponds with a color (green is low severity and red is high severity).
    Hovering over the different assets shows what components influence the risk on that asset.
    <br><br>
    In the Ranking representation box the risks and probabilities shown in the visual representation are shown in a table.
    The components (actors and devices) are ranked in breach probability.
    This helps pinpointing were the weakest links in the company are.
@endsection

@section('content')

<div class="container-fluid">

     <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    The results from the assessment can be shown in either a visual way or in a ranked way. To go back to editing the assessment, click <a href="{{ url('assessment/' . $assessment->id . '/edit') }}">here</a>.
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> &nbsp;Visual representation <a href="#" class="btn btn-primary btn-xs pull-left" id="toggle-visual">Hide</a> </div>

                <div class="panel-body" id="panel-to-set-height" style="padding-top: 0; height: 500px; padding-bottom: 0; position: relative;">

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

                                <div class="col-lg-9">

                                    <div class="row padding-row">

                                        @foreach($assessment->actors as $actor)
                                            <div class="col-lg-2">

                                                <div class="assessment-box" id="actor-{{ $actor->id }}">
                                                    <div class="probability-result" style="background: {{ $actor->getProbabilityColor() }}">{{ $actor->getProbabilityName() }} probability of breach</div>
                                                    <div class="probability-ranking">{{ array_search('a' . $actor->id, array_keys($ranking)) + 1 }}</div>
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
                                                    <div class="probability-result" style="background: {{ $device->getProbabilityColor() }}">{{ $device->getProbabilityName() }} probability of breach</div>
                                                    <div class="probability-ranking">{{ array_search('d' . $device->id, array_keys($ranking)) + 1 }}</div>
                                                    <i class="main-icon fa fa-{{ $device->devicetype->icon }}"></i>
                                                    {{ $device->name }}
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="row padding-row">

                                        @foreach($assessment->assets as $asset)
                                            <div class="col-lg-2">

                                                <div class="assessment-box asset-box" id="asset-{{ $asset->id }}" data-connectedelements="[{{ implode(',', $asset->connectedElementsIds) }}]">
                                                    <div class="risk-result" style="background: {{ $asset->getRiskColor() }}">{{ $asset->getRiskName() }} risk</div>
                                                    <i class="main-icon fa fa-{{ $asset->assettype->icon }}"></i>
                                                    {{ $asset->name }}
                                                </div>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-lg-1">

                                    @foreach($assessment->policies as $policy)

                                        <div class="row padding-row" style="padding-right: 20px; padding-top: 10px; padding-bottom: 10px;">
                                            <div class="col-lg-12">

                                                <div class="assessment-box assessment-box-policy" id="policy-{{ $policy->id }}">
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


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"> &nbsp;Ranking representation <a href="#" class="btn btn-primary btn-xs pull-left" id="toggle-ranking">Show</a> </div>

                <div class="panel-body" id="ranking-representation" style="display: none;">

                    <div class="col-lg-4">

                        <h4>Actors and devices with highest breach probability</h4>

                        <table class="table table-condensed table-striped">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Breach probability</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($ranking as $key => $ranking)
                                <?php

                                if($key[0] == 'a')
                                    $c = $actorsP->get(substr($key, 1));
                                elseif($key[0] == 'd')
                                    $c = $devicesP->get(substr($key, 1));


                                ?>
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td>{{ $c->getType() }}</td>
                                    <td class="text-center" style=" color: #fff; background: {{ $c->getProbabilityColor() }}">{{ $c->getProbabilityName() }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>

                    <div class="col-lg-4">
                        <h4>Assets with highest risk</h4>
                        <table class="table table-condensed table-striped">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Risk</th>
                            </tr>
                            <?php $i = 1; ?>
                            @foreach($assetRanking as $key => $ranking)
                                <?php $c = $assets->get($key); ?>
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td>{{ $c->name }}</td>
                                    <td class="text-center" style=" color: #fff; background: {{ $c->getRiskColor() }}">{{ $c->getRiskName() }}</td>
                                </tr>
                            @endforeach
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@section('footer-scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jsPlumb/2.2.9/jsplumb.js"></script>
<script type="text/javascript">

<?php
function parseConnection($sourceId, $sourceType, $targetId, $targetType, $color = 'blue', $anchor = '"AutoDefault"') {
    $r = 'var connection = jsPlumb.connect({
                anchor:'. $anchor . ',
                source:"' . $sourceType . '-' . $sourceId . '", 
                target:"' . $targetType . '-' . $targetId . '",
                endpoint:"Blank",
                endpointStyle:{ fill: "#f00", },
                paintStyle:{ stroke:"' . $color . '", strokeWidth:2 },
                connector: ["Straight"],
                hoverPaintStyle:{ stroke:"purple", strokeWidth: 5 },
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

function stringToColorCode($str) {
  return '#'.substr(md5($str), 0, 6);
  return '#' . $code;
}
?>


$(window).resize(function(){
    jsPlumb.repaintEverything();
});

jsPlumb.ready(function() {
    jsPlumb.setContainer(document.getElementById("svgContainer"));
    @foreach($assessment->devices as $device) 
        @foreach($device->actors as $actor)

            {!! parseConnection($actor->id, 'actor', $device->id, 'device', stringToColorCode($actor->name.$asset->name), '["Top","Bottom"]') !!}

        @endforeach

        @foreach($device->assets as $asset)

            {!! parseConnection($device->id, 'device', $asset->id, 'asset', stringToColorCode($device->name.$asset->name), '["Top","Bottom"]') !!}

        @endforeach


    @endforeach

    @foreach($assessment->policies as $policy)

        @foreach($policy->devices as $device)
            {!! parseConnection($policy->id, 'policy', $device->id, 'device', 'red') !!}
        @endforeach

        @foreach($policy->actors as $actor)
            {!! parseConnection($policy->id, 'policy', $actor->id, 'actor', 'red') !!}
        @endforeach

    @endforeach

});

    
    $(function() {
        $('#panel-to-set-height').height($('#row-with-height').height());

         $('#toggle-ranking').click(function(e) {
            e.preventDefault();

            $('#ranking-representation').slideToggle(function() {
                jsPlumb.repaintEverything();
            });

            if($('#toggle-ranking').html() == 'Show')
                $('#toggle-ranking').html('Hide');
            else
                $('#toggle-ranking').html('Show')

        });


        $('#toggle-visual').click(function(e) {
            e.preventDefault();

            if($('#toggle-visual').html() == 'Show')
                $('#toggle-visual').html('Hide');
            else
                $('#toggle-visual').html('Show')


            $('#panel-to-set-height').slideToggle(function() {
                $('#panel-to-set-height').height($('#row-with-height').height());
            });
        })
    });

    $('.asset-box').hover(function() {
        var ids = $(this).data('connectedelements');

        var asset_id = $(this).attr('id');

        $('.assessment-box').css('opacity', 0.3)
        $(this).css('opacity', 1);
        $('.assessment-box-policy').css('opacity',1)

        var allC = jsPlumb.getAllConnections();
        $.each(allC, function(key, connection) {
            connection.setVisible(false);
        });

        $.each(ids, function(key, val) {
            $(val).css('opacity', 1);


           
            var c1 = jsPlumb.getConnections({ target:[asset_id] });

            //if(val.substring(1, 7) == 'device') {
                var c2 = jsPlumb.getConnections({ target:[val.substring(1, val.length)] });
            //} else {
            //    var c2 = [];
            //}

            var connections = c1.concat(c2);

            $.each(connections, function(key, connection) {
                connection.setVisible(true);
            });

        });
    });

    $('.asset-box').on('mouseleave', function() {

        var allC = jsPlumb.getAllConnections();
            $.each(allC, function(key, connection) {
                connection.setVisible(true);
            });
        $('.assessment-box').css('opacity', 1)
    })

</script>
@endsection