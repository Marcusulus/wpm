
{{ form('' ,'id':'PersonForm', 'method':'post')}}
        <Label for='vorname'>Vorname: </label>
        <Label for='nachname'>Nachname:</label>
        {{text_field('vorname', , 'value':person.vorname)}}    
        {{text_field('nachname', 'placeholder':'Nachname', 'value':person.nachname)}}
        <div>
        <h3>Kontakt</h3>
        <br/>
            <Label for='email'>Email: </label>
            {{text_field('email', 'value':person.email)}}
            <Label for='telefon'>Telefon: </label>
            {{text_field('telefon',  'value':person.telefon)}}
            <Label for='mobil'>Mobil</label>
            {{text_field('mobil',  'value':person.mobil)}}
        </div>
        {% if not person.auftraggeber_id is empty %}
            <Label for='bemerkung'>Bemerkung: </label>
            {{ text_area('bemerkung', 'value':person.bemerkung, 'cols':50, 'rows':10)}}
        {% endif %}
    {{ end_form()}}
    {{button('btabbrechen', 'onclick':'PersonInfo(' ~ person.id ~ ')' , 'value':'Abbrechen')}}
    {% if person.auftraggeber_id == -1 %}
        {%  set istkunde = 0 %}
    {% else %}
        {%  set istkunde = 1 %}
    {% endif %}
    {{button('btspeichern', 'onclick':'PersonSpeichern('~ istkunde ~ ')',  'value':'Speichern')}}

