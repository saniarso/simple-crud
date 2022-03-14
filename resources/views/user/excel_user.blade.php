@if (in_array(Auth::user()->role, [1]))
    <h3>Users Data for Admin</h3>
@endif
@if (in_array(Auth::user()->role, [2]))
    <h3>Employees Data - Cabang {{ Auth::user()->cabang->nama_cabang }}</h3>
@endif

<table>
    <thead>
        <tr>
            <th width="200px"><b>Name</b></th>
            <th width="200px"><b>Email</b></th>
            <th width="100px"><b>No. HP</b></th>

            @if (in_array(Auth::user()->role, [2]))
                <th  width="300px"><b>Address</b></th>
            @endif

            @if (in_array(Auth::user()->role, [1]))
                <th width="100px"><b>Username</b></th>
                <th width="100px"><b>Cabang</b></th>
                <th width="50px"><b>Role</b></th>
            @endif
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $key => $user)
            <tr>
                <td>{{ @$user->name }}</td>
                <td>{{ @$user->email }}</td>
                <td>{{ @$user->no_hp }}</td>

                @if (in_array(Auth::user()->role, [2]))
                    <td>{{ @$user->address }}</td>
                @endif

                @if (in_array(Auth::user()->role, [1]))
                    <td>{{ @$user->username }}</td>
                    <td>{{ @$user->cabang->nama_cabang }}</td>
                    <td>{{ config('custom.role.' .@$user->role) }}</td>
                @endif
            </tr>
        @endforeach
    </tbody>
</table>
