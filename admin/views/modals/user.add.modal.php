<div class="modal fade modal-second" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Thêm thí sinh dự thi</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input type="text" class="form-control" required>
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" required autocomplete="off" name="username">
                      </div>

                      <div class="form-group">
                          <label>Mật khẩu</label>
                          <input type="text" class="form-control" readonly="true" required name="password">
                      </div>
                      <div class="form-group">
                        <label>Số điện thoại</label>
                          <input type="phone" class="form-control" name="phone" autocomplete="off">
                      </div>

                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                      <button class="btn btn-primary" onclick="creatUser(this)">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>