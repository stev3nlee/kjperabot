@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif @if(session()->has('flash_message'))
<div class="alert alert-{{ Session::get('flash_message_level') }}">
    {{ Session::get('flash_message') }}
</div>
@endif
