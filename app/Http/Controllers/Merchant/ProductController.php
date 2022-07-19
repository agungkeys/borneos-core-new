<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\{Merchant, Product};
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    public function master_product_index(Request $request)
    {
        $filter = $request->query('filter');
        $merchant = Merchant::where(['vendor_id' => auth()->guard('merchant')->user()->id])->get();
        if (!empty($filter)) {
            $products = Product::sortable()
                ->where([['products.name', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant[0]->id]])
                ->orWhere([['products.price', 'like', '%' . $filter . '%'], ['merchant_id', '=', $merchant[0]->id]])
                ->latest()
                ->paginate(10);
        } else {
            $products = Product::sortable()->where('products.merchant_id', '=', $merchant[0]->id)->latest()->paginate(10);
        }
        return view('merchant.product.index', compact('products', 'filter'));
    }
    public function master_product_status(Request $request)
    {
        $product = Product::withoutGlobalScopes()->find($request->id);
        $product->status = $request->status;
        $product->save();
        Alert::toast('Status Updated', 'success');
        return redirect('/merchant/master-product');
    }
    public function master_product_add()
    {
        $merchant = Merchant::where('vendor_id', auth()->guard('merchant')->user()->id)->get()[0];
        return view('merchant.product.add', compact('merchant'));
    }
    public function master_product_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'merchant_id'  => 'required',
            'product_name' => 'required',
            'price'        => 'required|numeric|min:0',
            'description'  => 'max:1500',
            'image'        => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request['discount_type'] == 'percent') {
            $dis = ($request['price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['price'] <= $dis) {
            $validator->getMessageBag()->add('unit_price', 'Discount can not be more or equal to the price!');
        }

        if ($request['price'] <= $dis || $validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };
        $category = [];
        if ($request->category != null) {
            array_push($category, [
                'id' => $request->category,
                'position' => 0,
            ]);
        }
        if ($request->sub_category != null) {
            array_push($category, [
                'id' => $request->sub_category,
                'position' => 1,
            ]);
        }
        if ($request->sub_sub_category != null) {
            array_push($category, [
                'id' => $request->sub_sub_category,
                'position' => 2,
            ]);
        }

        if ($request->file('image')) {
            $path_name = $request->file('image')->getRealPath();
            $image = Cloudinary::upload($path_name, ["folder" => "images/products", "overwrite" => TRUE, "resource_type" => "image"]);
            $image_url = $image->getSecurePath();
            $ext = substr($image_url, -3);
            $ext_jpeg = substr($image_url, -4);
            if ($ext == "jpg") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } else if ($ext == "png") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } elseif ($ext == "svg") {
                $image_url_webp = substr($image_url, 0, -3) . "webp";
            } elseif ($ext_jpeg == "jpeg") {
                $image_url_webp = substr($image_url, 0, -4) . "webp";
            };
            $detail_image = [
                'public_id' =>  $image->getPublicId(),
                'file_type' =>  $image->getFileType(),
                'size'      =>  $image->getReadableSize(),
                'width'     =>  $image->getWidth(),
                'height'    =>  $image->getHeight(),
                'extension' =>  $image->getExtension(),
                'webp'      =>  $image_url_webp
            ];
            $additional_image = json_encode($detail_image);
        } else {
            $image_url = '';
            $additional_image = '';
        };
        $product = new Product;
        $product->merchant_id = $request->merchant_id;
        $product->name = $request->product_name;
        $product->description = $request->description == null ? '' : $request->description;
        $product->image = $image_url;
        $product->additional_image = $additional_image;
        $product->category_id = $request->category;
        $product->category_ids = json_encode($category);
        $product->sub_category_id = $request->sub_category ?? '';
        $product->sub_sub_category_id = $request->sub_sub_category ?? '';
        $product->variations = '';
        $product->add_ons = '';
        $product->attributes = '';
        $product->choice_options = '';
        $product->price = $request->price;
        $product->set_menu = 0;
        $product->available_time_starts = $request->available_time_starts;
        $product->available_time_ends = $request->available_time_ends;
        $product->status = 1;
        $product->favorite = $request->favorite ? 1 : 0;
        $product->discount = $request->discount_type == 'amount' ? $request->discount : $request->discount;
        $product->discount_type = $request->discount_type;
        $product->save();
        Alert::success('Success', 'Created Successfully');
        return redirect('/merchant/master-product');
    }
    public function master_product_edit($id)
    {
        $product = Product::find($id);
        $merchant = Merchant::where(['id' => $product->merchant_id])->get()[0];
        $category = $merchant->category_id;
        $sub_category_id = 0;
        $sub_sub_category_id = 0;
        $category_ids = json_decode($product->category_ids);
        if ($category_ids) {
            $sub_category_id = count($category_ids) > 1 && $category_ids[1] ? $category_ids[1]->id : 0;
            $sub_sub_category_id = count($category_ids) > 2 && $category_ids[2] ? $category_ids[2]->id : 0;
        };
        return view('merchant.product.edit', [
            'product'             => $product,
            'category_id'         => $category,
            'sub_category_id'     => $sub_category_id ? $sub_category_id : 0,
            'sub_sub_category_id' => $sub_sub_category_id ? $sub_sub_category_id : 0
        ]);
    }
    public function master_product_update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'merchant_id'  => 'required',
            'product_name' => 'required',
            'price'        => 'required|numeric|min:0',
            'description'  => 'max:1000',
            'image'        => 'image|mimes:jpeg,png,jpg,svg|max:8192'
        ]);
        if ($request['discount_type'] == 'percent') {
            $dis = ($request['price'] / 100) * $request['discount'];
        } else {
            $dis = $request['discount'];
        }

        if ($request['price'] <= $dis) {
            $validator->getMessageBag()->add('unit_price', 'Discount can not be more or equal to the price!');
        }

        if ($request['price'] <= $dis || $validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        };
        $category = [];
        if ($request->category != null) {
            array_push($category, [
                'id' => $request->category,
                'position' => 0,
            ]);
        }
        if ($request->sub_category != null) {
            array_push($category, [
                'id' => $request->sub_category,
                'position' => 1,
            ]);
        }

        if ($request->sub_sub_category != null) {
            array_push($category, [
                'id' => $request->sub_sub_category,
                'position' => 2,
            ]);
        }

        $product = Product::findOrFail($id);
        if ($request->file('image')) {
            if ($product->image) {
                if (!$product->additional_image) {
                    $path_name = $request->file('image')->getRealPath();
                    $image = Cloudinary::upload($path_name, ["folder" => "images/products", "overwrite" => TRUE, "resource_type" => "image"]);
                    $image_url = $image->getSecurePath();
                    $ext = substr($image_url, -3);
                    $ext_jpeg = substr($image_url, -4);

                    if ($ext == "jpg") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } else if ($ext == "png") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } elseif ($ext == "svg") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } elseif ($ext_jpeg == "jpeg") {
                        $image_url_webp = substr($image_url, 0, -4) . "webp";
                    };
                    $detail_image = [
                        'public_id' =>  $image->getPublicId(),
                        'file_type' =>  $image->getFileType(),
                        'size'      =>  $image->getReadableSize(),
                        'width'     =>  $image->getWidth(),
                        'height'    =>  $image->getHeight(),
                        'extension' =>  $image->getExtension(),
                        'webp'      =>  $image_url_webp
                    ];
                    $additional_image = json_encode($detail_image);
                } else {
                    $key = json_decode($product->additional_image);
                    Cloudinary::destroy($key->public_id);
                    $path_name = $request->file('image')->getRealPath();
                    $image = Cloudinary::upload($path_name, ["folder" => "images/products", "overwrite" => TRUE, "resource_type" => "image"]);
                    $image_url = $image->getSecurePath();
                    $ext = substr($image_url, -3);
                    $ext_jpeg = substr($image_url, -4);

                    if ($ext == "jpg") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } else if ($ext == "png") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } elseif ($ext == "svg") {
                        $image_url_webp = substr($image_url, 0, -3) . "webp";
                    } elseif ($ext_jpeg == "jpeg") {
                        $image_url_webp = substr($image_url, 0, -4) . "webp";
                    };

                    $detail_image = [
                        'public_id' =>  $image->getPublicId(),
                        'file_type' =>  $image->getFileType(),
                        'size'      =>  $image->getReadableSize(),
                        'width'     =>  $image->getWidth(),
                        'height'    =>  $image->getHeight(),
                        'extension' =>  $image->getExtension(),
                        'webp'      =>  $image_url_webp
                    ];
                    $additional_image = json_encode($detail_image);
                }
            } else {
                $path_name = $request->file('image')->getRealPath();
                $image = Cloudinary::upload($path_name, ["folder" => "images/products", "overwrite" => TRUE, "resource_type" => "image"]);
                $image_url = $image->getSecurePath();
                $ext = substr($image_url, -3);
                $ext_jpeg = substr($image_url, -4);

                if ($ext == "jpg") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } else if ($ext == "png") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } elseif ($ext == "svg") {
                    $image_url_webp = substr($image_url, 0, -3) . "webp";
                } elseif ($ext_jpeg == "jpeg") {
                    $image_url_webp = substr($image_url, 0, -4) . "webp";
                };
                $detail_image = [
                    'public_id' =>  $image->getPublicId(),
                    'file_type' =>  $image->getFileType(),
                    'size'      =>  $image->getReadableSize(),
                    'width'     =>  $image->getWidth(),
                    'height'    =>  $image->getHeight(),
                    'extension' =>  $image->getExtension(),
                    'webp'      =>  $image_url_webp
                ];
                $additional_image = json_encode($detail_image);
            }
        } else {
            $image_url = $product->image;
            $additional_image = $product->additional_image;
        };
        $product->merchant_id = $request->merchant_id;
        $product->name = $request->product_name;
        $product->description = $request->description == null ? '' : $request->description;
        $product->image = $image_url;
        $product->additional_image = $additional_image;
        $product->category_id = $request->category;
        $product->sub_category_id = $request->sub_category ?? '';
        $product->sub_sub_category_id = $request->sub_sub_category ?? '';
        $product->category_ids = json_encode($category);
        $product->price = $request->price;
        $product->available_time_starts = $request->available_time_starts;
        $product->available_time_ends = $request->available_time_ends;
        $product->favorite = $request->favorite ? 1 : 0;
        $product->discount = $request->discount_type == 'amount' ? $request->discount : $request->discount;
        $product->discount_type = $request->discount_type;
        $product->save();
        Alert::success('Updated', 'Updated Successfully');
        return redirect('/merchant/master-product');
    }
    public function master_product_delete($id)
    {
        $product = Product::find($id);
        if ($product->image) {
            if (!$product->additional_image) {
                if (Storage::disk('public')->exists('product/' . $product->image)) {
                    Storage::disk('public')->delete('product/' . $product->image);
                }
            } else {
                $key = json_decode($product->additional_image);
                Cloudinary::destroy($key->public_id);
            };
        };
        $product->delete();
        return response()->json(['status' => 200]);
    }
}
