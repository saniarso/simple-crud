<!DOCTYPE html>
<html>
<head>
	<title>Employees Data</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>

	<center>
        @if (in_array(Auth::user()->role, [1]))
		    <h5>- Users Data for Admin -</h5>
        @endif
        @if (in_array(Auth::user()->role, [2]))
		    <h5>Employees Data - Cabang {{ Auth::user()->cabang->nama_cabang }} - </h5>
        @endif
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
                <th width="150px">Name</th>
                <th>Email</th>
                <th width="50px">No. HP</th>

                @if (in_array(Auth::user()->role, [2]))
                    <th>Address</th>
                @endif

                @if (in_array(Auth::user()->role, [1]))
                    <th>Username</th>
                    <th width="50px">Cabang</th>
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

</body>
</html>
