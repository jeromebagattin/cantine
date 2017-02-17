<?php
//print_r($_POST);

foreach(['lundi','mardi'] as $j) {
foreach ($_POST['caf_popotebundle_menu'][$j] as $f) {
    print_r($f);
    echo '<br>';
}
}
?>