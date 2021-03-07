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
                  <button class="btn btn-secondary font-weight-bold" title="Tạo đợt thi" data-toggle="modal" data-target="#newExamModal">Tạo đợt thi</button>
                  <small class="card-category font-italic">* Sau khi thêm mới đợt thi, bạn chọn các chức năng ở cột Chức năng để tạo đề và thí sinh dự thi. Khi hoàn tất, bạn chuyển trạng thái đợt thi ở cột đóng/mở để cho phép thí sinh vào thi</small>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-bordered table-hover">
                    <table class="table">
                      <thead class="text-dark text-center">
                        <th class=" font-weight-bold">
                          Mã đợt
                        </th>
                         <th class=" font-weight-bold">
                          Đợt thi
                        </th>
                        <th class="text-nowrap font-weight-bold">
                          Trạng thái
                        </th>
                        <th class="text-nowrap font-weight-bold">
                          Đóng/Mở
                        </th>
                        <th class=" font-weight-bold">
                          Bắt đầu
                        </th>
                        <th class=" font-weight-bold">
                          Kết thúc
                        </th>
                        <!-- <th class="text-nowrap font-weight-bold">
                          Người tạo
                        </th>  -->
                        <th class="text-nowrap font-weight-bold">
                          Chức năng
                        </th>
                        <th class=" font-weight-bold">
                          Ranking
                        </th>
                      </thead>
                      <tbody class="text-center">
                        <?php foreach($viewParams['exam'] as $value){ 
                        // var_dump($viewParams['exam']); die();
                        ?>
                        <tr>
                          <td><?php echo $value['exam_id']; ?></td>
                          <td class="font-weight-bold text-warning">
                            <a href="" title="Click để sửa" data-toggle="modal" data-target="#updateExamModal" onclick="getExamDetail('<?php echo $value['exam_id']; ?>')"><?php echo $value['name']; ?></a>
                          </td>
                          <td class="font-italic">
                            <p class=" text-success">Đang diễn ra</p>
                            <i class="fa fa-check"  style="color:green;cursor:pointer"  onclick="checkFilesExist('<?php echo $value['exam_id']; ?>')" aria-hidden="true" id="check_exist"></i><label class="text-italic" ></label>
                            <!-- <del>Đã kết thúc</del> -->

                          </td>
                          <td>
                            <?php if($value['is_actived'] == 0){?>
                            <p class="text-danger">Đóng</p>
                          <?php }else{ ?>
                            <p class="text-success">Mở</p>
                            <?php } ?>
                            <span title="Chuyển trạng thái" onclick="changeStatus('<?php echo $value['exam_id']; ?>')" class="material-icons" aria-hidden="true" style="color:green;cursor:pointer">autorenew</span>
                          </td>
                          <td class="text-primary">
                           <?php echo $value['start_exam']; ?>
                          </td>
                          <td class="text-primary">
                           <?php echo $value['end_exam']; ?>
                          </td>
                         <!--  <td  class="font-italic font-weight-bold">
                            <a href=""  title="Click để sửa">DoriHoang</a>
                          </td> -->
                          <td>
                            <span title="Tạo đề thi" data-toggle="modal" data-target="#uploadFilesModal" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer" onclick="addExam('<?php echo $value['exam_id']; ?>')">file_present</span>
                            <span title="Danh sách thí sinh"  data-toggle="modal" data-target="#uploadUsersModal" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer" onclick="addUsers('<?php echo $value['exam_id']; ?>')">supervisor_account</span>
                            <span title="Xóa" data-toggle="modal" data-target="#delModal" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Create new exam modal -->
      <?php getModal("exam.add")?>
      <!-- update a exam modal -->
      <?php getModal("exam.update")?>
      <!-- Upload Files modal -->
      <?php getModal("files.upload")?>
      <!-- Upload Users modal -->
      <?php getModal("users.upload")?>
      <!-- Delete modal -->
      <?php getModal("del")?>
      <!-- End Page Content -->
      <!-- footer -->
      <?php getTemplate("footer", $viewParams) ?>
    </div>
  </div>
  <!-- setting -->
  <?php getTemplate("setting", $viewParams);?>
  <!-- End of Main Content -->

  <!-- script -->
   <?php getTemplate("end", $viewParams);?>

