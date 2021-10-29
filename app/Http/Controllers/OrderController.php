<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Validator;
use Session;
use Carbon\Carbon;
use DataTables;
use App\Models\Order;

class OrderController extends Controller
{
    public function index()
    {   
    
        return view('pages.order.index');
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
                    $actionBtn = '<a  href="'.route('order.edit', $row->id).'" class="edit btn btn-success btn-sm">Edit</a> 
                                  <a href="'.route('order.delete', $row->id).'" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }
}
