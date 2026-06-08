@empty($penjualan)
    <!-- ... kode modal kesalahan tetap sama ... -->
@else
<form action="{{ url('/penjualan/' . $penjualan->penjualan_id.'/destroy') }}" method="POST" id="form-delete">
    @csrf
    @method('DELETE')
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Data Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <h5><i class="icon fas fa-exclamation-triangle"></i> Konfirmasi !!!</h5>
                    Apakah Anda ingin menghapus catatan penjualan ini?
                </div>
                <table class="table table-sm table-bordered table-striped">
                    {{-- Tambahkan ?? '-' untuk mencegah error jika data relasi null --}}
                    <tr><th class="text-right col-3">id penjualan:</th><td class="col-9">{{ $penjualan->penjualan_id }}</td></tr>
                    <tr><th class="text-right col-3">Kode Penjualan:</th><td class="col-9">{{ $penjualan->penjualan_kode }}</td></tr>
                    <tr><th class="text-right col-3">User:</th><td class="col-9">{{ $penjualan->user->user_nama ?? '-' }}</td></tr>
                    <tr><th class="text-right col-3">Tanggal:</th><td class="col-9">{{ $penjualan->penjualan_tanggal }}</td></tr>
                    <tr><th class="text-right col-3">Pembeli:</th><td class="col-9">{{ $penjualan->pembeli }}</td></tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </div>
    </div>
</form>
@endempty