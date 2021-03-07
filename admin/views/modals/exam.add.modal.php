<div class="modal fade modal-second" id="newExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Tạo đợt thi</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="addExamForm"  method="post" action="?action=addExamAct" enctype="multipart/form-data">
                        <input type="text" class="form-control" hidden="true" required autocomplete="off" required name="exam_id">
                        <div class="form-group">
                          <label>Tên đợt thi</label>
                          <input type="text" class="form-control" required autocomplete="off" required name="name">
                        </div>
                        <div class="form-group">
                          <label>Ngày bắt đầu</label>
                          <input type='text' class="form-control datetimepicker" id='start_exam' required autocomplete="off" name="start_exam" />
                        </div>
                        <div class="form-group">
                          <label>Ngày kết thúc</label>
                          <input type='text' class="form-control datetimepicker" id='end_exam' required autocomplete="off" name="end_exam" />
                        </div>
                        <div class="form-check">
                          <input
                            class=""
                            type="checkbox"
                            value="1"
                            checked = "true"
                            id="is_actived"
                            name="is_actived"
                          />
                          <label class="text-primary" for="is_actived"> Cho phép bắt đầu thi</label>
                        </div>
                        <div class="row">
                          <div class="col-md-12">
                            <label class="text-dark">Upload banner</label>
                            <input type="file" onchange="readURL(this);" name="exam_img" class="form-control input-group input-choose-file-height"/>
                            <div class="form-group">
                              <small class="text-center text-danger font-italic">* Kích thước ảnh tải lên là </small>
                            </div>
                            <!-- width: expression(this.width > 468 ? 468: true); -->
                            <img id="preview" style="height:60px;max-width:468px;width: 100%;" src="https://via.placeholder.com/468x60?text=Banner+đợt+thi" alt="your image" />
                          </div>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                      <button class="btn btn-primary" form="addExamForm">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- onclick="creatExam(this)" -->