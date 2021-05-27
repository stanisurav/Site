<?

//-------------= ВХОД =------------//
if(isset($_POST['login_f'])){
    login_valid_entry();
    password_valid_entry();

    //--- ВЫБОРКА ДАННЫХ ---//
      $logged_client=R::findOne('clients', 'login=?', array($_POST['log']));
    //--- ВЫБОРКА ДАННЫХ ---//

    if(!password_verify($_POST['password'], $logged_client->password))
        message("Логин или пароль введён неверно");

    $_SESSION['logged']=true;
    $_SESSION['logged_client']=$logged_client;

    redirect('profile');
}
//-------------= ВХОД =------------//





//-------------= Регистрация =------------//
if(isset($_POST['register_f'])){
    login_valid();
    email_valid();
    password_valid();

    $code = random_code(6);

    $_SESSION['confirm'] = array(
        'type' => 'register',
        'login'=> $_POST['log'],
        'email'=> $_POST['email'],
        'password'=> $_POST['password'],
        'code' => $code,
    );

      // Создаем письмо
      $mail = new PHPMailer\PHPMailer\PHPMailer();
      $mail->isSMTP();                                    // Отправка через SMTP
      $mail->CharSet = "UTF-8";                           // Кодировка сообщения UTF-8
      $mail->Host   = 'smtp.mail.ru';                     // Адрес SMTP сервера
      $mail->SMTPAuth   = true;                           // Enable SMTP authentication
      $mail->Username   = 'fitness-size';                 // ваше имя пользователя (без домена и @)
      $mail->Password   = '21GashnikOFF';                 // ваш пароль
      $mail->SMTPSecure = 'ssl';                          // шифрование ssl
      $mail->Port   = 465;                                // порт подключения


      $mail->setFrom('fitness-size@mail.ru','Сайт: Fitness-Size');      // от кого (email и имя)
      $mail->addAddress($_SESSION['confirm']['email'], $_SESSION['confirm']['login']);          // кому (email и имя)

      $mail->Subject = 'Активация аккаунта на сайте Fitness-Size';          // Тема сообщения

      // Сообщение
      $mail->msgHTML("<html><body>Здравствуйте, спасибо за регистрацию на сайте Fitness-Size <br>
                      Ваш E-mail ".$_SESSION['confirm']['email']." <br>
                      Для того чтобы ввойти в свой аккаунт, его нужно активировать. <br>
                      Ваш код подтверждения для активации: <br>
                      ".$_SESSION['confirm']['code']." <br> <br>
                      С уважением, <br> <br>
                      Администрация сайта Fitness-size.ru </html></body>");

      // Отправка сообщения
      if ($mail->send()) {
          // Переадресация на страницу confirm с сообщением
          redirtext('confirm','На вашу почту пришло письмо с кодом подтверждения');


      // В случае ошибки с правильностью почты
      } else {
          // Сообщение об ошибке
          message("Ошибка: проверьте правильность почты");
      }

}
//-------------= Регистрация =------------//





//-------------= Восстановление пароля =------------//
if(isset($_POST['recovery_f'])){

    email_valid_recovery();
    password_valid();

    if(!R::count('uservalid', 'email=?', array($_POST['email']))>0)
        message('Аккаунт с такой почтой не найден');

    //--- ВЫБОРКА ДАННЫХ ---//
    $q_id = R::getAll("SELECT id FROM clients WHERE email='$_POST[email]'");
    // Обработка данных
    foreach ($q_id as $r_id){

        $id=$r_id['id'];
    }
    //--- ВЫБОРКА ДАННЫХ ---//


    $code = random_code(6);

    $_SESSION['confirm']= array(
        'type' => 'recovery',
        'id'=> $id,
        'email'=> $_POST['email'],
        'password'=> $_POST['password'],
        'code' => $code,
    );

    // Создаем письмо
    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->isSMTP();                                    // Отправка через SMTP
    $mail->CharSet = "UTF-8";                           // Кодировка сообщения UTF-8
    $mail->Host   = 'smtp.mail.ru';                     // Адрес SMTP сервера
    $mail->SMTPAuth   = true;                           // Enable SMTP authentication
    $mail->Username   = 'fitness-size';                 // ваше имя пользователя (без домена и @)
    $mail->Password   = '21GashnikOFF';                 // ваш пароль
    $mail->SMTPSecure = 'ssl';                          // шифрование ssl
    $mail->Port   = 465;                                // порт подключения


    $mail->setFrom('fitness-size@mail.ru','Сайт: Fitness-Size');      // от кого (email и имя)
    $mail->addAddress($_SESSION['confirm']['email'], $_SESSION['confirm']['login']);          // кому (email и имя)

    $mail->Subject = 'Восстановление пароля на сайте Fitness-Size';          // Тема сообщения

    // Сообщение
    $mail->msgHTML("<html><body>Здравствуйте! <br>
                    Спасибо, что пользуетесь нашим сайтом Fitness-Size <br>
                    Ваш E-mail ".$_SESSION['confirm']['email']." <br>
                    Для того чтобы изменить пароль, нужно подтвердить, что это ваш аккаунт. <br>
                    Ваш код подтверждения для активации: <br>
                    ".$_SESSION['confirm']['code']." <br> <br>
                    С уважением, <br> <br>
                    Администрация сайта Fitness-size.ru </html></body>");

    // Отправка сообщения
    if ($mail->send()) {
        // Переадресация на страницу confirm с сообщением
        redirtext('confirm','На вашу почту пришло письмо с кодом подтверждения');

    // В случае ошибки с правильностью почты
    } else {
        // Сообщение об ошибке
        message("Ошибка: проверьте правильность почты");
    }
}
//-------------= Восстановление пароля =------------//





//-------------= Подтверждение =------------//
if(isset($_POST['confirm_f'])){

    if($_SESSION['confirm']['type']=='register'){

        if ($_SESSION['confirm']['code'] != $_POST['code'])
            message('Код подтверждения регистрации указан неверно');

            // Дата, IP, Активация = 0
            $date=date("d.m.y");
            $ip=$_SERVER['REMOTE_ADDR'];
            $activmetrs='0';

            // Таблица clients
              $client= R::dispense('clients');
              $client->login=$_SESSION['confirm']['login'];
              $client->email=$_SESSION['confirm']['email'];
              $client->password=$_SESSION['confirm']['password'];
              $client->date=$date;
              $client->avatar='';
              $client->ip=$ip;
              $client->activmetrs=$activmetrs;
              R::store($client);

            // Таблица uservalid
              $user_valid= R::dispense('uservalid');
              $user_valid->login=$_SESSION['confirm']['login'];
              $user_valid->email=$_SESSION['confirm']['email'];
              R::store($user_valid);

    // Обнуление сессии для подтверждения регистрации
    unset($_SESSION['confirm']);

    // Переадресация на страницу login c сообщением
    redirtext('login','Вы успешно прошли регистрацию');
    }


    else if($_SESSION['confirm']['type']=='recovery'){

          if ($_SESSION['confirm']['code'] != $_POST['code'])
              message('Код подтверждения восстановления указан неверно');

          // Изменение пароля
          $client = R::load('clients', $_SESSION['confirm']['id']);
          $client->password = $_SESSION['confirm']['password'];
          R::store($client);

          // Обнуление сессии для подтверждения регистрации
          unset($_SESSION['confirm']);

          redirtext('login','Ваш пароль успешно изменён');
    }
    else not_found();
}
//-------------= Подтверждение =------------//
