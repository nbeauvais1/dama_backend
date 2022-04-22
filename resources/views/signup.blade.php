@include('header')      
<?php $user_id = session('session_user_id'); ?>  
@if(!$user_id)

<h2>Register for a Membership!</h2>
<form action="/signedin" method="POST">
    @csrf
    <label for="fname">First Name</label>
    <input type="text" id="fname" name="fname">
    @if ($errors->has('fname'))
        <span class="error">{{ $errors->first('fname') }}</span>
    @endif


    <label for="lname">Last Name</label>
    <input type="text" id="lname" name="lname">
    @if ($errors->has('lname'))
        <span class="error">{{ $errors->first('lname') }}</span>
    @endif

    <label for="email">Email</label>   
    <input type="email" id="email" name="email">
    @if ($errors->has('email'))
        <span class="error">{{ $errors->first('email') }}</span>
    @endif

    <label for="password">Password</label>
    <input type="password" id="password" name="password">
    @if ($errors->has('password'))
        <span class="error">{{ $errors->first('password') }}</span>
    @endif

    <label for="type">Membership Type</label>
    <select name="type" id="type">
        <option value="Individual">Individual</option>
        <option value="Student">Student</option>
        <option value="Corporate5">Corporate - 5 Accounts</option>
        <option value="Corporate10">Corporate - 10 Accounts</option>
        <option value="CorporateUnlimited">Corporate - Unlimited Accounts</option>
    </select>
    @if ($errors->has('type'))
        <span class="error">{{ $errors->first('type') }}</span>
    @endif

    <div class="corporate_name_toggle hidden">
        <label for="corporate_name">Company Name</label>
        <input type="text" id="corporate_name" name="corporate_name">
        @if ($errors->has('corporate_name'))
            <span class="error">{{ $errors->first('corporate_name') }}</span>
    @endif
    </div>
    <input type="checkbox" id="email_list" name="email_list">
    <label for="email_list">Yes, I would like to join the email list.</label>
    <script>
        var membershipType = document.getElementById('type');
        var corporateNameToggle = document.querySelector(".corporate_name_toggle");
        console.log(membershipType.value);
        
        membershipType.addEventListener('change', (event) => {
            if(membershipType.value == 'Student' || membershipType.value == 'Individual'){
                corporateNameToggle.classList.add("hidden");
                }
            else if (membershipType.value == 'Corporate5' || membershipType.value == 'Corporate10' || membershipType.value == 'CorporateUnlimited'){
                corporateNameToggle.classList.remove("hidden");
            }

        });
    </script>
    <input type="submit" value="Sign Up!">
    
</form>

@else
    <h2>Active Memberships</h2>
    <?php
       
        $current_date = date('Y-m-d H:i:s');

        $user_memberships = DB::table('user_membership')
                    ->join('membership', 'membership.membership_id', '=', 'user_membership.membership_id')
                    ->select('*')
                    ->where('user_id', '=', $user_id)
                    ->where('user_membership.membership_id', '!=', 6)
                    ->where('expiry_date', '>=', $current_date)
                    ->get();

        $corporate_memberships = DB::table('user_membership')
                    ->join('membership', 'membership.membership_id', '=', 'user_membership.membership_id')
                    ->select('*')
                    ->where('user_id', '=', $user_id)
                    ->where('user_membership.membership_id', '=', 6)
                    ->where('expiry_date', '>=', $current_date)
                    ->get();

        $user_memberships_expired = DB::table('user_membership')
                    ->join('membership', 'membership.membership_id', '=', 'user_membership.membership_id')
                    ->select('*')
                    ->where('user_id', '=', $user_id)
                    ->where('user_membership.membership_id', '!=', 6)
                    ->where('expiry_date', '<', $current_date)
                    ->get();
    ?>
        @foreach($user_memberships as $user_membership)
        
          <div class="card">
                <h3>Membership Type: {{$user_membership->membership_type}} @if($user_membership->corporate_name) - {{$user_membership->corporate_name}} @endif</h3>
                <ul>
                    <li>Effective Date: <?php echo $user_membership->effective_date; ?></li>
                    <li>Expiry Date: <?php echo $user_membership->expiry_date; ?></li>
                    <li>Membership Price: $<?php echo $user_membership->membership_price; ?></li>
                    <li>Membership Discount: <?php echo $user_membership->membership_discount; ?></li>
                </ul>
                <a href="renew-membership?id={{$user_membership->user_membership_id}}"  class="button">Renew</a>
            </div>
        @endforeach

        @if($corporate_memberships->count() > 0)
        <h2>Active Corporate Memberships</h2>
            @foreach($corporate_memberships as $corporate_membership)
        
          <div class="card">
                <h3>Membership Type: {{$corporate_membership->membership_type}} @if($corporate_membership->corporate_name) - {{$corporate_membership->corporate_name}} @endif</h3>
                <ul>
                    <li>Effective Date: <?php echo $corporate_membership->effective_date; ?></li>
                    <li>Expiry Date: <?php echo $corporate_membership->expiry_date; ?></li>
                </ul>
            </div>
            @endforeach
        @endif

        @if($user_memberships_expired->count() > 0)
        <h2>Expired Memberships</h2>
            @foreach($user_memberships_expired as $user_membership)
        
          <div class="card">
                <h3>Membership Type: {{$user_membership->membership_type}} @if($user_membership->corporate_name) - {{$user_membership->corporate_name}} @endif</h3>
                <ul>
                    <li>Effective Date: <?php echo $user_membership->effective_date; ?></li>
                    <li>Expiry Date: <?php echo $user_membership->expiry_date; ?></li>
                    <li>Membership Price: $<?php echo $user_membership->membership_price; ?></li>
                    <li>Membership Discount: <?php echo $user_membership->membership_discount; ?></li>
                </ul>
            </div>
            @endforeach
        @endif
        <h2>Add Membership</h2>
        <form action="/add-new-membership" method="POST">
        @csrf

        <label for="type">Membership Type</label>
        <select name="type" id="type">
            <option value="Individual">Individual</option>
            <option value="Student">Student</option>
            <option value="Corporate5">Corporate - 5 Accounts</option>
            <option value="Corporate10">Corporate - 10 Accounts</option>
            <option value="CorporateUnlimited">Corporate - Unlimited Accounts</option>
        </select>
        @if ($errors->has('type'))
            <span class="error">{{ $errors->first('type') }}</span>
        @endif

        <div class="">
            <label for="corporate_name">Company Name</label>
            <input type="text" id="corporate_name" name="corporate_name">
            @if ($errors->has('corporate_name'))
                <span class="error">{{ $errors->first('corporate_name') }}</span>
            @endif
        </div>
        <input type="submit" value="Add Membership">
        
    </form>
@endif
@include('footer')
