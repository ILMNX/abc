<?php

namespace App\Http\Controllers;

use App\Models\PenjualanAbc;
use App\Models\PenjualanDetailAbc;
use App\Models\ProdukAbc;
use App\Models\Setting;
use Illuminate\Http\Request;
use PDF;

class PenjualanControllerAbc extends Controller
{
    public function index()
    {
        return view('penjualan_abc.index');
    }

    public function data()
    {
        $penjualan_abc = PenjualanAbc::with('member_abc')->orderBy('id_penjualan', 'desc')->get();

        return datatables()
            ->of($penjualan_abc)
            ->addIndexColumn()
            ->addColumn('total_item', function ($penjualan_abc) {
                return format_uang($penjualan_abc->total_item);
            })
            ->addColumn('total_harga', function ($penjualan_abc) {
                return 'Rp. '. format_uang($penjualan_abc->total_harga);
            })
            ->addColumn('bayar', function ($penjualan_abc) {
                return 'Rp. '. format_uang($penjualan_abc->bayar);
            })
            ->addColumn('tanggal', function ($penjualan_abc) {
                return tanggal_indonesia($penjualan_abc->created_at, false);
            })
            ->addColumn('kode_member', function ($penjualan_abc) {
                $member_abc = $penjualan_abc->member_abc->kode_member ?? '';
                return '<span class="label label-success">'. $member_abc .'</spa>';
            })
            ->editColumn('diskon', function ($penjualan_abc) {
                return $penjualan_abc->diskon . '%';
            })
            ->editColumn('kasir', function ($penjualan_abc) {
                return $penjualan_abc->user->name ?? '';
            })
            ->addColumn('aksi', function ($penjualan_abc) {
                return '
                <div class="btn-group">
                    <button onclick="showDetail(`'. route('penjualan_abc.show', $penjualan_abc->id_penjualan) .'`)" class="btn btn-xs btn-info btn-flat"><i class="fa fa-eye"></i></button>
                    <button onclick="deleteData(`'. route('penjualan_abc.destroy', $penjualan_abc->id_penjualan) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_member'])
            ->make(true);
    }

    public function create()
    {
        $penjualan_abc = new PenjualanAbc();
        $penjualan_abc->id_member = null;
        $penjualan_abc->total_item = 0;
        $penjualan_abc->total_harga = 0;
        $penjualan_abc->diskon = 0;
        $penjualan_abc->bayar = 0;
        $penjualan_abc->diterima = 0;
        $penjualan_abc->id_user = auth()->id();
        $penjualan_abc->save();

        session(['id_penjualan' => $penjualan_abc->id_penjualan]);
        return redirect()->route('transaksi_abc.index');
    }

    public function store(Request $request)
    {
        $penjualan_abc = PenjualanAbc::findOrFail($request->id_penjualan);
        $penjualan_abc->id_member = $request->id_member;
        $penjualan_abc->total_item = $request->total_item;
        $penjualan_abc->total_harga = $request->total;
        $penjualan_abc->diskon = $request->diskon;
        $penjualan_abc->bayar = $request->bayar;
        $penjualan_abc->diterima = $request->diterima;
        $penjualan_abc->update();

        $detail = PenjualanDetailAbc::where('id_penjualan', $penjualan_abc->id_penjualan)->get();
        foreach ($detail as $item) {
            $item->diskon = $request->diskon;
            $item->update();

            $produk_abc = ProdukAbc::find($item->id_produk);
            $produk_abc->stok -= $item->jumlah;
            $produk_abc->update();
        }

        return redirect()->route('transaksi_abc.selesai');
    }

    public function show($id)
    {
        $detail = PenjualanDetailAbc::with('produk_abc')->where('id_penjualan', $id)->get();

        return datatables()
            ->of($detail)
            ->addIndexColumn()
            ->addColumn('kode_produk', function ($detail) {
                return '<span class="label label-success">'. $detail->produk_abc->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($detail) {
                return $detail->produk_abc->nama_produk;
            })
            ->addColumn('harga_jual', function ($detail) {
                return 'Rp. '. format_uang($detail->harga_jual);
            })
            ->addColumn('jumlah', function ($detail) {
                return format_uang($detail->jumlah);
            })
            ->addColumn('subtotal', function ($detail) {
                return 'Rp. '. format_uang($detail->subtotal);
            })
            ->rawColumns(['kode_produk'])
            ->make(true);
    }

    public function destroy($id)
    {
        $penjualan_abc = PenjualanAbc::find($id);
        $detail    = PenjualanDetailAbc::where('id_penjualan', $penjualan_abc->id_penjualan)->get();
        foreach ($detail as $item) {
            $produk_abc = ProdukAbc::find($item->id_produk);
            if ($produk_abc) {
                $produk_abc->stok += $item->jumlah;
                $produk_abc->update();
            }

            $item->delete();
        }

        $penjualan_abc->delete();

        return response(null, 204);
    }

    public function selesai()
    {
        $setting = Setting::first();

        return view('penjualan_abc.selesai', compact('setting'));
    }

    public function notaKecil()
    {
        $setting= Setting::first();
        $penjualan_abc = PenjualanAbc::find(session('id_penjualan'));
        if (! $penjualan_abc) {
            abort(404);
        }
        $detail = PenjualanDetailAbc::with('produk_abc')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();
        
        return view('penjualan.nota_kecil', compact('setting', 'penjualan_abc', 'detail_abc'));
    }

    public function notaBesar()
    {
        $setting = Setting::first();
        $penjualan_abc = PenjualanAbc::find(session('id_penjualan'));
        if (! $penjualan_abc) {
            abort(404);
        }
        $detail = PenjualanDetailAbc::with('produk_abc')
            ->where('id_penjualan', session('id_penjualan'))
            ->get();

        $pdf = PDF::loadView('penjualan_abc.nota_besar', compact('setting', 'penjualan_abc', 'detail_abc'));
        $pdf->setPaper(0,0,609,440, 'potrait');
        return $pdf->stream('Transaksi-'. date('Y-m-d-his') .'.pdf');
    }
}
