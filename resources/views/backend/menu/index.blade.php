@extends('backend.template.main')
@section('title', 'Menu List')

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
                    href="{{ route('panel.image.index') }}">@yield('title')</a></li>
        </ol>
    </nav>
    <div class="d-flex justify-content-between w-100 flex-wrap">
        <div class="mb-3 mb-lg-0">
            <h1 class="h4">@yield('title')</h1>
            <p class="mb-0">List Menu Yummy restaurant</p>
        </div>
        @if (session('role') == 'operator')
        <div>
            <a href="{{ route('panel.menu.create') }}"
                class="btn btn-outline-gray-600 d-inline-flex align-items-center">
                <i class="fas fa-plus me-2"></i>
                Create Menu
            </a>
        </div>
        @endif
    </div>
</div>
@session('success')
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endsession

{{-- table --}}
<div class="card border-0 shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-centered table-nowrap table-hover rounded">
                <thead class="thead-light">
                    <tr>
                        <th class="border-0 rounded-start">No</th>
                        <th class="border-0">Name</th>
                        <th class="border-0">Category</th>
                        <th class="border-0">Price</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">File</th>
                        <th class="border-0">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($menus as $menu)
                    <tr>
                        <td>{{ ($menus->currentPage() - 1) * $menus->perPage() + $loop->iteration }}</td>
                        <td>{{ $menu->name }}</td>
                        <td>{{ $menu->category->title }}</td>
                        <td>Rp. {{ number_format($menu->price, 0, ',', '.') }}</td>
                        <td>
                            @if ($menu->status == 'active')
                            <span class="badge bg-success">Active</span>
                            @else
                            <span class="badge bg-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <img src="{{ asset('storage/' . $menu->photo) }}" alt="Gambar tidak ada" target="_blank">
                        </td>
                        <td>
                            <a href="{{ route('panel.menu.show', $menu->uuid) }}" class="btn btn-success"><i
                                    class="fas fa-eye"></i></a>
                            @if (session('role') == 'operator')
                            <a href="{{ route('panel.menu.edit', $menu->uuid) }}" class="btn btn-primary"><i
                                    class="fas fa-edit"></i></a>
                            <button class="btn btn-danger" onclick="deleteMenu(this)" data-uuid="{{ $menu->uuid }}">
                                <i class="fas fa-trash"></i>
                            </button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">
                            Data tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="d-flex justify-content-end mt-3">
                {{ $menus->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>

@endsection

@stack('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const deleteMenu = (e) => {
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
                        url: `{{ route('panel.menu.destroy', '') }}/${uuid}`,
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

