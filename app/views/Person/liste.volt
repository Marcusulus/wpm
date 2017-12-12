
<ul>
    {% for person in personen %}
    {{listitemlink('liperson' ~ person.id , 'onclick':'PersonInfo(' ~ person.id ~ ')' , 'value': person.vorname ~ " " ~ person.nachname)}}
    {% endfor %}        
</ul>
