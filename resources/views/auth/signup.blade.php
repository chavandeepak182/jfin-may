<form method="POST" action="{{ route('signup.submit') }}">
@csrf

<input name="first_name" placeholder="First Name" required>
<input name="last_name" placeholder="Last Name" required>
<input name="mobile_no" placeholder="Mobile Number" required>
<input name="email" placeholder="Email" required>

<button>Sign Up</button>

<p>
Already have an account?
<a href="{{ route('login.form') }}">Login</a>
</p>
</form>
