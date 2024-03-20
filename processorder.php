<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Автозапчасти от Вовки</title>
</head>

<body>
    <?php
    //Создать короткие имена переменых
    $tireqty = $_POST['tireqty'];
    $oilqty = $_POST['oilqty'];
    $sparkqty = $_POST['sparkqty'];
    ?>
    <h1>Автозапчасти от Вовки</h1>
    <h2>Результаты заказа</h2>

    <?php
    echo "<p>Заказ обработан в " . date('H:i, jS F Y') . "</p>";
    echo "<p>Ваш заказ: </p>";
    echo htmlspecialchars($tireqty).' шин<br />';
    echo htmlspecialchars($oilqty).' бутылок масла<br />';
    echo htmlspecialchars($sparkqty).' свечей зажигания<br />';
    ?>
</body>

</html>