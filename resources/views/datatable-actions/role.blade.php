<div class="center action-buttons">
    <x-buttons.button-primary-outline title="Set Permission" class="btn-permission" data-id="{{ $query->id }}"><i class="ti ti-lock"></i> Set Permission</x-buttons.button-primary-outline>
    <x-buttons.button-primary title="Edit" class="btn-edit" data-id="{{ $query->id }}"><i class="ti ti-pencil"></i></x-buttons.button-primary>
    <x-buttons.button-danger title="Delete" class="btn-delete"><i class="ti ti-trash"></i></x-buttons.button-danger>
    <x-inputs.form action="{{ route('role.delete', $query->id) }}" method="POST" class="form-delete">@method('DELETE')</x-inputs.form>
</div>