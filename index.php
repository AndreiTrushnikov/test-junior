<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <title>Тестовое задание на должность "Junior-разбработчик" в компанию [startmedia]</title>
</head>
<body>
    <main>
        <?php
            $json_attempts = file_get_contents("data_attempts.json");
            $json_cars = file_get_contents('data_cars.json');
            $data_attempts = json_decode($json_attempts, true);
            $data_cars = json_decode($json_cars, true);
            // Определяем количество столбцов
            $column_count = (round(count($data_attempts) / count($data_cars), 0, PHP_ROUND_HALF_DOWN));
            // Определяем шиирину столбца попыток, исходя из количества попыток(столбцов попыток) и количества участников.
            $width = (100 / $column_count);

            // Отлавливаем ошибки возникшие при превращении
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $data_error = '';
                    break;
                case JSON_ERROR_DEPTH:
                    $data_error = 'Достигнута максимальная глубина стека';
                    break;
                case JSON_ERROR_STATE_MISMATCH:
                    $data_error = 'Неверный или не корректный JSON';
                    break;
                case JSON_ERROR_CTRL_CHAR:
                    $data_error = 'Ошибка управляющего символа, возможно верная кодировка';
                    break;
                case JSON_ERROR_SYNTAX:
                    $data_error = 'Синтаксическая ошибка';
                    break;
                case JSON_ERROR_UTF8:
                    $data_error = 'Некорректные символы UTF-8, возможно неверная кодировка';
                    break;
                default:
                    $data_error = 'Неизвестная ошибка';
                    break;
            }

            // Если ошибки есть, то выводим их
            if ($data_error !='') echo $data_error;
        ?>

        <div class="container">
            <h1 class="title">Результаты спортивного соревнования</h1>
            <div class="table">
                <div class="table__header">
                    <div class="table__header-row">
                        <div class="table__header-place">Место</div>
                        <div>Фио</div>
                        <div>Город</div>
                        <div>Машина</div>
                        <div class="table__attempts">
                            <div>Попытки</div>
                            <div class="table__attempts-sort sort-btns">
                                <?
                                    // Отрисовываем количество столбцов попыток в хедере таблицы, в зависимости от определенного ранее $column_count
                                    for ($i = 1; $i < $column_count+1; $i++) {
                                        echo '<div class="sort-btn" data-sort-column="' . $i . '" style="width: ' . $width . '%;">' . $i . '</div>';
                                    };
                                ?>
                            </div>
                        </div>
                        <div class="table__summ sort-btns">
                            <div class="sort-btn" data-sort-column="0">Сумма</div>
                        </div>
                    </div>
                </div>
                <div class="table__body">
                        <?php
                        foreach($data_cars as $key_cars => $value_cars){
                            if(is_array($value_cars)){
                                echo '<div class="table__body-row" data-id="' . $data_cars[$key_cars]['id'] . '">';
                                    echo '<div class="table__place"></div>';

                                    foreach($value_cars as $key_car => $value_car){
                                        if ($key_car == 'id') continue;
                                        echo '<div>';
                                            echo $value_car;
                                        echo '</div>';
                                    }

                                    // Столбец с результатами каждой попытки
                                    echo '<div class="table__attempts">';
                                        echo '<div class="table__attempts-sort">';
                                            $summ = 0;
                                            $i = 1;
                                            foreach($data_attempts as $key_attempts => $value_attempts) {
                                                if(is_array($value_attempts)) {
                                                    foreach ($value_attempts as $key_attempt => $value_attempt) {
                                                        if ($key_attempt == 'id' && $value_attempt == $data_cars[$key_cars]['id']) {
                                                            echo '<div data-sort-column="' . $i . '" data-sort="' .  $value_attempts['result'] . '" style="width: ' . $width . '%">';
                                                            echo $value_attempts['result'];
                                                            echo '</div>';
                                                            $summ = $summ + $value_attempts['result'];
                                                            $i++;
                                                        };
                                                    };
                                                }
                                            }
                                        echo '</div>';
                                    echo '</div>';

                                    // сумма
                                    echo '<div class="table__summ" data-sort-column="0" data-sort="' .  $summ . '">';
                                        echo $summ;
                                    echo '</div>';
                                echo '</div>';
                            }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
<script src="/js/script.js"></script>
</body>
</html>

