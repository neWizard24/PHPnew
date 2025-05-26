<?php
function calculate_meeting_time($x1, $v1, $a1, $x2, $v2, $a2) {
    // Параметры:
    // x1, x2 - начальные координаты (м)
    // v1, v2 - начальные скорости (м/с)
    // a1, a2 - ускорения (м/с²)
    
    // Уравнение движения: x1(t) = x1 + v1*t + a1*t²/2
    // Уравнение движения: x2(t) = x2 + v2*t + a2*t²/2
    // Условие встречи: x1(t) = x2(t)
    
    // Приводим к квадратному уравнению:
    // (a1 - a2)/2 * t² + (v1 - v2)*t + (x1 - x2) = 0
    
    $A = ($a1 - $a2) / 2;
    $B = $v1 - $v2;
    $C = $x1 - $x2;
    
    // Дискриминант
    $D = pow($B, 2) - 4 * $A * $C;
    
    if ($D < 0) {
        return null; // Нет реальных решений - автомобили не встретятся
    }
    
    // Возможные решения
    $t1 = (-$B + sqrt($D)) / (2 * $A);
    $t2 = (-$B - sqrt($D)) / (2 * $A);
    
    // Выбираем минимальное положительное время
    $valid_times = array_filter([$t1, $t2], function($t) { return $t >= 0; });
    
    if (empty($valid_times)) {
        return null;
    }
    
    return min($valid_times);
}

function main() {
    echo "Введите начальное положение первого автомобиля x1 (м): ";
    $x1 = trim(fgets(STDIN));
    $x1 = floatval($x1);
    
    echo "Введите начальную скорость первого автомобиля v1 (м/с): ";
    $v1 = trim(fgets(STDIN));
    $v1 = floatval($v1);
    
    echo "Введите ускорение первого автомобиля a1 (м/с²): ";
    $a1 = trim(fgets(STDIN));
    $a1 = floatval($a1);
    
    echo "Введите начальное положение второго автомобиля x2 (м): ";
    $x2 = trim(fgets(STDIN));
    $x2 = floatval($x2);
    
    echo "Введите начальную скорость второго автомобиля v2 (м/с): ";
    $v2 = trim(fgets(STDIN));
    $v2 = floatval($v2);
    
    echo "Введите ускорение второго автомобиля a2 (м/с²): ";
    $a2 = trim(fgets(STDIN));
    $a2 = floatval($a2);
    
    $t = calculate_meeting_time($x1, $v1, $a1, $x2, $v2, $a2);
    
    if ($t === null) {
        echo "Автомобили не встретятся при заданных параметрах.\n";
    } else {
        printf("Время до встречи: %.2f секунд\n", $t);
    }
}

main();
?>