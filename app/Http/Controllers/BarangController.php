<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Barang;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class BarangController extends Controller
{
    public function dashboard(Request $request){
        $user = $request->session()->all();

        //to count all data
        $barangAll = Barang::all();
        $userAll = User::get()->all();

        //search
        $key = $request->key;
        //field apa saja yang bisa di cari menggunakan keyword
        $dataBarang = Barang::where('nama_barang', 'LIKE', '%'.$key.'%')
        ->orwhere('kode_barang', 'LIKE', '%'.$key.'%')
        ->orwhere('kategori_barang', 'LIKE', '%'.$key.'%')
        ->orwhere('harga', 'LIKE', '%'.$key.'%')
        ->orwhere('jumlah', 'LIKE', '%'.$key.'%')
        ->paginate(2);
        

        // return response()->json(count($barangAll));
        return view('dashboard', [
            "title" => "Dashboard", 
            "user" => $user, 
            'barang' => $dataBarang,
            'totalBarang' =>$barangAll,
            'userAll' => $userAll,
            'key' => $key,
        ]);
    }
    public function index(Request $request)
    {
        // req session
        $user = $request->session()->all();
        $key = $request->key;
        //  find postingan barang with specific user
        $userId = User::find($user['loginId']);
        $barang = $userId->barang()->where('nama_barang', 'LIKE', '%'.$key.'%')
        ->paginate(5);
        

        return view('barang.index', [
            "barang" => $barang ,
            "title" => "Data Barang", 
            "user" => $user, 
            "key" => $key,
            
        ]);
    }

    public function tambah(Request $request)
    {
        $user = $request->session()->all();
        return view('barang.form', ["title" => "Tambah Barang", "user"=> $user]);

    }

    public function simpan(Request $request)
    {
        $user = $request->session()->all();
        // dd($user['loginId']);
        $data = [
            'kode_barang'=>$request->kode_barang,
            'nama_barang'=>$request->nama_barang,
            'kategori_barang'=>$request->kategori_barang,
            'harga'=>$request->harga,
            'jumlah'=>$request->jumlah,
            'user_id'=>$user['loginId'],
        ];

        Barang::create($data);

        return redirect()->route('barang');
    }

    public function edit(Request $request, string $id)
    {
        $barang = Barang::where('id', $id)->first();

        $user = $request->session()->all();

        return view('barang.form', [
            "title"=>"Ubah Data", 
            "barang" => $barang ,
            "title" => "Ubah Data Barang",
            "user" => $user,
        ]);
    }

    public function update($id, Request $request)
    {
        $data = [
            'kode_barang'=>$request->kode_barang,
            'nama_barang'=>$request->nama_barang,
            'kategori_barang'=>$request->kategori_barang,
            'harga'=>$request->harga,
            'jumlah'=>$request->jumlah,
        ];

        Barang::where('id', $id)->update($data);

        return redirect()->route('barang');
    }

    public function hapus($id)
    {
        Barang::where('id', $id)->delete();
        return redirect()->route('barang');
    }
}
