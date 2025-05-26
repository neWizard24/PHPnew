<?php
function calculate_y($x) {
    if ($x <= 3) {
        // y(x) = lg(2^x + x^7 + |x-4|^x)
        $term = pow(2, $x) + pow($x, 7) + pow(abs($x - 4), $x);
        if ($term <= 0) return null;
        return log10($term);
    } elseif ($x > 3 && $x < 5) {
        // y(x) = ln((x/(1+x^2))^4)
        $denominator = 1 + pow($x, 2);
        if ($denominator == 0) return null;
        $arg = $x / $denominator;
        if ($arg <= 0) return null;
        return 4 * log($arg);
    } else {
        // y(x) = arccos(1/x) + 1
        $arg = 1 / $x;
        if (abs($arg) > 1) return null;
        return acos($arg) + 1;
    }
}

function main() {
    echo "Введите значение x: ";
    $x = trim(fgets(STDIN));
    $x = floatval($x);
    
    $y = calculate_y($x);
    
    if ($y === null) {
        echo "Функция не определена в точке x = $x\n";
    } else {
        printf("y(%.2f) = %.4f\n", $x, $y);
    }
}

main();
?>
