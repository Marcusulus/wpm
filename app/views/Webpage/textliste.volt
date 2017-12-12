
{% for text in texte %}
    {{ listitemlink('litxt' ~ text.id , 'onclick':'Textdetails('~ text.id ~')', 'value':text.titel) }}       
{% endfor %}
