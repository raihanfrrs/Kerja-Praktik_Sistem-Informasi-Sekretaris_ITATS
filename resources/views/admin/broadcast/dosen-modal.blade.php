<div class="modal fade" id="listDosenModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">List Dosen</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table id="dataListDosen" class="table table-master table-borderless datatable table-hover w-100">
                    <thead>
                        <tr>
                            <th scope="col" class="text-center">Dosen</th>
                            <th scope="col" class="text-center">NIP</th>
                            <th scope="col" class="text-center">Email</th>
                            <th scope="col" class="text-center">Nomor HP</th>
                            <th scope="col" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-md btn-primary" name="bulk_store" id="bulk_store">Proses</button>
        </div>
        
      </div>
    </div>
  </div>