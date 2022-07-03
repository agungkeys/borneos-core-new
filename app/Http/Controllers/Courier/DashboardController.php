<?php

namespace App\Http\Controllers\Courier;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\Courier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function dashboard(Request $request)
  {
    return view('courier.dashboard');
  }
}
