@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-note icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Blog<span class="badge badge-pill badge-primary">{{ number_format($master_blog->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Blog</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.blog.add') }}" class="btn-shadow btn btn-info btn-lg">Add Blog</a>
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
                  <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off" placeholder="Search" type="text" class="form-control" style="color: gray;">
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
                  <th style="min-width: 50px">@sortablelink('id', 'ID')</th>
                  <th>Image</th>
                  <th style="min-width: 120px">@sortablelink('blog_category_id', 'Category')</th>
                  <th style="min-width: 120px">@sortablelink('title', 'Title')</th>
                  <th style="min-width: 120px">@sortablelink('slug', 'Slug')</th>
                  <th style="min-width: 120px">@sortablelink('short-details', 'Short Details')</th>
                  <th style="min-width: 120px">@sortablelink('details', 'Details')</th>
                  <th style="min-width: 120px">@sortablelink('user_id', 'User')</th>
                  <th style="min-width: 100px">@sortablelink('status', 'Status')</th>
                  <th style="min-width: 100px">Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_blog->count() == 0)
              <tr>
                <td colspan="10">No blog to display.</td>
              </tr>
              @endif
                @foreach ($master_blog as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <img src="{{ URL::to($item->compressImage('w_32,h_32')) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $item->blog_category_id && $item->blog_category->name ? $item->blog_category->name :'-' }}</td>
                        <td>{{ $item->title ? $item->title : '-' }}</td>
                        <td>{{ $item->slug ? $item->slug : '-' }}</td>
                        <td title="{{ $item->short_details }}">{{ \Str::limit($item->short_details, 30, ' .')  }}</td>
                        <td>{!! $item->details ? \Str::limit($item->details, 30, ' .') : '-' !!}</td>
                        <td>{{ $item->user_id && $item->admin->f_name ? $item->admin->AdminName() : '-' }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$item->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.master-blog.status',[$item['id'],$item->status?0:1])}}'" id="statusCheckbox{{$item->id}}" {{$item->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="{{ route('admin.blog.edit',$item) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_blog({{$item->id}})" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_blog->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_blog->count()}} of {{ number_format($master_blog->total(), 0, "", ".") }} blog</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
@section('js')
   <script type="text/javascript">
      function delete_blog(id)
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
                    url: "/admin/master-blog/"+id,
                    data: {_token:_token,id:id},
                    success:function(response){
                      if(response.status == 200){
                          Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                          )
                          window.location = "/admin/master-blog";
                      }
                    }
                });
              }
            })
      }
   </script>
@endsection