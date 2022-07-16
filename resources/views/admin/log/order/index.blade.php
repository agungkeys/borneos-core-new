@extends('layouts.app-admin')

@section('content')
<div class="app-main__inner">
   <div class="app-page-title">
      <div class="page-title-wrapper">
         <div class="page-title-heading">
            <div class="page-title-icon">
               <i class="pe-7s-bookmarks icon-gradient bg-tempting-azure"></i>
            </div>
            <div>Log Order <span class="badge badge-pill badge-primary">{{ number_format($order_logs->total(), 0, "", ".") }}</span><div class="page-title-subheading">List Log Order</div></div>
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
                  <input id="filter" name="filter" value="{{ $filter }}" autocomplete="off" placeholder="Search Log Order" type="text" class="form-control" style="color: gray;">
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
                  <th>@sortablelink('prefix', 'Prefix')</th>
                  <th>@sortablelink('method', 'Method')</th>
                  <th>@sortablelink('method_detail', 'Method Detail')</th>
                  <th>@sortablelink('value', 'Value')</th>
                  <th>@sortablelink('deskription', 'Deskription')</th>
                  <th>@sortablelink('user', 'User')</th>
                  <th>@sortablelink('user_type', 'User Type')</th>
                  <th>Created At</th>
               </tr>
            </thead>
            <tbody>
              @if ($order_logs->count() == 0)
              <tr>
                <td colspan="8">No order log to display.</td>
              </tr>
              @endif
                @foreach ($order_logs as $order_log)
                    <tr>
                        <td>{{ $order_log->id }}</td>
                        <td>{{ $order_log->prefix }}</td>
                        <td>{{ $order_log->method }}</td>
                        <td>{{ $order_log->method_detail }}</td>
                        <td>{{ $order_log->value }}</td>
                        <td>{{ $order_log->description }}</td>
                        <td>{{ $order_log->user }}</td>
                        <td>{{ $order_log->user_type }}</td>
                        <td>{{ $order_log->created_at->format('d/m/Y H:i')}}</td>
                    </tr>
                @endforeach
            </tbody>
         </table>
          <div class="row">
            <div class="col-12 col-md-6 flex-1">
              {!! $order_logs->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
            </div>
            <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
              <p>Displaying {{$order_logs->count()}} of {{ number_format($order_logs->total(), 0, "", ".") }} log order</p>
            </div>
          </div>
      </div>
   </div>
 </div>
@endsection
