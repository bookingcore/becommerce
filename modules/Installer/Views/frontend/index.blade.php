@extends('Layout::installer')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="logo"></div>
        <div class="card" >
            <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <form method="post" action="{{route('installer.save_db')}}">
                    @csrf
                    <div class="vstack gap-3">
                        <div class="row g-3 align-items-center">
                            <div class="col-auto">
                                <label for="inputPassword6" class="col-form-label">Database Name</label>
                            </div>
                            <div class="col-auto">
                                <input type="password" id="inputPassword6" class="form-control" aria-describedby="passwordHelpInline">
                            </div>
                            <div class="col-auto">
        <span id="passwordHelpInline" class="form-text">
          Must be 8-20 characters long.
        </span>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
