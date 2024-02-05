<?php

use App\Http\Controllers\{
    DashboardController,
    KategoriController,
    LaporanController,
    ProdukController,
    MemberController,
    MemberControllerAbc,
    PengeluaranController,
    PembelianController,
    PembelianDetailController,
    PenjualanController,
    PenjualanDetailController,
    SettingController,
    SupplierController,
    SupplierControllerAbc,
    UserController,
    KategoriControllerAbc,
    ProdukControllerAbc,
    PembelianControllerAbc,
    PembelianDetailControllerAbc,
    PenjualanControllerAbc,
    PenjualanDetailControllerAbc,
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => 'level:1'], function () {
        Route::get('/kategori/data', [KategoriController::class, 'data'])->name('kategori.data');
        Route::resource('/kategori', KategoriController::class);
        Route::get('/kategori_abc/data', [KategoriControllerAbc::class, 'data'])->name('kategori_abc.data');
        Route::resource('/kategori_abc', KategoriControllerAbc::class);

        Route::get('/produk/data', [ProdukController::class, 'data'])->name('produk.data');
        Route::post('/produk/delete-selected', [ProdukController::class, 'deleteSelected'])->name('produk.delete_selected');
        Route::post('/produk/cetak-barcode', [ProdukController::class, 'cetakBarcode'])->name('produk.cetak_barcode');
        Route::resource('/produk', ProdukController::class);

        Route::get('/produk_abc/data', [ProdukControllerAbc::class, 'data'])->name('produk_abc.data');
        Route::post('/produk_abc/delete-selected', [ProdukControllerAbc::class, 'deleteSelected'])->name('produk_abc.delete_selected');
        Route::post('/produk_abc/cetak-barcode', [ProdukControllerAbc::class, 'cetakBarcode'])->name('produk_abc.cetak_barcode');
        Route::resource('/produk_abc', ProdukControllerAbc::class);

        Route::get('/member/data', [MemberController::class, 'data'])->name('member.data');
        Route::post('/member/cetak-member', [MemberController::class, 'cetakMember'])->name('member.cetak_member');
        Route::resource('/member', MemberController::class);

        Route::get('/member_abc/data', [MemberControllerAbc::class, 'data'])->name('member_abc.data');
        Route::post('/member_abc/cetak-member', [MemberControllerAbc::class, 'cetakMember'])->name('member_abc.cetak_member');
        Route::resource('/member_abc', MemberControllerAbc::class);

        Route::get('/supplier/data', [SupplierController::class, 'data'])->name('supplier.data');
        Route::resource('/supplier', SupplierController::class);

        Route::get('/supplier_abc/data', [SupplierControllerAbc::class, 'data'])->name('supplier_abc.data');
        Route::resource('/supplier_abc', SupplierControllerAbc::class);

        Route::get('/pengeluaran/data', [PengeluaranController::class, 'data'])->name('pengeluaran.data');
        Route::resource('/pengeluaran', PengeluaranController::class);

        Route::get('/pembelian/data', [PembelianController::class, 'data'])->name('pembelian.data');
        Route::get('/pembelian/{id}/create', [PembelianController::class, 'create'])->name('pembelian.create');
        Route::resource('/pembelian', PembelianController::class)
            ->except('create');

        Route::get('/pembelian_detail/{id}/data', [PembelianDetailController::class, 'data'])->name('pembelian_detail.data');
        Route::get('/pembelian_detail/loadform/{diskon}/{total}', [PembelianDetailController::class, 'loadForm'])->name('pembelian_detail.load_form');
        Route::resource('/pembelian_detail', PembelianDetailController::class)
            ->except('create', 'show', 'edit');

        Route::get('/pembelian_abc/data', [PembelianControllerAbc::class, 'data'])->name('pembelian_abc.data');
        Route::get('/pembelian_abc/{id}/create', [PembelianControllerAbc::class, 'create'])->name('pembelian_abc.create');
        Route::resource('/pembelian_abc', PembelianControllerAbc::class)
            ->except('create');

        Route::get('/pembelian_detail_abc/{id}/data', [PembelianDetailControllerAbc::class, 'data'])->name('pembelian_detail_abc.data');
        Route::get('/pembelian_detail_abc/loadform/{diskon}/{total}', [PembelianDetailControllerAbc::class, 'loadForm'])->name('pembelian_detail_abc.load_form');
        Route::resource('/pembelian_detail_abc', PembelianDetailControllerAbc::class)
            ->except('create', 'show', 'edit');

        Route::get('/penjualan/data', [PenjualanController::class, 'data'])->name('penjualan.data');
        Route::get('/penjualan', [PenjualanController::class, 'index'])->name('penjualan.index');
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show'])->name('penjualan.show');
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy'])->name('penjualan.destroy');

        Route::get('/penjualan_abc/data', [PenjualanControllerAbc::class, 'data'])->name('penjualan_abc.data');
        Route::get('/penjualan_abc', [PenjualanControllerAbc::class, 'index'])->name('penjualan_abc.index');
        Route::get('/penjualan_abc/{id}', [PenjualanControllerAbc::class, 'show'])->name('penjualan_abc.show');
        Route::delete('/penjualan_abc/{id}', [PenjualanControllerAbc::class, 'destroy'])->name('penjualan_abc.destroy');
    });

    Route::group(['middleware' => 'level:1,2'], function () {
        Route::get('/transaksi/baru', [PenjualanController::class, 'create'])->name('transaksi.baru');
        Route::post('/transaksi/simpan', [PenjualanController::class, 'store'])->name('transaksi.simpan');
        Route::get('/transaksi/selesai', [PenjualanController::class, 'selesai'])->name('transaksi.selesai');
        Route::get('/transaksi/nota-kecil', [PenjualanController::class, 'notaKecil'])->name('transaksi.nota_kecil');
        Route::get('/transaksi/nota-besar', [PenjualanController::class, 'notaBesar'])->name('transaksi.nota_besar');

        Route::get('/transaksi/{id}/data', [PenjualanDetailController::class, 'data'])->name('transaksi.data');
        Route::get('/transaksi/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailController::class, 'loadForm'])->name('transaksi.load_form');
        Route::resource('/transaksi', PenjualanDetailController::class)
            ->except('create', 'show', 'edit');

        Route::get('/transaksi_abc/baru', [PenjualanControllerAbc::class, 'create'])->name('transaksi_abc.baru');
        Route::post('/transaksi_abc/simpan', [PenjualanControllerAbc::class, 'store'])->name('transaksi_abc.simpan');
        Route::get('/transaksi_abc/selesai', [PenjualanControllerAbc::class, 'selesai'])->name('transaksi_abc.selesai');
        Route::get('/transaksi_abc/nota-kecil', [PenjualanControllerAbc::class, 'notaKecil'])->name('transaksi_abc.nota_kecil');
        Route::get('/transaksi_abc/nota-besar', [PenjualanControllerAbc::class, 'notaBesar'])->name('transaksi_abc.nota_besar');

        Route::get('/transaksi_abc/{id}/data', [PenjualanDetailControllerAbc::class, 'data'])->name('transaksi_abc.data');
        Route::get('/transaksi_abc/loadform/{diskon}/{total}/{diterima}', [PenjualanDetailControllerAbc::class, 'loadForm'])->name('transaksi_abc.load_form');
        Route::resource('/transaksi_abc', PenjualanDetailControllerAbc::class)
            ->except('create', 'show', 'edit');
    });

    Route::group(['middleware' => 'level:1'], function () {
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
        Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');

        Route::get('/user/data', [UserController::class, 'data'])->name('user.data');
        Route::resource('/user', UserController::class);

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::get('/setting/first', [SettingController::class, 'show'])->name('setting.show');
        Route::post('/setting', [SettingController::class, 'update'])->name('setting.update');
    });
 
    Route::group(['middleware' => 'level:1,2'], function () {
        Route::get('/profil', [UserController::class, 'profil'])->name('user.profil');
        Route::post('/profil', [UserController::class, 'updateProfil'])->name('user.update_profil');
    });
});