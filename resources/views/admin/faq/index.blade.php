@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-photo-gallery icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>List Frequently Ask Question (FAQ) <span class="badge badge-pill badge-primary">{{ number_format($faqs->total(), 0, "", ".") }}</span></div>
                </div>
                <div class="page-title-actions">
                    <a href="{{ route('admin.faq.create') }}" class="btn-shadow btn btn-info btn-lg">Add FAQ</a>
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
                                        <i class="fa fa-search fa-w-16 "></i>
                                        </div>
                                    </div>
                                    <input id="filter" name="filter" value="{{ $filter }}" placeholder="Search by Title" type="text" class="form-control" style="color: gray;">
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

                <div class="table-responsive">
                    <table class="table" id="couponsTable">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'No')</th>
                                <th>@sortablelink('title', 'Title')</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Image</th>
                                <th>Position</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @if ($faqs->count() == 0)
                                <tr>
                                    <td colspan="8">No FAQ to display</td>
                                </tr>
                            @endif

                            @foreach ($faqs as $faq)
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td>{{ $faq->title }}</td>
                                    <td>{{ $faq->category_faq_id && $faq->category ? $faq->category->title : '-' }}</td>
                                    <td>{!! Str::limit($faq->description, 20) !!}</td>
                                    <td>
                                        <img src="{{ $faq->image ? $faq->image : asset('images/default-image.jpg')  }}" alt="" width="100" height="100" style="object-fit: cover">
                                    </td>
                                    <td>{{ $faq->position ? $faq->position : "-" }}</td>
                                    <td>{{ $faq->type ? $faq->type : "-" }}</td>
                                    <td>
                                        <label class="m-auto align-middle" for="statusCheckbox{{$faq->id}}">
                                            <input type="checkbox" data-toggle="toggle" data-size="small" onChange="location.href='{{route('admin.faq.status',[$faq['id'], $faq->status ? 0 : 1])}}'" id="statusCheckbox{{$faq->id}}" {{$faq->status ? 'checked' : ''}}>
                                        </label>
                                    </td>
                                    <td>
                                         <a href="{{ route('admin.faq.edit', $faq->id) }}" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>

                                        <button type="button" onclick="delete_faq({{$faq->id}})" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 col-md-6 flex-1">
                            {!! $faqs->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                        </div>
                        <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                            <p>Displaying {{$faqs->count()}} of {{ number_format($faqs->total(), 0, "", ".") }} product(s).</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('js')
        <script>

            function delete_faq(id)
            {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to delete this file!?",
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
                        url: "/admin/faq/delete/"+id,
                        data: {_token:_token,id:id},
                        success:function(response){
                            if(response.status == 200){
                                Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                                )
                                window.location = "{{ route('admin.faq') }}";
                            }
                        }
                        });
                    }
                })
            }
        </script>
    </div>
@endsection
