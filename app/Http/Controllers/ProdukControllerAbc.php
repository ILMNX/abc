<?php

namespace App\Http\Controllers;

use App\Models\KategoriAbc;
use Illuminate\Http\Request;
use App\Models\ProdukAbc;
use PDF;

class ProdukControllerAbc extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategoriabc = KategoriAbc::all()->pluck('nama_kategori', 'id_kategori');

        return view('produk_abc.index', compact('kategoriabc'));
    }

    public function data()
    {
        $produk = ProdukAbc::leftJoin('kategori_abc', 'kategori_abc.id_kategori', 'produk_abc.id_kategori')
            ->select('produk_abc.*', 'nama_kategori')
            ->orderBy('kode_produk', 'asc')
            ->get();

        return datatables()
            ->of($produk)
            ->addIndexColumn()
            ->addColumn('select_all', function ($produk) {
                return '
                    <input type="checkbox" name="id_produk[]" value="'. $produk->id_produk .'">
                ';
            })
            ->addColumn('kode_produk', function ($produk) {
                return '<span class="label label-success">'. $produk->kode_produk .'</span>';
            })
            ->addColumn('nama_produk', function ($produk) {
                return '<span class="label label-primary">'. $produk->nama_produk .'</span>';
            })
            ->addColumn('harga_beli', function ($produk) {
                return format_uang($produk->harga_beli);
            })
            ->addColumn('harga_jual', function ($produk) {
                return format_uang($produk->harga_jual);
            })
            ->addColumn('stok', function ($produk) {
                return format_uang($produk->stok);
            })
            ->addColumn('le_commission', function ($produk) {
                return format_uang($produk->le_commission);
            })
            ->addColumn('abc_operation', function ($produk) {
                return format_uang($produk->abc_operation);
            })
            ->addColumn('leadership_fund', function ($produk) {
                return format_uang($produk->leadership_fund);
            })
            ->addColumn('lf_dana_lms', function ($produk) {
                return format_uang($produk->lf_dana_lms);
            })
            ->addColumn('lf_lf_adp1', function ($produk) {
                return format_uang($produk->lf_lf_adp1);
            })
            ->addColumn('lf_retirement_fund', function ($produk) {
                return format_uang($produk->lf_retirement_fund);
            })
            ->addColumn('lf_lf_adp2', function ($produk) {
                return format_uang($produk->lf_lf_adp2);
            })
            ->addColumn('lf_le_fund', function ($produk) {
                return format_uang($produk->lf_le_fund);
            })
            ->addColumn('harga_laporan', function ($produk) {
                return format_uang($produk->harga_laporan);
            })
            ->addColumn('harga_tithe', function ($produk) {
                return format_uang($produk->harga_tithe);
            })
            ->addColumn('harga_le', function ($produk) {
                return format_uang($produk->harga_le);
            })
            ->addColumn('harga_umum', function ($produk) {
                return format_uang($produk->harga_umum);
            })
            ->addColumn('harga_dasar', function ($produk) {
                return format_uang($produk->harga_dasar);
            })
            ->addColumn('point_buku', function ($produk) {
                return format_desimal($produk->point_buku);
            })
            ->addColumn('aksi', function ($produk) {
                return '
                <div class="btn-group">
                    <button type="button" onclick="editForm(`'. route('produk_abc.update', $produk->id_produk) .'`)" class="btn btn-xs btn-success btn-flat"><i class="fa fa-pencil"></i></button>
                    <button type="button" onclick="deleteData(`'. route('produk_abc.destroy', $produk->id_produk) .'`)" class="btn btn-xs btn-danger btn-flat"><i class="fa fa-trash"></i></button>
                </div>
                ';
            })
            ->rawColumns(['aksi', 'kode_produk', 'nama_produk', 'select_all'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$produk = Produk::latest()->first() ?? new Produk();
        //$request['kode_produk'] = 'B'. tambah_nol_didepan((int)$produk->id_produk +1, 6);

        $produk = ProdukAbc::create($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = ProdukAbc::find($id);

        return response()->json($produk);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produk = ProdukAbc::find($id);
        $produk->update($request->all());

        return response()->json('Data berhasil disimpan', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = ProdukAbc::find($id);
        $produk->delete();

        return response(null, 204);
    }

    public function deleteSelected(Request $request)
    {
        foreach ($request->id_produk as $id) {
            $produk = ProdukAbc::find($id);
            $produk->delete();
        }

        return response(null, 204);
    }

    public function cetakBarcode(Request $request)
    {
        $dataproduk = array();
        foreach ($request->id_produk as $id) {
            $produk = ProdukAbc::find($id);
            $dataproduk[] = $produk;
        }

        $no  = 1;
        $pdf = PDF::loadView('produk_abc.barcode', compact('dataproduk', 'no'));
        $pdf->setPaper('a4', 'potrait');
        return $pdf->stream('produk_abc.pdf');
    }
    public function loadForm($harga_jual = 0,$harga_beli = 0, $le_commission = 0, $abc_operation = 0, $leadership_fund = 0, $harga_laporan = 0, $harga_tithe = 0, $harga_le = 0, $harga_umum = 0,$point_buku=0)
    {
        $harga_beli   = $harga_jual * 30/100;
        $le_commission = $harga_jual * 50/100;
        $abc_operation = $harga_jual * 6/100;
        $leadership_fund = $harga_jual * 14/100;
        $harga_laporan = $harga_jual ;
        $harga_tithe = $le_commission*10/100 ;
        $harga_le = $harga_beli+$abc_operation+$leadership_fund+$harga_tithe ;
        $harga_umum = $harga_jual ;
        $point_buku = $harga_laporan/20000 ;
        $data    = [
            'harga_beli' => format_uang($harga_beli),
            'le_commission' => format_uang($le_commission),
            'abc_operation' => format_uang($abc_operation),
            'leadership_fund' => format_uang($leadership_fund),
            'harga_laporan' => format_uang($harga_laporan),
            'harga_tithe' => format_uang($harga_tithe),
            'harga_le' => format_uang($harga_le),
            'harga_umum' => format_uang($harga_umum),
            'point_buku' => format_uang($point_buku),
        ];

        return response()->json($data);
    }
}
