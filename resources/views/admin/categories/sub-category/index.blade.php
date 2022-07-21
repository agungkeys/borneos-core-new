@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Sub Category <span class="badge badge-pill badge-primary">{{ number_format($master_sub_categories->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Sub Category</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-sub-category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Sub Category</a>
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
                      <i class="fa fa-search fa-w-16"></i>
                    </div>
                  </div>
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search Sub Category" type="text" class="form-control" style="color: gray;">
                  <div class="input-group-prepend">
                    <button type="submit" class="btn btn-primary btn-md">Search</button>
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
                  <th>Category Name</th>
                  <th>@sortablelink('name', 'Sub Category Name')</th>
                  <th>@sortablelink('slug', 'Sub Category Slug')</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_sub_categories->count() == 0)
              <tr>
                <td colspan="8">No sub category to display.</td>
              </tr>
              @endif
                @foreach ($master_sub_categories as $index => $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        @if($category->image)
                        <td>
                            <img src="{{env('PUBLIC_IMAGE_HOST_CLOUDINARY')}}w_32,h_32,c_fill/{{env('PUBLIC_CLOUDINARY_ID')}}{{json_decode($category->additional_image)->public_id}}.webp" alt="" width="32" height="32">
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                        </td>
                        @endif
                        <td>{{ $category->CategoryNameFromSubCategory() }}</td>
                        <td>{{ $category->name ? $category->name : '-' }}</td>
                        <td>{{ $category->slug  }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$category->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.master-sub-category.status',[$category['id'],$category->status?0:1])}}'" id="statusCheckbox{{$category->id}}" {{$category->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="{{ route('admin.master-sub-category.edit',$category->id) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_sub_category({{$category->id}})" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_sub_categories->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_sub_categories->count()}} of {{ number_format($master_sub_categories->total(), 0, "", ".") }} sub category</p>
            </div>
          </div>
      </div>
   </div>
   <script type="text/javascript">
      function delete_sub_category(id)
      {
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
               let _token =  $('meta[name="csrf-token"]').attr('content');
               $.ajax({
                  type: "DELETE",
                  url: "/admin/master-sub-category/"+id,
                  data: {_token:_token,id:id},
                  success:function(response){
                     if(response.status == 200){
                        Swal.fire(
                           'Deleted!',
                           'Your file has been deleted.',
                           'success'
                        )
                        window.location = "/admin/master-sub-category";
                     }
                  }
               });
            }
            })
      }
   </script>
 </div>
@endsection
