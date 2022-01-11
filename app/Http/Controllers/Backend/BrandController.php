<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StorePostBrands as BrandsRequest;
use App\Http\Requests\EditPostBrand;
use App\Models\Brands;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
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
            $request->file('logo')->store(PATH_STORAGE_UPLOAD);
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
        } else {
            // xoa bo anh da upload
            if(Storage::exists(PATH_STORAGE_UPLOAD.'/'.$nameLogo)){
                Storage::delete(PATH_STORAGE_UPLOAD.'/'.$nameLogo);
            }
            return redirect()->route('admin.add.brand')->with('errorBrand', 'Failed to create brand');
        }
    }

    public function deleteBrand(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $id = is_numeric($id) ? $id : 0;
            if($id > 0){
                $brand = Brands::find($id);
                if(Storage::delete(PATH_STORAGE_UPLOAD.'/'.$brand->logo)){
                    $del = $brand->delete();
                    if($del){
                        return response()->json([
                            'message' => 'delete brand success',
                            'code' => 200
                        ]);
                    }
                    return response()->json([
                        'message' => 'delete brand fail',
                        'code' => 500
                    ]);
                } 
                return response()->json([
                    'message' => 'delete logo brand fail',
                    'code' => 500
                ]);
            }
            return response()->json([
                'message' => 'id brand invalid',
                'code' => 500
            ]);
        }
    }

    public function editBrand(Request $request)
    {
        $id = $request->id;
        $infoBrand = Brands::findOrFail($id);

        return view('backend.brand.edit',[
            'info' => $infoBrand
        ]);
    }

    public function handleEdit(EditPostBrand $request)
    {
        $id = $request->id;
        $infoBrand = Brands::findOrFail($id);
        $nameBrand = $request->name;
        $slug = slugify($nameBrand);
        $description = $request->description;

        // check uploaded file
        // khong bat buoc nguoi dung phai upload logo
        // chi check logo khi nguoi dung thuc su upload
        $oldLogo = $infoBrand->logo;
        $logo = $infoBrand->logo;
        $nameLogo = null;
        if ($request->hasFile('logo')) {
            if ($request->file('logo')->isValid()) {
                $nameLogo = $request->file('logo')->hashName();
            }
        }

        if($nameLogo !== null) {
            // co upload anh
            // validate image
            $validator = Validator::make(
                $request->all(),
                ['logo' => 'mimes:jpg,png,jpeg'],
                ['logo.mimes' => 'Logo phai la cac dinh dang jpg,png,jpeg']
            );
            if ($validator->fails()) {
                return redirect()
                            ->route('admin.edit.brand',['slug' => $infoBrand->slug, 'id' => $infoBrand->id])
                            ->withErrors($validator)
                            ->withInput();
            }
            $logo = $nameLogo;
        }

        // update data
        $infoBrand->name = $nameBrand;
        $infoBrand->slug = $slug;
        $infoBrand->logo = $logo;
        $infoBrand->description = $description;
        $infoBrand->updated_at = date('Y-m-d H:i:s');

        $update = $infoBrand->save();
        if($update){
            if($nameLogo !== null) {
                // luu anh moi
                $request->file('logo')->store(PATH_STORAGE_UPLOAD);
                if(Storage::exists(PATH_STORAGE_UPLOAD.'/'.$oldLogo)){
                    // xoa anh cu
                    Storage::delete(PATH_STORAGE_UPLOAD.'/'.$oldLogo);
                }
            }
            return redirect()->route('admin.brands')->with('successBrand', 'updated success');
        }
        return redirect()->route('admin.edit.brand',['slug' => $infoBrand->slug, 'id' => $infoBrand->id])->with('errorBrand', 'Failed to update brand');
    }
}
