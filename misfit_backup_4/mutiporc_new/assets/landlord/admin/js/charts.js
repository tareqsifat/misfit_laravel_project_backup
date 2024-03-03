
        var xValuesOD = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("OrderDailyChart", {
            type: "line",
            data: {
                labels: xValuesOD,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 3830, 2478],
                    borderColor: "#F57D26",
                    fill: false
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 3000, 2000, 1500],
                    borderColor: "#FFC608",
                    fill: false
                }, {
                    data: [300, 700, 2000, 1000, 4000, 3000, 2000, 1000, 200, 100],
                    borderColor: "#6D3F31",
                    fill: false
                }]
            },
            scales: {
                    /*xAxes: [{
                            display: true,
                            scaleLabel: {
                                display: true,
                                labelString: 'Month'
                            }
                        }],*/
                    yAxes: [{
                            display: true,
                            ticks: {
                                beginAtZero: true,
                                steps: 5,
                                stepValue: 5,
                                
                            }
                        }]
                },
            options: {
                legend: {
                    display: false
                }
            }
            
        });

        

        var xValuesOW = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("OrderWeeklyChart", {
            type: "line",
            data: {
                labels: xValuesOW,
                datasets: [{
                    data: [860, 1140, 1060, 2060, 1070, 1110, 1330, 2210, 3830, 2478],
                    borderColor: "#F57D26",
                    fill: false
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 3000, 4000, 2500],
                    borderColor: "#FFC608",
                    fill: false
                }, {
                    data: [300, 700, 2000, 3000, 4000, 3000, 2000, 1000, 800, 4000],
                    borderColor: "#6D3F31",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValuesOM = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("OrderMonthlyChart", {
            type: "line",
            data: {
                labels: xValuesOM,
                datasets: [{
                    data: [860, 1140, 1060, 1060, 1070, 1110, 1330, 2210, 3830, 2478],
                    borderColor: "#F57D26",
                    fill: false
                }, {
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 2500, 4000, 3500],
                    borderColor: "#FFC608",
                    fill: false
                }, {
                    data: [300, 2700, 2000, 4000, 2000, 1000, 2000, 1000, 200, 100],
                    borderColor: "#6D3F31",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValuesSD = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("SalesDailyChart", {
            type: "line",
            data: {
                labels: xValuesSD,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 3000, 2000, 1500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            
            options: {
                legend: {
                    display: false
                }
            }
            
        });
    
        




        var xValuesSW = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("SalesWeeklyChart", {
            type: "line",
            data: {
                labels: xValuesSW,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 3000, 1000, 2500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValuesSM = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("SalesMonthlyChart", {
            type: "line",
            data: {
                labels: xValuesSM,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 1000, 2500, 4000, 3500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValuesCD = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("CommissionDailyChart", {
            type: "line",
            data: {
                labels: xValuesCD,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 4000, 3000, 2000, 1500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            
            options: {
                legend: {
                    display: false
                }
            }
            
        });
    
        



        var xValuesCW = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("CommissionWeeklyChart", {
            type: "line",
            data: {
                labels: xValuesCW,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 2000, 2700, 1000, 3000, 4000, 2500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValuesCM = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];

        new Chart("CommissionMonthlyChart", {
            type: "line",
            data: {
                labels: xValuesCM,
                datasets: [{
                    data: [1600, 1700, 1700, 1900, 1000, 2700, 500, 2500, 4000, 3500],
                    borderColor: "#F57D26",
                    fill: false
                }]
            },
            options: {
                legend: {
                    display: false
                }
            }
        });
    
        



        var xValues = ["Complete Orders", "Cancelled Orders"];
        var yValues = [118, 12];
        var barColors = [
            "#6633FF",
            "#DC0000"
        ];

        new Chart("totalOrdersChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                aspectRatio: 1.1,
                legend: {
                    display: false
                },
                title: {
                    display: false,
                    text: "World Wide Wine Production 2018"
                }
            }
        });
    
        



        var xValues = ["Closed", "Suspended", "Open"];
        var yValues = [90, 20, 10];
        var barColors = [
            "#69B935",
            "#18C4D8",
            "#DC0000"
        ];

        new Chart("totalComplaintChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                //zoomOutPercentage: 80,
                aspectRatio: 1,
                legend: {
                    display: false
                },
                title: {
                    display: false
                }
            }
        });
    
        



        var xValues = ["Manfuha Al-Ja...", "Al-Bat'ha", "Al-Deerah","Mi'kal"];
        var yValues = [27, 28, 13,19];
        var barColors = [
            "#DC0000",
            "#69B935",
            "#3F3CC7",
            "#18C4D8"
        ];

        new Chart("totalComplaintAreaChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                //zoomOutPercentage: 80,
                aspectRatio: 1,
                legend: {
                    display: false
                },
                title: {
                    display: false
                }
            }
        });
    
        


        var xValues = ["Manfuha Al-Ja...", "Al-Bat'ha", "Al-Deerah","Mi'kal"];
        var yValues = [27, 28, 13,19];
        var barColors = [
            "#DC0000",
            "#69B935",
            "#3F3CC7",
            "#18C4D8"
        ];

        new Chart("totalSalesAreaChart", {
            type: "pie",
            data: {
                labels: xValues,
                datasets: [{
                    backgroundColor: barColors,
                    data: yValues
                }]
            },
            options: {
                //zoomOutPercentage: 80,
                aspectRatio: 1,
                legend: {
                    display: false
                },
                title: {
                    display: false
                }
            }
        });
    
        

        /*
    
        var data = [{
        data: [50, 55, 60, 33],
        labels: ["India", "China", "US", "Canada"],
        backgroundColor: [
            "#4b77a9",
            "#5f255f",
            "#d21243",
            "#B27200"
        ],
        borderColor: "#fff"
        }];
        var options = {
            tooltips: {
                enabled: false
            },
            plugins: {
                datalabels: {
                formatter: (value, ctx) => {
                    let datasets = ctx.chart.data.datasets;
                    if (datasets.indexOf(ctx.dataset) === datasets.length - 1) {
                    let sum = datasets[0].data.reduce((a, b) => a + b, 0);
                    let percentage = Math.round((value / sum) * 100) + '%';
                    return percentage;
                    } else {
                    return percentage;
                    }
                },
                color: '#fff',
                }
            }
        };
        var ctx = document.getElementById("totalOrdersChart").getContext('2d');
        var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            datasets: data
        },
        options: options
        }); 
    

      */

        if ($(window).width() > 575) {
            $('.pieChartsRow').each(function(){  
                var highestBox = 0;
            
                $(this).find('.card-common').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.card-common').height(highestBox);
            });

            /*
            $('.ordersAll').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card').height(highestBox);
            });
            */
            $('.ordersAll').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card .total-info-card-title').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card .total-info-card-title').height(highestBox);
            });
            

            $('.SalesCommission').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card').height(highestBox);
            });
            $('.SalesCommission').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card .total-info-card-title').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card .total-info-card-title').height(highestBox);
            });
            

            $('.customersEq').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card').height(highestBox);
            });
            $('.customersEq').each(function(){  
                var highestBox = 0;
            
                $(this).find('.total-info-card .total-info-card-title').each(function(){
                if($(this).height() > highestBox){  
                    highestBox = $(this).height();  
                }
                })
            
                $(this).find('.total-info-card .total-info-card-title').height(highestBox);
            });
        }