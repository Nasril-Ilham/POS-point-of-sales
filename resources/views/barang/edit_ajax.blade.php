@empty($barang)
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
<form action="{{ url('/barang/'.$barang->barang_id.'/update_ajax') }}" method="POST" id="form-edit">
    @csrf
    @method('PUT')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Barang</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Kategori Barang</label>
                    <select name="kategori_id" id="kategori_id" class="form-control">
                        <option value="">- Pilih Kategori -</option>
                        @foreach($kategori as $item)
                            <option {{ ($item->kategori_id == $barang->kategori_id)? 'selected' : '' }} value="{{ $item->kategori_id }}">{{ $item->kategori_nama }}</option>
                        @endforeach
                    </select>
                    <small id="error-kategori_id" class="text-danger error-text"></small>
                </div>
                <div class="form-group">
                    <label>Kode Barang</label>
                    <input type="text" name="barang_kode" class="form-control" value="{{ $barang->barang_kode }}">
                    <small id="error-barang_kode" class="text-danger error-text"></small>
                </div>
                <div class="form-group">
                    <label>Nama Barang</label>
                    <input type="text" name="barang_nama" class="form-control" value="{{ $barang->barang_nama }}">
                    <small id="error-barang_nama" class="text-danger error-text"></small>
                </div>
                <div class="form-group">
                    <label>Harga Beli</label>
                    <input type="number" name="harga_beli" class="form-control" value="{{ $barang->harga_beli }}">
                    <small id="error-harga_beli" class="text-danger error-text"></small>
                </div>
                <div class="form-group">
                    <label>Harga Jual</label>
                    <input type="number" name="harga_jual" class="form-control" value="{{ $barang->harga_jual }}">
                    <small id="error-harga_jual" class="text-danger error-text"></small>
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
            kategori_id: { required: true, number: true },
            barang_kode: { required: true, maxlength: 10 },
            barang_nama: { required: true, maxlength: 100 },
            harga_beli: { required: true, number: true },
            harga_jual: { required: true, number: true }
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

                        /* 
                           BAGIAN PENTING: 
                           Di file index kamu menggunakan: var dataBarang
                           Maka panggil langsung: dataBarang.ajax.reload()
                        */
                        if (typeof dataBarang !== 'undefined') {
                            dataBarang.ajax.reload(null, false);
                        } else {
                            window.location.reload(); 
                        }
                    } else {
                        $('.error-text').text('');
                        $.each(response.msgField, function(prefix, val){
                            $('#error-' + prefix).text(val[0]);
                        });
                    }
                },
                error: function(xhr){
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