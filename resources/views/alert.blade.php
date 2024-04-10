@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-error" style="background-color: red; font-size: 16px; color: white">
        {{ session('error') }}
    </div>
@endif


@if (Session::has('success'))
    <div class="alert alert-success" style="background-color: green; font-size: 16px; color: white">   
        {{ Session::get('success') }}
    </div>
@endif