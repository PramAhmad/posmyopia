<x-layouts.app>
    <x-slot:title>Product</x-slot>
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Product</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item" aria-current="page">Product</li>
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
                            <x-inputs.input type="text" class="search-datatable ps-5" id="input-search" placeholder="Search Product" autocomplete="false" />
                            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                        </div>
                    </div>

                    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('create product')))
                    <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                        <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-product" class="btn-add-product"><i class="ti ti-plus"></i>Add product</x-buttons.button-primary>
                    </div>
                    @endif
                </div>
            </div>
            <div class="table-responsive">
                {!! $dataTable->table(['class' => 'table align-middle text-nowrap product-datatable w-100']) !!}
            </div>
        </x-cards.card>

        <x-elements.modal id="modal-product" data-bs-backdrop="static" data-bs-keyboard="false" size="modal-xl">
    <div class="modal-body">
        <x-inputs.form class="form-product">
            <div class="row">
                <!-- Left Column -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <label for="image" class="form-label fw-semibold">Image Product</label>
                        <x-inputs.input-file id="image" name="image" class="form-control" label="Image" />
                    </div>
                </div>
                
                <!-- Right Column -->
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        @if (auth()->user()->hasRole('superadmin'))
                            <x-inputs.select
                                id="toko_id"
                                name="toko_id"
                                label="Nama Toko"
                                :options="$toko"
                                displayField="nama_toko"
                                required />
                            
                        @else

                            <label for="" class="form-label fw-semibold">Nama Toko</label>
                       <input type="text" disabled value="{{$toko->nama_toko}}" class="form-control">
                        @endif
                    </div>
                </div>
            </div>
            
                <div class="form-group mb-2">
                    <img src="" alt="" class="  image-preview"  height="100px"  id="image-preview">
                </div>
             
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.select
                            id="category_id"
                            name="category_id"
                            label="Nama Category"
                            :options="$category"
                            displayField="name"
                            required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                    <div class="form-group mb-2">
                        <x-inputs.select
                            id="unit_id"
                            name="unit_id"
                            label="Unit"
                            :options="$unit"
                            displayField="name"
                            required />
                    </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="name" name="name" class="" label="Name" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="slug" name="slug" class="" label="Slug" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="code" name="code" class="" label="Code" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="quantity" name="quantity" class="" label="Quantity" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="buying_price" name="buying_price" class="" label="Buying Price" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="selling_price" name="selling_price" class="" label="Selling Price" required />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="quantity_alert" name="quantity_alert" class="" label="Quantity Alert" required />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group mb-2">
                        <x-inputs.input id="tax" name="tax" class="" label="Tax" />
                    </div>
                </div>
            </div>

            <div class="form-group mb-2">
                <x-inputs.input id="notes" name="notes" class="" label="Notes" />
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
        <style>
            .dataTables_length,
            .dataTables_filter {
                display: none
            }

            .dataTable {
                font-size: .83rem
            }

            .table> :not(caption)>*>* {
                padding: 10px 10px;
            }
        </style>
        @endpush
        @push('script')
        <script type="module" src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
        @vite('resources/js/page/product.js')
        @endpush
</x-layouts.app>