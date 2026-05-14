<form action="{{ url('/barang/import_ajax') }}" method="POST" id="form-import" enctype="multipart/form-data">
    @csrf
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Download Template</label>
                    <!-- Pastikan file template_barang.xlsx ada di folder public -->
                    <a href="{{ asset('template_barang.xlsx') }}" class="btn btn-info btn-sm" download>
                        <i class="fa fa-file-excel"></i> Download
                    </a>
                </div>
                <div class="form-group">
                    <label>Pilih File</label>
                    <input type="file" name="file_barang" id="file_barang" class="form-control">
                    <small id="error-file_barang" class="error-text form-text text-danger"></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
    $("#form-import").validate({
        rules: {
            // Pastikan plugin additional-methods.min.js sudah di-include untuk 'extension'
            file_barang: {
                required: true, 
                extension: "xlsx"
            },
        },
        messages: {
            file_barang: {
                required: "Silahkan pilih file terlebih dahulu",
                extension: "Hanya file dengan ekstensi .xlsx yang diperbolehkan"
            }
        },
        submitHandler: function(form) {
            var formData = new FormData(form); 
            $.ajax({
                url: form.action,
                type: form.method,
                data: formData,
                processData: false, 
                contentType: false,
                beforeSend: function() {
                    // Opsional: Tambahkan loading state pada tombol
                    $('.btn-primary').prop('disabled', true).text('Loading...');
                },
                success: function(response) {
                    if(response.status){
                        $('#myModal').modal('hide'); // Sesuaikan ID modal Anda
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: response.message
                        });
                        if (typeof tableBarang !== 'undefined') {
                            tableBarang.ajax.reload(); 
                        }
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val) {
                            $('#error-'+prefix).text(val[0]);
                        });
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: response.message
                        });
                    }
                },
                complete: function() {
                    $('.btn-primary').prop('disabled', false).text('Upload');
                }
            });
            return false;
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});
</script>