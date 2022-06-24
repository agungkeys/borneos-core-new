<?php

namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    $merchant = Merchant::where(['vendor_id' => Auth()->id()])->get();
    return view('merchant.dashboard', compact(['merchant']));
  }
}
