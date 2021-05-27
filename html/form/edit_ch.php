<div id="Modal_ch" class="Modal">
    <div class="Modal_top">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Редактирование</h1>
        </div>
    </div>

      <div class="form-group">
        <label for="surname">Фамилия</label>
        <input type="text" class="form-control" id="surname" placeholder="<?=$_SESSION['data_ch']['surname']?>">
      </div>

      <div class="form-group">
        <label for="name">Имя</label>
        <input type="text" class="form-control" id="name" placeholder="<?=$_SESSION['data_ch']['name']?>">
      </div>

      <div class="form-group">
        <label for="midname">Отчество</label>
        <input type="text" class="form-control" id="midname" placeholder="<?=$_SESSION['data_ch']['midname']?>">
      </div>

      <div class="form-group">
        <label for="age">Возраст</label>
        <input type="text" class="form-control" id="age" placeholder="<?=$_SESSION['data_ch']['age']?>">
      </div>

      <div class="form-group">
        <label for="city">Город</label>
        <input type="text" class="form-control" id="city" placeholder="<?=$_SESSION['data_ch']['city']?>">
      </div>

      <div class="form-group">
        <label for="contrain">Противопоказания</label>
        <input type="text" class="form-control" id="contrain" placeholder="<?=$_SESSION['data_ch']['contrain']?>">
      </div>

      <div class="form-group">
        <label for="target">Цель</label>
        <input type="text" class="form-control" id="target" placeholder="<?=$_SESSION['data_ch']['target']?>">
      </div>

      <input type="hidden" id="id" value="<?=$_SESSION['data_ch']['id']?>">
      <input type="hidden" id="type" value="edit">
      <input type="hidden" id="type_info" value="characters">


      <input type="button" class="button-login" value="Сохранить" onClick="Post_query('script_user','data','surname.name.midname.age.city.contrain.target.type.type_info.id')">
    <span id="Modal_close_ch" class="close Modal_close">x</span>
</div>
<div id="Overlay_ch" class="Overlay"></div>
