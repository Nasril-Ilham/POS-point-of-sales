@empty($penjualan)
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Kesalahan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
        </div>
        <div class="modal-body">
            <div class="alert alert-danger">Data tidak ditemukan</div>
        </div>
    </div>
</div>
@else
<form action="{{ url('/penjualan/'.$penjualan->penjualan_id.'/update') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>id penjualan</label>
                    <input type="text" name="penjualan_id" id="penjualan_id" class="form-control" value="{{ $penjualan->penjualan_id }}">
                    <small id="error-penjualan_id" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>user id</label>
                    <input type="text" name="user_id" id="user_id" class="form-control" value="{{ $penjualan->user_id }}">
                    <small id="error-user_id" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>penjualan kode</label>
                    <input type="text" name="penjualan_kode" id="penjualan_kode" class="form-control" value="{{ $penjualan->penjualan_kode }}">
                    <small id="error-penjualan_kode" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="text" name="penjualan_tanggal" id="penjualan_tanggal" class="form-control" value="{{ $penjualan->penjualan_tanggal }}">
                    <small id="error-penjualan_tanggal" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>pembeli</label>
                    <input type="text" name="pembeli" id="pembeli" class="form-control" value="{{ $penjualan->pembeli }}">
                    <small id="error-pembeli" class="error-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

{{-- pelajari ajax reload di bawah ini karna ada beberpaa fitur yang lainya tidak sama seperti ini --}}

<script>
$(document).ready(function () {
    $("#form-edit").validate({
        rules: {
            penjualan_id: { required: true, number: true },
            user_id: { required: true, number: true },
            penjualan_kode: { required: true },
            penjualan_tanggal: { required: true },
            pembeli: { required: true }
        },
        submitHandler: function(form) {
            $.ajax({
                url: $(form).attr('action'),
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    if(response.status){
                        $('#myModal').modal('hide');
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        
                        // Reload DataTable (menggunakan variabel dataStok dari file index)
                        // di sini var datastok di panggil dan akhirnya bisa membuat reload ketika kita update 
                        // dan mungkin tambahan pada create karna cuma di create user yang bisa auto reloa ketika 
                        // sudah input data 
                        if (typeof dataStok !== 'undefined') {
                            dataStok.ajax.reload(null, false);
                        } else {
                            window.location.reload(); 
                        }
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val){
                            $('#error-' + prefix).text(val[0]);
                            $('#' + prefix).addClass('is-invalid');
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                error: function(xhr){
                    Swal.fire({ 
                        icon: 'error', 
                        title: 'Error', 
                        text: 'Terjadi kesalahan sistem.' 
                    });
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) { 
            $(element).addClass('is-invalid'); 
        },
        unhighlight: function (element) { 
            $(element).removeClass('is-invalid'); 
        }
    });
});
</script>
@endempty