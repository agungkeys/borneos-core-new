<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use Yajra\Datatables\Datatables;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $banners = Banner::all();
        return view('admin.banner.index', [
            'banners' => $banners
        ]);
    }

    // public function data(){
    //     $banners = Banner::all();

    //     return Datatables::of($banners)
    //             ->addIndexColumn()
    //             ->editColumn('action', function($banner){
    //                 return '<form action="'.route('banners.destroy', $banner->id).'" method="POST">
    //                     <a href="'.route('banners.edit', [$banner->id]).'" class="btn btn-primary" title="Edit"><i class="fas fa-pen"></i></a>
    //                     '.csrf_field().'
    //                     '.method_field("DELETE").'
    //                     <button title="Delete" type="submit" class="btn btn-link" onclick="return confirm(\'Are you sure?\')"> <i class="fas fa-trash"></i> </button>
    //                 </form>
    //                 ';
    //         })->make(true);
    //     // return response()->json($banners, 200);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.banner.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $banner = Banner::where('id', $id)->first();
        return view('admin.banner.edit', [
            'banner' => $banner
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $banner = Banner::findOrFail($id);

        $banner->delete();
        return redirect()->route('admin.banners.index');
    }
}
