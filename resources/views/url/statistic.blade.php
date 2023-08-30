@extends('base')

@section('content')
    <div class="container mt-5">
        <div class="text-center">
            <h1>Statistics for our links </h1>
        </div>
        <div><canvas id="myGraphique" width="300" height="300"></canvas></div>
    </div>
    
    

<script>

    const data = @json($data)

    console.log(data['labels'],data['dataset']['data'])
    
    const ctx= document.getElementById('myGraphique').getContext("2d");
    let myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data['labels'],
            options: {
                scales: {
                    y: 
                    {
                        beginAtZero: true
                    }
                }
            },
            datasets: [
                {
                    label: `Stats of links` ,
                    data: data['dataset']['data'],
                    backgroundColor: 'rgb(13,110,253)', // Couleur de remplissage
                    borderColor: 'rgb(13,110,253)', // Couleur de la bordure
                    borderWidth: 1 // Largeur de la bordure
                }
            ]
        }
    })

</script>
@endsection