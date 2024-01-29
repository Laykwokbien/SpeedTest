@extends('template.master')

@section('dashboard')
    <div class="container justify-content-center align-items-center">
        <form action="" method="post">
            @csrf
            <label for="" class="form-label">Grade: </label>
            <select name="grade_id">
                <option selected disabled hidden>Pilih Grade</option>
                @foreach ($page['grade'] as $row)
                    <option @if ($row['id'] == $id['grade_id']) {{ 'selected' }} @endif value="{{ $row['id'] }}">{{ $row['simbol'] }}</option>
                @endforeach
            </select>
            <label for="" class="form-label">Nama:</label>
            <input type="text" class="form-control" name="name" value="{{ $id->name }}">
            <button type="submit" class="btn primary">Kirim Data</button>
        </form>
    </div>
@endsection