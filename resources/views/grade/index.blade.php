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
        @if (session()->has('delete'))
            <div class="warning danger">
                {{ session('delete') }}
            </div>
        @endif
        @if ($page['delete'])
            <form class="container delete" action="" method="POST">
                @csrf
                <label for="delete">Are you sure wanna to delete this record?</label>
                <div class="selectionbtn">
                    <button class="btn deletebtn danger" type="submit">Yes</button>
                    <a href="/grade/create"><button class="btn deletebtn primary" type="button">No</button></a>
                </div>
            </form>
        @endif
    </div>
    <div class="container unique flex-row">
        <form action="" method="post">
            @csrf
            <label for="" class="form-label">Simbol:</label>
            <input type="text" name="simbol" class="form-control" autocomplete="off">
            <label for="" class="form-label">Maksimal Kecepatan:</label>
            <input type="number" name="max_speed" class="form-control">
            <button type="submit" class="btn primary" @if ($page['delete']) {{ 'disabled' }} @endif>Kirim
                Data</button>
        </form>
        <table>
            <thead>
                <th>#</th>
                <th>Simbol</th>
                <th>Maksimal Kecepatan</th>
                <th>Updated</th>
                <th>Aksi</th>
            </thead>
            @foreach ($page['data'] as $row)
                <tbody>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $row['simbol'] }}</td>
                    <td>{{ $row['max_speed'] }}</td>
                    <td>{{ $row['updated_at'] }}</td>
                    <td>
                        <a href="/grade/update/{{ $row['id'] }}"><button class="btn primary">Edit</button></a>
                        <a  href="/grade/delete/{{ $row['id'] }}"><button class="btn danger">Delete</button></a>
                    </td>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection
