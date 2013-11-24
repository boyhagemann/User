
<h1>Permissions</h1>
        
{{ Form::open(array('route' => 'user.permissions.save')) }}
        
@foreach($permissionRepository->getPermissions() as $title => $permissions)

<h2>{{ $title }}</h2>

<table class="table table-striped">
    
    <thead>
        <tr>            
            <th class="col-lg-4"></th>

            @foreach($groups as $group)

            <th>{{ $group->name }}</th>

            @endforeach
            
        </tr>
    </thead>

    <tbody>

        @foreach($permissions as $permission => $label)

        <tr>

            <td>{{ $label }}</td>

            @foreach($groups as $group)

            <td class="">{{ Form::checkbox($permission . '[]', $group->id, isset($permissions[$group->id]) && in_array($permission, $permissions[$group->id])) }}</td>

            @endforeach

        </tr>

        @endforeach
        
    </tbody>
</table>

<div class="row">
    <div class="col-lg-12">
        {{ Form::button('Save changes', array('type' => 'submit', 'class' => 'btn btn-large btn-primary')) }}
    </div>
</div>
        
@endforeach

{{ Form::close() }}