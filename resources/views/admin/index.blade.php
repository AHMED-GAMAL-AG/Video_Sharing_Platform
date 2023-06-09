@extends('theme.default')

@section('heading')
    لوحة التحكم
@endsection

@section('content')
    <div class="row justify-content-center">

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center text-right">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                عدد مقاطع الفيديو</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $number_of_videos }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-video fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center text-right">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                عدد القنوات</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $number_of_channels }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-film fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div>
        <canvas id="myChart" class="mt-4"></canvas>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var names = <?php echo $names; ?>;
        var totalViews = <?php echo $total_views; ?>;

        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: names,
                datasets: [{
                    label: 'القنوات الأكثر مشاهدة',
                    data: totalViews
                }]
            },

            // Configuration options go here
            options: {}
        });
    </script>
@endsection
