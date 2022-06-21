<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tac;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TACController extends Controller
{
    public function master_tac_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $tacs = Tac::sortable()
            ->where('tacs.title', 'like', '%'. $filter . '%')
            ->paginate(10);
        } else {
            $tacs = Tac::sortable()->paginate(10);
        }
        return view('admin.tac.index', compact('tacs', 'filter'));
    }

    public function master_tac_status(Request $request){
        $tac = Tac::withoutGlobalScopes()->find($request->id);

        $tac->status = $request->status;
        $tac->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.master-tac');
    }

    public function master_tac_create(){

    }

    public function master_tac_store(Request $request){

    }

    public function master_tac_edit($id){

    }

    public function master_tac_update(Request $request, $id){

    }
}
