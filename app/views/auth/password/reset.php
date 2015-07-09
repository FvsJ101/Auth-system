{% extends 'templates/default.php' %}

{% block title %}Reset Form{% endblock %}

{% block content %}
<p>Reset form</p>
<form action="{{ urlFor('password.reset.post') }}?email={{ email }}&identifier={{ identifier|url_encode }}" method="post">
    <div>
        <label for="password">Email</label>
        <input type="password" name="password" id="password" />
        {% if errors.has('password') %} {{ errors.first('password') }} {% endif %}
    </div>
    <div>
        <label for="password_confirm">Confirm Password</label>
        <input type="password" name="password_confirm" id="password_confirm" />
        {% if errors.has('password_confirm') %} {{ errors.first('password_confirm') }} {% endif %}
    </div>
    <div>
        <input type="submit" value="Reset"/>
    </div>
    <input name="{{ csrf_key }}" type="hidden" value="{{ csrf_token }}"/>
</form>
{% endblock %}