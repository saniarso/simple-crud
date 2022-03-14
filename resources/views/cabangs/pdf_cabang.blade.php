<!DOCTYPE html>
<html>
<head>
	<title>Branches Data</title>
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
        <h5>Branches Data</h5>
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
                <th width="50px" class="text-center">Id</th>
                <th>Nama Cabang</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($cabangs as $key => $cabang)
                <tr>
                    <td class="text-center">{{ $cabang->id }}</td>
                    <td>{{ $cabang->nama_cabang }}</td>
                </tr>
            @endforeach
		</tbody>
	</table>

</body>
</html>
