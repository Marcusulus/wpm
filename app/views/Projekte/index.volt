
<h3>Projekte</h3>
<ul>
{% for p in projekte %}
    {{listitemlink('btinfo', 'onclick':'ProjektInfo('~ p.id ~')', 'value':p.name)}}
{% endfor %}
</ul>
<br/>
{{ button('btneu', 'onclick':'ProjektNeu()', 'value':'Neu') }}

<div id='content'>
</div>
