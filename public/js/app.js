
    $(document).ready(function(){

        const chart = {
            type: 'line',
            data: {
                labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
                    'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                datasets: []
            },
            options: {
                responsive: true,
                title: {
                    display: true,
                    text: 'Posts em Redes Sociais'
                },
                scales: {
                    xAxes: [{
                        display: true,
                    }],
                    yAxes: [{
                        display: true,
                    }]
                }
            }
        };
        const canvas = document.getElementById('canvas');

        $.get("chart", function(data, status){
            if(status == 'success') {

                console.log(data);

                data.forEach(value => {
                    chart.data.datasets.push({

                        label: value.label,
                        backgroundColor: value.backgroundColor,
                        borderColor: value.borderColor,
                        fill: false,
                        data: value.data
                    });
                });
                new Chart(canvas , chart);
            }
        });
    });