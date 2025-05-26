<?php
function calculate_y_formula($x) {
    try {
        if ($x < -1 || $x > 1) {
            throw new Exception("x должен быть в интервале [-1, 1] для arcsin(x)");
        }
        $term1 = asin($x);
        
        $term2 = 5 * sqrt(pow($x, 2) + 1);
        
        $sin_x = sin($x);
        if (2 * $sin_x <= 0) {
            throw new Exception("Логарифм не определен для неположительных значений");
        }
        $term3 = log(2 * $sin_x);
        
        return $term1 + $term2 + $term3;
    } catch (Exception $e) {
        echo "Ошибка вычисления: " . $e->getMessage() . "\n";
        return null;
    }
}

function calculate_y_math($x) {

    return calculate_y_formula($x);
}

function is_in_region_D($x, $y) {

    return (pow($x, 2) + pow($y, 2) <= 25) && ($y >= 0);
}

function main() {

    echo "Введите значение x: ";
    $x = trim(fgets(STDIN));
    $x = floatval($x);
    

    $y_formula = calculate_y_formula($x);
    $y_math = calculate_y_math($x);
    
    if ($y_formula === null || $y_math === null) {
        return;
    }
    

    $in_region_formula = is_in_region_D($x, $y_formula);
    $in_region_math = is_in_region_D($x, $y_math);
    

    echo "\nРезультаты:\n";
    printf("Способ 1 (формулы преобразования): y = %.4f, Принадлежит D: %s\n", 
           $y_formula, $in_region_formula ? 'True' : 'False');
    printf("Способ 2 (математические функции): y = %.4f, Принадлежит D: %s\n", 
           $y_math, $in_region_math ? 'True' : 'False');
}


main();
?>