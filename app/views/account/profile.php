{% extends 'templates/default.php' %}

{% block title %}Update Profile {{ auth.getFullNameOrUsername }}{% endblock %}

{% block content %}
<form action="{{ urlFor('account.profile.post') }}" method="post">
    <div>
        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="{{ request.post('email') ? request.post('email') : auth.email}}" />
        {% if errors.has('email') %} {{ errors.first('email') }} {% endif %}
    </div>
    <div>
        <label for="first_name">First Name</label>
        <input type="text" name="first_name" id="first_name" value="{{ request.post('first_name') ? request.post('first_name') : auth.first_name}}"/>
        {% if errors.has('first_name') %} {{ errors.first('first_name') }} {% endif %}
    </div>
    <div>
        <label for="last_name">Suranme</label>
        <input type="text" name="last_name" id="last_name" value="{{ request.post('last_name') ? request.post('last_name') : auth.last_name}}"/>
        {% if errors.has('last_name') %} {{ errors.first('last_name') }} {% endif %}
    </div>
    <div>
        <input type="submit" value="Update"/>
    </div>
    <input name="{{ csrf_key }}" type="hidden" value="{{ csrf_token }}"/>
</form>
{% endblock %}




