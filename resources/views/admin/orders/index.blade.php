@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div><span class="text-capitalize">{{$slug}} </span>Orders<div class="page-title-subheading">List <span class="text-capitalize">{{$slug}} </span>Orders</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-category.add') }}" class="btn-shadow btn btn-info btn-lg">Create Order</a>
         </div>
      </div>
   </div>
 </div>
 @endsection
