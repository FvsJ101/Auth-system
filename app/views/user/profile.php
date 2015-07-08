{% extends 'templates/default.php' %}

{% block title %}{{ user.getFullNameOrUsername }} Profile{% endblock %}

{% block content %}
    <h2>{{ user.getFullNameOrUsername }} Profile</h2>
    <dl>
        {% if user.getFullName %}
            <dt>Full Name:</dt>
            <dd>{{ user.getFullname }}</dd>
        {% endif %}
            <dt>Email: </dt>
            <dd>{{ user.email }}</dd>
    </dl>
{% endblock %}