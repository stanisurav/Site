
<?
//------- Верхняя часть html страницы -------//
top_auth("Восстановление аккаунта");

    ?>
<!--  -->
<!-- Авторизация -->
<div class="container">
    <div class="parent-box">
      <div class="col-md-6 text-center login-box">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Восстановление аккаунта</h1>
        </div>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" id="email"/>
          </div>

          <div class="form-group">
          <input  type="password" class="form-control" placeholder="Пароль" id="password" />
          </div>

          <div class="form-group">
            <input type="password" class="form-control" placeholder="Подтвердите пароль" id="password_conf"/>
          </div>

          <input type="button" class="button-login" value="Восстановить" onClick="Post_query('script_auth','recovery','email.password.password_conf')">
          <div class="registration">
            <p><a href="login">Вернуться назад</a></p>
          </div>
      </div>
    </div>
  </div>

<?

//------- Нижняя часть html главной страницы -------//
bottom_auth();
