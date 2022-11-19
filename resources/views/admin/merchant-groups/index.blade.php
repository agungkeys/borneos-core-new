@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Merchant Groups <span class="badge badge-pill badge-primary">{{ number_format($master_merchant_group->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Merchant-Groups</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-merchant-group.add') }}" class="btn-shadow btn btn-info btn-lg">Add Merchant-Group</a>
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
                  <th>@sortablelink('id', 'ID')</th>
                  <th>Image</th>
                  <th>@sortablelink('name', 'Name')</th>
                  <th>@sortablelink('slug', 'Slug')</th>
                  <th>@sortablelink('flat_delivery','Flat Delivery')</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_merchant_group->count() == 0)
              <tr>
                <td colspan="6">No Merchant group to display.</td>
              </tr>
              @endif
                @foreach ($master_merchant_group as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            <img src="{{ URL::to($item->compressImage('w_32,h_32')) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $item->name ? $item->name : '-' }}</td>
                        <td>{{ $item->slug  }}</td>
                        @if($item->flat_delivery == 1)
                        <td>Yes</td>
                        @else
                        <td>No</td>
                        @endif
                        <td>
                           <a href="{{ route('admin.master-merchant-group.edit',$item->id) }}" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_merchant_group->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_merchant_group->count()}} of {{ number_format($master_merchant_group->total(), 0, "", ".") }} merchant groups</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
