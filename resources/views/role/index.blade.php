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
                        <input type="text" class="form-control search-datatable ps-5" id="input-search" placeholder="Search Role" autocomplete="false">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y fs-6 text-dark ms-3"></i>
                    </div>
                </div>
                <div class="col-md-8 col-xl-10 text-end d-flex justify-content-md-end justify-content-center mt-3 mt-md-0">
                    <x-buttons.button-primary data-bs-toggle="modal" data-bs-target="#modal-role" class="btn-add-role"><i class="ti ti-plus"></i>Add Role</x-buttons.button-primary>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            {{-- <table class="table border table-striped table-bordered text-nowrap role-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Role</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table> --}}
            {!! $dataTable->table(['class' => 'table border table-striped table-bordered text-nowrap role-datatable w-100']) !!}
        </div>
    </x-cards.card>

    <x-elements.modal id="modal-role" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-body">
            <x-inputs.form class="form-role">
                <div class="form-group">
                    <x-inputs.input id="name" name="name" label="Role Name" required/>
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
        <style>.dataTables_length,.dataTables_filter{display: none}</style>
    @endpush
    @push('script')
        <script src="{{ asset('templates/mdrnz/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        {!! $dataTable->scripts() !!}
        <script>
            let dtTable = '';
            $(function(){
                // $('.role-datatable').DataTable({
                //     "processing": true,
                //     "serverSide": true,
                //     "responsive": true,
                //     "language": {
                //         "processing": `<div class="shadow p-3"><div class="spinner-border spinner-border-sm text-primary" role="status"></div> Processing...</div>`,
                //     },
                // })
                dtTable = window.LaravelDataTables["role-table"]

                $('.btn-add-role').on('click', function(){
                    $('.modal-title').text('Add Role')
                })

                $('.btn-save').on('click', function(){
                    const t = $(this)
                    const form = t.closest('div.modal-content').find('form')
                    const id = t.data('id')
                    const actionUrl = id ? `${baseUrl}/role/${id}/edit` : `${baseUrl}/role`
                    let formData = new FormData(form[0]);

                    if (id) {
                        formData.append('_method', 'PUT')
                    }

                    if (!form[0].checkValidity()) {
                        return form[0].reportValidity()
                    }

                    $.ajax({
                        type: 'POST',
                        url: actionUrl,
                        data: formData,
                        contentType: false,
                        processData: false,
                        beforeSend: function() {
                            t.html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true)
                            form.find('.error-message').remove()
                        },
                        success: function(response) {
                            dtTable.ajax.reload()
                            $('.modal').modal('hide')

                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: response.message,
                            })
                        },
                        complete: function() {
                            t.html('<i class="ti ti-device-floppy"></i> Save').prop('disabled', false)
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function(i, item) {
                                        let attribute = `input[name="${i}"],select[name="${i}"],textarea[name="${i}"]`

                                        if (i.match(/\./g)) {
                                            attribute = `input[data-name="${i}"],select[data-name="${i}"],textarea[data-name="${i}"]`
                                        }

                                        form.find(attribute).closest('div').append(`<div class="w-100"><small class="error-message text-danger">${item}</small></div>`)
                                        
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: xhr.responseJSON.message,
                                        confirmButtonText: 'OK'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops!',
                                    text: '',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                })

                $('table.dataTable tbody').on('click', 'tr td .btn-edit', function(){
                    const t = $(this)

                    $.ajax({
                        type: 'POST',
                        url: `${baseUrl}/role/${t.data('id')}/edit`,
                        data: {id:t.data('id')},
                        beforeSend: function() {
                            t.html('<div class="spinner-border spinner-border-sm" role="status"></div>').prop('disabled', true)
                        },
                        success: function(response) {
                            $('.modal-title').text('Edit Role')
                            $('#modal-role').modal('show')

                            $.each(response.data, function(i, item) {
                                $('.modal form').find(`input[name=${i}]`).val(item)
                                $('.modal-content').find(`.btn-save`).attr('data-id', t.data('id'))
                            })
                        },
                        complete: function() {
                            t.html('<i class="ti ti-pencil"></i>').prop('disabled', false)
                        },
                        error: function(xhr, status, error) {
                            if (xhr.responseJSON) {
                                if (xhr.responseJSON.errors) {
                                    $.each(xhr.responseJSON.errors, function(i, item) {
                                        let attribute = `input[name="${i}"],select[name="${i}"],textarea[name="${i}"]`

                                        if (i.match(/\./g)) {
                                            attribute = `input[data-name="${i}"],select[data-name="${i}"],textarea[data-name="${i}"]`
                                        }

                                        $('form').find(attribute).closest('div').append(`<div class="w-100"><small class="error-message text-danger">${item}</small></div>`)
                                        
                                    })
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops!',
                                        text: xhr.responseJSON.message,
                                        confirmButtonText: 'OK'
                                    })
                                }
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops!',
                                    text: '',
                                    confirmButtonText: 'OK'
                                })
                            }
                        }
                    });
                })

                $('.modal').on('hidden.bs.modal', function () {
                    $('.modal form')[0].reset()
                    $('.modal-content').find('.btn-save').removeAttr('data-id')
                })

                $('form').on('submit', function(e){
                    e.preventDefault();
                    return false;
                })
            })
        </script>
    @endpush
</x-layouts.app>