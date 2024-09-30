<x-layouts.app>
    <x-slot:title>Unit</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Unit</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Unit</li>
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
                        <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search Unit" autocomplete="false" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                
                @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create unit')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-unit" class="btn-add-unit"><i class="ti ti-plus"></i>Add unit</x-buttons.button-primary>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table align-middle text-nowrap unit-datatable w-100']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-unit" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-body">
            <x-inputs.form class="form-unit">
            <div class="form-group mb-2">
                @if (auth()->user()->hasRole('superadmin'))
                    <x-inputs.select 
                        id="toko_id" 
                        name="toko_id" 
                        label="Nama Toko" 
                        :options="$toko" 
                        displayField="nama_toko" 
                        required
                    />
                @else
                    <x-inputs.input type="hidden" id="toko_id" name="toko_id" value="{{ auth()->user()->toko_id }}" />
                @endif

                <div class="form-group mb-2">
                    <x-inputs.input id="name" name="name" class="" label="Name" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="slug" name="slug" class="" label="Slug" required/>
                </div>
                <div class="form-group mb-2">
                    <x-inputs.input id="short_code" name="short_code" class="" label="Short Code" required/>
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
    <script>
    var isSuperAdmin = `@json(auth()->user()->hasRole('superadmin'))`;
    console.log(isSuperAdmin);
    $(document).ready(function() {
    var table = $('.unit-datatable').DataTable();

    if (isSuperAdmin) {
        table.column(2).visible(true);
    } else {
   
        table.column(2).visible(false);
    }
   
});
</script>


        <script type="module" src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

        @vite('resources/js/page/unit.js')
    @endpush
</x-layouts.app>