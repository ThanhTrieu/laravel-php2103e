<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brands;

class EloquentTestController extends Controller
{
    public function saveBrands()
    {
        $brands = new Brands;
        $brands->name = 'Adidas';
        $brands->slug = 'adidas';
        $brands->logo = 'adidas-01.png';
        $brands->status = 1;
        $brands->description = null;
        $brands->created_at = date('Y-m-d H:i:s');
        $brands->updated_at = null;

        $save = $brands->save();
        if($save){
            return "OK";
        } else {
            return "Error";
        }
    }

    public function updateBrand(Request $request)
    {
        $id = $request->id;
        $id = is_numeric($id) ? $id : 0;

        $brands = Brands::find($id);
        $brands->name = 'Puma';

        $save = $brands->save();
        if($save){
            return "OK";
        }
        return "Error";
    }

    public function deleteBrands(Request $request)
    {
        $id = $request->id;
        $id = is_numeric($id) ? $id : 0;

        $brands = Brands::find($id);

        $del = $brands->delete();
        if($del){
            return "OK";
        }
        return "Error";
    }

    public function selectBrands()
    {
        $data = Brands::select('id', 'name')->where('id', 1)->first();
        if($data !== null) {
            $data = $data->toArray();
        }
        dd($data);
    }
}
