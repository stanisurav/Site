<div id="Modal_m" class="Modal">
    <div class="Modal_top">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Редактирование</h1>
        </div>
    </div>

      <div class="form-group">
        <label for="surname">Логин</label>
        <input type="text" class="form-control" id="login" placeholder="<?=$_SESSION['data_m']['login']?>">
      </div>

      <div class="form-group">
        <label for="name">Почта</label>
        <input type="text" class="form-control" id="email" placeholder="<?=$_SESSION['data_m']['email']?>">
      </div>

      <input type="hidden" id="id" value="<?=$_SESSION['data_m']['id']?>">

      <input type="button" class="button-login" value="Сохранить" onClick="Post_query('script_user','data','login.email.type.type_info.id')">
    <span id="Modal_close_m" class="close Modal_close">x</span>
</div>
<div id="Overlay_m" class="Overlay"></div>
