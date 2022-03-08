<!DOCTYPE html>
<html>
<head>
	<title>Membuat Laporan PDF Dengan DOMPDF Laravel</title>
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
		<h5>Daftar Karyawan - CRUD TEST -</h4>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
                @if (in_array(Auth::user()->role, [1]))
                    <th>Role</th>
                @endif

                <th>Name</th>
				<th>Email</th>
				<th>No. HP</th>
				<th>Address</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($users as $key => $user)
                <tr>
                    @if (in_array(Auth::user()->role, [1]))
                        <td>{{ config('custom.role.' .$user->role) }}</td>
                    @endif

                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->no_hp }}</td>
                    <td>{{ $user->address }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>

</body>
</html>
