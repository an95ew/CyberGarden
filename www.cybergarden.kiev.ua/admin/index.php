<?php
session_start();
include __DIR__.'/include/db.php'; 
?>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="ajax.js" charset="utf-8"></script>
  <META charset="utf-8">
  <title> Админка </title>
  <link rel="stylesheet" href="/css/style.css">
</head>

  <body>
    <div class="container-fluid" id="navigation">
      <div class="row" id="login_bar">

        <div class="col-3" align="left" style="color: white;" >
          <a href="/admin/logout.php">Выйти</a>
        </div>

        <div class="col-6" align="center" style="color: white;" >
          Welcome back, commander
        </div>

        <div class="col-3" align="center" style="color: red;" >
        </div>

      </div>

     <div class="container-fluid" id="navigation">
			<nav class="navbar navbar-expand-lg">
			  <a class="navbar-brand" href="../index.php">
				<img id="site_logo" src="img/logo.png" width="100%" height="100%">
			  </a>
			  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			  </button>
			  <div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
				  <li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#">Features</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" href="#footer">Footer</a>
				  </li>
				</ul>
				<span class="navbar-item">
					<img class="img-top" src="img/clock.jpg" style="width:60px; height:60px" alt="Card image cap">
					<span id="clockDate">
						Countig...
					</span>	
					<span class="badge badge-secondary" id="clockTime">
						Countig...
					</span>			
					<script>
					var today = new Date();
					var dd = today.getDate();
					var mm = today.getMonth()+1; //January is 0!
					var yyyy = today.getFullYear();
					if(dd<10) {
					  dd='0'+dd
					} 

					if(mm<10) {
					  mm='0'+mm
					} 

					today = mm+'/'+dd+'/'+yyyy;
					document.getElementById("clockTime").innerHTML = today;
					var myVar=setInterval(function(){myTimer()},1000);

					function myTimer() {
						var d = new Date();
						document.getElementById("clockDate").innerHTML = d.toLocaleTimeString();
					}
					</script> 
				</span>
			  </div>
			</nav>
    </div>

    <div class="container-fluid" id="content" style="min-height: 100%;">
      <div class="row">
        <div class="col-2" id="left_col">

          <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" style="width: 100%; float: center;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Управление
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="add_article.php">Добавить новость</a>
              <a class="dropdown-item" href="edit_article.php">Редактировать новость</a>
              <a class="dropdown-item" href="delete_article.php">Удалить новость</a>
            </div>
          </div>
          <br/>
          <div class="dropdown">
            <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" style="width: 100%; float: center;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Управление аккаунтом
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="account_change.php">
                Изменить данные
              </a>
            </div>
          </div>

       </div>
        <div class="col-8" id="middle_col">
        <div id="content_user">
          <?php
          while ($row = mysql_fetch_array($result))
          {?>
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-4">
                    <img class="card-img" src="/img/logo.png" style="width:100%; height:auto;" alt="Card image cap">
                  </div>
                  <div class="col-8">
                    <p id="news_name" ><?php echo $row ['title']; ?></p>
                    <p id="date_time" ><?php echo $row ['time']." ("; echo $row['date'].") <br><br>"; ?></p>
                    <p class="card-text blog_text_short"><?php echo $row['description']; ?></p>
                    <button class="btn btn-primary" onclick="getData(<?php echo $row['id']; ?>)">Read</button>
                  </div>
                </div>
              </div>
            </div>
          <hr />
        <?php } ?>
      </div>
      </div>
        <div class="col-2" id="right_col">
        </div>
      </div>

    </div>

    <div class="footer"> </div>

  </body>
</html>
