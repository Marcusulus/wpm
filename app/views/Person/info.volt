
{{person.vorname}} 
    {{person.nachname}}
    <h3>Kontakt</h3><br/>    
    <Label>Email: </label>
    {{person.email}}
    <br/>
    <Label for='cbauftraggeber_id'>Telefon: </label>
    {{person.telefon}}
    <br/>
    <Label>Mobil: </label>
    {{person.mobil}}
    <br/>
    {% if not person.auftraggeber_id is empty %}
        <Label for='bemerkung'>Bemrkung: </label>
        {{ text_area('bemerkung', 'value':person.bemerkung, 'cols':50, 'rows':10, 'readonly':'')}}
    {% endif %}
    {{button('btloeschen', 'onclick':'PersonLoeschen(' ~ person.id ~ ')' , 'value':'Löschen')}}
    {{button('btzurueck', 'onclick':'PersonInfoAusblenden()', 'value':'Zurück')}}  
    {{button('btbearbeiten', 'onclick':'PersonBearbeiten('~ person.id ~ ')', 'value':'Bearbeiten')}}

