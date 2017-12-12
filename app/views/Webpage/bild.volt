
{{ form('', 'id':'BildEditForm', 'method':'post', 'enctype':"multipart/form-data")}}
    <Label for='titel'>Titel: </label>
    {{ text_field('titel', 'value':bild.titel)}}
    {{ Image(bild.pfad)}}
    <Label for='dateiname'>Dateiname: </label>
    {{ text_field('dateiname', 'value':bild.dateiname)}}
    <Label for='status_id'>Status: </label>
    {{ select('status_id', status, 'using':['id','bezeichnung'])}} 
    <Label for='bemerkung'>Bemerkung</label><br/>
    {{ text_area('bemerkung', 'value':bild.bemerkung, 'cols':50, 'rows':10)}}
{{ end_form()}}
Auflösung: {{ bild.breite }} x {{ bild.hoehe }}
<br/>

{{ button('btabbrechen', 'onclick':'DateiDetailsAusblenden()', 'value':'Abbrechen' )}}
{{ button('btloeschen', 'onclick':"BildEdit(Delete)", 'value':'Löschen') }}
{{ button('btspeichern', 'onclick':"BildEdit(update)", 'value':'Ändern') }}
 