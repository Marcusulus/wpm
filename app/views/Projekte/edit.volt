
{{form('', 'id':'ProjektForm', 'method':'Post')}} 
    <Label for='name'>Projektname</Label>
    {{text_field('name', 'value':projekt.name)}}
    <Label for='auftraggeber_id'>Auftraggeber</label>
    {{select('auftraggeber_id', kunden, 'using':['id','name'], 'value':projekt.auftraggeber_id)}}
    <Label for='start'>Start: </label>
    {% if projekt.start is empty %}
        {{date_field('start', 'placeholder':'Projektname', 'value':date("Y-m-d") )}}
    {% else %}
        {{date_field('start', 'placeholder':'Projektname', 'value':projekt.start )}}
    {% endif %}
    <Label for='deadline'>Ende: </label>
    {{date_field('deadline', 'placeholder':'Projektname')}}
    <br/>
    Milestones
    <br/>
    {% for milestone in milestones %}
        {% if milestone.iststandard == 1 %}
            {{ check_field('select' ~ milestone.id , 'name':'milestone'~ milestone.id ~'[milestone_id]',  'checked':'',  'value':milestone.id) }}
        {% else %}
            {{ check_field('select' ~ milestone.id, 'name':'milestone'~ milestone.id ~'[milestone_id]',  'value':milestone.id ) }}
        {% endif %}
        {{ milestone.bezeichnung }}
        <Label for='start'>Start(geplant): </label>
        {{date_field('start' ~ milestone.id, 'name':'milestone'~ milestone.id ~'[start_geplant]', 'value':milestone.start_geplant )}}
        <Label for='start'>Ende(geplant): </label>
        {{date_field('deadline' ~ milestone.id, 'name':'milestone'~ milestone.id ~'[ende_geplant]', 'value':milestone.ende_geplant )}} 
        <br/>
    {% endfor %}
{{ end_form()}}
{{button('btabbrechen', 'onclick':'ProjektNeuAusblenden()', 'value':'Abbrechen')}} 
{{button('btspeichern', 'onclick':'Projektspeichern(false)',  'value':'Speichern')}}
{{button('btauswahl', 'onclick':'Projektspeichern(true)',  'value':'Auswählen')}}
