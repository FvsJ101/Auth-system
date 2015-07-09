{% extends 'email/templates/default.php' %}


{% block content %}
    <p>Your requested a password reset.</p>
    <p>Click this link to reset your password: {{ baseUrl }}{{ urlFor('password.reset') }}?email={{ user.email }}&identifier={{ identifier|url_encode }}</p>
{% endblock %}