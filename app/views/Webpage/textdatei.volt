
<br/>

{{ form('', 'id':'TextdateiEditForm',  'method':'post', 'enctype':"multipart/form-data")}}
    {{ text_field('titel', 'value':datei.titel)}}
    <!-- <iframe src={{ '"'  ~ datei.pfad ~ '"'}}></iframe> -->
    {{ text_field('dateiname', 'value':datei.dateiname)}}
    {{select('status_id', status, 'using':['id','bezeichnung'])}}
    Bemerkung:
    <br/>
    {{ text_area('bemerkung', 'value':datei.bemerkung, 'cols':50, 'rows':10)}}
{{ end_form()}}
{{ button('btabbrechen', 'onclick':'DateiDetailsAusblenden()', 'value':'Abbrechen' )}}
{{ button('btloeschen', 'onclick':"TextdateiEdit('Delete')", 'value':'Löschen') }}
{{ button('btspeichern', 'onclick':"TextdateiEdit('update')", 'value':'Ändern') }}
 