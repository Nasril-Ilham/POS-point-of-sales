<form action="{{ url('user/store_foto') }}" method="POST" id="form-upload-foto" enctype="multipart/form-data">
    @csrf
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Unggah Foto Profil</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nama User</label>
                    <select name="user_nama" id="user_nama" class="form-control" required>
                        <option value="">- Pilih User -</option>
                        @foreach ($user as $u)
                            <option value="{{ $u->user_id }}">{{ $u->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label>Pilih Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                    <small class="text-muted">Format: JPG, JPEG, PNG (Maks 2MB)</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan Foto</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function() {
        $("#form-upload-foto").validate({
            rules: {
                user_nama: { required: true },
                foto: { required: true, extension: "jpg|jpeg|png" }
            },
            submitHandler: function(form) {
                let formData = new FormData(form);
                $.ajax({
                    url: form.action,
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if(response.status) {
                            $('#myModal').modal('hide');
                            Swal.fire({ icon: 'success', title: 'Berhasil', text: response.message })
                            .then(() => { location.reload(); });
                        } else {
                            Swal.fire('Gagal', response.message, 'error');
                        }
                    }
                });
                return false;
            }
        });
    });
</script>