
{% for datei in dateien %}
    {{ listitemlink('litxtfile' ~ datei.id , 'onclick':'Textdateidetails('~ datei.id ~')', 'value':datei.titel) }}       
{% endfor %}
