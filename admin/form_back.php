<?php
/* BACK PAGE ONLY */
?>



<!-- HEADER -->

<div class="form-header">

<div class="header-left">
<img src="../assets/img/dswdlogo.webp">
<img src="../assets/img/bagongph.webp">
</div>


<div class="header-center">

<p style="margin-bottom:0;font-weight:bold;font-size:13px">
Republic of the Philippines<br>
Department of Social Welfare and Development
</p>

<p style="margin-bottom:0;font-weight:900;font-size:15px">
FAMILY ASSISTANCE CARD IN<br>
EMERGENCIES AND DISASTERS (FACED)
</p>

</div>


<div class="header-right" style="text-align:center;font-weight:800;font-style:italic;">

THIS CARD IS NOT FOR SALE<br>
BENEFICIARY'S COPY

<div class="official-box">

<div class="official-title">
OFFICIAL USE ONLY
</div>

SERIAL NUMBER

</div>

</div>

</div>



<!-- TITLE -->

<div class="section-title">
FAMILY ASSISTANCE RECORD
</div>


<table class="family-table">

<tr>

<th rowspan="2">DATE</th>

<th rowspan="2">
NAME OF RECEIVING<br>
FAMILY MEMBER
</th>

<th colspan="5">
ASSISTANCE PROVIDED
</th>

<th rowspan="2">PROVIDER</th>

<th rowspan="2">
SIGNATURE /
THUMBMARK
</th>

</tr>


<tr>

<th>EMERGENCY / DISASTER</th>
<th>ASSISTANCE</th>
<th>UNIT</th>
<th>QUANTITY</th>
<th>COST</th>

</tr>



<?php

$rows = 18;

for($i=0; $i<$rows; $i++):

?>

<tr>

<td><?= $records[$i]["date_received"] ?? "" ?></td>

<td><?= $records[$i]["receiving_name"] ?? "" ?></td>

<td><?= $records[$i]["disaster_type"] ?? "" ?></td>

<td><?= $records[$i]["assistance_type"] ?? "" ?></td>

<td><?= $records[$i]["unit"] ?? "" ?></td>

<td><?= $records[$i]["quantity"] ?? "" ?></td>

<td><?= $records[$i]["cost"] ?? "" ?></td>

<td><?= $records[$i]["provider"] ?? "" ?></td>

<td></td>

</tr>

<?php endfor; ?>

</table>