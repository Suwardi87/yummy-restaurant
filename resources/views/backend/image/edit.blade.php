@extends('backend.template.main')

@section('title', 'Update Image')

@section('content')
<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.image.index') }}">Gallery
                    Image</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('panel.image.create') }}">@yield('title')</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Update Gambar Yummy restaurant </p>
        </div>
        <div>
            <a href="{{ route('panel.image.index') }}" class="btn btn-outline-primary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 mb-4">
        <div class="card border-0 shadow components-section">
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form action="{{ route('panel.image.update', $image->uuid) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Input Name -->
                    <div class="mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $image->name }}"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Input Description -->
                    <div class="my-2">
                        <label for="description">Description</label>
                        <textarea name="description" id="description"
                            class="form-control @error('description') is-invalid @enderror">{{ old('description', $image->description) }}</textarea>
                        @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                    <!-- Input File -->
                    <div class="mb-3">
                        <label for="file">File Image</label>
                        <input name="file" type="file" id="file" value="{{ $image->file }}"
                            class="form-control @error('file') is-invalid @enderror">
                        @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <div>
                            <img src="{{ asset('storage/'.$image->file) }}" width="100px" alt="{{ $image->name }}">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="float-end">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>


            </div>
        </div>
    </div>
</div>
@endsection
