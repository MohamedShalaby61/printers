@if(Session::has('message'))
    <p class="alert {{ Session::get('alert-class', 'alert-info') }}" style="font-size: 12px;">{{ Session::get('message') }}</p>
@endif
