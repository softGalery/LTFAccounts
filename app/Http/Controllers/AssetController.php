<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AssetController extends Controller
{
    //This is for asset page view
    public function index()
    {
        return view('admin.pages.assets');
    }

    // This method for asset list
    public function allAsset()
    {
        $user_id = Auth::user()->id;
        return Asset::where('user_id', $user_id)->get();
    }

    public function creatAsset(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'asset_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'estimated_lifetime' => 'required|numeric|max:255',
            'location' => 'required|string|max:255'
        ]);
        try {
            $user_id = Auth::id();
            $img = $request->file('asset_image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/asset/{$img_name}";

            // Save image after validation
            $img->move(public_path('uploads/asset/'), $img_name);

            $price = floatval($request->input('price'));

            $asset = Asset::create([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'asset_image' => $img_url,
                'type' => $request->input('type'),
                'price' => $price,
                'purchase_date' => $request->input('purchase_date'),
                'estimated_lifetime' => $request->input('estimated_lifetime'),
                'location' => $request->input('location'),
                'user_id' => $user_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Asset created successfully',
                'data' => $asset
            ], 201);

        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create asset'
            ], 500);
        }
    }

    public function deleteAsset(Request $request)
    {
        $user_id= Auth::id();
        $asset_id=$request->input('id');
        $filePath = $request->input('file_path');
        File::delete($filePath);
        return Asset::where('id',$asset_id)->where('user_id',$user_id)->delete();
    }

    public function updateAsset(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'asset_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'type' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'purchase_date' => 'required|date',
            'estimated_lifetime' => 'required|numeric|max:255',
            'location' => 'required|string|max:255'
        ]);

        $user_id = Auth::id();
        $asset_id = $request->input('id');

        // $asset = Asset::where('id', $asset_id)->where('user_id', $user_id)->first();

    
        if ($request->hasFile('asset_image')) {
            // Save the new image
            $img = $request->file('asset_image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url = "uploads/asset/{$img_name}";
            $img->move(public_path('uploads/asset/'), $img_name);

              // Delete the old image
            $filePath = $request->input('file_path');
            File::delete($filePath); 
            
            // Update the asset with the new image
            Asset::where('id', $asset_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),                                                                                            
                'asset_image' => $img_url,
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'estimated_lifetime' => $request->input('estimated_lifetime'),
                'location' => $request->input('location')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Asset updated successfully'
            ], 201);
        }
        else {
            // Update the asset without changing the image
            Asset::where('id', $asset_id)->where('user_id', $user_id)->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'type' => $request->input('type'),
                'price' => $request->input('price'),
                'purchase_date' => $request->input('purchase_date'),
                'estimated_lifetime' => $request->input('estimated_lifetime'),
                'location' => $request->input('location')
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Asset updated successfully'
            ], 201);
        }

    }

}
