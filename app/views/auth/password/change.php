{% extends 'templates/default.php' %}

{% block title %}Profile Update{% endblock %}

{% block content %}
<form action="{{ urlFor('password.change.post') }}" method="post">
    <div>
        <label for="password_old">Old Password</label>
        <input type="password" name="password_old" id="password_old" />
        {% if errors.has('password_old') %} {{ errors.first('password_old') }} {% endif %}
    </div>
    <div>
        <label for="password">New Password</label>
        <input type="password" name="password" id="password"/>
        {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
    </div>
    <div>
        <label for="password_confirm">Confirm Password</label>
        <input type="password" name="password_confirm" id="password_confirm"/>
        {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
    </div>
    <div>
        <input type="submit" value="Update"/>
    </div>
    <input name="{{ csrf_key }}" type="hidden" value="{{ csrf_token }}"/>
</form>
{% endblock %}