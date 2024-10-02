@extends('backend.template.main')
@section('title', 'Gallery Image')

@section('content')
    
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.image.index') }}">@yield('title')</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Daftar Gambar Yummy restaurant</p>
        </div>
        <div>
            <a href="{{ route('panel.image.create') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
               <i class="fas fa-plus me-2"></i>
                Create Image
            </a>
        </div>
    </div>
</div>

{{-- table  --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap table-hover table-nowrap mb-0 rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">No</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Slug</th>
                        <th class="border-0">Description</th>
                        <th class="border-0">File</th>
                        <th class="border-0">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($images as $image)
                    <tr>
                        <td>{{ ($images->currentPage() - 1) * $images->perPage() + $loop->iteration }}</td>
                        <td>{{ $image->name }}</td>
                        <td>{{ $image->slug }}</td>
                        <td>{{ $image->description }}</td>
                        <td width="20%" height="20%">
                            <img src="{{ asset('storage/'.$image->file) }}" alt="Gambar tidak ada"  target="_blank">
                        </td>
                        <td>
                            <a href="{{ route('panel.image.edit', $image->slug) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('panel.image.destroy', $image->slug) }}" method="post" class="d-inline">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
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