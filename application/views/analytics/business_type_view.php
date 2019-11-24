<style>
    .checkbox {
        padding: 10px;
    }
</style>
<div class="card">
    <div class="card-body">
        <canvas id="application_by_status" width="400" height="100"></canvas>
        <script>
            var checked = false;
            function getAnalytics(data)
            {
                $.ajax({
                    url: "<?=base_url().add_index()?>analytics/ranks",
                    type: "GET",
                    dataType: "json",
                    data: {
                        application_by_status: 1,
                        included: data
                    },
                    success: function(data){
                        $("#report").html("");
                        
                        for(let x = 0; x < data.application_by_status.length; x++)
                        {
                            $("#report").append(
                                "<tr><td>"+data.application_by_status[x]+"</td><td>"+data.count[x]+"</td></tr>"
                            );

                            if(!checked)
                            {
                                $("#checkbox-list").append(
                                    "<td class='checkbox'><input class='in-check' type='checkbox' name='includes' value='"+data.application_by_status[x]+"' checked='checked'> "+data.application_by_status[x]+"</td>"
                                );
                            }
                        }

                        checked = true;

                        var ctx = document.getElementById('business_type').getContext('2d');
                        var myChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: data.application_by_status,
                                datasets: [{
                                    label: 'Application By Status',
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
        <b>Includes:</b>
        <table>
            <tr id="checkbox-list">
            </tr>
        </table>
        <button type="submit" id="submit">Submit</button>
        <script>
            $("#submit").on("click", function(){
                let checkSelected = $(".in-check");

                let selectedValues = new Array();

                for(let x = 0; x < checkSelected.length; x++)
                {
                    if($(checkSelected[x]).prop("checked"))
                    {
                        selectedValues.push($(checkSelected[x]).val());
                    }
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
            <th>Application by Status</th>
            <th>Count</th>
        </tr>
    </thead>
    <tbody id="report">
    </tbody>
</table>