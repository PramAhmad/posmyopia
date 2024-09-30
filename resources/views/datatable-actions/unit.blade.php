<div class="center action-buttons">
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('edit unit')))
        <x-buttons.button-primary title="Edit" class="btn-edit" data-id="{{ $query->id }}"><i class="ti ti-pencil"></i></x-buttons.button-primary>
    @endif
    @if ((auth()->user()->hasRole('superadmin')) | (auth()->user()->hasPermissionTo('delete unit')))
        <x-buttons.button-danger title="Delete" class="btn-delete"><i class="ti ti-trash"></i></x-buttons.button-danger>
        <x-inputs.form action="{{ route('unit.delete', $query->id) }}" method="POST" class="form-delete">@method('DELETE')</x-inputs.form>
    @endif
</div>