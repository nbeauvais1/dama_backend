@include('header')

<?php  
$user_id = session('session_user_id');
$user_memberships = DB::table('user_membership')
	->join('membership', 'user_membership.membership_id', '=', 'membership.membership_id')
	->select('*')
	->where('user_membership.membership_id', '>=', '3')
	->where('user_membership.membership_id', '<', '6')
	->where('user_id', '=', $user_id)
	->get();
?>
@if($user_memberships == '[]')
	<p class="error">You must be a corporate account holder to use this feature.</p>
<h2>Add Corporate Account Member</h2>

@else
<h2>Add Corporate Account Member</h2>
	@foreach($user_memberships as $user_membership)
		<?php  
			$current_members = DB::table('corporate_membership')
					->join('user_membership', 'user_membership.user_membership_id', '=', 'corporate_membership.user_membership_id')
					->join('user', 'corporate_membership.user_id', '=', 'user.user_id')
					->select('corporate_membership.user_id', 'corporate_membership.email', 'corporate_membership.active_yn')
					->where('user_membership.user_membership_id', '=', $user_membership->user_membership_id)
					->get();
			$current_members_count = DB::table('corporate_membership')
					->join('user_membership', 'user_membership.user_membership_id', '=', 'corporate_membership.user_membership_id')
					->join('user', 'corporate_membership.user_id', '=', 'user.user_id')
					->select('corporate_membership.user_id')
					->where('corporate_membership.active_yn', '=', 'Y')
					->where('user_membership.user_membership_id', '=', $user_membership->user_membership_id)
					->count();

		?>
	
		<h3>Membership Type: {{$user_membership->membership_type}}</h3>
		<ul>
			<li>
				Maximum Account Members: 
				@if($user_membership->membership_id == 5)
				Unlimited
				@elseif($user_membership->membership_id == 4)
				10
				@elseif($user_membership->membership_id == 3)
				5
				@endif
			</li>
			<li>
				Number of Account Members:
				{{$current_members_count}}
			</li>
			<li>
				Current Account Members:
				@foreach($current_members as $current_member)
				@if($current_member->active_yn == 'Y')
				<div>
					{{$current_member->email}} <a href="/remove-corporate-member?u_id={{$current_member->user_id}}&c_id={{$user_membership->user_membership_id}}">Remove</a>
				</div>
				@endif
				@endforeach
			</li>
		</ul>
		<form action="/add-corporate-member?c_id={{$user_membership->user_membership_id}}" method="POST" class="">
		@csrf

		<label for="email">Email</label>
		<input type="text" id="email" name="email">

		<input type="submit" value="Add Member" name="" class="">

	</form>
	@endforeach
@endif




@include('footer')