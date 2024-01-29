@extends('template.master')

@section('dashboard')
    <div class="container index">
        <div class="desc">
            <h1>Grade o'Trains</h1>
            <p>Grading Trains was never as easy as this</p>
        </div>
        <div class="selectbtn">
            <a href="/grade/create"><button class="btn primary">Make a Grade</button></a>
            <a href="/trains/create"><button class="btn primary">Make a List of Trains</button></a>
        </div>
    </div>
@endsection