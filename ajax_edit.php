<?php 
$conn=mysqli_connect("localhost","root","root");
mysqli_select_db($conn,"mrbs");
$branch = isset($_GET['branch']) ? $_GET['branch'] : '';
$tower = isset($_GET['tower']) ? $_GET['tower'] : '';

if($branch!="")
{
$res=mysqli_query($conn, "SELECT * FROM building WHERE branchid=$branch");

echo "<label for='ex2'>"; echo "Choose Tower*"; echo "</label>";
echo "<select class='form-control' name='towerdd' id='towerdd' onchange='change_tower()'>";
echo "<option>"; echo "Select"; echo "</option>";
while($row=mysqli_fetch_array($res))
{
echo "<option value='$row[buildingid]'>"; echo $row["buildingname"]; echo "</option>";
}
echo "</select>";
}



if($tower!="")
{
$res=mysqli_query($conn, "SELECT * FROM building WHERE buildingid=$tower");
echo "<label for='ex2'>"; echo "Choose Level*"; echo "</label>";
echo "<select class='form-control' id='levelof' name='leveldd'>";
echo "<option>"; echo "Select"; echo "</option>";

$row=mysqli_fetch_array($res);
$level = $row['nlevel'];
for($i=0; $i<=$level; $i++)
{
echo "<option value='$i'>".$i."</option>";
}
echo "</select>";
}
 ?>

