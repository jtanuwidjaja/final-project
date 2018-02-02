<?php
    include("loginserv.php");
    if (($_SESSION["role"] != "1")&&($_SESSION["role"] != "0")) {
        header("location: index.php");
    }
    include("./includes/DB_queries.php");
    
    $campusquery = get_branch_list();
    $userid = $_SESSION['login'];
    //searching branch for administrators of faculties
    if ($_SESSION["role"] == 1) {
        $userbrachquery = mysqli_query($conn, 
       "SELECT branchid, facultyid FROM user WHERE login = '$userid'");
        $rows = mysqli_fetch_array($userbrachquery);
        $userbranch = $rows["branchid"];
        //$faculty = $rows["facultyid"];
    }
?>

<!DOCTYPE HTML5>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> 
    <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css">
    
</head>
<body>
    <!--Navigation bar-->
    <?php include("./includes/navi_bar.php")?>
    
    
    
    <div class="container">
        
        <div id="test"></div>
        
<!--        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pt-3">-->
        <h1>Dashboard</h1>
    
        <div class="row">
            <div class="form-group col-lg-4 col-md-4">
                <label >Campus</label>
            <select class="form-control" name="campus" id="campus"<?php if ($_SESSION["role"] != "0") echo 'readonly'?>>
            <?php 
                while($row = mysqli_fetch_array($campusquery)){        
                    echo '<option value="'.$row["branchid"].'"';
                    if(isset($userbranch)){
                        if ($row["branchid"] == $userbranch) {
                            echo ' selected';
                        }
                    }
                    echo '>'.$row["branchname"].'</option>';
                }
            ?>
            </select>
            </div>
            <div class='form-group col-md-4'>
                <label >Date from</label>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker_from'>
                        <input type='text' class="form-control" id="date_from"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
            <div class='form-group col-md-4'>
                <label >Date to</label>
                <div class="form-group">
                    <div class='input-group date' id='datetimepicker_to'>
                        <input type='text' class="form-control" id="date_to"/>
                        <span class="input-group-addon">
                            <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row text-center " >
                <div class="col-sm-6 placeholder" >
                    <div class="panel panel-default">
                    <div class="panel-heading">Total utilization</div>
                    <div class="panel-body">
                            <canvas id="totalutil" height="100x"></canvas>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">Building utilization</div>
                        <div class="panel-body" >
                            <canvas id="buildingpie" height="105x"></canvas>
                        </div>
                    </div>
                </div>
                
                <div class="col-6 col-sm-6 table-responsive">
                <div class="panel panel-default">
                    <div class="panel-heading">Room utilization</div>
                    <div class="panel-body">
                    <div class="btn-group" data-toggle="buttons" id="buildinglist">
                    </div>
                      <p></p>
                    <table id="roomtable" class="table table-striped table-fixed table-hover">
                      <thead>
                        <tr>
                            <th>Room</th>
                            <th>Building</th>
                            <th>Level</th>
                            <th>Utilization</th>
                        </tr>
                      </thead>
                    </table>
                    
                </div>
            </div>
                

        </div>   
        <div class="row"> 
            <div class="col-sm-4 placeholder">
                    
                </div>
            
        </div>


        </div>

    </div>
        
 
   

<script src='lib/moment.min.js'></script>
<script src='lib/jquery.min.js'></script>
    
<script type="text/javascript" src="DataTables/datatables.min.js"></script>





    
<!--Bootstrap main -->
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!--JS files for Datapicker-->

<script type="text/javascript" src="js/moment.js"></script>
<script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>

<script src="js/Chart.min.js"></script>  


