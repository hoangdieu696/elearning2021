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
            <div class="col-md-6">
              <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Tìm kiếm...">
                <button type="submit" class="btn btn-white btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-primary">
                  <!-- <h3 class="card-title ">Danh sách đợt thi main</h3> -->
                  <button class="btn btn-secondary font-weight-bold" data-toggle="modal" data-target="#newAdminModal" >Thêm tài khoản</button>
                  <small class="card-category font-italic">* Đây là chức năng thêm tài khoản Admin</small>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-bordered table-hover">
                    <table class="table">
                      <thead class="text-dark text-center">
                        <th class=" font-weight-bold">
                          Mã
                        </th>
                         <th class=" font-weight-bold">
                          Tên hiển thị
                        </th>
                        <th class="text-nowrap font-weight-bold">
                          Email
                        </th>
                        <th class="text-nowrap font-weight-bold">
                          Mật khẩu
                        </th>
                        <th class=" font-weight-bold">
                          Số điện thoại
                        </th>
                       <!--  <th class=" font-weight-bold">
                          Ngày tạo
                        </th> -->
                        <th class="text-nowrap font-weight-bold">
                          Người tạo
                        </th> 
                        <th class="text-nowrap font-weight-bold">
                          Chức năng
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td class="text-center">
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="" title="Click để sửa"><?php echo $viewParams['fullname']; ?></a>
                          </td>
                          <td class="font-italic text-success">
                            <?php echo $viewParams['email']; ?>
                          </td>
                          <td class="text-danger text-over-box text-nowrap">
                            <?php echo $viewParams['password']; ?>
                            <!-- <span title="Hiện mật khẩu" onclick="changeStatus(26049,0)" class="material-icons" aria-hidden="true" style="color:green;cursor:pointer">autorenew</span> -->
                          </td>
                          <td class="text-primary">
                           <?php echo $viewParams['phone']; ?>
                          </td>
                          <td class="text-primary">
                           <?php echo $viewParams['create_at']; ?>
                          </td>
                          <!-- <td  class="font-italic font-weight-bold">
                            <a href=""  data-toggle="modal" data-target="#detailUserModal"  title="Chi tiết"><?php echo $viewParams['create_by']; ?></a>
                          </td> -->
                          <td class="text-center">
                            <span title="Sửa tài khoản" data-toggle="modal" data-target="#updateUserModal" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span>        </span>
                            <span title="Xóa" data-toggle="modal" data-target="#delModal" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Add new account admin modal -->
      <?php getModal("account.add")?>
      <!-- Update account modal -->
      <?php getModal("user.update")?>
      <!-- Detail account modal -->
      <?php getModal("user.detail")?>
      <!-- Delete modal -->
      <?php getModal("del")?>
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

