<div class="row">
    <div class="col-md-4">
        <div class="alert alert-info">
            Total no. of Applications:<br>
            <h3 class="text-center" id="total_no_of_applications">0</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-warning">
            No. of Unfinished Applications:
            <h3 class="text-center" id="total_no_of_unfinished_applications">0</h3>
        </div>
    </div>
    <div class="col-md-4">
        <div class="alert alert-success">
            No. of Finished Applications
            <h3 class="text-center" id="total_no_of_finished_applications">0</h3>
    </div>
    </div>
    <script>
        $(document).ready(function(){
            $.ajax({
                type: "GET",
                url: "<?=base_url().add_index()?>analytics/card",
                dataType: "json",
                data: {
                    all: 1
                },
                success: function(data){
                    $("#total_no_of_applications").text(data.total_no_of_applications);
                    $("#total_no_of_unfinished_applications").text(data.total_no_of_unfinished_applications);
                    $("#total_no_of_finished_applications").text(data.total_no_of_finished_applications);
                }
            });
        });
    </script>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Business Categories</h5>
            </div>
            <div class="card-body">
                <canvas id="business_categories" width="400" height="400"></canvas>
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?=base_url().add_index()?>analytics/ranks",
                            type: "GET",
                            dataType: "json",
                            data: {
                                business_categories: 1
                            },
                            success: function(data){
                                var ctx = document.getElementById('business_categories').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: data.category,
                                        datasets: [{
                                            label: 'Business Categories',
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
                    }); 
                </script>
            </div>
            <div class="card-footer">
                <a href="<?=base_url().add_index()?>analytics/business_categories">View Details</a>                
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Business Types</h5>
            </div>
            <div class="card-body">
                <canvas id="business_type" width="400" height="400"></canvas>
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?=base_url().add_index()?>analytics/ranks",
                            type: "GET",
                            dataType: "json",
                            data: {
                                business_type: 1
                            },
                            success: function(data){
                                var ctx = document.getElementById('business_type').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: data.business_type,
                                        datasets: [{
                                            label: 'Business Type',
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
                    }); 
                </script>
            </div>
            <div class="card-footer">
                <a href="<?=base_url().add_index()?>analytics/business_type">View Details</a>                
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Applications by Day</h5>
            </div>
            <div class="card-body">
                <canvas id="application_by_day" width="400" height="100"></canvas>
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?=base_url().add_index()?>analytics/reports",
                            type: "GET",
                            dataType: "json",
                            data: {
                                application_by_day: 1
                            },
                            success: function(data){
                                var ctx = document.getElementById('application_by_day').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: data.date_of_application,
                                        datasets: [{
                                            label: 'Application By Date',
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
                    }); 
                </script>
            </div>
            <div class="card-footer">
                <a href="<?=base_url().add_index()?>analytics/application_by_day">View Details</a>                
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Applications by Status</h5>
            </div>
            <div class="card-body">
                <canvas id="application_by_status" width="400" height="400"></canvas>
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?=base_url().add_index()?>analytics/reports",
                            type: "GET",
                            dataType: "json",
                            data: {
                                application_by_status: 1
                            },
                            success: function(data){
                                var ctx = document.getElementById('application_by_status').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: data.status,
                                        datasets: [{
                                            label: 'Business Type',
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
                    }); 
                </script>
            </div>
            <div class="card-footer">
                <a href="<?=base_url().add_index()?>analytics/application_by_status">View Details</a>                
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5>Businesses by Status</h5>
            </div>
            <div class="card-body">
                <canvas id="business_by_status" width="400" height="400"></canvas>
                <script>
                    $(document).ready(function(){
                        $.ajax({
                            url: "<?=base_url().add_index()?>analytics/reports",
                            type: "GET",
                            dataType: "json",
                            data: {
                                business_by_status: 1
                            },
                            success: function(data){
                                var ctx = document.getElementById('business_by_status').getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'pie',
                                    data: {
                                        labels: data.status,
                                        datasets: [{
                                            label: 'Business Type',
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
                    }); 
                </script>
            </div>
            <div class="card-footer">
                <a href="<?=base_url().add_index()?>analytics/businesses_by_status">View Details</a>                
            </div>
        </div>
    </div>
</div>
