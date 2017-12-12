
<table>
    <tr>
        <th>Bezeichnung</th>
        <th>Standard </th>
    </tr>
    {% for stat in webstatus %}
    <tr>
        <td>{{ listitemlink('liwstatus' ~ stat.id  , 'onclick':'WebStatusVerwaltung('  ~ stat.id ~')' , 'value':stat.bezeichnung) }}</td>
        {% if stat.iststandard == 1 %}
            <td>{{ check_field('', 'disabled':'',  'checked':'' )}}</td>
        {% else %}
            <td>{{ check_field('', 'disabled':'')}}</td>
        {% endif %}
    </tr>
    {% endfor %}       
</table>
<div id='webstatus'>
</div>
