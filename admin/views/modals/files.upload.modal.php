<div class="modal fade" id="uploadFilesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-lg modal-dialog modal-dialog-scrollable" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-uppercase font-weight-bold" id="exampleModalLabel">Tải đề thi</h5>
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

                  <p class="card-category">Mẫu file đề ở đây
                    <a href="../../upload/Test365.Mau_Danh_Sach_Cau_Hoi.xls" download>
                      <button class="btn btn-secondary">Tải xuống</button>
                    </a>
                  </p>
                </div>
                <div class="card-body">
                  <form method="post" enctype="multipart/form-data" action="?action=uploadFilesAct" id="uploadFilesForm">
                     <input type="text" name="exam_id" id="exam_id_add" hidden="false" />
                    <div class="row">
                      <div class="col-md-12">
                        <label class="text-dark">Upload part 1</label>
                        <input type="file" name="part_1" required="" class="form-control input-group input-choose-file-height"/>
                        <div class="form-group">
                          <small class="text-center text-danger font-italic">* Giới hạn dung lượng <= 10MB</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label class="text-dark">Upload part 2</label>
                        <input type="file" name="part_2" required class="form-control input-group input-choose-file-height"/>
                        <div class="form-group">
                          <small class="text-center text-danger font-italic">* Giới hạn dung lượng <= 10MB</small>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <label class="text-dark">Upload part 3</label>
                        <input type="file" name="part_3" required class="form-control input-group input-choose-file-height"/>
                        <div class="form-group">
                          <small class="text-center text-danger font-italic">* Giới hạn dung lượng <= 10MB</small>
                        </div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <mark class="text-info font-italic small">Chú ý: Bạn cần tải file excel đề lên theo đúng định dạng đã tải</mark>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Bỏ qua</button>
        <button class="btn btn-primary" form="uploadFilesForm" name="uploadFilesBtn">Lưu</button>
      </div>
    </div>
  </div>
</div>