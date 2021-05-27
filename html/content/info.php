<?

    if(isset($_SESSION['logged_client'])){

        $id_user=$_SESSION['logged_client']->id;

        //--- ВЫБОРКА ДАННЫХ ---//

        // characters
        $ch_client = R::getAll("SELECT * FROM characters WHERE id_user='$id_user'");
        // clients
        $m_client = R::getAll("SELECT * FROM clients WHERE id='$id_user'");


        //--- ОБРАБОТКА ДАННЫХ ---//

        // characters
        foreach ($ch_client as $rch){

          $_SESSION['data_ch'] = array(
            'surname' => $rch['surname'],
            'name' => $rch['name'],
            'midname' => $rch['midname'],
            'age' => $rch['age'],
            'city' => $rch['city'],
            'sex' => $rch['sex'],
            'contrain' => $rch['contrain'],
            'target' => $rch['target'],
            'id' => $rch['id'],
          );
        }

        // clients
        foreach ($m_client as $rm){

          $_SESSION['data_m'] = array(
            'id' => $rm['id'],
            'login' => $rm['login'],
            'email' => $rm['email'],
            'password' => $rm['password'],
            'date' => $rm['date'],
          );
        }




        //---= Подключение форм =---//
        form('edit_ch');
        form('edit_m');

?>
        <!--- ВЫВОД ДАННЫХ --->
        <div class="top_info"><h4><?echo $_SESSION['data_ch']['surname']." ".$_SESSION['data_ch']['name']." ".$_SESSION['data_ch']['midname'];?></h4></div>

        <div class="character_info">

            <div class="character_info_slice">
                Возраст: <?=$_SESSION['data_ch']['age']?>
            </div>

            <div class="character_info_slice">
                Город: <?=$_SESSION['data_ch']['city']?>
            </div>

            <div class="character_info_slice">
              Пол: <?=$_SESSION['data_ch']['sex']?>
            </div>

            <div class="character_info_slice">
              Противопоказания: <?=$_SESSION['data_ch']['contrain']?>
            </div>

            <div class="character_info_slice">
              Цель: <?=$_SESSION['data_ch']['target']?>
            </div>

          </div>
            <button class="but_popap" id="but_popap_ch">Редактировать</button>
            <hr>

        <div class="main_info">
            <div class="main_info_slice">
              Email: <?=$_SESSION['data_m']['email']?>
            </div>

            <div class="main_info_slice">
              Логин: <?=$_SESSION['data_m']['login']?>
            </div>

            <div class="main_info_slice">
              Дата регистрации: <?=$_SESSION['data_m']['date']?>
            </div>
          </div>
            <!-- <button class="but_popap" id="but_popap_m">Редактировать</button> -->
            <hr>


<?
    }
