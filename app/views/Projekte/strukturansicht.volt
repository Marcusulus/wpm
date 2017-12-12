{% macro knoten(page) %}
    {{listitemlink('liinfo' ~ page.id , 'onclick':'WebpageInfo(' ~ page.id ~ ')', 'value':page.titel) }}
    {% if page.children is not empty %}
    <ul>
        {% for child in page.children %}
            {{ knoten(child) }}
        {% endfor %}
    </ul>
    {% endif %}
{% endmacro %}


{{ knoten(page) }}
