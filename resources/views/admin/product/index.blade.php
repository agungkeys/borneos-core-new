@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Product<div class="page-title-subheading">List Master Product</div></div>
         </div>
         <div class="page-title-actions">
             <a href="#" class="btn-shadow btn btn-info btn-lg">Add Product</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
         <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Category</th>
                  <th>Merchant</th>
                  <th>Price</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        @if($product->image)
                        <td>
                            <img src="{{ URL::to($product->image) }}" alt="" width="32" height="32">
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                        </td>
                        @endif
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->merchant->name }}</td>
                        <td>Rp. {{ number_format($product->price,2, ",", ".") }}</td>
                        <td>
                           <label for="statusCheckbox{{$product->id}}">
                              <input type="checkbox" onclick="location.href='{{route('admin.product.status',[$product['id'],$product->status?0:1])}}'" id="statusCheckbox{{$product->id}}" {{$product->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="#" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
   @include('sweetalert::alert')
 </div>
@endsection
