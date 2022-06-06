@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-server icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Category<div class="page-title-subheading">List Master Category</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-category.add') }}" class="btn-shadow btn btn-info btn-lg">Add Category</a>
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
                  <th>Category Name</th>
                  <th>Category Slug</th>
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
                           <a href="{{ route('admin.master-category.edit',$master_category->id) }}" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_category({{$master_category->id}})" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
      </div>
   </div>
   @include('sweetalert::alert')
   <script type="text/javascript">
     
      function delete_category(id)
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
                  url: "/admin/master-category/"+id,
                  data: {_token:_token,id:id},
                  success:function(response){
                     if(response.status == 200){
                        Swal.fire(
                           'Deleted!',
                           'Your file has been deleted.',
                           'success'
                        )
                        window.location = "/admin/master-category";
                     }
                  }
               });
            }
            })
      }
   </script>
 </div>
@endsection
