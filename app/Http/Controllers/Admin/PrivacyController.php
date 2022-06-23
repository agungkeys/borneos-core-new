<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class PrivacyController extends Controller
{
    public function privacy_index(Request $request){
        $filter = $request->query('filter');
        if (!empty($filter)){
            $privacies = PrivacyPolicy::sortable()
            ->where('privacies.title', 'like', '%'. $filter . '%')
            ->paginate(10);
        } else {
            $privacies = PrivacyPolicy::sortable()->paginate(10);
        }
        return view('admin.privacy.index', compact('privacies', 'filter'));
    }

    public function privacy_status(Request $request){
        $privacy = PrivacyPolicy::withoutGlobalScopes()->find($request->id);

        $privacy->status = $request->status;
        $privacy->save();

        Alert::toast('Status updated!', 'success');
        return redirect()->route('admin.privacy-policy');
    }
}
