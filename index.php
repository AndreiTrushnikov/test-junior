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

            <div class="table">
                <div class="table__header">
                    <div class="table__header-row">
                        <div>id</div>
                        <div>Фио</div>
                        <div>Город</div>
                        <div>Машина</div>
                        <div class="table__attempts">
                            <div>Попытки</div>
                            <div class="table__attempts-sort">
                                <span>1</span>
                                <span>2</span>
                                <span>3</span>
                                <span>4</span>
                            </div>
                        </div>
                        <div>Сумма</div>
                    </div>
                </div>
                <div class="table__body">
                        <?php foreach($data_cars as $key_cars => $value_cars){
                            if(is_array($value_cars)){
                                echo '<div class="table__body-row" data-id="'; echo $data_cars[$key_cars]['id']; echo '">';
                                // print($data_cars[$key_cars]['id']);
                                foreach($value_cars as $key_car => $value_car){
                                    // if ($key2 == 'id') continue;
                                    echo '<div>';
                                    echo $value_car;
                                    echo '</div>';
                                }

                                foreach($data_attempts as $key_attempts => $value_attempts) {
                                    if(is_array($value_attempts)) {
                                        foreach ($value_attempts as $key_attempt => $value_attempt) {
                                            // print($key_attempt);
                                            // print($value_attempt);
                                            // echo '</br>';
                                            // print_r($key_attempt);
                                            // print($value_attempt);
                                            // print($value_attempts[$key_attempt]);
                                            if ($key_attempt == 'id' && $value_attempt == $data_cars[$key_cars]['id']) {
                                                echo '<div>';
                                                echo $value_attempt;
                                                echo '</div>';
                                            }
                                        }
                                    }
                                }
                                echo '</div>';
                            }
                        } ?>
                        <!-- <div class="table__attempts">
                            <div class="table__attempts-sort">
                                <span>15</span>
                                <span>65</span>
                                <span>1</span>
                                <span>5</span>
                            </div>
                        </div>
                        <div>Сумма</div> -->
                    </div>
                    <!-- <div class="table__body-row">
                        <div>Карл</div>
                        <div>Нью-Йорк</div>
                        <div>Boston</div>
                        <div class="table__attempts">
                            <div class="table__attempts-sort">
                                <span>135</span>
                                <span>635</span>
                                <span>14</span>
                                <span>54</span>
                            </div>
                        </div>
                        <div>Сумма</div>
                    </div>
                    <div class="table__body-row">
                        <div>Вика</div>
                        <div>Москва</div>
                        <div>Ford</div>
                        <div class="table__attempts">
                            <div class="table__attempts-sort">
                                <span>55</span>
                                <span>65</span>
                                <span>18</span>
                                <span>7</span>
                            </div>
                        </div>
                        <div>Сумма</div>
                    </div> -->
                </div>
            </div>


    </main>
</body>
</html>

