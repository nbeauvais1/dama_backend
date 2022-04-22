@include('header')
    <form action="/remove-email" method="POST">
        @csrf

    <label for="email">Unsubscribe from Email List</label>
    <input type="email" name="email" id="email">
    @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
    @endif

    <input type="submit" value="Join Now">


    </form>
@include('footer')        