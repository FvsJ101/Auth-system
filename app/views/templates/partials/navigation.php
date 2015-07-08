{% if auth %}
    <p>Hallo {{ auth.getFullNameOrUsername }}! <img src="{{ auth.getAvatarUrl({size: 30}) }}" alt="Avatar"/></p>

{% endif %}


<ul>
    <li><a href="{{ urlFor('home') }}">Home</a></li>
    {% if auth %}
    <li><a href="{{ urlFor('logout') }}">Logout</a></li>
    <li><a href="{{ urlFor('user.profile', {username:auth.username}) }}">View Profile</a></li>
    <li><a href="{{ urlFor ('password.change') }}">Update Profile</a></li>
        {% if auth.isAdmin %}
            <li><a href="{{ urlFor('admin.example') }}">Admin Area</a></li>
        {% endif %}
    {% else %}
        <li><a href="{{ urlFor('register') }}">Register</a></li>
        <li><a href="{{ urlFor('login') }}">Login</a></li>
    {% endif %}
    <li><a href="{{ urlFor('user.all') }}">List All Users</a></li>

</ul>