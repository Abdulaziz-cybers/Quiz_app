<?php
function yourFunction($array1, $array2) {
    $missedKeys = array_diff_key($array1, $array2);
    foreach ($missedKeys as $key => $value) {
        $missedKeys[$key] = 'Tushib qoldi';
    }
    return $missedKeys;
}

$array1 = ['a' => 1, 'bob' => 2, 'c' => 3];
$array2 = ['b' => 2, 'd' => 4];
print_r( yourFunction($array1, $array2));