<div class="modal fade" id="uploadUsersModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-lg modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase font-weight-bold" id="exampleModalLabel">Danh sách thí sinh</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xl-12">
              <div class="card">
                <div class="card-header card-header-primary">

                  <p class="card-category">Mẫu file thí sinh ở đây 
                    <a href="../../upload/Test365.Mau_Danh_Sach_Thi_Sinh.xls" download>
                      <button class="btn btn-secondary">Tải xuống</button>
                    </a>
                  </p>
                </div>
                <div class="card-body">
                  <form id="uploadUsersForm"  action="?action=uploadUsersAct" method="post" enctype="multipart/form-data">
                    <input type="text" hidden="false" id="exam_id_add_user" name="exam_id_add">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="text-dark" for="team_id">Chọn ca thi</label>
                          <select class="form-control" id="team_id" name="team_id">
                            <option class="form-group" value="1">Team 1</option>
                            <option class="form-group" value="2">Team 2</option>
                            <option class="form-group" value="3">Team 3</option>
                            <option class="form-group" value="4">Team 4</option>
                          </select>
                      </div>
                    </div>
                  </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label class="text-dark">Upload danh sách thí sinh</label>
                        <input type="file" name="listUsers" class="form-control input-group input-choose-file-height"/>
                        <div class="form-group">
                          <small class="text-center text-danger font-italic">* Upload đúng file mẫu. Giới hạn dung lượng <= 10MB</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <div class="input-group input-file" name="upFile">
                              <span class="input-group-btn">
                                 <button class="btn btn-success btn-choose" data-toggle="modal" data-target="#newUserModal" type="button">Thêm thí sinh</button>
                                 <small class="text-center align-text-bottom text-danger font-italic">* Thêm thí sinh vào danh sách đã upload</small>
                              </span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <mark class="text-info font-italic small">Chú ý: Bạn cần tải file đề lên theo đúng định dạng</mark>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Bỏ qua</button>
        <button class="btn btn-primary" form="uploadUsersForm">Lưu</button>
      </div>
    </div>
  </div>
</div>
<?php getModal("user.add")?>