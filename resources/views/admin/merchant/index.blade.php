@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="metismenu-icon pe-7s-home icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master Merchant<div class="page-title-subheading">List Master Merchant</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-merchant.add') }}" class="btn-shadow btn btn-info btn-lg">Add Merchant</a>
         </div>
      </div>
   </div>
   <div class="main-card mb-3 card">
      <div class="card-body">
         <table style="width: 100%;" id="example" class="table table-hover table-striped table-bordered">
            <thead>
               <tr>
                  <th>No.</th>
                  <th>Logo</th>
                  <th>Merhant</th>
                  <th>Owner</th>
                  <th>Phone</th>
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
                           <form action="{{ route('admin.master-category.delete',$master_merchant->id) }}" method="post">
                              <a href="{{ route('admin.master-category.edit',$master_merchant->id) }}" class="btn btn-warning btn-sm"> Edit</a>
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
