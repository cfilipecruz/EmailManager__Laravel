@can('admin')
@endcan
@can('viewEmails')
@endcan
{{route('$funcionario.delete', $funcionario->id)}}
