<?php
/* FRONT PAGE */
?>


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



<!-- LOCATION -->

<div class="section-title">
LOCATION OF THE AFFECTED FAMILY
</div>


<div class="form-row">
<div class="label">1. REGION</div>
<div class="value"><?= $b["region"] ?></div>

<div class="label">4. DISTRICT</div>
<div class="value"><?= $b["district"] ?></div>
</div>


<div class="form-row">
<div class="label">2. PROVINCE</div>
<div class="value"><?= $b["province"] ?></div>

<div class="label">5. BARANGAY</div>
<div class="value"><?= $b["barangay"] ?></div>
</div>


<div class="form-row">
<div class="label">3. CITY / MUNICIPALITY</div>
<div class="value"><?= $b["municipality"] ?></div>

<div class="label">6. EVACUATION CENTER</div>
<div class="value"><?= $b["evacuation_site"] ?></div>
</div>



<!-- HEAD -->

<div class="section-title">
HEAD OF THE FAMILY
</div>



<div class="form-row">
<div class="label">7. LAST NAME</div>
<div class="value"><?= $b["last_name"] ?></div>

<div class="label">15. CIVIL STATUS</div>
<div class="value"><?= $b["civil_status"] ?></div>
</div>


<div class="form-row">
<div class="label">8. FIRST NAME</div>
<div class="value"><?= $b["first_name"] ?></div>

<div class="label">16. MOTHER'S MAIDEN NAME</div>
<div class="value"><?= $b["mothers_maiden_name"] ?></div>
</div>


<div class="form-row">
<div class="label">9. MIDDLE NAME</div>
<div class="value"><?= $b["middle_name"] ?></div>

<div class="label">17. RELIGION</div>
<div class="value"><?= $b["religion"] ?></div>
</div>


<div class="form-row">
<div class="label">10. NAME EXT.</div>
<div class="value"><?= $b["name_ext"] ?></div>

<div class="label">18. OCCUPATION</div>
<div class="value"><?= $b["occupation"] ?></div>
</div>


<div class="form-row">
<div class="label">11. BIRTHDAY</div>
<div class="value"><?= $b["birthdate"] ?></div>

<div class="label">19. MONTHLY FAMILY NET INCOME</div>
<div class="value"><?= $b["monthly_income"] ?></div>
</div>


<div class="form-row">
<div class="label">12. Age</div>
<div class="value"><?= $b["age"] ?></div>

<div class="label">20. ID CARD PRESENTED</div>
<div class="value"><?= $b["id_card_presented"] ?></div>
</div>


<div class="form-row">
<div class="label">13. PLACE OF BIRTH</div>
<div class="value"><?= $b["place_of_birth"] ?></div>

<div class="label">21. ID CARD NUMBER</div>
<div class="value"><?= $b["id_number"] ?></div>
</div>


<div class="form-row">

<div class="label">14. SEX</div>

<div class="value">

<input type="checkbox" <?= $b["sex"]=="Male"?"checked":"" ?>> MALE
<input type="checkbox" <?= $b["sex"]=="Female"?"checked":"" ?>> FEMALE

</div>


<div class="label">22. CONTACT NUMBER</div>
<div class="value"><?= $b["contact_number"] ?></div>

</div>

<!-- ADDRESS -->

<div class="form-row">

<div class="label">23. PERMANENT ADDRESS</div>

<div class="value" style="grid-column: span 3;">

<?= 
$b["house_no"]." ".
$b["street"]." ".
$b["sitio"]." ".
$b["addr_barangay"]." ".
$b["addr_city"].", ".
$b["addr_province"]." ".
$b["zip_code"]
?>

</div>

</div>



<div class="form-row" style="font-size:10px">

<div></div>

<div style="grid-column: span 3; display:flex; justify-content:space-between;">

<span>House/Block/Lot No.</span>
<span>Street</span>
<span>Subd./Village</span>
<span>Barangay</span>
<span>City/Municipality</span>
<span>Province</span>
<span>Zip Code</span>

</div>

</div>



<!-- OTHERS -->

<div class="form-row">

<div class="label">24. OTHERS</div>

<div style="grid-column: span 3; border:none; display:flex; gap:25px; align-items:center;">

<label>
<input type="checkbox" <?= $b["is_4ps"]==1?"checked":"" ?>>
4Ps Beneficiary
</label>

