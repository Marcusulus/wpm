
{% include 'includes/statusbearbeiten.volt' %}

{{ button('btabbrechen', 'onclick':'StatusEditAusblenden()', 'value':'Abbrechen' ) }}
{% if status.id > -1 %}
    {{ button('btloeschen', 'onclick':"Statusloeschen()",  'value':'Löschen')}}
{% endif %}
{{ button('btspeichern', 'onclick':"StatusSpeichern()",   'value':'Speichern')}}
