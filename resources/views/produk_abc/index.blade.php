@extends('layouts.master')

@section('title')
    Master Buku ABC
@endsection

@section('breadcrumb')
    @parent
    <li class="active">Master Buku ABC</li>
@endsection

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="box">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('produk_abc.store') }}')" class="btn btn-success btn-xs btn-flat"><i class="fa fa-plus-circle"></i> Buat Master Buku</button>
                    <button onclick="deleteSelected('{{ route('produk_abc.delete_selected') }}')" class="btn btn-danger btn-xs btn-flat"><i class="fa fa-trash"></i> Hapus</button>
                    <button onclick="cetakBarcode('{{ route('produk_abc.cetak_barcode') }}')" class="btn btn-info btn-xs btn-flat"><i class="fa fa-barcode"></i> Cetak Barcode</button>
                </div>
            </div>
            <div class="box-body table-responsive">
                <form action="" method="post" class="form-produk">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">
                                <input type="checkbox" name="select_all" id="select_all">
                            </th>
                            <th width="5%"><i class="fa fa-cog"></i>Aksi</th>
                            <th width="5%">No</th>
                            <th>Kode Buku</th>
                            <th width="300%">Nama Buku</th>
                            <th>Kategori</th>
                            <th>Penerbit</th>
                            <th>Tanggal Terbit</th>
                            <th>Harga Dasar</th>
                            <th>Harga Beli</th>
                            <th>Harga Jual</th>
                            <th>LE Commission</th>
                            <th>ABC Operation & Cashier</th>
                            <th>Leadership Fund & Retirement</th>
                            <th>Dana LMS</th>
                            <th>Leadership Fund(ADP)</th>
                            <th>Retirement Fund</th>
                            <th>Leadership Fund(ADP)</th>
                            <th>LE Fund</th>
                            <th>Harga Laporan</th>
                            <th>Tithe</th>
                            <th>Harga LE</th>
                            <th>Harga Umum</th>
                            <th>Point Buku</th>
                            <th>Diskon</th>
                            <th>Stok</th>
                            
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

@includeIf('produk_abc.form')
@endsection

@push('scripts')
<script>
    let table;

    $(function () {
        table = $('.table').DataTable({
            processing: true,
            autoWidth: false,
            ajax: {
                url: '{{ route('produk_abc.data') }}',
            },
            columns: [
                {data: 'select_all', searchable: false, sortable: false},
                {data: 'aksi', searchable: true, sortable: true},
                {data: 'DT_RowIndex', searchable: false, sortable: false},
                {data: 'kode_produk'},
                {data: 'nama_produk'},
                {data: 'nama_kategori'},
                {data: 'merk'},
                {data: 'tanggal_terbit'},
                {data: 'harga_dasar'},
                {data: 'harga_beli'},
                {data: 'harga_jual'},
                {data: 'le_commission'},
                {data: 'abc_operation'},
                {data: 'leadership_fund'},
                {data: 'lf_dana_lms'},
                {data: 'lf_lf_adp1'},
                {data: 'lf_retirement_fund'},
                {data: 'lf_lf_adp2'},
                {data: 'lf_le_fund'},
                {data: 'harga_laporan'},
                {data: 'harga_tithe'},
                {data: 'harga_le'},
                {data: 'harga_umum'},
                {data: 'point_buku'},
                {data: 'diskon'},
                {data: 'stok'},
                
            ]
        });

        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });

        $('[name=select_all]').on('click', function () {
            $(':checkbox').prop('checked', this.checked);
        });
    });

    function addForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Buat Master Buku');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_produk]').focus();
    }

    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Produk');

        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();

        $.get(url)
            .done((response) => {
                $('#modal-form [name=nama_produk]').val(response.nama_produk);
                $('#modal-form [name=id_kategori]').val(response.id_kategori);
                $('#modal-form [name=merk]').val(response.merk);
                $('#modal-form [name=harga_beli]').val(response.harga_beli);
                $('#modal-form [name=harga_jual]').val(response.harga_jual);
                $('#modal-form [name=diskon]').val(response.diskon);
                $('#modal-form [name=tanggal_terbit]').val(response.tanggal_terbit);
                $('#modal-form [name=harga_dasar]').val(response.harga_dasar);
                $('#modal-form [name=le_commission]').val(response.le_commission);
                $('#modal-form [name=abc_operation]').val(response.abc_operation);
                $('#modal-form [name=leadership_fund]').val(response.leadership_fund);
                $('#modal-form [name=lf_dana_lms]').val(response.lf_dana_lms);
                $('#modal-form [name=lf_lf_adp1]').val(response.lf_lf_adp1);
                $('#modal-form [name=lf_retirement_fund]').val(response.lf_retirement_fund);
                $('#modal-form [name=lf_lf_adp2]').val(response.lf_lf_adp2);
                $('#modal-form [name=lf_le_fund]').val(response.lf_le_fund);
                $('#modal-form [name=harga_laporan]').val(response.harga_laporan);
                $('#modal-form [name=harga_tithe]').val(response.harga_tithe);
                $('#modal-form [name=harga_le]').val(response.harga_le);
                $('#modal-form [name=harga_umum]').val(response.harga_umum);
                $('#modal-form [name=point_buku]').val(response.point_buku);
                $('#modal-form [name=stok]').val(response.stok);
                $('#modal-form [name=kode_produk]').val(response.kode_produk);
            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }

    function deleteData(url) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
            $.post(url, {
                    '_token': $('[name=csrf-token]').attr('content'),
                    '_method': 'delete'
                })
                .done((response) => {
                    table.ajax.reload();
                })
                .fail((errors) => {
                    alert('Tidak dapat menghapus data');
                    return;
                });
        }
    }

    function deleteSelected(url) {
        if ($('input:checked').length > 1) {
            if (confirm('Yakin ingin menghapus data terpilih?')) {
                $.post(url, $('.form-produk_abc').serialize())
                    .done((response) => {
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menghapus data');
                        return;
                    });
            }
        } else {
            alert('Pilih data yang akan dihapus');
            return;
        }
    }

    function cetakBarcode(url) {
        if ($('input:checked').length < 1) {
            alert('Pilih data yang akan dicetak');
            return;
        } else if ($('input:checked').length < 3) {
            alert('Pilih minimal 3 data untuk dicetak');
            return;
        } else {
            $('.form-produk_abc')
                .attr('target', '_blank')
                .attr('action', url)
                .submit();
        }
    }
</script>
@endpush