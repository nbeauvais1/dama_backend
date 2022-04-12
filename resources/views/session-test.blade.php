@include('header')

  
    @endif
    <form action="/session-test" method="POST">
        @csrf <!-- {{ csrf_field() }} --> 

        <label for="email_post">Password: </label>
        <input type="email" name="email_post" id="email_post" placeholder="Email">

        <a href="/forget-password">Forgot Password</a>

        <label for="password_post">Password: </label>
        <input type="password" name="password_post" id="password_post" placeholder="Password">

        <input type="submit" value="Sign In!">
    </form>
</body>
@include('footer')