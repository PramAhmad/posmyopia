<x-layouts.app>
    <x-slot:title>Role</x-slot>
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Role</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a class="text-muted" href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item" aria-current="page">Role</li>
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
                        <input type="text" class="form-control search ps-5" id="input-search" placeholder="Search Role" autocomplete="false">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <x-buttons.button-primary><i class="ti ti-plus"></i>Add Role</x-buttons.button-primary>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table border table-striped table-bordered text-nowrap role-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </x-cards.card>

    @push('css')
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}">
        <link rel="stylesheet" href="{{ asset('templates/mdrnz/css/custom-datatables.css') }}">
        <style>.dataTables_length,.dataTables_filter{display: none}</style>
    @endpush
    @push('script')
        <script src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script>
            $(function(){
                $('.role-datatable').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "responsive": true,
                    "language": {
                        "processing": `<div class="shadow p-3"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Processing...</div>`,
                    },
                })
            })
        </script>
    @endpush
</x-layouts.app>