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
        @if (in_array(Auth::user()->role, [1]))
		    <h5>Branches Data -for Admin-</h5>
        @endif
        @if (in_array(Auth::user()->role, [2]))
		    <h5>Branches Data</h5>
        @endif
	</center>

	<table class='table table-bordered'>
		<thead>
			<tr>
                <th>Nama Cabang</th>

                @if (in_array(Auth::user()->role, [1]))
                    
                @endif
			</tr>
		</thead>
		<tbody>
			@foreach ($cabangs as $key => $cabang)
                <tr>
                    <td>{{ $cabang->nama_cabang }}</td>

                    @if (in_array(Auth::user()->role, [1]))
                        
                    @endif
                </tr>
            @endforeach
		</tbody>
	</table>

</body>
</html>
