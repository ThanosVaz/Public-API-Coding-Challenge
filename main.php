<?php

//Consumes data from a public API, Performs some manipulation on the data & Outputs results

$url = 'http://api.citybik.es/v2/networks'; //URL to read data from
$data = json_decode(file_get_contents($url)); //Puts the contents of the file into a variable & decodes Json feed
error_reporting(0); //Supresses notices
?>

<html>
<table> <!--Creates a table row with titles-->
  <tbody>
    <tr>
      <th>COMPANY</th>
      <th>ID</th>
      <th>CITY</th>
      <th>COUNTRY</th>
      <th>NAME</th>
    </tr>

<?php
$count_tot = 0; //Zeroises total count
$count_gb = 0;  //Zeroises gb count

foreach ( $data as $element ) {   //Iterates over the array
  foreach ( $element as $e ) {
    $count_tot = $count_tot + 1;  //Increases total counter by 1
    if ($e->location->country == 'GB') {  //Checks if the country is GB
      $count_gb = $count_gb + 1;  //Increases gb counter by 1
?>
  <tr>  <!-- Displays the data in a table form -->
    <td><?php echo (implode($e->company));  ?> </td>  <!-- Displays the company. Uses implode to join array elements in a string -->
    <td><?php echo $e->id;                  ?> </td>  <!-- Displays the id -->
    <td><?php echo $e->location->city;      ?> </td>  <!-- Displays the city -->
    <td><?php echo $e->location->country;   ?> </td>  <!-- Displays the country -->
    <td><?php echo $e->name;                ?> </td>  <!-- Displays the name -->
  </tr>
<?php
    }
  }
}

?>
<!-- Displays the gb and total counters -->
<p> There are in total <?php echo  $count_tot ?> City Bikes shops in the world, of which the following <?php echo $count_gb ?> in GB</p>