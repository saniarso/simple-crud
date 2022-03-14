<h3>Branches Data</h3>

<table>
    <thead>
        <tr>
            <th width="50px" class="text-center">Id</th>
            <th>Nama Cabang</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($cabangs as $key => $cabang)
            <tr>
                <td>{{ $cabang->id }}</td>
                <td>{{ $cabang->nama_cabang }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
