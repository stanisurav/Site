<?

if(empty($_SESSION['confirm']['code']))not_found();

//------- Верхняя часть html страницы -------//
top_auth("Подтверждение");

?>
<!--  -->
<!-- Авторизация -->
<div class="container">
    <div class="parent-box">
      <div class="col-md-6 text-center login-box">
        <div class="col login-head">
          <!-- <img src="./img/grtech.png" alt=""> -->
          <h1>Подтверждение</h1>
        </div>
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Код" id="code"/>
          </div>

          <input type="button" class="button-login" value="Подтвердить" onClick="Post_query('script_auth','confirm','code')">
          <div class="registration">
            <p><a href="login">Вернуться назад</a></p>
          </div>
      </div>
    </div>
  </div>

<?

//------- Нижняя часть html главной страницы -------//
bottom_auth();
