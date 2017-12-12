
<div>
    {{ form('' , 'id':'KundenForm' , 'method':'post')}}
            <Label for='name'>Name: </label>
            {{ text_field('name', 'value':kunde.name)}}
            <h3>Anschrift</h3>
            <Label for='strasse'>Straße: </label>
            {{ text_field('strasse', 'value':kunde.strasse)}}
            <Label for='hausnummer'>HNr.: </label>
            {{ text_field('hausnummer', 'value':kunde.hausnummer)}}
            <br/>
            <Label for='plz'>Postleizahl: </label>
            {{ text_field('plz', 'value':kunde.plz)}}
            <Label for='ort'>Ort: </label>
            {{ text_field('ort', 'value':kunde.ort)}}
            <br/>
            <br/>      
    {{end_form()}}

    {{button('btabbrechen', 'onclick':'KundenAbbrechen(' ~ kunde.id ~ ')', 'value':'Abbrechen')}} 
    {{ button('btspeichern', 'onclick':'KundenSpeichern(' ~ kunde.id ~')', 'value':'Speichern')}}
</div>
