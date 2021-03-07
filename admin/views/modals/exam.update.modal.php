<div class="modal fade modal-second" id="updateExamModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-uppercase font-weight-bold"  id="exampleModalLabel">Thêm thí sinh dự thi</h5>
                      <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="updateExamForm"  method="post" action="?action=updateExamAct">
                        <input type="text" class="form-control" hidden="true" autocomplete="off" id="exam_id_update" required name="exam_id_update">
                        <div class="form-group">
                          <label>Tên đợt thi</label>
                          <input type="text" class="form-control"  autocomplete="off" id="name_update" required name="name_update">
                        </div>
                        <div class="form-group">
                          <label>Ngày bắt đầu</label>
                          <input type='text' class="form-control datetimepicker" id='start_exam_update' required autocomplete="off" name="start_exam_update" />
                        </div>
                        <div class="form-group">
                          <label>Ngày kết thúc</label>
                          <input type='text' class="form-control datetimepicker" id='end_exam_update' required autocomplete="off" name="end_exam_update" />
                        </div>
                        <div class="form-check">
                          <input
                            class=""
                            type="checkbox"
                            value="1"
                            checked = "true"
                            id="is_actived_update"
                            name="is_actived_update"
                          />
                          <label class="text-primary" for="is_actived_update"> Cho phép bắt đầu thi</label>
                        </div>
                      </form>
                    </div>
                    <div class="modal-footer">
                      <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy bỏ</button>
                      <button class="btn btn-primary" form="updateExamForm">Lưu</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- onclick="creatExam(this)" -->