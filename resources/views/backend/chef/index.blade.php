@extends('backend.template.main')

@section('title', 'Gallery Chef')

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
            <li class="breadcrumb-item active" aria-current="page"><a
                    href="{{ route('panel.chef.index') }}">@yield('title')</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">Daftar Gambar Chef Yummy restaurant</p>
        </div>
        @if (auth()->user()->role == 'operator')
        <div>
            <a href="{{ route('panel.chef.create') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i>
                Create Chef
            </a>
        </div>
        @endif
    </div>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- table --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap table-hover rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">No</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Position</th>
                        <th class="border-0">Description</th>
                        <th class="border-0">Photo</th>
                        <th class="border-0">Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($chefs as $key => $chef)
                    <tr>
                        <td width="5%">{{ $key + 1 }}</td>
                        <td>{{ $chef->name }}</td>
                        <td>{{ $chef->position }}</td>
                        <td>{{ Str::limit($chef->description, 10) }}</td>
                        <td width="20%" height="20%">
                            <img src="{{ asset('storage/' . $chef->photo) }}" alt="Gambar tidak ada" target="_blank">
                        </td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('panel.chef.show', $chef->uuid) }}" class="btn btn-success"><i
                                        class="fas fa-eye"></i></a>
                            @if (auth()->user()->role == 'operator')
                            <a href="{{ route('panel.chef.edit', $chef->uuid) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            @endif
                            @if (auth()->user()->role == 'operator')
                            <button class="btn btn-danger" onclick="deleteChef(this)" data-uuid="{{ $chef->uuid }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3">
                {{ $chefs->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection

@stack('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const deleteChef = (e) => {
            let uuid = e.getAttribute('data-uuid');
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: `{{ route('panel.chef.destroy', '') }}/${uuid}`,
                        type: 'DELETE',
                        success: function(data) {
                            Swal.fire({
                                title: "Deleted!",
                                text: data.message,
                                icon: "success",
                                showConfirmButton: false
                            });
                            window.location.reload();
                        }
                    }).fail(function() {
                        Swal.fire({
                            title: "Error!",
                            text: data.message,
                            icon: "error"
                        });
                    });
                }
            });
        }
</script>

