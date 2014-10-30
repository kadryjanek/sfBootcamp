
{% extends "::layout.html.twig" %}

{% block title %}Lista obrazków{% endblock %}

{% block body %}
    <h1>{{ block('title') }}</h1>
    <ul>
        {% for image in images %}
        <li>
        	<im src="/assets/images/{{ image.path }}" />
            <a href="{{ path('image_show', {'id': image.id}) }}">
                {{ image.title }}
            </a>
            <p>{{ image.description }}</p>
        </li>
        {% endfor %}
    </ul>
{% endblock %}


