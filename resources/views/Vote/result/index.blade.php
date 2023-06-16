@extends('layouts.app', ['activePage' => 'result', 'title' => 'U-Election', 'navName' => 'Result List', 'activeButton' => 'laravel'])

@section('content')
<div class="content">
    <div class="container-fluid">
        @foreach ($vote_details as $vd)
        {{-- admin --}}
        @if(Auth::user()->role_id == 1)
        <div class="row">
            <div class="col-md-4">
                <div class="card ">
                    <div class="card-header ">
                        <h4 class="card-title">{{ __('Total Votes') }}</h4>
                        <p class="card-category">{{ __('How many Vote') }}</p>
                    </div>
                    <div class="card-body text-center">
                        <h2>{{$vd->total_vote}}</h2>
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
                        <h2>{{$vd->total_voter}}</h2>
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
                        <h2>{{$vd->total_candidate}}</h2>
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

        @php
            $position = [
                'President',
                'Vice president',
                'General Secretary',
                'Honorary Treasurer',
                'Strategic Planning',
                'Club & Societies',
                'Sports & Recreational',
                'Student Development 1',
                'Student Development 2',
                'Welfare 1',
                'Welfare 2',
                'Welfare 3',
                'Entrepreneurship',
                'Human Resource'
            ];

            //user cannot see vote that is on going
            date_default_timezone_set("Asia/Kuala_Lumpur");
        @endphp

        <div class="row">
            <div class="col-md-12">
                <div class="card strpied-tabled-with-hover">
                    <div class="card-header">
                        <h4 class="card-title">Result List</h4>
                        <p class="card-category">{{$vd->title}}</p>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <table class="table table-hover table-striped">
                            @if (date('Y-m-d H:i:s', strtotime(now())) <= date('Y-m-d H:i:s', strtotime($vd->end)) && Auth::user()->role_id != 1)      
                            <div class="pl-lg-4 pr-lg-4"><h4>Vote Still On Going</h4></div>
                            @else
                            <thead>
                                <th>#</th>
                                <th>Candidate</th>
                                <th>Total Vote</th>
                                <th>Picture</th>
                                <th>Position</th>
                            </thead>
                            <tbody>
                                @foreach ($vd->candidate_vote->sortByDesc('candidate_vote_total') as $key=>$c)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$c->user->name}}</td>
                                    <td>
                                        {{$c->candidate_vote_total}}
                                    </td>
                                    <td>
                                        @if($c->user->photo != null)
                                            <img class="avatar border-gray" src="{!! asset('archieve/user/'.$c->user->email.'/'.$c->user->photo) !!}" alt="...">                                            </a>
                                        @else
                                            <img class="avatar border-gray" src="{!! asset('archieve/noimage.jpg') !!}" alt="...">
                                        @endif
                                    </td>
                                    <td>{{$position[$loop->iteration-1]}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            @endif
                            
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
    
@endsection

@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            // Javascript method's body can be found in assets/js/demos.js
            @foreach($vote_details as $v)
            setTimeout(() => {
                var candidate = [];
                var count_vote = [];
                initDashboardPageCharts();
                    
                @foreach($v->candidate_vote as $c)
                    candidate.push("<?php echo $c->user->name ?>");
                    count_vote.push("<?php echo $c->candidate_vote_total ?>");
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

                    var chartActivity = Chartist.Bar('#chartActivity_<?php echo $v->id ?>', data, options, responsiveOptions);


                }
            }, 100);
            @endforeach
        });
    </script>
@endpush