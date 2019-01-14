function loadChart(level) {
    var number = [];number.push(0);
    var point = [];point.push(0);
    $.post("backend/php/get_chart.php", {level: level}, function(result){
        pushedData = jQuery.parseJSON(result);
        $.each(pushedData, function(i, serverData)
        {
            number.push(parseInt(serverData['number']));
            point.push(parseInt(serverData['point']));
        });
        Chart.defaults.global.defaultFontColor = '#000000';
        Chart.defaults.global.defaultFontFamily = 'Arial';
        var lineChart = document.getElementById('line-chart');
        var myChart = new Chart(lineChart, {
            type: 'line',
            data: {
                labels: number,
                datasets: [
                    {
                        label: 'Listen Number',
                        data: point,
                        backgroundColor: 'rgba(0, 128, 128, 0.3)',
                        borderColor: 'rgba(0, 128, 128, 0.7)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
            }
        });
    });


}
function loadPoint(point) {
    var maxscore = $('#maxscore').text();
    var level = $('#level-mode').text();
    level = parseInt(level);
    maxscore = parseInt(maxscore);
    var p = (point/maxscore) *100;
    $.post("backend/php/point.php", {point: point,level: level}, function(result){
        loadChart(level);
    });

    $('#myavgscore').css('width',p);
}