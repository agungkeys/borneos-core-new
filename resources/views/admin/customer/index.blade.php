@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-users icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Customer<span class="badge badge-pill badge-primary">{{ number_format($master_customers->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Customer</div></div>
         </div>
         <div class="page-title-actions">
             <!-- <a href="{{ route('admin.master-user.add') }}" class="btn-shadow btn btn-info btn-lg">Add User</a> -->
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
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search User" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('id', 'ID')</th>
                  <th>@sortablelink('name', 'Name')</th>
                  <th>@sortablelink('email', 'Email')</th>
                  <th>@sortablelink('telp', 'Telp')</th>
                  <th>Birth Date</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_customers->count() == 0)
              <tr>
                <td colspan="8">No user to display.</td>
              </tr>
              @endif
                @foreach ($master_customers as $index => $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->email  }}</td>
                        <td>{{ $customer->telp  }}</td>
                        <td>{{ $customer->birth_date }}</td>
                        <td>
                           
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_customers->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_customers->count()}} of {{ number_format($master_customers->total(), 0, "", ".") }} users</p>
            </div>
          </div>
      </div>
   </div>
   <script>
     function delete_master_customer(id){
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
                  url: "/admin/master-user/"+id,
                  data: {_token:_token,id:id},
                  success:function(response){
                    if(response.status == 200){
                        Swal.fire(
                           'Deleted!',
                           'Your file has been deleted.',
                           'success'
                        )
                        window.location = "/admin/master-user";
                     }
                  }
               });
            }
            })
     }
   </script>
 </div>
@endsection
