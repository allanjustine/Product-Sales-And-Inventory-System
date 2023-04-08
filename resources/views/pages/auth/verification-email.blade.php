<div class="card">
    <div class="card-body">
        <h1>Greetings from AJM website</h1>

        <p>
            Welcome, {{ $user->name }}! <br>

        </p>

        <p>
            Email: {{ $user->email }}<br>
            Gender: {{ $user->gender }}<br>
            Account Created: {{ $user->created_at }}
        </p>
        <p>
            You received this email as a result of your registration to our web site.
            Please click on the verification link to verify your account.
        </p>

        <p>
            <b><a href="{{ url('/verification/' . $user->remember_token . '/' . $user->id) }}">Click here to verify your account</a></b>
        </p>
    </div>
</div>
