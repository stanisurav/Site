<?

//-------------= Добавление данных =------------//
if(isset($_POST['data_f'])){

      // При добавлении новых данных
      if ($_POST['type']=='new'){
        data_entry_valid();

        $_SESSION['new_data'] = array(
          'surname' => $_POST['surname'],
          'name' => $_POST['name'],
          'midname' => $_POST['midname'],
          'sex' => $_POST['sex'],
          'age' => $_POST['age'],
          'city' => $_POST['city'],
          'contrain' => $_POST['contrain'],
          'target' => $_POST['target'],
          'id_user' => $_POST['id_user'],
        );

        // Таблица characters
          $character= R::dispense('characters');
          $character->surname=$_SESSION['new_data']['surname'];
          $character->name=$_SESSION['new_data']['name'];
          $character->midname=$_SESSION['new_data']['midname'];
          $character->sex=$_SESSION['new_data']['sex'];
          $character->age=$_SESSION['new_data']['age'];
          $character->city=$_SESSION['new_data']['city'];
          $character->contrain=$_SESSION['new_data']['contrain'];
          $character->target=$_SESSION['new_data']['target'];
          $character->id_user=$_SESSION['new_data']['id_user'];
          R::store($character);

          // Обнуление сессии для подтверждения регистрации
          unset($_SESSION['new_data']);

          // Переадресация на страницу profile c сообщением
          redirtext('profile','Вы успешно добавили данные');

    // При изменении данных
  }else if($_POST['type']=='edit'){

        // Для характеристик
        if($_POST['type_info'] == 'characters'){

            data_edit_valid();

            $_SESSION['edit_data'] = array(
              'surname' => $_POST['surname'],
              'name' => $_POST['name'],
              'midname' => $_POST['midname'],
              'age' => $_POST['age'],
              'city' => $_POST['city'],
              'contrain' => $_POST['contrain'],
              'target' => $_POST['target'],
              'id' => $_POST['id'],
            );

            // Изменение пароля
            $character = R::load('characters', $_SESSION['edit_data']['id']);
            $character->surname = $_SESSION['edit_data']['surname'];
            $character->name = $_SESSION['edit_data']['name'];
            $character->midname = $_SESSION['edit_data']['midname'];
            $character->age = $_SESSION['edit_data']['age'];
            $character->city = $_SESSION['edit_data']['city'];
            $character->contrain = $_SESSION['edit_data']['contrain'];
            $character->target = $_SESSION['edit_data']['target'];
            R::store($character);

            // Обнуление сессии для подтверждения регистрации
            unset($_SESSION['edit_data']);

            redirtext('profile','Ваши данные успешно изменены');

        // Для основной информации
        }else if($_POST['type_info'] == 'mains'){

            message("Кря");

        }
    }
}
