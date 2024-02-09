<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="kode_produk" class="col-lg-2 col-lg-offset-1 control-label">Kode Buku</label>
                        <div class="col-lg-6">
                            <input type="text" name="kode_produk" id="kode_produk" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                        
                    </div>
                    <div class="form-group row">
                        <label for="nama_produk" class="col-lg-2 col-lg-offset-1 control-label">Judul Buku </label>
                        <div class="col-lg-6">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="id_kategori" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                        <div class="col-lg-6">
                            <select name="id_kategori" id="id_kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                @foreach ($kategoriabc as $key => $item)
                                <option value="{{ $key }}">{{ $item }}</option>
                                @endforeach
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="merk" class="col-lg-2 col-lg-offset-1 control-label">Penerbit</label>
                        <div class="col-lg-6">
                            <input type="text" name="merk" id="merk" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal_terbit" class="col-lg-2 col-lg-offset-1 control-label">Tanggal Terbit</label>
                        <div class="col-lg-6">
                            <input type="date" name="tanggal_terbit" id="tanggal_terbit" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    
                    <hr>
                    <div class="form-group row">
                        <label for="harga_dasar" class="col-lg-2 col-lg-offset-1 control-label">Harga Dasar</label>
                        <div class="col-lg-6">
                            <input type="number" placeholder="Input Harga Dasar"name="harga_dasar" id="harga_dasar" class="form-control" required>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_beli" class="col-lg-2 col-lg-offset-1 control-label">Invoice Price</label>
                        <label for="harga_beli" class="col-lg-1 control-label"><i>30%</i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="harga_beli" id="harga_beli" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="le_commission" class="col-lg-2 col-lg-offset-1 control-label">LE Commission</label>
                        <label for="le_commission" class="col-lg-1 control-label"><i>50%</i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="le_commission" id="le_commission" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="abc_operation" class="col-lg-2 col-lg-offset-1 control-label">ABC Operation & Cashier</label>
                        <label for="le_commission" class="col-lg-1 control-label"><i>6%</i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="abc_operation" id="abc_operation" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="leadership_fund" class="col-lg-2 col-lg-offset-1 control-label">Leadership Fund & Retirement</label>
                        <label for="le_commission" class="col-lg-1 control-label"><i>14%</i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="leadership_fund" id="leadership_fund" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                        <ul class="col-md-3 col-lg-offset-1">
                            <li>Dana LMS <i> 2%</i></li>
                            <input type="number" min="1" step="any" name="lf_dana_lms" id="lf_dana_lms" class="form-control" required readonly>
                            <li>Leadership Fund (ADP)<i> 1%</i></li>
                            <input type="number" min="1" step="any" name="lf_lf_adp1" id="lf_lf_adp1" class="form-control" required readonly>
                            <li>Retirement Fund<i> 1%</i></li>
                            <input type="number" min="1" step="any" name="lf_retirement_fund" id="lf_retirement_fund" class="form-control" required readonly>
                            <li>Leadership Fund (ADP)<i> 9%</i></li>
                            <input type="number" min="1" step="any" name="lf_lf_adp2" id="lf_lf_adp2" class="form-control" required readonly>
                            <li>LE Fund<i> 1%</i></li>
                            <input type="number" min="1" step="any" name="lf_le_fund" id="lf_le_fund" class="form-control" required readonly>
                        </ul>
                    </div>
                    <div class="form-group row">
                        <label for="harga_laporan" class="col-lg-2 col-lg-offset-1 control-label">Harga Laporan</label>
                        <label for="le_commission" class="col-lg-1 control-label"><i></i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="harga_laporan" id="harga_laporan" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_tithe" class="col-lg-2 col-lg-offset-1 control-label">Tithe</label>
                        <label for="harga_tithe" class="col-lg-2 control-label"><i><small>10% LE Commission</small></i></label>
                        <div class="col-lg-4">
                            <input type="number" min="1" step="any" name="harga_tithe" id="harga_tithe" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_le" class="col-lg-2 col-lg-offset-1 control-label">Harga LE</label>
                        <label for="harga_le" class="col-lg-1 control-label"><i></i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="harga_le" id="harga_le" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_umum" class="col-lg-2 col-lg-offset-1 control-label">Harga Umum</label>
                        <label for="harga_umum" class="col-lg-1 control-label"><i></i></label>
                        <div class="col-lg-5">
                            <input type="number" min="1" step="any" name="harga_umum" id="harga_umum" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="point_buku" class="col-lg-2 col-lg-offset-1 control-label">Point Buku</label>
                        <label for="harga_tithe" class="col-lg-2 control-label"><i><small>Harga/20.000</small></i></label>
                        <div class="col-lg-4">
                            <input type="number" min="1" step="any" name="point_buku" id="point_buku" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="diskon" class="col-lg-2 col-lg-offset-1 control-label">Diskon</label>
                        <div class="col-lg-6">
                            <input type="number" name="diskon" id="diskon" class="form-control" value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga_jual" class="col-lg-2 col-lg-offset-1 control-label">Harga Jual</label>
                        <div class="col-lg-6">
                            <input type="number" min="1" step="any" name="harga_jual" id="harga_jual" class="form-control" required readonly>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="stok" class="col-lg-2 col-lg-offset-1 control-label">Stok</label>
                        <div class="col-lg-6">
                            <input type="number" name="stok" id="stok" class="form-control" required value="0">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="fa fa-save"></i> Simpan</button>
                    <button type="button" class="btn btn-sm btn-flat btn-warning" data-dismiss="modal"><i class="fa fa-arrow-circle-left"></i> Batal</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('harga_dasar').addEventListener('input', function() {
    var hargaDasar = parseFloat(this.value);
    var hargaBeli = (hargaDasar * 0.3).toFixed(0);
    var leCommission = (hargaDasar * 0.5).toFixed(0);
    var abcOperation = (hargaDasar * 0.06).toFixed(0);
    //LEADERSHIP FUND 14%----------------------------------------
    var leadershipFund = (hargaDasar * 0.14).toFixed(0);
        var danaLms = (leadershipFund*0.02);
        var leadershipFundAdp1 = (leadershipFund*0.01);
        var retirementFund = (leadershipFund * 0.01);
        var leadershipFundAdp2 = (leadershipFund * 0.09);
        var leFund = (leadershipFund * 0.01);
    //LEADERSHIP FUND 14%-----------------------------------------
    var hargaLaporan = (hargaDasar).toFixed(0);
    var hargaTithe = (parseFloat(leCommission) * 0.1).toFixed(0);
    var hargaLe = parseFloat(hargaBeli) + parseFloat(abcOperation) + parseFloat(leadershipFund) + parseFloat(hargaTithe);
    var hargaUmum = hargaLaporan;
    var pointBuku = (hargaUmum/20000).toFixed(2);
    var hargaJual = hargaDasar;


    document.getElementById('harga_beli').value = hargaBeli;
    document.getElementById('le_commission').value = leCommission;
    document.getElementById('abc_operation').value = abcOperation;
    document.getElementById('leadership_fund').value = leadershipFund;
        document.getElementById('lf_dana_lms').value = danaLms;
        document.getElementById('lf_lf_adp1').value = leadershipFundAdp1;
        document.getElementById('lf_retirement_fund').value = retirementFund;
        document.getElementById('lf_lf_adp2').value = leadershipFundAdp2;
        document.getElementById('lf_le_fund').value = leFund;
    document.getElementById('harga_laporan').value = hargaLaporan;
    document.getElementById('harga_tithe').value = hargaTithe;
    document.getElementById('harga_le').value = hargaLe;
    document.getElementById('harga_umum').value = hargaUmum;
    document.getElementById('point_buku').value = pointBuku;
    document.getElementById('harga_jual').value = hargaJual;
});



