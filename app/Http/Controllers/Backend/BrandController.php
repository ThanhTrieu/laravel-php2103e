<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostBrands as BrandsRequest;
use App\Models\Brands;
use Config;

class BrandController extends Controller
{
    public function index()
    {
        $limit = Config::get('common.limit_page');
        $brands = Brands::paginate($limit);

        return view('backend.brand.index', [
            'brands' => $brands
        ]);
    }

    public function addBrand()
    {
        return view('backend.brand.add');
    }

    public function handleAddBrand(BrandsRequest $request, Brands $brands)
    {
        $name = $request->name;
        $slug = slugify($name); // goi ham trong file Common / Helpers
        $description = $request->description;
        $status = 1;
        $createdTime = date('Y-m-d H:i:s');

        $nameLogo = null;
        // xu ly upload anh
        if ($request->file('logo')->isValid()) {
            //ko co loi gi
            $nameLogo = $request->file('logo')->hashName();
            $request->file('logo')->store('public/images');
        }

        if($nameLogo === null){
            return redirect()->route('admin.add.brand')->with('invalidLogo', 'Can not upload logo brand');
        }

        // insert database
        $brands->name = $name;
        $brands->slug = $slug;
        $brands->logo = $nameLogo;
        $brands->status = $status;
        $brands->description = $description;
        $brands->created_at = $createdTime;
        $brands->updated_at = null;

        $save = $brands->save();
        if($save){
            return redirect()->route('admin.brands')->with('successBrand', 'Created success');
        }
        return redirect()->route('admin.add.brand')->with('errorBrand', 'Failed to create brand');
    }
}
