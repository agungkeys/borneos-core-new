@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Product <span class="badge badge-pill badge-primary">{{ number_format($products->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Product</div></div>
         </div>
         <div class="page-title-actions">
             <a href="#" class="btn-shadow btn btn-info btn-lg">Add Product</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
        <div class="row mb-3">
          <div class="col-12 col-md-5">
            <div class="d-flex">
              <form class="form-inline" method="GET">
                <div class="input-group">
                  <div class="input-group-prepend">
                    <div class="input-group-text">
                      <i class="fa fa-search fa-w-16 "></i>
                    </div>
                  </div>
                  <input id="filter" name="filter" value="{{$filter}}" placeholder="Search Product, Price" type="text" class="form-control" style="color: gray;">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-md">Search</buttton>
                  </div>
                </div>
              </form>
              <form class="form-inline" method="GET">
                <button class="btn btn-light btn-lg ml-2">Clear</button>
              </form>
            </div>
          </div>
        </div>
         <table style="width: 100%;" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                  <th>@sortablelink('id', 'No')</th>
                  <th>Image</th>
                  <th>@sortablelink('name', 'Name')</th>
                  <th>@sortablelink('category.name', 'Category')</th>
                  <th>@sortablelink('merchant.name', 'Merchant')</th>
                  <th>@sortablelink('price', 'Price')</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($products->count() == 0)
              <tr>
                <td colspan="8">No products to display.</td>
              </tr>
              @endif
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        @if($product->image)
                        <td>
                            <img src="{{ URL::to($product->image) }}" alt="" width="32" height="32">
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                        </td>
                        @endif
                        <td>{{ $product->name ? $product->name : '-' }}</td>
                        <td>{{ $product->category && $product->category->name ? $product->category->name : '-' }}</td>
                        <td>{{ $product->merchant && $product->merchant->name ? $product->merchant->name : '-' }}</td>
                        <td>Rp. {{ number_format($product->price,2, ",", ".") }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$product->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.product.status',[$product['id'],$product->status?0:1])}}'" id="statusCheckbox{{$product->id}}" {{$product->status?'checked':''}}>
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
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $products->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$products->count()}} of {{ number_format($products->total(), 0, "", ".") }} product(s).</p>
            </div>
          </div>
      </div>
   </div>
   @include('sweetalert::alert')
 </div>

@endsection