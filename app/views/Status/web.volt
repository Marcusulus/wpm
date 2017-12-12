
{% include 'includes/statusbearbeiten.volt' %}


{{ button('btabbrechen', 'onclick':'StatusEditAusblenden()', 'value':'Abbrechen' ) }}
{% if status.id > -1 %}
    {{ button('btloeschen', 'onclick':"WebStatusloeschen()",  'value':'Löschen')}}
{% endif %}
{{ button('btspeichern', 'onclick':"WebStatusSpeichern()",   'value':'Speichern')}}
