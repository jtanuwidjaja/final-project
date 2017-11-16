<?php 
$link=mysqli_connect("localhost","root","root");
mysqli_select_db($link,"mrbs");
$branch = isset($_GET['branch']) ? $_GET['branch'] : '';
$tower = isset($_GET['tower']) ? $_GET['tower'] : '';


if($branch!="")
{
$res=mysqli_query($link, "SELECT * FROM building WHERE branchid=$branch");
echo "<label for='ex2'>"; echo "Choose Tower*"; echo "</label>";
echo "<select class='form-control' id='towerdd' onchange='change_tower()'>";
echo "<option>"; echo "Select"; echo "</option>";
while($row=mysqli_fetch_array($res))
{
echo "<option value='$row[buildingid]' selected>"; echo $row["buildingname"]; echo "</option>";
}

echo "</select>";

}



if($tower!="")
{
$res=mysqli_query($link, "SELECT * FROM room WHERE buildingid=$tower");
echo "<label for='ex2'>"; echo "Choose Level*"; echo "</label>";
echo "<select class='form-control' id='level'>";
echo "<option>"; echo "Select"; echo "</option>";
while($row=mysqli_fetch_array($res))
{
echo "<option value='$row[roomid]' selected>"; echo $row["roomname"]; echo "</option>";
}

echo "</select>";

}

 ?>
