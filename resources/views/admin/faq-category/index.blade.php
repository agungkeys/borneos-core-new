@extends('layouts.app-admin')

@section('content')
    <div class="app-main__inner">
        <div class="app-page-title">
            <div class="page-title-wrapper">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-bookmarks icon-gradient bg-tempting-azure"></i>
                    </div>
                    <div>Category List Frequently Ask Question (FAQ) <span class="badge badge-pill badge-primary">{{ number_format($faq_categories->total(), 0, "", ".") }}</span></div>
                </div>
                <div class="page-title-actions">
                    <a href="#" class="btn-shadow btn btn-info btn-lg">Add Category</a>
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
                                    <input id="filter" name="filter" value="{{ $filter }}" placeholder="Search by Title" type="text" class="form-control" style="color: gray;" autocomplete="off">
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

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>@sortablelink('id', 'No')</th>
                                <th>Image</th>
                                <th>@sortablelink('title', 'Title')</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($faq_categories->count() == 0)
                                <tr>
                                    <td colspan="5">No FAQ Category to display</td>
                                </tr>
                            @endif

                            @foreach ($faq_categories as $faq)
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td>
                                        <img src="{{ $faq->image ? $faq->image : asset('images/default-image.jpg')  }}" alt="" width="32" height="32" style="object-fit: cover">
                                    </td>
                                    <td>{{ $faq->title }}</td>
                                    <td>{!! Str::limit($faq->description, 20) !!}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm"><i style="font-size: 14px" class="text-white pe-7s-note"></i></a>
                                        <button type="button" class="btn btn-danger btn-sm"><i style="font-size: 14px" class="pe-7s-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-12 col-md-6 flex-1">
                            {!! $faq_categories->appends(['sort' => request()->sort, 'direction' => request()->direction, 'filter' => request()->filter])->onEachSide(2)->links() !!}
                        </div>
                        <div class="col-12 col-md-6 w-100 d-flex justify-content-end align-middle">
                            <p>Displaying {{$faq_categories->count()}} of {{ number_format($faq_categories->total(), 0, "", ".") }} FAQ categories.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
