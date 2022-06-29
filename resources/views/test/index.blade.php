@extends('layouts.panel')

@section('board')
<div class="container-fluid">
    <div class="row mb-3">
        <div class="col">
            <h1 class="text-white"><i class="bi bi-graph-up me-2"></i>Results & Statistics</h1>
        </div>
    </div>
    <hr class="hr">
    <div class="row mb-3">
        <div class="col d-flex justify-content-center my-2">
            <div class="info-card card-1 taken-card fade-in-right">
                <h1 class="title">Submited</h1>
                <div class="number display-1 fw-bold">{{ $numberOfTestedStudent }}</div>
            </div>
        </div>
        <div class="col d-flex justify-content-center my-2">
            <div class="info-card student-card fade-in-right">
                <h1 class="title">Students</h1>
                <div class="number display-1 fw-bold">{{ $numberOfStudent }}</div>
            </div>
        </div>
        <div class="col d-flex justify-content-center my-2">
            <div class="info-card question-card fade-in-right">
                <h1 class="title">Questions</h1>
                <div class="number display-1 fw-bold">{{ $numberOfQuestion }}</div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6 p-2">
            <div class="card p-4 fade-in-down bg-white">
                <canvas id="pie-canvas" width="200" height="200"> </canvas>
            </div>
        </div>
        <div class="col-md-6 p-2">
            <div class="card p-4 fade-in-down bg-white">
                <canvas id="bar-canvas" width="200" height="200"> </canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const data = {
            labels: [
                'Studnets Passed: ' + {{ $passed }} + ' (%' + {{ ($passed/$numberOfStudent)*100 }} + ')',
                'Studnets Failed: ' + {{ $failed }} + ' (%' + {{ ($failed/$numberOfStudent)*100 }} + ')',
                'Studnets Untested Yet: ' + {{ $numberOfUntestedStudent }} + ' (%' + {{ ($numberOfUntestedStudent/$numberOfStudent)*100 }} + ')'
            ],
            datasets: [{
                label: 'Pie Canvas',
                data: [{{ $passed }}, {{ $failed }}, {{ $numberOfUntestedStudent }}],
                backgroundColor: [
                '#1A9603',
                '#96031A',
                '#6D676E'
                ],
                hoverOffset: 4
            }]
        };

        const config = {
            type: 'pie',
            data: data,
        };

        const myPieChart = new Chart(
            document.getElementById('pie-canvas'),
            config
        );

        const barlabels = {!! $top10->pluck('name') !!};;
        const bardata = {
        labels: barlabels,
        datasets: [{
            label: 'Top 10 Passed Students',
            data: {{ $top10->pluck('degree') }},
            backgroundColor: ['#1A9603'],
            borderWidth: 1
        }]
        };
        
        const barconfig = {
            type: 'bar',
            data: bardata,
            options: {
                scales: {
                    y: {
                        beginAtZero: true,  
                        max: {{ $finalDegree }},
                        ticks:{ padding: {{ floor($finalDegree/5) }}},
                    }
                }
            },
        };
        
        const myBarChart = new Chart(
            document.getElementById('bar-canvas'),
            barconfig
        );
        
    </script>
@endpush