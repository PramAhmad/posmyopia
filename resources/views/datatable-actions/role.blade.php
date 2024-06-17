<div class="center action-buttons">
    @if ($query->name !== 'superadmin')
        <a href="{{ route('role.permission', $query->id) }}" title="Set Permission" class="btn btn-outline-primary" data-id="{{ $query->id }}"><i class="ti ti-lock"></i> Set Permission</a>
    @endif
    <x-buttons.button-primary title="Edit" class="btn-edit" data-id="{{ $query->id }}"><i class="ti ti-pencil"></i></x-buttons.button-primary>
    <x-buttons.button-danger title="Delete" class="btn-delete"><i class="ti ti-trash"></i></x-buttons.button-danger>
    <x-inputs.form action="{{ route('role.delete', $query->id) }}" method="POST" class="form-delete">@method('DELETE')</x-inputs.form>
</div>