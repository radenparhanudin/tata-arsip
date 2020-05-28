

@hasrole('administrator')
<li class="{{ set_active('user.index') }}">
    <a href="{{ route('user.index') }}">
        <i class="material-icons">person</i>
        <span>Manajemen Users</span>
    </a>
</li>
@endhasrole
