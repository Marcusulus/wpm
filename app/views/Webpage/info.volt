
{{ form('', 'id':'WebpageForm' )}}
    <Label for='titel'>Titel:</label>
    {{ text_field('titel', 'value':webpage.titel) }}
    <br/>
    <Label for='status_id'>Status</label>
    {{select('status_id', webpagestatus, 'using':['id','bezeichnung'], 'value':webpage.status_id, 'onchange':'WebpagestatusUpdate()' )}}
    <br/>
    <Label for='parent_id'>Übergeordnete Seite: </label>
    {% if webpage.parent_id is empty %}
        {{ select('parent_id', webpages, 'using':['id','titel'], 'value':webpage.id )}}
    {% else %}
        {{ select('parent_id', webpages, 'using':['id','titel'],  'value':webpage.parent_id  ) }}
    {% endif  %}
{{ end_form() }}
{{ button('btloeschen', 'value':'Löschen', 'onclick':"WebpageLoeschen()") }}
{{ button('btspeichern', 'value':'Ändern', 'onclick':"WebpageSpeichern()") }}
{{form('', 'id':'WebpageNeuForm')}}
    {{ text_field('titel', 'value':'') }}
{{end_form()}}
{{ button('', 'value':'Neue Unterseite', 'onclick':"WebpageNeu()") }}
<h3>Textdateien</h3>
<div id='textdateien'>
</div>
{{form('', 'id':'TextdateiForm', 'name':'TextdateiForm', 'method':'post', 'onchange':'TextdateiHochladen()','enctype':"multipart/form-data")}}
    {{file_field('daten[]', 'accept':'text/*,.pdf,.doc,.docx', 'multiple':'' ) }}       
{{end_form()}}
<h3>Bilder</h3>
<div id="bilder">
</div>
{{form('', 'id':'BildForm', 'method':'post')}}
    {{file_field('daten[]', 'accept':'image/*','onchange':'BildHochladen()', 'multiple':'' ) }}
{{end_form()}}
<h3>Texte</h3>
<div id="texte">
</div>
{{form('', 'id':'TextForm', 'method':'post')}}
    {{text_field('titel', 'placeholder':'Titel' ) }}
    <Label for='textlaenge'>Max. Zeichen</label>
    {{ numeric_field('textlaenge', 'placeholder':'maximale Zeichenanzahl' ) }}
{{end_form()}}
{{button('neu', 'onclick':"TextNeu('new')", 'value':'Neu' )}}
<div id='details'>
</div>
