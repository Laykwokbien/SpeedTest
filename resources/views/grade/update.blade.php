@extends('template.master')

@section('dashboard')
    <div class="container justify-content-center align-items-center">
        <form action="" method="post">
            @csrf
            <label for="" class="form-label">Simbol:</label>
            <input type="text" name="simbol" class="form-control" value="{{ $id['simbol'] }}">
            <label for="" class="form-label">Maksimal Kecepatan:</label>
            <input type="number" name="max_speed" class="form-control" value="{{ $id['max_speed'] }}">
            <button type="submit" class="btn primary">Kirim Data</button>
        </form>
    </div>
@endsection