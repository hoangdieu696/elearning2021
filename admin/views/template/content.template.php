
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
                  <h3 class="card-title ">Danh sách đợt thi</h3>
                  <p class="card-category font-italic">Sau khi thêm mới đợt thi, bạn chọn các chức năng ở cột Chức năng để tạo đề và thí sinh dự thi. Khi hoàn tất, bạn chuyển trạng thái đợt thi ở cột đóng/mở để cho phép thí sinh vào thi</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive table-bordered table-hover">
                    <table class="table">
                      <thead>
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
                        <th class="text-nowrap font-weight-bold">
                          Người tạo
                        </th> 
                        <th class="text-nowrap font-weight-bold">
                          Chức năng
                        </th>
                        <th class=" font-weight-bold">
                          Ranking
                        </th>
                      </thead>
                      <tbody>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="" title="Click để sửa">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic text-success">
                            Đang diễn ra
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                            <span title="Chuyển trạng thái" onclick="changeStatus(26049,0)" class="material-icons" aria-hidden="true" style="color:green;cursor:pointer">autorenew</span>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href=""  title="Click để sửa">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" data-toggle="modal" data-target="#uploadFilesModal" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh"  data-toggle="modal" data-target="#uploadUsersModal" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" data-toggle="modal" data-target="#delModal" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="" title="Click để sửa">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic">
                            <del>Đã kết thúc</del>
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="" title="Click để sửa">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic">
                            <del>Đã kết thúc</del>
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic">
                            <del>Đã kết thúc</del>
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic">
                            <del>Đã kết thúc</del>
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic text-success">
                            Đang diễn ra
                          </td>
                          <td>
                            <p class="text-primary">Mở</p>
                            <span title="Chuyển trạng thái" onclick="changeStatus(26049,0)" class="material-icons" aria-hidden="true" style="color:green;cursor:pointer">autorenew</span>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
                          </td>
                        </tr>
                        <tr>
                          <td>
                            1
                          </td>
                          <td class="font-weight-bold text-warning">
                            <a href="">Dakota Rice Dakota Rice</a>
                          </td>
                          <td class="font-italic text-success">
                            Đang diễn ra
                          </td>
                          <td>
                            <p class="text-danger">Đóng</p>
                            <span title="Chuyển trạng thái" onclick="changeStatus(26049,0)" class="material-icons" aria-hidden="true" style="color:green;cursor:pointer">autorenew</span>
                          </td>
                          <td class="text-primary">
                           20/02/2021 22:33:00
                          </td>
                          <td class="text-primary">
                           24/02/2021 22:33:00
                          </td>
                          <td  class="font-italic font-weight-bold">
                            <a href="">DoriHoang</a>
                          </td>
                          <td>
                            <span title="Tạo đề thi" onclick="changeStatus(26049,0)" class="material-icons text-success" aria-hidden="true" style="color:green;cursor:pointer">file_present</span>
                            <span title="Danh sách thí sinh" onclick="changeStatus(26049,0)" class="material-icons  text-success" aria-hidden="true" style="color:green;cursor:pointer">supervisor_account</span>
                            <span title="Xóa" onclick="changeStatus(26049,0)" class="material-icons text-danger" aria-hidden="true" style="color:green;cursor:pointer">takeout_dining</span>
                          </td>
                          <td>
                            <button class="btn btn-success">Download</button>
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
      <!-- Upload Files modal -->
      <?php getModal("uploadFiles")?>
      <!-- Upload Users modal -->
      <?php getModal("uploadUsers")?>
      <!-- Delete modal -->
      <?php getModal("del")?>