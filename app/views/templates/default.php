<!doctype html>
<!-- here where you would like all css sheets and js and evrything regarding frame of the html-->
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Website | {% block title %}{% endblock %}</title>
</head>
<body>

    {% include 'templates/partials/navigation.php' %}
    {% include 'templates/partials/messages.php' %}
    {% block content %}{% endblock %}
</body>
</html>