<label>
<input type="checkbox" <?= $b["ip_type"]!=""?"checked":"" ?>>
IP (Type of Ethnicity):
</label>

<span style="
border-bottom:1px solid black;
min-width:150px;
display:inline-block;
">

<?= $b["ip_type"] ?>

</span>

</div>

</div>



<!-- FAMILY -->

<div class="section-title">
FAMILY INFORMATION
</div>


<table class="family-table">

<tr>
<th>Family Member</th>
<th>Relation</th>
<th>Birthdate</th>
<th>Age</th>
<th>Sex</th>
<th>Education</th>
<th>Occupation</th>
<th>Vulnerability</th>
</tr>


<?php

$maxRows = 6;

for ($i = 0; $i < $maxRows; $i++):

$f = $family[$i] ?? null;

?>

<tr>

<td><?= $f["name"] ?? "" ?></td>

<td><?= $f["relation"] ?? "" ?></td>

<td><?= $f["birthdate"] ?? "" ?></td>

<td><?= $f["age"] ?? "" ?></td>

<td><?= $f["sex"] ?? "" ?></td>

<td><?= $f["education"] ?? "" ?></td>

<td><?= $f["occupation"] ?? "" ?></td>

<td><?= $f["vulnerability"] ?? "" ?></td>

</tr>

<?php endfor; ?>

</table>



<!-- ACCOUNT -->

<div class="section-title">
ACCOUNT INFORMATION
</div>


<p class="note">

Note: In case the family head does not have a bank or e-wallet account,
any of the family members with a validated account can be indicated.

</p>



<div class="form-row">

<div class="label">25. BANK / E-WALLET</div>
<div class="value"><?= $b["bank_wallet"] ?></div>

<div class="label">27. ACCOUNT TYPE</div>
<div class="value"><?= $b["account_type"] ?></div>

</div>



<div class="form-row">

<div class="label">26. ACCOUNT NAME</div>
<div class="value"><?= $b["account_name"] ?></div>

<div class="label">28. ACCOUNT NUMBER</div>
<div class="value"><?= $b["account_number"] ?></div>

</div>



<!-- OWNERSHIP -->

<div class="form-row">

<div class="label">29. HOUSE OWNERSHIP</div>
<div></div>

<div class="label">30. SHELTER DAMAGE CLASSIFICATION</div>
<div></div>

</div>



<div class="form-row">

<div></div>

<div style="border:none">

<label>
<input type="checkbox" <?= $b["ownership"]=="owner"?"checked":"" ?>>
OWNER
</label>

<label>
<input type="checkbox" <?= $b["ownership"]=="renter"?"checked":"" ?>>
RENTER
</label>

<label>
<input type="checkbox" <?= $b["ownership"]=="sharer"?"checked":"" ?>>
SHARER
</label>

</div>



<div></div>

<div style="border:none">

<label>
<input type="checkbox"
<?= $b["damage_classification"]=="Partially damage"?"checked":"" ?>
>
PARTIALLY DAMAGED
</label>

<label>
<input type="checkbox"
<?= $b["damage_classification"]=="Totally damage"?"checked":"" ?>
>
TOTALLY DAMAGED
</label>

</div>

</div>



<!-- SIGNATURE -->

<div class="signature-wrap">


<div class="thumb-box">

<div class="thumb"></div>

Right Thumbmark

</div>


<div class="sign-col">

<div class="line"></div>
<div class="label-sign">
Signature / Thumbmark of Family Head
</div>

<div class="line"></div>
<div class="label-sign">
Date Registered
</div>

</div>


<div class="sign-col">

<div class="line"></div>
<div class="label-sign">
Name / Signature of Barangay Captain
</div>

<div class="line"></div>
<div class="label-sign">
Name / Signature of LSWDO
</div>

</div>

</div>



<!-- PRIVACY -->

<div>

<h5 style="text-align:center;font-size:15px;font-weight:800">
DATA PRIVACY DECLARATION
</h5>

<p style="text-align:center;font-size:13px;font-weight:bold">

All data and information indicated herein shall be used for identification purposes
for the implementation of disaster risk reduction and management (DRRM)
programs, projects, and activities and its disclosure shall be in compliance
to Republic Act 10173 (Data Privacy Act of 2012).

</p>

</div>