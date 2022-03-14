<center>
    @if (in_array(Auth::user()->role, [1]))
        <h5>- Users Data for Admin -</h5>
    @endif
    @if (in_array(Auth::user()->role, [2]))
        <h5>Employees Data - Cabang {{ Auth::user()->cabang->nama_cabang }} - </h5>
    @endif
</center>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>No. HP</th>

            @if (in_array(Auth::user()->role, [2]))
                <th>Address</th>
            @endif

            @if (in_array(Auth::user()->role, [1]))
                <th>Username</th>
                <th>Cabang</th>
                <th>Role</th>
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