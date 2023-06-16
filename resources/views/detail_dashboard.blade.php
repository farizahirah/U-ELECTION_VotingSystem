@extends('layouts.app', ['activePage' => 'dashboard', 'title' => 'U-Election', 'navName' => 'Dashboard', 'activeButton' => 'laravel'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Total Votes') }}</h4>
                            <p class="card-category">{{ __('How many Vote') }}</p>
                        </div>
                        <div class="card-body text-center">
                            <h2>{{$total_vote}}</h2>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats">
                                <p>Start: {{date('d-m-Y', strtotime($vd->start))}}, End: {{date('d-m-Y', strtotime($vd->end))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header ">     
                            <h4 class="card-title">{{ __('Total Voters') }}</h4>
                            <p class="card-category">{{ __('How many Voter') }}</p>
                        </div>
                        <div class="card-body text-center">
                            <h2>{{$total_voter}}</h2>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats">
                                <p>Start: {{date('d-m-Y', strtotime($vd->start))}}, End: {{date('d-m-Y', strtotime($vd->end))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{{ __('Total Candidates') }}</h4>
                            <p class="card-category">{{ __('How many Candidate') }}</p>
                        </div>
                        <div class="card-body text-center">
                            <h2>{{$total_candidate}}</h2>
                        </div>
                        <div class="card-footer">
                            <hr>
                            <div class="stats">
                                <p>Start: {{date('d-m-Y', strtotime($vd->start))}}, End: {{date('d-m-Y', strtotime($vd->end))}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @php
                date_default_timezone_set("Asia/Kuala_Lumpur");
            @endphp
            @if (date('Y-m-d H:i:s', strtotime(now())) <= date('Y-m-d H:i:s', strtotime($vd->end)) && Auth::user()->role_id != 1)
            
            @else
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header ">
                            <h4 class="card-title">{{ $vd->title }}</h4>
                            <p class="card-category">{{ __('Live Result') }}</p>
                        </div>
                        <div class="card-body ">
                            <div id="chartActivity_{{$vd->id}}" class="ct-chart"></div>
                        </div>
                        <div class="card-footer ">
                            <div class="stats">
                                <i class="fa fa-check"></i> {{ __('Data information certified') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            setTimeout(() => {
                var candidate = [];
                var count_vote = [];
                initDashboardPageCharts();
                    
                @foreach($candidates as $c)
                    candidate.push("<?php echo $c->user->name ?>");
                    count_vote.push("<?php echo $c->candidate_vote ?>");
                @endforeach
                
                
                
                function initDashboardPageCharts() {
                    var data = {
                        labels: candidate,
                        series: [
                            count_vote
                        ]
                    };

                    var options = {
                        seriesBarDistance: 10,
                        axisX: {
                            showGrid: false,
                        },
                        height: "245px",
                    };

                    var responsiveOptions = [
                        ['screen and (max-width: 640px)', {
                            seriesBarDistance: 5,
                            axisX: {
                                labelInterpolationFnc: function(value) {
                                    return value[0];
                                }
                            }
                        }]
                    ];

                    var chartActivity = Chartist.Bar('#chartActivity_<?php echo $vd->id ?>', data, options, responsiveOptions);


                }
            }, 100);
        });

        //clock
        var canvas = document.getElementById("canvas");
        var ctx = canvas.getContext("2d");
        var radius = canvas.height / 2;
        ctx.translate(radius, radius);
        radius = radius * 0.90
        setInterval(drawClock, 1000);

        function drawClock() {
            drawFace(ctx, radius);
            drawNumbers(ctx, radius);
            drawTime(ctx, radius);
        }

        function drawFace(ctx, radius) {
            var grad;
            ctx.beginPath();
            ctx.arc(0, 0, radius, 0, 2*Math.PI);
            ctx.fillStyle = 'white';
            ctx.fill();
            grad = ctx.createRadialGradient(0,0,radius*0.95, 0,0,radius*1.05);
            grad.addColorStop(0, '#333');
            grad.addColorStop(0.5, 'white');
            grad.addColorStop(1, '#333');
            ctx.strokeStyle = grad;
            ctx.lineWidth = radius*0.1;
            ctx.stroke();
            ctx.beginPath();
            ctx.arc(0, 0, radius*0.1, 0, 2*Math.PI);
            ctx.fillStyle = '#333';
            ctx.fill();
        }

        function drawNumbers(ctx, radius) {
            var ang;
            var num;
            ctx.font = radius*0.15 + "px arial";
            ctx.textBaseline="middle";
            ctx.textAlign="center";
            for(num = 1; num < 13; num++){
                ang = num * Math.PI / 6;
                ctx.rotate(ang);
                ctx.translate(0, -radius*0.85);
                ctx.rotate(-ang);
                ctx.fillText(num.toString(), 0, 0);
                ctx.rotate(ang);
                ctx.translate(0, radius*0.85);
                ctx.rotate(-ang);
            }
        }

        function drawTime(ctx, radius){
            var now = new Date();
            var hour = now.getHours();
            var minute = now.getMinutes();
            var second = now.getSeconds();
            //hour
            hour=hour%12;
            hour=(hour*Math.PI/6)+
            (minute*Math.PI/(6*60))+
            (second*Math.PI/(360*60));
            drawHand(ctx, hour, radius*0.5, radius*0.07);
            //minute
            minute=(minute*Math.PI/30)+(second*Math.PI/(30*60));
            drawHand(ctx, minute, radius*0.8, radius*0.07);
            // second
            second=(second*Math.PI/30);
            drawHand(ctx, second, radius*0.9, radius*0.02);
        }

        function drawHand(ctx, pos, length, width) {
            ctx.beginPath();
            ctx.lineWidth = width;
            ctx.lineCap = "round";
            ctx.moveTo(0,0);
            ctx.rotate(pos);
            ctx.lineTo(0, -length);
            ctx.stroke();
            ctx.rotate(-pos);
        }

        //countdown
        // Set the date we're counting down to
        var countDownDate = new Date("<?php echo $vd->end ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="countdown"
        document.getElementById("countdown").innerHTML = days + "d " + hours + "h "
        + minutes + "m " + seconds + "s ";

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("countdown").innerHTML = "Vote Closed";
        }
        }, 1000);
    </script>
@endpush