<script>
    
    var table = $('#roomtable').DataTable({
        "scrollY": "324px",
        //"scrollCollapse": true,
        "paging": false,
        "info" : false,
        select: {
            style: 'single'
        },
        "columnDefs": [
            {
                "targets": [ 1 ],
                "visible": false
            },
        ]
    });

    $(function () {
        $('#datetimepicker_from').datetimepicker({
            useCurrent: false,
            defaultDate: moment().subtract(1, 'months').format('MM/DD/YYYY') + ' 09:00 AM',
            //'11/22/2017 01:00 AM',
            stepping: 30
            
        });
        $('#datetimepicker_to').datetimepicker({
            useCurrent: false, //Important! See issue #1075
            defaultDate: moment().format('MM/DD/YYYY') + ' 06:00 PM',
            
            stepping: 30
        });
        updatedashboard();
        
        
        $("#datetimepicker_from").on("dp.change", function (e) {
            $('#datetimepicker_to').data("DateTimePicker").minDate(e.date);
            updatedashboard();
        });
        $("#datetimepicker_to").on("dp.change", function (e) {
            $('#datetimepicker_from').data("DateTimePicker").maxDate(e.date);
            updatedashboard();
            
        });
        
        $("#campus").on("change", function () {
            updatedashboard();
        });
            
        $('#buildinglist').on('click','.buildingfilter',function () {
        table
        .columns( 1 )
        .search( $(this).prop('id') )
        .draw();
    });
        
        

        
    });
   
var total_building_util = [];
var building_list = [];
var colorbuilding = [];
    
