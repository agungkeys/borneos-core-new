@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-medal icon-gradient bg-tempting-azure"></i>
            </div>
            <div>
               Master Category
               <div class="page-title-subheading">
                   Choose between regular React Bootstrap tables or advanced dynamic ones.</div>
            </div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-category.add') }}" class="btn-shadow btn btn-info"> Tambah</a>
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
                @foreach ($master_categories as $master_category)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>
                            <img src="{{ URL::to($master_category->image) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $master_category->name }}</td>
                        <td>{{ $master_category->slug }}</td>
                        <td>
                            <a href="{{ route('admin.master-category.edit',$master_category->id) }}" class="btn btn-warning btn-sm"> Edit</a>
                            <a href="#" class="btn btn-danger btn-sm"> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>



@endsection