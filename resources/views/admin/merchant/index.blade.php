@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="metismenu-icon pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Merchant <span class="badge badge-pill badge-primary">{{ number_format($master_merchants->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master Merchant</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-merchant.add') }}" class="btn-shadow btn btn-info btn-lg">Add Merchant</a>
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
                  <input id="filter" name="filter" value="{{$filter}}" autocomplete="off" placeholder="Search Merchant" type="text" class="form-control" style="color: gray;">
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
                  <th>No.</th>
                  <th>Logo</th>
                  <th>@sortablelink('name','Merchant')</th>
                  <th>Owner</th>
                  <th>Phone</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
                @foreach ($master_merchants as $master_merchant)
                    <tr>
                        <td>{{ $loop->iteration }}.</td>
                        <td>
                            <img src="{{ URL::to($master_merchant->logo) }}" alt="" width="32" height="32">
                        </td>
                        <td>{{ $master_merchant->name }}</td>
                        <td>{{ $master_merchant->f_name }}{{ ' ' }}{{ $master_merchant->l_name }}</td>
                        <td>{{ $master_merchant->phone }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$master_merchant->merchant_id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.master-merchant.status',[$master_merchant['merchant_id'],$master_merchant->merchant_status?0:1])}}'" id="statusCheckbox{{$master_merchant->merchant_id}}" {{$master_merchant->merchant_status?'checked':''}} >
                              {{ $master_merchant->merchant_status }}
                            </label>
                           {{-- @dd($master_merchant['id']) --}}
                        </td>
                        <td>
                           <a href="{{ route('admin.master-merchant.edit',$master_merchant->merchant_id) }}" class="btn btn-warning btn-sm" title="Edit"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" onclick="delete_master_merchant({{$master_merchant->merchant_id}})" class="btn btn-danger btn-sm" title="Delete"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_merchants->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_merchants->count()}} of {{ number_format($master_merchants->total(), 0, "", ".") }} category</p>
            </div>
        </div>
      </div>
   </div>

   @include('sweetalert::alert')
 </div>
@endsection
@section('js')
    <script type="text/javascript">
        function delete_master_merchant(id)
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
                    url: "/admin/master-merchant/"+id,
                    data: {
                                _token:_token,
                                id:id
                            },
                    success:function(response){
                        if(response.status == 200){
                            Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                            )
                            setTimeout("location.href = '/admin/master-merchant';",1000);
                        }
                        else if(response.status == 201){
                            Swal.fire(
                            'Erorr!',
                            'Your file cannot be deleted, your merchant still has the product.',
                            'error'
                            )
                        }

                    }
                });
                }
                })
        }
    </script>
@endsection
