<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // lay thong tin gio hang
        $dataCart = \Cart::content();
        $carts = [];
        if($dataCart !== null){
            $carts = $dataCart->toArray();
        }
        return view('frontend.cart.index',[
            'carts' => $carts
        ]);
    }

    public function deleteCart()
    {
        \Cart::destroy();
        return redirect()->route('frontend.cart');
    }

    public function updateCart(Request $request)
    {
        if($request->ajax()) {
            $qty   = $request->qty;
            $qty   = (is_numeric($qty) && $qty > 0 && $qty < 10) ? $qty : 1;
            $rowId = $request->rowid;

            \Cart::update($rowId, $qty);
            return response()->json(['cod' => 200, 'mess' => 'success']);
        }
    }

    public function removeCart(Request $request)
    {
        $rowId = $request->rowid;
        \Cart::remove($rowId);
        return redirect()->route('frontend.cart');
    }

    public function addCart(Request $request)
    {
        $idProduct = $request->id;
        $info = getDataProductsDemoById($idProduct);
        if(!empty($info)){
            // them gio hang
            \Cart::add([
                'id' => $info['id'],
                'name' => $info['name'],
                'qty' => 1,
                'price' => $info['price'],
                'weight' => 0,
                'options' => [
                    'image' => $info['image']
                ]
            ]);
            // view gio hang
            return redirect()->route('frontend.cart');
        } else {
            abort(404);
        }
    }
}
