@extends('backend.template.main')

@section('title', 'Create Chef')

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
            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.chef.index') }}">List Chef</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('panel.chef.create') }}">@yield('title')</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Create List Chef Yummy restaurant </p>
        </div>
        <div>
            <a href="{{ route('panel.chef.index') }}" class="btn btn-outline-primary"><i
                    class="fas fa-arrow-left me-1"></i> Back</a>
        </div>
    </div>
</div>
                <form action="{{ route('panel.chef.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Input Name -->
                    <div class="mb-4">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                        @error('name')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Input Photo -->
                            <div class="mb-3">
                                <label for="photo">Photo</label>
                                <input name="photo" type="file" class="form-control @error('photo') is-invalid @enderror">
                                @error('photo')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <!-- Input Position -->
                            <div class="mb-4">
                                <label for="position">Position</label>
                                <select name="position" class="form-select @error('position') is-invalid @enderror">
                                    <option value="">-- select position --</option>
                                    <option value="master chef" {{ old('position') == 'master chef' ? 'selected' : '' }}>Master Chef</option>
                                    <option value="patissier" {{ old('position') == 'patissier' ? 'selected' : '' }}>Patissier</option>
                                    <option value="chef" {{ old('position') == 'chef' ? 'selected' : '' }}>Chef</option>
                                </select>
                                @error('position')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Input Description -->
                    <div class="mb-4">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Input Instagram Link -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="instagram_link">Instagram Link</label>
                                <input type="text" name="instagram_link" class="form-control @error('instagram_link') is-invalid @enderror" value="{{ old('instagram_link') }}">
                                @error('instagram_link')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Input LinkedIn Link -->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="linkedin_link">LinkedIn Link</label>
                                <input type="text" name="linkedin_link" class="form-control @error('linkedin_link') is-invalid @enderror" value="{{ old('linkedin_link') }}">
                                @error('linkedin_link')
                                <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
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

