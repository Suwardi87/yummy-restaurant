@extends('backend.template.main')
@section('title', 'Detail Video')

@section('content')

<div class="py-4">
    <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
        <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
            <li class="breadcrumb-item">
                <a href="#">
                    <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                </a>
            </li>
            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.video.index') }}">Gallery
                Video</a></li>
            <li class="breadcrumb-item active" aria-current="page">Detail Video {{ $video->name }}</li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Detail Video {{ $video->name }}</p>
        </div>
        @if (session('role') == 'operator')
        <div>
            <a href="{{ route('panel.video.index') }}" class="btn btn-outline-gray-600 d-inline-flex align-items-center">
               <i class="fas fa-arrow-left me-2"></i>
                back
            </a>
            <a href="{{ route('panel.video.edit', $video->uuid) }}" class="btn btn-primary d-inline-flex align-items-center">
                <i class="fas fa-edit me-2"></i>
                Edit
            </a>
        </div>
        @endif
    </div>
</div>

{{-- table  --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <iframe width="100%" height="150" src="{{ $video->video_link }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>
            <div class="col-md-8">
                <table class="table table-bordered">
                    <tr>
                        <th class="border-0">Name</th>
                        <td>{{ $video->name }}</td>
                    </tr>
                    <tr>
                        <th class="border-0">Slug</th>
                        <td>{{ $video->slug }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

