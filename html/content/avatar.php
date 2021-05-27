ф<?
// Подключение основной сессии
$client=$_SESSION['logged_client'];


// Выборка данных по аватару
$q_avatar = R::getAll("SELECT * FROM clients WHERE id='$client->id'");


// Обработка данных
foreach ($q_avatar as $r_avatar){

    $avatar=$r_avatar['avatar'];
}

// Проверка на наличие аватарки
if(!$avatar or $avatar==''){

    $avatar="assets/img/default.jpg";
}
?>

    <!-- Форма для загрузки фотографии -->
    <div id="myModal" class="Modal">
        <div id="myModal_top" class='Modal_top'>

            <span>Загрузка новой фотографии</span>
        </div>
        <!-- Контент -->
        <b>Друзьям проще вас узнать, если вы загрузите настоящую фотографию. Вы можете загрузить изображение в формате
      png, jpg, jpeg</b>

        <!-- Выбор аватарки -->
        <div id="butUpload" class='butUpload'>Выберите файл</div>
        <div id="filesUpload"></div>

        <!-- Футер -->
        <hr> &nbsp;&nbsp;&nbsp;&nbsp;Если у вас проблеммы с загрузкой, то вы можете выбрать файл наименьшего размера.
        <span id="myModal__close" class="close Modal_close">x</span>
    </div>
    <div id="myOverlay" class="Overlay"></div>

    <!-- Контейнер аватарки -->
    <div id="photo" class="photo">

        <img width="200" height="260" src="<?=$avatar?>">
        <button class="myLinkModal">Загрузить фото</button>
    </div>
