<?= $this->Html->script('chart/dist/Chart.bundle.js') ?>

    <div id="canvas-holder" style="width:75%" class="center-block">
        <canvas id="chart-area1"></canvas>
        <hr>
        <canvas id="chart-area2"></canvas>
    </div>
    
    <!--
    <button id="randomizeData">Randomize Data</button>
    <button id="addData">Add Data</button>
    <button id="removeData">Remove Data</button>
    -->

    <script>
    /*
    var randomScalingFactor = function() {
        return Math.round(Math.random() * 100);
    };
    var randomColorFactor = function() {
        return Math.round(Math.random() * 255);
    };
    var randomColor = function(opacity) {
        return 'rgba(' + randomColorFactor() + ',' + randomColorFactor() + ',' + randomColorFactor() + ',' + (opacity || '.3') + ')';
    };
    */
    var config1 = {
        data: {
            datasets: [{
                data: <?= json_encode($num_candidatos); ?>,
                backgroundColor: [
                    "#F7464A",
                    "#46BFBD",
                    "#FDB45C",
                    "#949FB1",
                    "#4D5360",
                    "#7D5360",
                    "#4D9360",
                ],
                label: 'My dataset' // for legend
            }],
            labels: <?= json_encode($lista_ceas); ?>
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Número de Candidatos Excyl2016 por CEAS'
            },
            scale: {
              ticks: {
                beginAtZero: true,
              },
              reverse: false
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    };

    var config2 = {
        data: {
            datasets: [{
                data: <?= json_encode($num_candidatos); ?>,
                backgroundColor: [
                    "#F7464A",
                    "#46BFBD",
                    "#FDB45C",
                    "#949FB1",
                    "#4D5360",
                    "#7D5360",
                    "#4D9360",
                ],
                label: 'My dataset' // for legend
            }],
            labels: <?= json_encode($lista_ceas); ?>
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                text: 'Número de Candidatos Excyl2016 por CEAS'
            },
            scale: {
              ticks: {
                beginAtZero: true,
              },
              reverse: false
            },
            animation: {
                animateRotate: true,
                animateScale: true
            }
        }
    };

    window.onload = function() {
        var ctx1 = document.getElementById("chart-area1");
        window.myPolarArea = Chart.PolarArea(ctx1, config1);

         var ctx2 = document.getElementById("chart-area2");
        window.myPolarArea = Chart.PolarArea(ctx2, config2);
    };
/*
    $('#randomizeData').click(function() {
        $.each(config.data.datasets, function(i, piece) {
            $.each(piece.data, function(j, value) {
                config.data.datasets[i].data[j] = randomScalingFactor();
                config.data.datasets[i].backgroundColor[j] = randomColor();
            });
        });
        window.myPolarArea.update();
    });

    $('#addData').click(function() {
        if (config.data.datasets.length > 0) {
            config.data.labels.push('dataset #' + config.data.labels.length);

            $.each(config.data.datasets, function(i, dataset) {
                dataset.backgroundColor.push(randomColor());
                dataset.data.push(randomScalingFactor());
            });

            window.myPolarArea.update();
        }
    });

    $('#removeData').click(function() {
        config.data.labels.pop(); // remove the label first

        $.each(config.data.datasets, function(i, dataset) {
            dataset.backgroundColor.pop();
            dataset.data.pop();
        });

        window.myPolarArea.update();
    });

*/
    </script>