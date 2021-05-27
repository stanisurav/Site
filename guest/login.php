<?
//------- Верхняя часть html страницы -------//
top_auth('Авторизация');

?>
  <!-- Авторизация -->
  <div class="container">
    <div class="parent-box">
      <div class="col-md-6 text-center login-box">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Авторизация</h1>
        </div>
          <div class="form-group">
            <input type="text" class="form-control" id="log" placeholder="Логин">
          </div>

          <div class="form-group">
            <input type="password" class="form-control" id="password" placeholder="Пароль">
          </div>

          <input type="button" class="button-login" value="Войти" onClick="Post_query('script_auth','login','log.password')">

          <div class="registration">
            <p>Нет учетной записи? <a href="register">Регистрация</a></p>
            <p>Забыли пароль? <a href="recovery">Восстановить пароль</a></p>
          </div>

      </div>
    </div>
  </div>
<?


//------- Нижняя часть html главной страницы -------//
bottom_auth();
