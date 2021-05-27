<?

// Подключение базы данных
  include "db.php";

// Подключаем библиотеки PHPMailer
  include "libs/mailer/src/Exception.php";
  include "libs/mailer/src/PHPMailer.php";ё
  include "libs/mailer/src/SMTP.php";

// Запуск сессии
session_start();

// Обработка пути
if ($_SERVER["REQUEST_URI"]=='/'){

    $page = 'main';

}else {

    $page= substr($_SERVER["REQUEST_URI"], 1);

    if( !preg_match('/^[A-z0-9]{3,15}$/', $page)) not_found();

}

//---------- Дополнительные функции ----------//
function redirtext($url,$text){
    exit('{"redir" : "'.$url.'","text" : "'.$text.'"}');
}
// Фунция сообщения
function message($text){
    exit('{"message" : "'.$text.'"}');
}
// Функция переадресации
function redirect($url){
    exit('{"redirect" : "'.$url.'"}');
}
// Функция генерации рандомного кода для подтверждения почты
function random_code($num=30){
    return substr(str_shuffle('012345679abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),0,$num);
}
// Функция NOT FOUND
function not_found(){
    exit ("Страница 404");
}
// Функция присваивание роли
function role_assign(){
  //Пользователь
    if(isset($_SESSION['logged_client'])){return $role='clients';}
  //Администратор
   elseif(isset($_SESSION['logged_admin'])){return $role='admins';}
  //Тренер
   else{return $role='coachs';}
}
//---------- Дополнительные функции ----------//




//---------- Функции проверки ----------//
function login_valid_entry(){
    if(empty($_POST['log']))
        message('Введите логин');

    if(!R::count('uservalid', 'login=?', array($_POST['log']))>0)
        message('Пользователь с таким логином не найден');
}

function password_valid_entry(){
    if(empty($_POST['password']))
        message('Логин или пароль введён неверно');
}

function login_valid(){
    if(empty($_POST['log']))
        message('Введите логин');

    if(strlen($_POST['log'])<2 OR strlen($_POST['log'])>30)
        message('Длина логина может составлять от 3 до 30 символов');

    if(R::count('uservalid', 'login=?', array($_POST['log']))>0)
        message('Пользователь с таким логином уже существует');
}

function email_valid(){
    if(empty($_POST['email']))
        message('Введите email');

    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        message('Указан некорректный E-mail');

    if(R::count('uservalid', 'email=?', array($_POST['email']))>0)
        message('Пользователь с такой почтой уже существует');
}

function password_valid(){
    if(empty($_POST['password']))
        message('Введите пароль');

    if( strlen($_POST['password'])<7 OR strlen($_POST['password'])>100)
      message('Пароль указан неверно. Он должен содержать минимум 8 символов');

    if($_POST['password']!=$_POST['password_conf'])
      message('Пароли не совпадают');

      $_POST['password']= password_hash($_POST['password'], PASSWORD_DEFAULT);
}

function email_valid_recovery(){
    if(empty($_POST['email']))
        message('Введите email');

    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
        message('Указан некорректный E-mail');
}

function data_valid(){
    if(!R::count('characters', 'id_user=?', array($_SESSION['logged_client']->id))>0)
        include "html/form/oblig.php";
}

function data_entry_valid(){
    if(empty($_POST['surname']))
        message('Введите вашу Фамилию');

    if(empty($_POST['name']))
        message('Введите ваше Имя');

    if(empty($_POST['midname']))
        message('Введите своё Отчество');

    if(empty($_POST['sex']))
        message('Выберите пол');

    if(empty($_POST['age']))
        message('Введите ваш возвраст');

    if(empty($_POST['city']))
        message('Введите ваше место проживания');

    if(empty($_POST['contrain']))
        message("Введите ваши противопоказания. Если их нет, то введите ''Нет''");

    if(empty($_POST['target']))
        message('Введите вашу цель занятия спортом');

}

function data_edit_valid(){
    if(empty($_POST['surname']))
        $_POST['surname'] = $_SESSION['data_ch']['surname'];

    if(empty($_POST['name']))
        $_POST['name'] = $_SESSION['data_ch']['name'];

    if(empty($_POST['midname']))
        $_POST['midname'] = $_SESSION['data_ch']['midname'];

    if(empty($_POST['age']))
        $_POST['age'] = $_SESSION['data_ch']['age'];

    if(empty($_POST['city']))
        $_POST['city'] = $_SESSION['data_ch']['city'];

    if(empty($_POST['contrain']))
        $_POST['contrain'] = $_SESSION['data_ch']['contrain'];

    if(empty($_POST['target']))
        $_POST['target'] = $_SESSION['data_ch']['target'];

    if(empty($_POST['login'])){
        $_POST['login'] = $_SESSION['data_m']['login'];
    }else {

        if(strlen($_POST['login'])<2 OR strlen($_POST['login'])>30)
            message('Длина логина может составлять от 3 до 30 символов');

        if($_POST['login'] == $_SESSION['data_m']['login'])
            message('У вас уже стоит этот логин');

        if(R::count('uservalid', 'login=?', array($_POST['login']))>0)
            message('Пользователь с таким логином уже существует');
    }

    if(empty($_POST['email'])){
        $_POST['email'] = $_SESSION['data_m']['email'];
      }else {

          if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))
              message('Указан некорректный E-mail');

          if($_POST['email'] == $_SESSION['data_m']['email'])
              message('У вас уже стоит эта почта');

          if(R::count('uservalid', 'email=?', array($_POST['email']))>0)
              message('Пользователь с такой почтой уже существует');
      }

}
//---------- Функции проверки ----------//




//---------- Проверка на существование страницы  ----------//
// Основные страницы
if ( file_exists("all/$page.php")){include "all/$page.php";}
else if ( $_SESSION['logged']==true AND file_exists("user/$page.php")){include "user/$page.php";}
else if ( $_SESSION['logged']==false AND file_exists("guest/$page.php")){include "guest/$page.php";}

// Скрипты
else if ( file_exists("app/$page.php")){include "app/$page.php";}

// Страница не найдена
else not_found();
//---------- Проверка на существование страницы  ----------//




//---------- Функции для верхней и нижней части страницы  ----------//
// Верхняя часть страницы
function top_main($title){include "html/top/top_main.php";}
function top_auth($title){include "html/top/top_auth.php";}
function top_client($title){include "html/top/top_client.php";}

// Нижняя часть страницы
function bottom_main(){include "html/bottom/bottom_main.php";}
function bottom_auth(){include "html/bottom/bottom_auth.php";}
function bottom_client(){include "html/bottom/bottom_client.php";}
//---------- Функции для верхней и нижней части страницы  ----------//





//---------- Функции для шапки  ----------//

function head(){

    //Пользователь
      if(isset($_SESSION['logged_client'])){include "html/head/head_client.php";}

    //Администратор
     elseif(isset($admin)){include "html/head/head_admin.php";}

    //Тренер
     elseif(isset($coach)){include "html/head/head_coach.php";}

    //Гость
     else include "html/head/head_guest.php";


}
//---------- Функции для шапки  ----------//






//---------- Функции для подключения контента  ----------//

function content($title){

    if($title=='avatar'){include "html/content/avatar.php";}
    else if($title=='info'){include "html/content/info.php";}
}

//---------- Функции для подключения контента  ----------//





//---------- Функции для подключения форм  ----------//

function form($title){

    if($title=='edit_ch'){include "html/form/edit_ch.php";}
    else if($title=='edit_m'){include "html/form/edit_m.php";}
}

//---------- Функции для подключения форм  ----------//
