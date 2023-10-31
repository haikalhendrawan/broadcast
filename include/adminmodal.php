    <!--Add user modal-->
    <div class="modal fade bd-example-modal-lg" id="addusermodal" tabindex="-1" role="dialog" aria-labelledby="addusermodal" aria-hidden="true">
        <div class="modal-dialog modal-l">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                 </div>

                 <div class="modal-body">
                    <!--begin form-->
                    <form name="adduser" id="adduserform">
                    
                    <div class="form-group">
                    <label for="nama">Nama</label>
                    <input name="namauser" id="namauser" class="form-control" placeholder="insert name here"></input>
                    </div>

                    <div class="form-group">
                    <label for="NIPuser">NIP</label>
                    <input name="NIPuser" id="NIPuser" class="form-control" placeholder="insert nomor NIP"></input>
                    </div>

                    <div class="form-group">
                    <label for="jabatanuser">Bidang</label>
                    <input name="jabatanuser" id="jabatanuser" class="form-control" placeholder="insert bidang"></input>
                    </div>

                    <div class="form-group">
                    <label for="nomorhpuser">Nomor HP</label>
                    <input name="nomorhpuser" id="nomorhpuser" class="form-control" placeholder="insert nomor HP"></input>
                    </div>

                    <div class="form-group mt-5 text-center">
                    <button type="submit" name="submituser" id="submituser" class="btn btn-primary">Submit</button>
                    <button type="button" class="btn btn-outline-secondary" name="clearsubmituser" id="clearsubmituser">Reset</button>
                    </div>

                    </form>
                 </div>
            </div>
        </div>
    </div>
