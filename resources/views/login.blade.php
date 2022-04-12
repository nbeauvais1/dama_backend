@include('header')

    <form action="/login" method="POST">
        @csrf <!-- {{ csrf_field() }} --> 

        <label for="email">Email: </label>
        <input type="email" name="email" id="email" placeholder="Email">
        @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
        @endif   

        <a href="/forget-password">Forgot Password</a>

        <label for="password">Password: </label>
        <input type="password" name="password" id="password" placeholder="Password">
        @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
        @endif   

        <input type="submit" value="Sign In!">
    </form>
</body>
@include('footer')