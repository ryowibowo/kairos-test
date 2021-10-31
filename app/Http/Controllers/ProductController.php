<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;
use Session;
use Carbon\Carbon;

class ProductController extends Controller
{
    public function index()
    {   
    	$data = Product::all();
        return view('pages.product.index', ['data' => $data]);
    }

    public function create()
    {
        return view('pages.product.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
    		'product_name' => 'required',
            'price' => 'required|integer'
	    	
    	]);
               
            DB::table('products')->insert(
                [
                    'product_name' => $request->product_name,
                    'price' => $request->price,
                    'created_at' => Carbon::now()
                ]
            );
 
            Session::flash('message_alert', 'Berhasil Disimpan');
            return redirect()->route('product'); 
    }

    public function edit($id)
    {
        $item = DB::table('products')
        ->where('id', $id)
        ->first();

        return view('pages.product.edit')->with([
            'item' => $item
        ]);
    }
    

    public function update(Request $request, $id)
    {

        $update = DB::table('products')
            ->where('id', $id)
            ->update([
                'product_name' => $request->product_name,
                'price' => $request->price
        ]);

        Session::flash('message_alert', 'Berhasil Diupdate');
        return redirect()->route('product'); 
    }

    public function destroy($id)
    {
        $delete = DB::table('products')->delete($id);
        
        Session::flash('message_alert', 'Berhasil Diapus');
        return redirect()->route('product'); 
    }

    public function getAll($id = 0)
    {   
        $data = Product::find($id);
        echo json_encode($data);

    }

}
