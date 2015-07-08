{% if auth %}
    <p>Hallo,{{ auth.getFullNameOrUsername() }},</p>
{% else %}
    <p>Hello there,</p>
{% endif %}


{% block content %}


{% endblock %}