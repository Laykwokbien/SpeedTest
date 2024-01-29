@extends('template.master')

@section('dashboard')
<div class="messages">
    @if (session()->has('messages'))
        @foreach (session('messages') as $col)
            @foreach ($col as $messages)
                <div class="warning danger">
                    {{ $messages }}
                </div>
            @endforeach
        @endforeach
    @else
        @if (session()->has('success'))
            <div class="warning success">
                {{ session('success') }}
            </div>
        @endif
    @endif
    @if ($page['delete'])
        <form class="container delete" action="" method="POST">
            @csrf
            <label for="delete">Are you sure wanna to delete this record?</label>
            <div class="selectionbtn">
                <button class="btn deletebtn danger" type="submit">Yes</button>
                <a href="/trains/create"><button class="btn deletebtn primary" type="button">No</button></a>
            </div>
        </form>
    @endif
</div>
    <div class="container unique flex-row">
        <form action="" method="post">
            @csrf
            <label for="" class="form-label">Grade: </label>
            <select name="grade_id">
                <option selected disabled hidden>Pilih Grade</option>
                @foreach ($page['grade'] as $row)
                    <option value="{{ $row['id'] }}">{{ $row['simbol'] }}</option>
                @endforeach
            </select>
            <label for="" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="name">
            <button type="submit" class="btn primary">Kirim Data</button>
        </form>
        <table>
            <thead>
                <th>#</th>
                <th>Grade</th>
                <th>Nama</th>
                <th>Updated</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($page['data'] as $row)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row->grade->simbol }}</td>
                    <td>{{ $row['name'] }}</td>
                    <td>{{ $row['updated_at'] }}</td>
                    <td>
                        <a href="/trains/update/{{ $row['id'] }}"><button class="btn primary">Edit</button></a>
                        <a href="/trains/delete/{{ $row['id'] }}"><button class="btn danger">Delete</button></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection