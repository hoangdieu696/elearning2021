<?php if(!defined('__CONTROLLER__')) return; ?>
<?php getTemplate("header", $viewParams); ?>

<body>
  <!-- Page Wrapper -->
  <div class="wrapper">
    <?php getTemplate("sidebar", $viewParams); ?>
    <!-- Content Wrapper -->
    <div class="main-panel">
      <!-- Navbar/topbar -->
      <?php getTemplate("topbar", $viewParams); ?>
      <!-- Begin Page Content -->
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Tạo tài khoản</h4>
                  <p class="card-category">* Đây là form thêm tài khoản thí sinh thi</p>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Tên hiển thị</label>
                          <input type="text" class="form-control" name="fullname">
                          <div class="text-danger font-italic">
                            <small><?php echo(isset($errors['fullname']))? $errors['fullname']:''?></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Email</label>
                          <input type="email" class="form-control" name="email">
                          <div class="text-danger font-italic">
                            <small><?php echo(isset($errors['email']))? $errors['email']:''?></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mật khẩu</label>
                          <input type="text" disable="true" class="form-control" id="show-pass" name="password">
                          <div class="text-danger font-italic">
                            <small><?php echo(isset($errors['password']))? $errors['password']:''?></small>
                          </div>
                        </div>
                        <!-- An element to toggle between password visibility -->
                        <input type="checkbox" onclick="checkPassword()"> <small class="text-success font-italic">Kiểm tra mật khẩu</small>
                      </div>
                    </div>
                     <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Số điện thoại</label>
                          <input type="phone" class="form-control" name="phone">
                          <div class="text-danger font-italic">
                            <small><?php echo(isset($errors['phone']))? $errors['phone']:''?></small>
                          </div>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary pull-right" name="addUserBtn">Lưu</button>
                    <div class="clearfix"></div>
                  </form>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-profile">
                <div class="card-avatar">
                  <a href="javascript:;">
                    <img class="img" src="assets/images/faces/marc.jpg" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category text-gray">dieuhoang@gmail.com</h6>
                  <h4 class="card-title">Dori Hoang</h4>
                  <p class="card-description">
                    Rank: 5
                  </p>
                  <p class="card-description">
                    Total Score: 100
                  </p>
                  <a href="./dashboard.html" class="btn btn-primary btn-round">Ranking</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- End Page content -->
      <!-- footer -->
      <?php getTemplate("footer", $viewParams) ?>
    </div>
  </div>
  <!-- setting -->
  <?php getTemplate("setting", $viewParams);?>
  <!-- End of Main Content -->

  <!-- script -->
   <?php getTemplate("end", $viewParams);?>
