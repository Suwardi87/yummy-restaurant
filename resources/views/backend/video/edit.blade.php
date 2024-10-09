@extends('backend.template.main')

@section('title', 'Edit Video')

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
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.video.index') }}">Gallery
                    Video</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('panel.video.edit', $video->uuid) }}">Edit Video</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Edit video Yummy restaurant </p>
        </div>
        <div>
            <a href="{{ route('panel.video.index') }}" class="btn btn-outline-primary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('panel.video.update', $video->uuid) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $video->name) }}">
                @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="video_link" class="form-label">Video Link</label>
                <input type="url" name="video_link" class="form-control @error('video_link') is-invalid @enderror"
                    value="{{ old('video_link', $video->video_link) }}">
                @error('video_link')
                <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mt-3">
                <iframe width="50%" height="30%" src="{{ $video->video_link }}" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>

            <div class="float-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>

@endsection

