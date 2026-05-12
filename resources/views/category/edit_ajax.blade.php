@empty($kategori)

<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>

            <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
            </button>
        </div>

        <div class="modal-body">
            <div class="alert alert-danger">
                Data tidak ditemukan
            </div>
        </div>

    </div>
</div>

@else

<form action="{{ url('/kategori/'.$kategori->kategori_id.'/update_ajax') }}" 
      method="POST" 
      id="form-edit">

    @csrf
    @method('PUT')

    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Edit Data Kategori</h5>

                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <div class="form-group">
                    <label>Kode kategori</label>

                    <input type="text"
                           name="kategori_kode"
                           class="form-control"
                           value="{{ $kategori->kategori_kode }}">

                    <small id="error-kategori_kode"
                           class="text-danger error-text"></small>
                </div>

                <div class="form-group">
                    <label>Nama kategori</label>

                    <input type="text"
                           name="kategori_nama"
                           class="form-control"
                           value="{{ $kategori->kategori_nama }}">

                    <small id="error-kategori_nama"
                           class="text-danger error-text"></small>
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" 
                        class="btn btn-warning"
                        data-dismiss="modal">
                    Batal
                </button>

                <button type="submit" 
                        class="btn btn-primary">
                    Simpan
                </button>
            </div>

        </div>
    </div>

</form>

<script>
$(document).ready(function () {

    $("#form-edit").validate({

        rules: {
            kategori_kode: {
                required: true,
                maxlength: 10
            },
            kategori_nama: {
                required: true,
                maxlength: 50
            }
        },

        submitHandler: function(form) {

            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),

                success: function(response) {

                    if(response.status){

                        // tutup modal
                        $('#myModal').modal('hide');

                        // notif sukses
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });

                        // reload datatable
                        window.dataKategori.ajax.reload(null, false);

                    } else {

                        $('.error-text').text('');

                        $.each(response.msgField, function(prefix, val){
                            $('#error-' + prefix).text(val[0]);
                        });

                    }

                },

                error: function(xhr){
                    console.log(xhr);

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Terjadi kesalahan'
                    });
                }
            });

            return false;
        }

    });

});
</script>

@endempty