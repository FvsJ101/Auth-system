{% extends 'templates/default.php' %}

{% block title %}Recover Password{% endblock %}

{% block content %}
<p>Enter your email address to start the recovery process.</p>
<form action="{{ urlFor('password.recover.post') }}" method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" {% if request.post('email') %} value="{{ request.post('email') }}" {% endif %} />
        {% if errors.has('email') %} {{ errors.first('email') }} {% endif %}
    </div>
    <div>
        <input type="submit" value="Request"/>
    </div>
    <input name="{{ csrf_key }}" type="hidden" value="{{ csrf_token }}"/>
</form>
{% endblock %}