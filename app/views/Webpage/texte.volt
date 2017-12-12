
{{ form('', 'id':'TextEditForm', 'method':'post', 'enctype':"multipart/form-data")}}
            <Label for='titel'>Titel: </label>
            {{ text_field('titel', 'value':text.titel)}}
            <Label for='textdaten'>Text</label>
            {{ text_area('textdaten', 'value':text.textdaten, 'cols':75, 'rows':20)}}
            <Label for='status_id'>Status: </label>
            {{ select('status_id', status, 'using':['id','bezeichnung'])}} 
            {{ text.textlaenge }}
            <Label for='bemerkung'>Bemerkung</label>
            {{ text_area('bemerkung', 'value':text.bemerkung, 'cols':50, 'rows':10)}}
{{ end_form()}}
<br/>
{{ button('btabbrechen', 'onclick':"TextDetailsAusblenden()", 'value':'Abbrechen' )}}
{{ button('btloeschen', 'onclick':"TextEdit('Delete')", 'value':'Löschen') }}
{{ button('btspeichern', 'onclick':"TextEdit('update')", 'value':'Ändern') }}
 