<?
// Различные сессии
$client=$_SESSION['logged_client'];

// Проверка на статус пользователя
if (isset($client)) {
    // Присвоение значений пользователя переменным
    $id=$client->id;
    $name_table='clients';
}elseif(isset($coach)) {

    // Присвоение значений пользователя переменным
    $id=$coach->id;
    $name_table='coachs';
}

// При загрузке изображения
if(isset($_POST['file'])){

    // Переменная пути аватарки
    $uploadDir="assets/img/";

    // Разрешение, которые можно загружать
    $types=array("image/png","image/jpeg","image/pjpeg", "image/p-png");

    // Максимальный размер
    $size=5242880;

    // Название загруженного изображения
    $file=$_FILES['clientfile']['name'];

    // Разрешение загруженного изображения
    $extension = pathinfo($file, PATHINFO_EXTENSION);

    // Присваивание нового уникального названия для изображения
    $new_name=uniqid().'.'.$extension;

    // Массив для вывода ошибок
    $res=array();

    // Проверка на различные ошибки
    if(!isset($file)){

        message("Ошибка! Возможно файл слишком большой");
    }

    if($_FILES['clientfile']['size'] > $size OR $_FILES['clientfile']['size']==0){

        message("Ошибка! максимальный вес 5 мб");
    }

    if(!in_array($_FILES['clientfile']['type'],$types)){

        message("Ошибка! Допустимые расширение- .gif, .png, .jpg");
    }

    // При успешной загрузки изображения
    if(move_uploaded_file($_FILES['clientfile']['tmp_name'],$uploadDir.$new_name)){

        // Обновление данных
        $q=R::exec("UPDATE $name_table SET avatar='assets/img/$new_name' WHERE id='$id'");

        message("Фотография успешно загружена");

    }else{

        message("Ошибка загрузки");
    }
}

?>
