<!DOCTYPE HTML>  
<html>
<style>
<?php
    include 'formstyle.css';
?>
</style>   


<body>  

<?php
require_once ('db_connect.php');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	$sts = 0;
	$res = [];

	$querystr = "SELECT * FROM persons where name <> ''";
	getPerson($querystr, $res, $sts);
	if($sts = 0) {
        echo '<p> No data </>';
		$pdo = NULL;
	}
}




echo '<table class="styled-table"> ';
echo '<thead>
<tr>
    <th>Namn</th>
    <th>Enamn</th>
    <th>Adress</th>
    <th>Vån</th><th>
    email</th>
    <th>Tel</th>
    <th>Ändra</th>
    <th>Sopa</th>

</tr>
</thead>';

for ($i = 0; $i < count($res); $i++){
    $name = $res[$i]['name'];
    $lname = $res[$i]['lname'];
    $adress = $res[$i]['adress'];
    $etage = $res[$i]['etage'];
    $nr = $res[$i]['nr'];
    $email = $res[$i]['email'];
    $id = $res[$i]['ID'];
    $class = (($i % 2) == 0) ? "table_odd_row" : "table_even_row";


    echo "<tbody class='styled-table'>";
    echo "<tr class='styled-table'>";
        echo '<td class="styled-table">'.$name."</td>";
        echo "<td class='styled-table'>".$lname."</td>";
        echo "<td class='styled-table'>".$adress."</td>";
        echo "<td class='styled-table'>".$etage."</td>";
        echo "<td class='styled-table'>".$email."</td>";
        echo "<td class='styled-table'>".$nr."</td>";
        echo "<td class='styled-table'><a href=/php/edit/".$id."><button>Ändra</button></a></td>";
        echo "<td class='delete-button'><a href=/php/delete/".$id."><button >Sopa</button></a></td>";
        //echo "<td class='styled-table'>".$id."</td>";
    echo "</tr>";

}
echo '<tbody>';
echo '</table>';
?>
</body>
</html>


