<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Session;


class OrderController extends Controller
{
    public function index()
    {   
    
        return view('pages.order.index');
    }

    public function create()
    {
        $data = DB::table('products')
                ->select('products.*', 'product_details.*')
                    
                ->join('product_details', 'product_details.product_id', '=', 'products.id')
                ->get();
        $product = DB::table('products')
            ->get();

        $now = Carbon::now()->isoFormat('YYYYMM');
        $string = '0000';
    
        $id = substr($string, -4, 4);
        $newID = $id+1;
        $newID = str_pad($newID, 4, '0', STR_PAD_LEFT);
        $result = $now . '' . $newID;
        
        $order = new Order();

        $last = $order->orderBy('id', 'DESC')->pluck('id')->first();
        $new = $last + 1;
    
        return view('pages.order.create', ['data' => $data, 'product' => $product, 'prod_id' => $new] );
    }

    public function store(Request $request)
    {
        $this->validate($request, [
    		'order_date' => 'required',
            'customer_name' => 'required'
	    	
    	]);
               
            DB::table('orders')->insert(
                [   
                    'id' => $request->id,
                    'order_date' => $request->order_date,
                    'customer_name' => $request->customer_name,
                    'subtotal' => $request->subtotal
                ]
            );
 
            Session::flash('message_alert', 'Berhasil Disimpan');
            return redirect()->route('order.create'); 
    }

    public function edit($id)
    {
        $item = DB::table('orders')
        ->where('id', $id)
        ->first();

        return view('pages.order.edit')->with([
            'item' => $item
        ]);
    }

    public function update(Request $request, $id)
    {

        $update = DB::table('orders')
            ->where('id', $id)
            ->update([
                'order_date' => $request->order_date,
                'customer_name' => $request->customer_name
        ]);

        Session::flash('message_alert', 'Berhasil Diupdate');
        return redirect()->route('order'); 
    }

    public function destroy($id)
    {
        $delete = DB::table('orders')->delete($id);
        
        Session::flash('message_alert', 'Berhasil Diapus');
        return redirect()->route('order'); 
    }

    public function datatables(Request $request)
    {
        
        if ($request->ajax()) {
            $order = new Order();
        
            if(!empty($request->order_id)){
                $order = $order->where('id', 'LIKE', "%" . $request->order_id . "%");
            }
            if(!empty($request->nama)){
                $order = $order->where('customer_name', 'LIKE', "%" . $request->nama . "%");
            }
    
            $order = $order->select('*')
                ->get();
            return Datatables::of($order)
                ->addIndexColumn()
                ->addColumn('action', function($row){

                    $actionBtn = '';
                    if(Auth::user()->type == 'admin'){
                        $actionBtn = '<a  href="'.route('order.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> 
                                  <a href="'.route('order.delete', $row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';
                    }
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
    
    public function addProduct(Request $request)
    {
        $this->validate($request, [
    		'qty' => 'required'
	    	
    	]);
        $product = DB::table('products')
            ->select('price')
            ->where('id', $request->product_id)
            ->first();
        DB::table('product_details')->insert(
            [
                'product_id' => $request->product_id,
                'qty' => $request->qty,
                'subtotal' => $request->qty * $product->price,
                'created_at' => Carbon::now()
            ]
        );

        Session::flash('message_alert', 'Berhasil Disimpan');
        return redirect()->route('order.create'); 
    }

    public function destroyDetail($id)
    {
        $delete = DB::table('product_details')->delete($id);
        
        Session::flash('message_alert', 'Berhasil Diapus');
        return redirect()->route('order.create'); 
    }
}