document.getElementById('productForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var hargaDasar = parseFloat(document.getElementById('harga_dasar').value);
    var hargaBeli = parseFloat(document.getElementById('harga_beli').value);
    var leCommission = parseFloat(document.getElementById('le_commission').value);
    var abcOperation = parseFloat(document.getElementById('abc_operation').value);
    var leadershipFund = parseFloat(document.getElementById('leadership_fund').value);
        var danaLms = parseFloat(document.getElementById('lf_dana_lms').value);
        var leadershipFundAdp1 = parseFloat(document.getElementById('lf_lf_adp1').value);
        var retirementFund = parseFloat(document.getElementById('lf_retirement_fund').value);
        var leadershipFundAdp2 = parseFloat(document.getElementById('lf_lf_adp2').value);
        var leFund = parseFloat(document.getElementById('lf_le_fund').value);
    var hargaLaporan = parseFloat(document.getElementById('harga_laporan').value);
    var hargaTithe = parseFloat(document.getElementById('harga_tithe').value);
    var hargaLe = parseFloat(document.getElementById('harga_le').value);
    var hargaUmum = parseFloat(document.getElementById('harga_umum').value);
    var pointBuku = parseFloat(document.getElementById('point_buku').value);
    var hargaJual = parseFloat(document.getElementById('harga_jual').value);
    // Lakukan sesuatu dengan data yang disubmit
});

function formatRupiah(angka) {
    var number_string = angka.toString().replace(/[^\d]/g, ''); // Menghilangkan semua karakter non-digit
    var split = number_string.split('.');
    var sisa = split[0].length % 3;
    var rupiah = split[0].substr(0, sisa);
    var ribuan = split[0].substr(sisa).match(/\d{3}/g);

    if (ribuan) {
        var separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] !== undefined ? rupiah + '.' + split[1] : rupiah;
    return rupiah;
}
</script>


