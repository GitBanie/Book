<!-- Message de confirmation de vote -->
@if(Session::has('message'))
    <div class="alert alert-success">
        <p>{{Session::get('message')}}</p>
    </div>
@endif
