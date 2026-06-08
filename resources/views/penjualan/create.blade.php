<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <h5 class="modal-title">Tambah Penjualan</h5>
            <button type="button" class="close" data-dismiss="modal">
                <span>&times;</span>
            </button>
        </div>

        <div class="modal-body">

            <form action="{{ url('penjualan/store') }}" method="POST" id="form-tambah">
                @csrf

                <div class="form-group">
                    <label>User</label>
                    <select name="user_id" class="form-control">
                        <option value="">- Pilih User -</option>
                        @foreach ($user as $item)
                            <option value="{{ $item->user_id }}">
                                {{ $item->user_nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Kode Penjualan</label>
                    <input type="text" name="penjualan_kode" class="form-control">
                </div>

                <div class="form-group">
                    <label>Pembeli</label>
                    <input type="text" name="pembeli" class="form-control">
                </div>

                <div class="form-group">
                    <label>Tanggal Penjualan</label>
                    <input type="date" name="penjualan_tanggal" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">
                    Simpan
                </button>

            </form>

        </div>

    </div>
</div>

{{-- js --}}

<script>
    $('.modal-backdrop').length
    $(document).ready(function() {
        // Reset form ketika modal ditutup
        $('#myModal').on('hidden.bs.modal', function() {
            $('#form-tambah')[0].reset();
            $('.error-text').text('');
            $('.form-control').removeClass('is-invalid');
        });

        $('#form-tambah').validate({
            rules: {
                user_id: {
                    required: true
                },
                penjualan_kode: {
                    required: true,
                    minlength: 3
                },
                pembeli: {
                    required: true
                },
                penjualan_tanggal: {
                    required: true,
                    date: true
                }
            },
            submitHandler: function(form) {
                $.ajax({
                    url: form.action,
                    type: form.method,
                    data: $(form).serialize(),
                    success: function(response) {
                        console.log(response); // Debug ke console browser

                        // Bersihkan sisa error lama
                        $('.error-text').text('');
                        $('.form-control').removeClass('is-invalid');

                        // UBAH DARI response.status MENJADI response.success
                        if (response.success === true || response.status === true) {

                            // Tutup modal terlebih dahulu. 
                            // Pastikan selector '#myModal' sesuai dengan id tag modal <div> Anda (misal: id="myModal")
                            $('#myModal').modal('hide');

                            // Munculkan SweetAlert Sukses
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil',
                                text: response
                                    .message // Mengambil pesan "Penjualan berhasil disimpan"
                            });

                            // Memastikan DataTable melakukan reload otomatis tanpa refresh halaman
                            if (window.dataUser) {
                                window.dataUser.ajax.reload();
                            } else if ($.fn.DataTable.isDataTable('#table-penjualan')) {
                                $('#table-penjualan').DataTable().ajax.reload();
                            } else {
                                // Alternatif terakhir jika variabel datatable tidak ketemu, 
                                // reload halaman secara halus setelah user menekan OK di SweetAlert
                                setTimeout(function() {
                                    location.reload();
                                }, 1500);
                            }

                        } else {
                            // Handler jika server mengirim success: false beserta field error
                            if (response.msgField) {
                                $.each(response.msgField, function(prefix, val) {
                                    $('#' + prefix).addClass('is-invalid');
                                    $('#error-' + prefix).text(val[0]);
                                });
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Terjadi Kesalahan',
                                text: response.message ||
                                    'Gagal menyimpan data.'
                            });
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseJSON); // Debug
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'Terjadi kesalahan saat menyimpan data'
                        });
                    }
                });
                return false;
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
