
<div id="myModalObl" class="Modal">
    <div class="Modal_top">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Введите ваши данные</h1>
        </div>
    </div>

      <div class="form-group">
        <input type="text" class="form-control" id="surname" placeholder="Фамилия">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="name" placeholder="Имя">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="midname" placeholder="Отчество">
      </div>


      <div class="form-group">
        <strong style="color:blue">&#9794; </strong> <input type="radio" id="sex" value="Мужской" style="margin-right:10%" checked="checked">
        <strong style="color:pink">&#9792; </strong> <input type="radio" id="sex" value="Женский" >
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="age" placeholder="Возраст">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="city" placeholder="Город">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="contrain" placeholder="Противопоказания к занятиям?">
      </div>

      <div class="form-group">
        <input type="text" class="form-control" id="target" placeholder="Цель занятия спортом">
      </div>

      <input type="hidden" id="type" value="new">
      <input type="hidden" id="id_user" value="<?=$_SESSION['logged_client']->id?>">

      <input type="button" class="button-login" value="Сохранить" onClick="Post_query('script_user','data','surname.name.midname.sex.age.city.contrain.target.type.id_user')">

    <!-- Футер -->
    <hr> &nbsp;&nbsp;&nbsp;&nbsp; Это обязательное условие!
</div>
<div id="myOverlayObl" class="Overlay"></div>
