<style>
    .checkbox {
        padding: 10px;
    }
</style>
<div class="card">
    <div class="card-body">
        <canvas id="application_by_day" width="400" height="100"></canvas>
        <script>
            var checked = false;
            function getAnalytics(data)
            {
                $.ajax({
                    url: "<?=base_url().add_index()?>analytics/reports",
                    type: "GET",
                    dataType: "json",
                    data: {
                        application_by_day: 1,
                        between: data
                    },
                    success: function(data){
                        $("#report").html("");
                        
                        for(let x = 0; x < data.date_of_application.length; x++)
                        {
                            $("#report").append(
                                "<tr><td>"+data.date_of_application[x]+"</td><td>"+data.count[x]+"</td></tr>"
                            );
                        }

                        checked = true;

                        var ctx = document.getElementById('application_by_day').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'line',
                            data: {
                                labels: data.date_of_application,
                                datasets: [{
                                    label: 'Applications by Day',
                                    data: data.count,
                                    backgroundColor: [
                                        'rgba(255, 99, 132, 0.2)',
                                        'rgba(54, 162, 235, 0.2)',
                                        'rgba(255, 206, 86, 0.2)',
                                        'rgba(75, 192, 192, 0.2)',
                                        'rgba(153, 102, 255, 0.2)',
                                        'rgba(255, 159, 64, 0.2)'
                                    ],
                                    borderColor: [
                                        'rgba(255, 99, 132, 1)',
                                        'rgba(54, 162, 235, 1)',
                                        'rgba(255, 206, 86, 1)',
                                        'rgba(75, 192, 192, 1)',
                                        'rgba(153, 102, 255, 1)',
                                        'rgba(255, 159, 64, 1)'
                                    ],
                                    borderWidth: 1
                                }]
                            },
                            options: {
                                scales: {
                                    yAxes: [{
                                        ticks: {
                                            beginAtZero: true
                                        }
                                    }]
                                }
                            }
                        });
                    }
                });
            }

            $(document).ready(function(){
                getAnalytics("");
            }); 
        </script>
        <br>
        <b>Show Between:</b>
        <table>
            <tr>
                <td class="checkbox"><input type="date" class="select-date form-control"></td>
                <td class="checkbox"><input type="date" class="select-date form-control"></td>
            </tr>
        </table>
        <button type="submit" id="submit">Submit</button>
        <script>
            $("#submit").on("click", function(){
                let checkSelected = $(".select-date");

                let selectedValues = new Array();

                for(let x = 0; x < checkSelected.length; x++)
                {
                    selectedValues.push($(checkSelected[x]).val());
                }

                getAnalytics(selectedValues.toString());
            });
        </script>
    </div>
</div>
<br>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Date</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody id="report">
    </tbody>
</table>