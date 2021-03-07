<div class="modal fade modal-second" id="updateUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Sửa thông tin</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                        <label>Tên hiển thị</label>
                        <input type="text" class="form-control" required value="<?php echo $viewParams['fullname']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" required autocomplete="off" name="username" value="<?php echo $viewParams['email']; ?>">
                      </div>
                      <div class="form-group">
                        <label>Số điện thoại</label>
                          <input type="phone" class="form-control" name="phone" autocomplete="off" required value="<?php echo $viewParams['phone']; ?>">
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                      <button class="btn btn-primary" onclick="updateUser(this)">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>