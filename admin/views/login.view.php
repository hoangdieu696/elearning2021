<?php if(!defined('__CONTROLLER__')) return; ?>
<?php 
getTemplate("header", $viewParams); ?>
<body>
	<div class="limiter">
		<div class="container-login100" style="background-image: url('assets/images/login-bg.jpg');">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="?action=loginAct">
					<img class="login100-form-logo" src="assets/images/books.png" >

					<span class="login100-form-title p-b-34 p-t-27">
						Đăng nhập Admin
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
                        <button class="btn btn-primary btn-block" type="submit" name="loginBtn">Đăng nhập</button>
                    </div>
				</form>
			</div>
		</div>
	</div>
</body>
</html>