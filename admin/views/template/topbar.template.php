<!-- Navbar --> 
      <nav class="navbar navbar-expand-lg logo navbar-absolute fixed-top ">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand text-uppercase text-weight-bold" href="javascript:;">Danh sách</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <ul class="navbar-nav">
              <li class="nav-item dropdown">
                <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="mr-2 d-none d-lg-inline text-gray-600"><?php echo $viewParams['fullname']; ?></span>
                  <img class="img-profile rounded-circle" src="assets/images/login-bg.jpg">
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#infoModal" onclick="loadInfo();">
                    <i class="fa fa-user fa-sm fa-fw mr-2 text-gray-400"></i>Thông tin tài khoản</a>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#changePassModal">
                    <i class="fa fa-lock fa-sm fa-fw mr-2 text-gray-400"></i>Thay đổi mật khẩu</a>
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item text-center" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>Đăng xuất</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Logout modal -->
      <?php getModal("logout")?>
      <!-- Info modal -->
              <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Thông tin tài khoản</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body" id="infoModalBody">
                      chưa cập nhật
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                      <button class="btn btn-primary" onclick="updateInfo(this)">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Change Password Modal-->
              <div class="modal fade" id="changePassModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <form method="post" action="?action=changePassAct">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Thay đổi mật khẩu</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="form-group">
                          <label>Mật khẩu cũ</label>
                            <input type="password" class="form-control" name="old_pass" required>
                        </div>
                        <div class="form-group">
                          <label>Mật khẩu mới</label>
                            <input type="password" class="form-control"  name="new_pass" required>

                        </div>
                        <div class="form-group">
                          <label>Nhập lại mật khẩu</label>
                            <input type="password" class="form-control" name="new_pass2" required>
                        </div>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                        <button class="btn btn-primary" name="changePassBtn">Lưu</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
      <!-- End Navbar