<x-layouts.app>
    <x-slot:title>Customer</x-slot>
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Customer</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Customer</li>
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
                        <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search Customer" autocomplete="false" />
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                
                @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create customer')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-customer" class="btn-add-customer"><i class="ti ti-plus"></i>Add customer</x-buttons.button-primary>
                    </div>
                @endif
            </div>
        </div>
        <div class="table-responsive">
            {!! $dataTable->table(['class' => 'table align-middle text-nowrap customer-datatable w-100']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-customer" data-bs-backdrop="static" data-bs-keyboard="false" size="modal-xl">
    <div class="modal-body">
        <x-inputs.form class="form-customer">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <x-inputs.select
                        id="toko_id"
                        name="toko_id"
                        label="Nama Toko *"
                        class="select2"
                        :options="$toko"
                        :selected="old('toko_id')"
                        displayField="nama_toko"
                        required />
                           
            </div>


                <div class="col-md-6 mb-2">
                    <x-inputs.input id="name" name="name" class="" label="Name *" required />
                </div>

                <div class="col-md-6 mb-2">
                    <x-inputs.input id="phone" name="phone" class="" label="Phone *" required />
                </div>

                <div class="col-md-6 mb-2">
                    <x-inputs.input id="email" name="email" class="" label="Email *" required />
                </div>

                <div class="col-md-12 mb-2">
                    <x-inputs.input id="address" name="address" class="" label="Address *" required />
                </div>

                <div class="col-md-6 mb-2">
                    <label for="photo" class="form-label">Photo</label>
                    <x-inputs.input-file id="photo" name="photo" class="form-control" label="Photo" />
                    <img id="photo-preview" src="#" alt="Image Preview" class="img-thumbnail mt-2" style="display:none; max-width: 200px;" />
                </div>

                <div class="col-md-6 mb-2">
                    <x-inputs.input id="account_holder" name="account_holder" class="" label="Account Holder" />
                </div>

                <div class="col-md-6 mb-2">
                    <x-inputs.input id="account_number" name="account_number" class="" label="Account Number" />
                </div>

                <div class="col-md-6 mb-2">
                    <x-inputs.input id="bank_name" name="bank_name" class="" label="Bank Name" />
                </div>
            </div>
        </x-inputs.form>
    </div>
    <div class="modal-footer">
        <x-buttons.button-danger class="font-medium waves-effect" data-bs-dismiss="modal">Close</x-buttons.button-danger>
        <x-buttons.button-save-with-icon class="btn-save" />
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
        @vite('resources/js/page/customer.js')
    @endpush
</x-layouts.app>