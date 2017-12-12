
<table>
<tr>
  <th>Name</th>
  <th>Standard</th>  
</tr>
{% for milestone in milestones %}
    <tr>
        <td>{{ listitemlink('', 'onclick':'MilestoneInfo('  ~ milestone.id ~  ')' , 'value':milestone.bezeichnung) }}</td>
        {% if milestone.iststandard == 1 %}
            <td>{{ check_field('cfsatndard' ~ milestone.id, 'disabled':'',  'checked':'' )}}</td>
        {% else %}
            <td>{{ check_field('cfsatndard' ~ milestone.id, 'disabled':'')}}</td>
        {% endif %}
    </tr>
{% endfor %}
</table>


<div id='milestone'>
</div>
