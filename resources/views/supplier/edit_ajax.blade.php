@empty($supplier)
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
<form action="{{ url('/supplier/'.$supplier->supplier_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kode Supplier</label>
                    <input type="text" name="supplier_kode" id="supplier_kode" class="form-control" value="{{ $supplier->supplier_kode }}">
                    <small id="error-supplier_kode" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Nama Supplier</label>
                    <input type="text" name="supplier_nama" id="supplier_nama" class="form-control" value="{{ $supplier->supplier_nama }}">
                    <small id="error-supplier_nama" class="error-text text-danger"></small>
                </div>
                <div class="form-group">
                    <label>Alamat Supplier</label>
                    <input type="text" name="supplier_alamat" id="supplier_alamat" class="form-control" value="{{ $supplier->supplier_alamat }}">
                    <small id="error-supplier_alamat" class="error-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    $("#form-edit").validate({
        rules: {
            supplier_kode: { required: true, maxlength: 100 },
            supplier_nama: { required: true, maxlength: 255 },
            supplier_alamat: { required: true, maxlength: 255 }
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
                        
                        // Reload DataTable
                        if (typeof dataSupplier !== 'undefined') {
                            dataSupplier.ajax.reload(null, false);
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
                    Swal.fire({ icon: 'error', title: 'Error', text: 'Terjadi kesalahan sistem.' });
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element) { $(element).addClass('is-invalid'); },
        unhighlight: function (element) { $(element).removeClass('is-invalid'); }
    });
});
</script>
@endempty