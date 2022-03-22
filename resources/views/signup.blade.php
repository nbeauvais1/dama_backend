@include('header')        
        <div>
            <h1>Register for a Membership!</h1>
            <form action="/signedin" method="POST">
                @csrf
                <label for="fname">First Name</label>
                <input type="text" id="fname" name="fname">
                <label for="lname">Last Name</label>
                <input type="text" id="lname" name="lname">
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
                <label for="type">Membership Type</label>
                <select name="type" id="type">
                    <option value="Individual">Individual</option>
                    <option value="Student">Student</option>
                    <option value="Corporate5">Corporate - 5 Accounts</option>
                    <option value="Corporate10">Corporate - 10 Accounts</option>
                    <option value="CorporateUnlimited">Corporate - Unlimited Accounts</option>
                </select>
                <label for="pfp">Profile Picture</label>
                <input type="file" id="pfp" name="pfp">
                <input type="submit" value="Sign Up!">
            </form>
        </div>
@include('footer')
