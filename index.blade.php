<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.1/datatables.min.css" rel="stylesheet">
</head>

<body>

    {{-- navbar --}}
    <nav
        class="navbar  sticky-top navbar-expand-lg bg-warning animate__animated  animate__backInDown animate__delay-.1s">
        <div class="container">
            <a class="navbar-brand fw-bold text-white" href="#">
                <img src="{{ asset('assets/smk17.png') }}" alt="INI IMAGE WEB PRODUK" width="30" height="24"
                    class="d-inline-block align-text-top">
                Web Produk
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto gap-3">
                    <li class="nav-item">
                        <a class="nav-link  text-white" aria-current="page" href="{{ route('produk.index') }}"><i
                                class="bi bi-house-door-fill"></i>Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('produk.create') }}"><i
                                class="bi bi-bag-plus-fill"></i>Tambah Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('kategori.index') }}"><i
                                class="bi bi-bag-plus-fill"></i>Tambah Kategori</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    {{-- navbar end --}}
    <h1 class="fw-bold text-center">halaman Kategori</h1>
    {{-- card jumlah  --}}
    <h2 class="fw-bold text-center">Jumlah Data</h2>
    <div class="container d-flex justify-content-evenly">
        <div class="card" style="width: 10rem;">
            <img src="{{ asset('assets/smk17.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Produk</h5>
                <p class="card-text">{{ $prodata }}</p>
            </div>
        </div>
        <div class="card" style="width: 10rem;">
            <img src="{{ asset('assets/photo.png') }}" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Kategori</h5>
                <p class="card-text">{{ $katdata }}</p>
            </div>
        </div>
    </div><br>
    {{-- card jumlah end --}}
    {{-- form kategori --}}
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        {{-- tombol modal add kategori  --}}
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modaladd">
            Tambah Data Kategori
        </button>
        {{-- tombol modal add kategori end --}}
        <table id="dt" class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center fw-bold">No</th>
                    <th class="text-center fw-bold">Nama Kategori</th>
                    <th class="text-center fw-bold">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($kategoris as $kategori)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td class="text-center">{{ $kategori->nama_kategori }}</td>
                        <td class="text-center">
                            <a href="{{ route('kategori.show', $kategori->id) }}" class="btn btn-info btn-sm">Show</a>
                            <a href="{{ route('kategori.edit', $kategori->id) }}"
                                class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">Tidak ada data.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    </div>
    {{-- form kategori end --}}

    {{-- modal add data kategori --}}
    <div class="modal fade" id="Modaladd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Kategori</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('kategori.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">Nama Kategori</label>
                            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control"
                                value="{{ old('nama_kategori') }}">
                            @error('nama_kategori')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    {{-- modal add data kategori end --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/dt-2.2.1/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#dt').DataTable();
        });
    </script>
</body>

</html>
