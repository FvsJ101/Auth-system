{% extends 'templates/default.php' %}

{% block title %}All Active Users{% endblock %}

{% block content %}
    <h2>All Active Users</h2>

    {% if users is empty %}
        <p>Sorry no Registered Users!</p>
    {% else %}
        {% for user in users %}
            <div class="user">
                <a href="{{ urlFor('user.profile', {username:user.username}) }}">{{ user.username }}</a>
                {% if user.getFullname %}
                    ({{ user.getFullname }})
                {% endif %}
                {% if user.isAdmin %}
                    (Admin)
                {% endif %}
            </div>
        {% endfor %}
    {% endif %}
{% endblock %}