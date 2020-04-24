@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul class="m-l-20">
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif
