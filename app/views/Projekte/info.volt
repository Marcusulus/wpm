
<h3>Details</h3>
    {{ projekt.name}}
    <br/>
    Auftraggeber: {{kunde.name}}
    <br/>
    <label for='dfstart'>Start: </label>
    {{ date_field('dfstart', 'value':projekt.start, 'readonly':'')}}
    <br/>
    {% if projekt.deadline is not null %}
        <label for='dfdead'>Ende: </label>
        {{date_field('dfdead', 'value':projekt.deadline, 'readonly':'')}}
    {% endif %}
<br/>
Milestones
<br/>
{% for milestone in milestones %}
    {{ milestone.bezeichnung }}
    {% if not milestone.start_geplant is empty %}
        <label for='dfstartplan' >Start(geplant): </Label>
        {{date_field('dfstartplan' ~ milestone.id, 'value':milestone.start_geplant, 'readonly':'' )}}
    {% endif %}
    {% if not milestone.start is empty %}
         <label for='dfstart' >Start: </Label>
        {{date_field('dfstart' ~ milestone.id, 'value':milestone.start, 'readonly':'' )}}
    {% endif %}
    {% if not milestone.ende_geplant is empty %}
        <label for='dfdeadline' >Ende(geplant): </Label>
        {{date_field('dfdeadline' ~ milestone.id, 'value':milestone.ende_geplant,  'readonly':'')}}
    {% endif %}
    {% if not milestone.ende is empty %}
        <label for='dfdeadlineplan' >Ende: </Label>
        {{date_field('dfdeadlineplan' ~ milestone.id, 'value':milestone.ende,  'readonly':'')}}
    {% endif %}

    {% if milestone.start is empty %}
        {{ button('btstart', 'onclick':'MilestoneStart(' ~ milestone.id ~ ' )', 'value':'Beginnen') }}
    {% elseif milestone.ende is empty %}
        {{ button('btstop', 'onclick':'MilestoneStop(' ~ milestone.id ~ ' )', 'value':'Abschließen') }}
    {% endif %}
    <br/>
{% endfor %}
{{button('btbearbeiten', 'onclick':'ProjektBearbeiten('~ projekt.id ~')', 'value':'Bearbeiten' )}}
{{button('btauswahl', 'onclick':'WebsiteStruktur('~ projekt.id ~')', 'value':'Auswählen' )}}

