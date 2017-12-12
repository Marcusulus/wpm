
<div>
    {{ form('', 'id':'MilestoneForm', 'method':'Post' ) }}
        {% if milestone.id <= -1 %}
            <Label for='bezeichnung'>Bezeichnung: </label>
            {{ text_field('bezeichnung', 'placeholder':'Bezeichnung') }}
            <Label for='iststandard'>Standard: </label>
            {{ check_field('iststandard') }}
        {% else %}
            <Label for='bezeichnung'>Bezeichnung: </label>
            {{ text_field('bezeichnung', 'placeholder':'Bezeichnung', 'value': milestone.bezeichnung) }}
            <Label for='iststandard'>Standard: </label>
            {% if milestone.iststandard == 1 %}
                {{ check_field('iststandard' ,'checked':'') }}
            {% else %}
                {{ check_field('iststandard' ) }}
            {% endif %}
        {% endif %}
    {{ end_form() }}

    {{ button('btabbrechen', 'onclick':'MilestoneEditAusblenden()', 'value':'Abbrechen' ) }}
    {% if milestone.id > -1 %}
    {{ button('btloeschen', 'onclick':"MilestoneSpeichern('Delete')",  'value':'Löschen')}}
    {% endif %}
    {{ button('btspeichern', 'onclick':"MilestoneSpeichern('save')",   'value':'Speichern')}}
</div>
