@extends('layouts.app')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                
                    <canvas id="canvas"></canvas>
                       
            </div>
            <div class="col-md-3"></div>                 
        </div>
    </div>
    
     <div class="container-fluid">
        <div class="row-fluid">
        <div class="span6">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Report Bulanan </h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Bulan</th>
                        <th>Pendapatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach($reportBulanan as $b)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$b->bulan}}</td>
                        <td>Rp {{number_format($b->pendapatan)}}</td>
                    </tr>
                    @endforeach
                    
                    </tbody>
                </table>
            </div>
        </div>
        </div>

         <div class="span6">
        @if(Session::has('message'))
            <div class="alert alert-success text-center" role="alert">
                <strong>Well done!</strong> {{Session::get('message')}}
            </div>
        @endif
        <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                <h5>Report Tahunan</h5>
            </div>
            <div class="widget-content nopadding">
                <table class="table table-bordered data-table">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tahun</th>
                        <th>Pendapatan</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($reportTahunan as $t)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$t->tahun}}</td>
                        <td>Rp {{number_format($t->pendapatan)}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>

        </div>
    </div>
@endsection
@section('jsblock')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.js" charset="utf-8"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
    
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        
    </script>
    <script>
        console.log('test');
        var url = "{{url('/chart')}}";
            console.log(url);
            var Pendapatan = new Array();
            var Labels = new Array();
            var Bulan = new Array();
            $(document).ready(function(){
              $.get(url, function(response){
                  console.log(response);
                response.forEach(function(data){
                    Pendapatan.push(data.pendapatan);
                    Labels.push(data.pendapatan);                    
                    Bulan.push(data.bulan);
                });
                var ctx = document.getElementById("canvas").getContext('2d');
                    var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: {
                          labels:Bulan,
                          datasets: [{
                              label: 'Pendapatan',
                              data: Pendapatan,
                              borderWidth: 1
                          }]
                      },
                      options: {
                          scales: {
                              yAxes: [{
                                  ticks: {
                                      beginAtZero:true
                                  }
                              }]
                          }
                      }
                  });
              });
            });
</script>
@endsection
