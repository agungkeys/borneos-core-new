@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Sub Sub Category<div class="page-title-subheading">List Master Sub Sub Category</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-sub-sub-category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Category</a>
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
                  <th>Slug</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($master_sub_sub_categories as $master_sub_sub_category)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>
                           @if($master_sub_sub_category->image)
                              <img src="{{ URL::to($master_sub_sub_category->image) }}" alt="" width="32" height="32">
                           @else
                              <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                           @endif
                        </td>
                        <td>{{ $master_sub_sub_category->name }}</td>
                        <td>{{ $master_sub_sub_category->slug }}</td>
                        <td>
                           <form action="{{ route('admin.master-sub-sub-category.delete',$master_sub_sub_category->id) }}" method="post">
                              <a href="{{ route('admin.master-sub-sub-category.edit',$master_sub_sub_category->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                              @method('delete')
                              @csrf
                              <button type="submit" onclick="return confirm('Are you sure ?')" class="btn btn-danger btn-sm"> Delete</button>
                           </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
 </div>
@endsection