var BuildingCanvas = document.getElementById("buildingpie");
var BuildingBarchart = new Chart(BuildingCanvas, {
    
    type: 'bar',
    data: {
        labels: building_list,
        datasets: [{
            data: total_building_util,
            backgroundColor: colorbuilding,
        }]
    },
    options: {
        legend: {
        display: false
    },
    tooltips: {
        callbacks: {
           label: function(tooltipItem) {
                  return tooltipItem.yLabel;
           }
        }
    },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
    });

    var total_util = [];
    var colortotalutil = [];
    var plugin = {
       beforeDraw: function(chart) {
    
        var width = chart.chart.width,
            height = chart.chart.height,
            ctx = chart.chart.ctx;

        ctx.restore();
        var fontSize = (height / 114).toFixed(2);
        ctx.font = fontSize + "em sans-serif";
        ctx.textBaseline = "middle";

        var text = total_util[0]+'%',
            textX = Math.round((width - ctx.measureText(text).width) / 2),
            textY = height / 2;

        ctx.fillText(text, textX, textY);
        ctx.save();
    }
   }; 


    var TotalCanvas = document.getElementById("totalutil").getContext("2d");
    var Totalchart = new Chart(TotalCanvas, {
        plugins: [plugin],
        type: 'doughnut',
        data: {
            labels: [
              "Total utilization","Unutilized"
            ],
            datasets: [{
                data: total_util,
                backgroundColor: colortotalutil,
            }]
        },
        options: {
            responsive: true,
            legend: {
              display: false
            }

        }
    });
    
   
    
//    Chart.pluginService.register({
//  beforeDraw: function(chart) {
//    
//        var width = chart.chart.width,
//            height = chart.chart.height,
//            ctx = chart.chart.ctx;
//
//        ctx.restore();
//        var fontSize = (height / 114).toFixed(2);
//        ctx.font = fontSize + "em sans-serif";
//        ctx.textBaseline = "middle";
//
//        var text = total_util[0]+'%',
//            textX = Math.round((width - ctx.measureText(text).width) / 2),
//            textY = height / 2;
//
//        ctx.fillText(text, textX, textY);
//        ctx.save();
//    }
//  
//});


function updatedashboard(){
    
    var int_start = $("#datetimepicker_from").data('DateTimePicker').date();
    var int_end = $("#datetimepicker_to").data('DateTimePicker').date();
    var minuteDuration = int_end.diff(int_start,'minutes'); //number of minutes in entered date interval (using for calculation of utilization)
    table
    .clear()
    .draw();
    
    $.post("get_utilization.php",
    {
        date_from: $("#datetimepicker_from").data('DateTimePicker').date().format('YYYY-MM-DD'),
        time_from: $("#datetimepicker_from").data('DateTimePicker').date().format('HH:mm:ss'),
        date_to: $("#datetimepicker_to").data('DateTimePicker').date().format('YYYY-MM-DD'),
        time_to: $("#datetimepicker_to").data('DateTimePicker').date().format('HH:mm:ss'),
        branch: $('#campus option:selected').val()
    },
           function(data, status){
                
                total_util.length = 0;
                colortotalutil.length = 0;
                
                var total_num_of_rooms = 0;
                var rows_html_code = '';
                
                total_building_util.length = 0;
                building_list.length = 0;
                colorbuilding.length = 0;

                var items = [], numberOfrooms= [], base, key, totutil = 0;

                for (var i = 0; i < data.length; i++) {
                    base = data[i];
                    //room utilization
                    var roomutil = Math.round(100*(base.duration/minuteDuration));
                    table.row.add( [base.roomname,base.buildingname,base.level,roomutil + '%']).draw();
                    
                    
                    //total utilization
                    totutil +=  base['duration'];
                    
                    //building utilization
                    key = base.buildingname;
                    // if not already present in the map, add a zeroed item in the map
                    if (!items[key]) {
                        items[key] = 0;
                    }
                    
                    if (!numberOfrooms[key]) {
                        numberOfrooms[key] = 0;
                    }
                                        
                    items[key] += base['duration'];
                    numberOfrooms[key] = numberOfrooms[key] + 1;
 
                }
                
        

                // Now, generate new array
                for (key in items) {
                    //alert(key + " " + numberOfrooms[key]);
                    var util = Math.round(100*(items[key]/(numberOfrooms[key]*minuteDuration)));
                    total_building_util.push(util);
                    building_list.push(key);
                    total_num_of_rooms += numberOfrooms[key];
                    
                }
                
        
                //Updating dashboard
                    //Updating Total utilization
                
                    totutil = Math.round(100*(totutil/(total_num_of_rooms*minuteDuration)));
        
                    total_util.push(totutil);
                    total_util.push(100-totutil);
                
                    colortotalutil.push(getGreenToRed(total_util[0]));
                    colortotalutil.push('rgba(255,255,255,1)');

                    Totalchart.update();
        
                    //Updating Building utilization
                    $.each(total_building_util,function(index,value){
                        colorbuilding.push(getGreenToRed(value));
                    });
                    BuildingBarchart.update();
                    //Updating Room utilization                 
                var buildinglist_htmlcode='';
                for (var i = 0; i < building_list.length; i++) {
                    if (i==0) {
                        buildinglist_htmlcode = '<label class="btn btn-primary active buildingfilter" id="'+ building_list[i]+'"><input type="radio" name="options" id="'+building_list[i]+'" autocomplete="off" value="1" checked>'+ building_list[i]+'</label>';
                        table
                            .columns( 1 )
                            .search( building_list[i] )
                            .draw();
                    }
                    else {
                        buildinglist_htmlcode += '<label class="btn btn-primary buildingfilter" id="'+ building_list[i]+'"><input type="radio" name="options" id="'+ building_list[i]+'" autocomplete="off">'+ building_list[i]+'</label>';
                    }
                
                    
                    
                }
               
                document.getElementById('buildinglist'). innerHTML = buildinglist_htmlcode;
        }
           ,"json"
          );
}

  
function getGreenToRed(percent){
            var r=200,
                n=200,
                o=percent>50?r:Math.floor(r*percent/50),
                i=percent<50?n:Math.floor(n*(100-percent)/50),
                a=i+","+o+",50";
        return "rgba("+a+",1)";
}   
    

    

</script>
    
<script>
        <?php if ($_SESSION["role"] != "0") echo "
        $('#campus option:not(:selected)').prop('disabled', true);
        ";?>
</script>
    
       
</body>
</html>