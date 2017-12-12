<ul>
    {% for k in kunden %}
        {{listitemlink('likunde' ~ k.id , 'onclick':'KundenInfo(' ~ k.id ~ ')' ,'value':k.name)}}
    {% endfor %}
</ul>
