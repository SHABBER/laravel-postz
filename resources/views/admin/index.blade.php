<x-admin-master>

@section('content')

@if (Auth::user()->userHasRole('admin'))
    {{-- <h1>Welcome Admin</h1> --}}

   
    <div class="container col-sm-8">
        <canvas id="myChart"></canvas>
    </div>
    <div class="container col-sm-5 ">
        <canvas class='mt-4' id="usersChart"></canvas>
    </div>

    {{-- @foreach($users as $user) {{$user->posts()->count()}} @endforeach --}}
@else
    
    {{redirect}}

@endif


@endsection()

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // const labels = 
      
        const data = {
            labels: [
                'Posts',
                'Comments',
                'Replies',  
                ],
            datasets: [{
                label: 'status',
                backgroundColor:  ['rgb(255, 99, 132)','rgb(155, 99, 232)','rgb(55, 199, 132)'],
                borderColor: ['rgb(255, 99, 132)','rgb(155, 99, 232)','rgb(55, 199, 132)'],
                data: [ {{$posts}}, {{$comments}}, {{$replies}}],
                // borderWidth: 5,
                width:10,
                borderRadius: 5,
            }]
        };
      
        const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            plugins: {
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Status'
            }
            }
        },
        };
      </script>



    <script>
        const myChart = new Chart(
          document.getElementById('myChart'), config );



        const usersChart = new Chart($('#usersChart'), {
            type: 'pie',
            data: {
                labels:{!! $users->pluck('name') !!},
                datasets: [{
                    label: 'Users posts',
                    backgroundColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400'],
                    borderColor: 'rgb(255, 255, 255)',
                    
                    data: [{{ implode(",",$allcount) }}],
                   
                    width:10,
                    borderRadius: 5,
                }]
                },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                        onHover: handleHover,
                        onLeave: handleLeave    
                    },
                title: {
                    display: true,
                    text: 'Users posts'
                }
                }
            },

        });


        // Append '4d' to the colors (alpha channel), except for the hovered index
        function handleHover(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = index === item.index || color.length === 9 ? color : color + '4D';
            });
            legend.chart.update();
            }

        // Removes the alpha channel from background colors
        function handleLeave(evt, item, legend) {
            legend.chart.data.datasets[0].backgroundColor.forEach((color, index, colors) => {
                colors[index] = color.length === 9 ? color.slice(0, -2) : color;
            });
            legend.chart.update();
            }

      </script>





@endsection

</x-admin-master>