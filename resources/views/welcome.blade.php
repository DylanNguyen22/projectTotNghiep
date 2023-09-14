





<?php
$arr = [];
$bigArr = [['a', 'b', 'c'], ['b'], ['c']];
foreach ($bigArr as $key => $smallArr) {
    $a = [];
    array_push($a, $key);
    // echo "<pre>";
    // print_r($a);
    // print_r($smallArr);
    // echo "=======";
    array_push($smallArr, $a[0]);
    array_push($arr, $smallArr);

}

echo "<pre>";
    print_r($arr);
?>
