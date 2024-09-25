<x-layouts.app>
    <x-slot:title>Toko</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Toko</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Toko</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    <x-cards.card>
        <div class="mb-3">
            <div class="row">
                <div class="col-md-4 col-xl-2">
                    <div class="position-relative">
                        <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search Toko" autocomplete="false" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                
                @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create toko')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-toko" class="btn-add-toko"><i class="ti ti-plus"></i>Add toko</x-buttons.button-primary>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table align-middle text-nowrap toko-datatable w-100']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-toko" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-body">
            <x-inputs.form class="form-toko" >
                <div class="form-group mb-2">
                    <label for="" class="form-label">Logo</label>
                    <x-inputs.input-file id="logo" name="logo" class="form-control" label="Logo" />
                </div>
                <!-- logo-preview -->
                <div class="form-group mb-2">
                    <img src="" alt="" class="img-fluid img-thumbnail logo-preview"  id="logo-preview">
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="nama_toko" name="nama_toko" class="" label="Nama Toko" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="domisili" name="domisili" class="" label="Domisili" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="alamat_usaha" name="alamat_usaha" class="" label="Alamat Usaha" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="nohp" name="nohp" class="" label="Nohp" required/>
                </div>
            </x-inputs.form>
        </div>
        <div class="modal-footer">
            <x-buttons.button-danger class="font-medium waves-effect" data-bs-dismiss="modal">Close</x-buttons.button-danger>
            <x-buttons.button-save-with-icon class="btn-save"/>
        </div>
    </x-elements.modal>

    @push('css')
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/css/custom-datatables.css') }}">
        <style>.dataTables_length,.dataTables_filter{display: none}.dataTable{font-size: .83rem}.table > :not(caption) > * > * { padding: 10px 10px;}</style>
    @endpush
    @push('script')
        <script type="module" src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        @vite('resources/js/page/toko.js')
    @endpush
</x-layouts.app>