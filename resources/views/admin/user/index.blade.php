@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-users icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Master User <span class="badge badge-pill badge-primary">{{ number_format($master_users->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Master User</div></div>
         </div>
         <div class="page-title-actions">
             <a href="{{ route('admin.master-user.add') }}" class="btn-shadow btn btn-info btn-lg">Add User</a>
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
                  <th>Image</th>
                  <th>@sortablelink('f_name', 'Name')</th>
                  <th>@sortablelink('phone', 'Phone')</th>
                  <th>@sortablelink('email', 'Email')</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
              @if ($master_users->count() == 0)
              <tr>
                <td colspan="8">No user to display.</td>
              </tr>
              @endif
                @foreach ($master_users as $index => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        @if($user->image)
                        <td>
                            <img src="{{ URL::to($user->image) }}" alt="" width="32" height="32">
                        </td>
                        @else
                        <td>
                            <img src="{{ asset('images/default-image.jpg') }}" alt="" width="32" height="32">
                        </td>
                        @endif
                        <td>{{ $user->f_name }} {{ $user->l_name }}</td>
                        <td>{{ $user->phone  }}</td>
                        <td>{{ $user->email  }}</td>
                        <td>{{ $user->role && $user->role->name ? $user->role->name : '-' }}</td>
                        <td>
                           <label class="m-auto align-middle" for="statusCheckbox{{$user->id}}">
                              <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.master-user.status',[$user['id'],$user->status?0:1])}}'" id="statusCheckbox{{$user->id}}" {{$user->status?'checked':''}}>
                           </label>
                        </td>
                        <td>
                           <a href="#" class="btn btn-warning btn-sm" title="Edit ?"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                           <button type="button" class="btn btn-danger btn-sm" title="Delete ?"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $master_users->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$master_users->count()}} of {{ number_format($master_users->total(), 0, "", ".") }} users</p>
            </div>
          </div>
      </div>
   </div>
   @include('sweetalert::alert')
 </div>
@endsection
