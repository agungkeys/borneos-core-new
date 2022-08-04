@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-bookmarks icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Blog Category <span class="badge badge-pill badge-primary">{{ number_format($master_category_blog->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Blog Category</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.blog-category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Blog Category</a>
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
                  <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off" placeholder="Search Blog Category" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('id', 'ID')</th>
                  <th>Image</th>
                  <th>@sortablelink('name', 'Blog Category Name')</th>
                  <th>@sortablelink('slug', 'Blog Category Slug')</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_category_blog->count() == 0)
              <tr>
                <td colspan="8">No blog category to display.</td>
              </tr>
              @endif
                @foreach ($master_category_blog as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        @if($item->image)
                        <td>
                            <img src="{{ URL::to($item->image) }}" alt="" width="32" height="32">
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                        </td>
                        @endif
                        <td>{{ $item->name ? $item->name : '-' }}</td>
                        <td>{{ $item->slug ? $item->slug : '-' }}</td>
                        <td>
                           <a href="#" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button"  class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_category_blog->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_category_blog->count()}} of {{ number_format($master_category_blog->total(), 0, "", ".") }} blog categories</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
