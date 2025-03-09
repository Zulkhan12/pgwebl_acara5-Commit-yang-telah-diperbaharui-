@extends('layout.template')

@section('content')
<h1>Data Mahasiswa</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Kelas</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Hans</td>
            <td>21012344</td>
            <td>B</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Jett</td>
            <td>21012345</td>
            <td>A</td>
        </tr>
        <tr>
            <td>3</td>
            <td>Phoenix</td>
            <td>21012346</td>
            <td>C</td>
        </tr>
        <tr>
            <td>4</td>
            <td>Sage</td>
            <td>21012347</td>
            <td>B</td>
        </tr>
        <tr>
            <td>5</td>
            <td>Reyna</td>
            <td>21012348</td>
            <td>A</td>
        </tr>
    </tbody>
</table>
@endsection
