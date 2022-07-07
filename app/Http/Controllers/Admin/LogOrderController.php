<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LogOrderController extends Controller
{
  public function index()
  {
    return view('admin.log.order.index');
  }
}
