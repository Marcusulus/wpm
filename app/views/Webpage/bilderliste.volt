
{% for bild in bilder %}
    {{ image_input( 'id':'img' ~ bild.id , 'src':bild.pfad, 'height':75, 'width':75, 'onclick':'Bilddetails('~ bild.id ~')'  ) }}
{% endfor %}

