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
             <a href="{{ route('admin.master-product.add') }}" class="btn-shadow btn btn-info btn-lg">Add Product</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
        <form method="GET">
          <div class="row mb-3">
            <div class="col-12 col-md-3">
              <div class="d-flex">
                <div class="form-inline w-100" >
                  <div class="input-group w-100">
                    <div class="input-group-prepend">
                      <div class="input-group-text">
                        <i class="fa fa-search fa-w-16 "></i>
                      </div>
                    </div>
                    <input id="filter" name="filter" value="{{$filter}}" placeholder="Search Product, Price" type="text" class="form-control" style="color: gray;" autocomplete="off">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-12 col-md-3">
              <div class="d-flex">
                  <div class="input-group w-100">
                    <select name="merchant" id="merchant" class="js-data-example-ajax multiselect-dropdown form-control" placeholder="Merchant">
                      <option disabled selected>Select Merchant</option>
                      @foreach ($merchants as $merchant)
                        <option value="{{ $merchant->id }}" {{ request()->merchant == $merchant->id ? 'selected' : ''}}>{{ $merchant->name }}</option>
                      @endforeach
                    </select>
                  </div>
              </div>
            </div>
              <div class="col-12 col-md-2">
              <div class="d-flex">
                  <div class="input-group w-100">
                    <select name="favorite" id="favorite" class="form-control">
                      <option disabled selected>Select Favorite</option>
                      <option {{ $favorite == 1 ? 'selected':'' }} value="1">Favorite Active</option>
                      <option {{ $favorite == 0 ? 'selected':'' }} value="0">Favorite Not Active</option>
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="d-flex">
                  <div class="input-group w-100">
                    <select name="status" id="status" class="form-control">
                      <option disabled selected>Select Status</option>
                      <option {{ $status == 1 ?'selected':'' }} value="1">Status Active</option>
                      <option {{ $status == 0 ? 'selected':'' }} value="0">Status Not Active</option>
                    </select>
                  </div>
              </div>
            </div>
            <div class="col-12 col-md-2">
              <div class="d-flex">
                <a href="/admin/master-product" class="btn btn-light btn-lg mr-2">Clear</a>
                <button type="submit" class="btn btn-primary btn-md">Search</button>
              </div>
            </div>
          </div>
        </form>
         <table style="width: 100%;" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                  <th>@sortablelink('id', 'No')</th>
                  <th>Image</th>
                  <th>@sortablelink('name', 'Name')</th>
                  <th>@sortablelink('category.name', 'Category')</th>
                  <th>Sub Category</th>
                  <th>Sub Sub Category</th>
                  <th>@sortablelink('merchant.name', 'Merchant')</th>
                  <th>@sortablelink('price', 'Price')</th>
                  <th>Favorite</th>
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
                        <td>
                            <img src="{{ URL::to($product->compressImage('w_32,h_32')) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $product->name ? $product->name : '-' }}</td>
                        <td>{{ $product->category && $product->category->name ? $product->category->name : '-' }}</td>
                        <td>{{ $product->sub_category_id ? $product->sub_category($product->sub_category_id) : '-' }}</td>
                        <td>{{ $product->sub_sub_category_id ? $product->sub_sub_category($product->sub_sub_category_id) : '-' }}</td>
                        <td>{{ $product->merchant && $product->merchant->name ? $product->merchant->name : '-' }}</td>
                        <td>Rp. {{ number_format($product->price,2, ",", ".") }}</td>
                        <td>
                           <label class="m-auto align-middle" for="favoriteCheckbox{{$product->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.product.favorite',[$product['id'],$product->favorite?0:1])}}'" id="favoriteCheckbox{{$product->id}}" {{$product->favorite?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$product->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.product.status',[$product['id'],$product->status?0:1])}}'" id="statusCheckbox{{$product->id}}" {{$product->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="{{ route('admin.master-product.edit',$product->id) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_product({{$product->id}})" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $products->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter, 'merchant' => request()->merchant, 'favorite' => request()->favorite, 'status' => request()->status])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$products->count()}} of {{ number_format($products->total(), 0, "", ".") }} product(s).</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
@section('js')
  <script>
     function delete_product(id){
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            let _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: "DELETE",
                url: "/admin/master-product/"+id,
                data: {_token:_token,id:id},
                success:function(response){
                  if(response.status == 200){
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                      window.location = "/admin/master-product";
                  }
                }
            });
          }
        })
     }
  </script>
@endsection