
<!-- <html>
    <head>
    <link rel="stylesheet" href="../Assets/css/login.css">
    </head>
    <body>
            <div class="app-login">
                <div class="center-screen">
                    <div class="app-login_container">
                        <div class="app-login_title"> <h1 id="title_login">Hệ Thống Thi Trắc Nghiệm </h1> </div>
                        <div class="app-login_form">
                            <form action="checkLogin" method="POST">
                                <div class="fix-layout">
                                    <table style="margin: 2%; border-spacing: 30px 10px;">
                                        <tr>
                                            <td><label class="text">Tên Tài Khoản</label></td>
                                            <td><input type="text" id = 'username' name="username"></td>

                                        </tr>
                                        <tr>
                                            <td><label class="text"> Mật Khẩu </label></td>
                                            <td><input type="password" id ='password' name="password"></td>

                                        </tr>
                                        
                                    </table>
                                </div>
                                <div style="display: flex; justify-content: center; "><button class="text" id="submit-login" name="submit"> Đăng Nhập</button></div>                            
                                <div > <p> ?></p></div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </body>
</html> -->

<html lang="en">

<head>
  <meta charset="utf-8" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../Assets/css/demo.css" rel="stylesheet"/>
  <!-- <link rel="stylesheet" href="../Assets/css/login.css"> -->
  <link rel="apple-touch-icon" sizes="76x76" href="../Assets/img/apple-icon.png">
  <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <link rel="icon" type="image/png" href="../Assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- CSS Files -->
  <link href="../Assets/css/material-dashboard/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <!-- datetime picker -->
  <link rel="stylesheet" href="../Assets/vendor/datetime/css/bootstrap-datetimepicker.min.css">
</head>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('../Assets/img/login-bg.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="checkLogin">
					<img class="login100-form-logo" src="../Assets/img/books.png" >

					<span class="login100-form-title p-b-34 p-t-27">
						Đăng nhập thí sinh
					</span>

					<div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control text-white" autocomplete="off" name="username">
                    </div>

					<div class="form-group">
           	            <label>Mật khẩu</label>
                        <input type="password" class="form-control text-white" name="password">
                    </div>
					<div class="form-group">
                        <button class="btn btn-primary btn-block" type="submit" name="submit">Đăng nhập</button>
                    </div>
				</form>
                <?php if(isset($data['failed'])){ echo $data['failed'];}?>
			</div>
		</div>
	</div>
</body>
</html>