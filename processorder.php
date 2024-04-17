<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автозапчасти от Вовки</title>
</head>

<body>
    <?php
    //Цены сохраняем в константы
    define('TIREPRICE', 100);
    define('OILPRICE', 10);
    define('SPARKPRICE', 4);
    //Создать короткие имена переменых

    $tireqty = $_POST['tireqty'];
    $oilqty = $_POST['oilqty'];
    $sparkqty = $_POST['sparkqty'];
    $tireqty > 0 ? $tireqty = $tireqty : $tireqty = 0;
    $oilqty > 0 ? $oilqty = $oilqty : $oilqty = 0;
    $sparkqty > 0 ? $sparkqty = $sparkqty : $sparkqty = 0;

    ?>
    <h1>Автозапчасти от Вовки</h1>
    <h2>Результаты заказа</h2>

    <?php
    $totalqrty = 0;
    $totalqrty = $tireqty + $oilqty + $sparkqty;
    $totalamount = 0.00;
    echo "<p>Заказ обработан в " . date('H:i, jS F Y') . "</p>";
    if ($totalqrty == 0) {
        echo 'Вы ничего не заказали на предыдущей странице! <br />';
    } else {
        if ($tireqty < 10) {
            $dicount = 0;
        } elseif ($tireqty >= 10 && $tireqty <= 49) {
            $dicount = 5;
        } elseif ($tireqty >= 50 && $tireqty <= 99) {
            $dicount = 10;
        } else {
            $dicount = 15;
        }

        echo "<p>Ваш заказ: </p>";
        if ($tireqty > 0) {
            echo htmlspecialchars($tireqty) . ' шин<br />';
        }
        if ($oilqty > 0) {
            echo htmlspecialchars($oilqty) . ' бутылок масла<br />';
        }
        if ($sparkqty > 0) {
            echo htmlspecialchars($sparkqty) . ' свечей зажигания<br />';
        }
        $totalamount = $tireqty * TIREPRICE * (1 - $dicount / 100) + $oilqty * OILPRICE + $sparkqty * SPARKPRICE;

        echo "<p>Заказано товаров: " . $totalqrty . "<br />";
        echo "Итого: $" . number_format($totalamount, 2) . "<br />";
        if ($dicount > 0) {
            echo "(скидка на шины " . $dicount . "% составила $" . ($tireqty * TIREPRICE * $dicount / 100) . ")<br />";
        }
        $taxrate = 0.1; //Местный налог с продаж -- 10%
        $totalamount = $totalamount * (1 + $taxrate);
        echo "Всего, включая налог с продаж: $" . number_format($totalamount, 2) . "</p>";
    }
    $outputstring = $date . '\t' . $tireqty . ' шин\t' . $oilqty . ' масла\t' . $sparkqty . ' свечей зажигания\t' . $totalamount . '\t' . $address . '\n';
    $fp = @fopen("orders.txt", 'ab');
    if (!$fp) {
        echo '<p><strong>В настоящий момент Ваш запрос не может быть обработан. Пожалуйста, попробуйте позже.</strong></p>';
        exit;
    };
    flock($fp, LOCK_EX);
    fwrite($fp, $outputstring, strlen($outputstring));
    flock($fp, LOCK_UN);
    fclose($fp);
    echo '<p>Ваш заказ записан</p>'


    ?>
</body>

</html>