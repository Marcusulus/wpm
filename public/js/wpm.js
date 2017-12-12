function ContentCallBack(id)
{
    return function(data, status) {
        $(id).html(data);
    };
}

function ContentFunctionCallBack(id, func)
{
    return function(data, status) {
        $(id).html(data);
        func();
    };
}

function FunctionCallback(func)
{
    return function(data, status) {
        func();
    };
}

function WechselZu(ziel)
{

    var callback = ContentCallBack("#page");

    $.get("Index/WechselZu/"+ziel, callback);

}
/*
*   Funktionen für Kundenverwaltung
*/

function KundenNeu()
{

    var callback = ContentCallBack("#content");

    $.get("Kunden/neu/", callback);
}

function KundenAbbrechen(id = -1)
{
    //Abbrechen neuer kunde anlegen
    if(id == -1)
    {
        $("#content").html('');
    }
    //Abbrechen Kunde bearbeiten
    else
    {
        KundenInfo(id);
    }
}

function KundenInfo(id)
{
    var callback = ContentFunctionCallBack("#content", PersonListe);

    $.get("Kunden/info/" + id, callback);
}

function KundenBearbeiten(id = -1)
{

    var callback = ContentCallBack("#info");

    $.get("Kunden/edit/"+ id, callback);    
}

function KundenSpeichern(id = -1)
{

    var callback = ContentFunctionCallBack("#content",  KundenListe);

    $.post("Kunden/speichern/"+id,$("#KundenForm").serialize(),callback)
}

function KundenLoeschen(id)
{

    var callback = ContentCallBack("#content");

    $.get("Kunden/loeschen/"+id, callback);
}

function KundenListe()
{
    var callback =ContentCallBack("#kunden");

    $.get("Kunden/liste", callback);
}

/*
*   Funktionen für Personendaten
*/

function PersonInfo(id)
{
    //Abbrechen neue person anlegen
    if(id == -1)
    {
       PersonInfoAusblenden();
    }
    else
    {
        var callback = ContentCallBack("#partner");

        $.get("Person/info/"+id, callback);
    }
}

function PersonInfoAusblenden()
{
    $('#partner').html('');
}

function PersonBearbeiten(id = -1, kunde = null)
{
    var callback = ContentCallBack("#partner");

    $.get("Person/edit/", callback);
}

function PersonNeu()
{
    var callback = ContentCallBack("#partner");

    $.get("Person/neu/", callback);
}

function PersonSpeichern(kunde = 0)
{
    if(kunde == 0)
    {
        var callback = function(data) {
            $("#partner").html(data);
            PersonListe(true);
        };
    }
    else
    {
        var callback = ContentFunctionCallBack('#partner',PersonListe);
    }

    $.post("Person/speichern/",$("#PersonForm").serialize(),callback)
}


function PersonLoeschen(id) 
{
    var callback = ContentFunctionCallBack("#partner",PersonListe);

    $.get("Person/loeschen/"+id, callback);
}

function PersonListe(maliste = false) 
{
    var callback = ContentCallBack("#personen");
    $.get("Person/liste/"+maliste, callback);
}

/*
*   Funktionen Konfiguration
*/

function MitarbeiterVerwaltung()
{
    var callback = function(data)
        {  
            $("#content").html(data); 
            PersonListe(true);
        }

    $.get("Konfiguration/Mitarbeiter/", callback);
    var xhttp = new XMLHttpRequest();
}

function StatusVerwaltung()
{
    var callback = function(data)
        {
            $("#content").html(data);

            StatusListe();
            WebstatusListe();
        } 

    $.get("Konfiguration/Status/", callback);
}

function MilestoneVerwaltung()
{
    var callback = ContentFunctionCallBack("#content", MilestoneListe);

    $.get("Konfiguration/Milestones/", callback);
}

/*
*   Funktionen für statusverwaltung
*/

function ContentStatusVerwaltung(id = -1)
{
    var callback = ContentCallBack("#contentstatus");

    $.get("Status/content/"+id, callback);

}

function WebStatusVerwaltung(id = -1)
{
    var callback = ContentCallBack("#webstatus");

    $.get("Status/Web/"+id, callback);
}

function StatusEditAusblenden()
{
    $("#webstatus").html('')
    $("#contentstatus").html('');
}

function StatusSpeichern()
{

    var callback = FunctionCallback( StatusListe );
   
    

    $.post("Status/speichern/",$('#StatusForm').serialize(),callback);

    StatusEditAusblenden();
}

function StatusLoeschen()
{

    var callback = FunctionCallback( StatusListe );

    $.post("Status/loeschen/",$('#StatusForm').serialize(),callback);

    StatusEditAusblenden();

}

function WebStatusSpeichern()
{
    var callback = FunctionCallback( WebstatusListe);

    $.post("Status/speichern/",$('#StatusForm').serialize(),callback);

    StatusEditAusblenden();
}

function WebStatusLoeschen()
{

    var callback = FunctionCallback( WebstatusListe);


    $.post("Status/loeschen/",$('#StatusForm').serialize(),callback);

    StatusEditAusblenden();

}

function StatusListe()
{
    var callback = ContentCallBack("#statusliste");

    $.get("Status/liste/", callback);
}

function WebstatusListe()
{
    var callback = ContentCallBack("#webstatusliste");

    $.get("Status/webliste/", callback);
}

/*
*   Funktionen für Milestoneverwaltung
*/

function MilestoneInfo(id = -1)
{
    var callback = ContentCallBack("#milestone");

    $.get("Milestone/info/"+id, callback);
}

function MilestoneListe()
{
    var callback = ContentCallBack("#milestones");

    $.get("Milestone/liste/", callback);
}

function MilestoneEditAusblenden()
{
    $("#milestone").html('');
}

function MilestoneSpeichern(action)
{
    var callback = ContentFunctionCallBack("#milestone", MilestoneListe);

    $.post("Milestone/edit/"+action, $('#MilestoneForm').serialize() , callback);
}

function MilestoneStart(id)
{
    var callback = ContentCallBack('#content');
    
    $.get('Milestone/start/'+id, callback);
}

function MilestoneStop(id)
{
    var callback = ContentCallBack('#content');
    
    $.get('Milestone/stop/'+id, callback);
}

/*
*   Funktionen ProjektVerwalrung
*/

function ProjektInfo(id = -1)
{
    var callback = ContentCallBack("#content");

    $.get("Projekte/info/"+id, callback);
}

function ProjektNeu()
{
    var callback = ContentCallBack("#content");

    $.get("Projekte/edit/", callback);

}

function ProjektBearbeiten(id = -1)
{
    var callback = ContentCallBack("#content");

    $.get("Projekte/edit/"+id, callback);

}

function ProjektNeuAusblenden()
{
    $("#content").html('');
}

function Projektspeichern(action)
{
    var callback = ContentFunctionCallBack("#page",KundenListe);

    

    $.post("Projekte/speichern/"+action,$("#ProjektForm").serialize(),callback)
    ProjektNeuAusblenden();
}

function ProjektStruktur()
{
    var callback = ContentCallBack("#struktur");

    $.get("Projekte/strukturansicht/", callback);
}

/*
*   Funktionen für webseite
*/

function WebsiteStruktur()
{
    var callback = ContentFunctionCallBack("#page", ProjektStruktur);

    $.get("Projekte/struktur/", callback);
}

function WebpageInfo(id = -1)
{
    var callback = function(data)
        {
            $("#content").html(data);
            TextListe();
            TextdateiListe();
            BilderListe();
        };

    $.get("Webpage/info/"+id, callback);

}

function WebpageSpeichern()
{
    var callback =ContentFunctionCallBack("#content",ProjektStruktur);
    
    $.post("Webpage/speichern/",$("#WebpageForm").serialize(),callback)

}

function WebpageNeu()
{
    var callback =ContentFunctionCallBack("#content",ProjektStruktur);
    $.post("Webpage/neu/",$("#WebpageNeuForm").serialize(),callback)
    
}

function WebpageLoeschen()
{
    var callback =ContentFunctionCallBack("#content",ProjektStruktur);
    $.get("Webpage/loeschen/",callback)
}

function WebpagestatusUpdate()
{
    var callback = function(data){};

    $.post("Webpage/WebpageStatusUpdate/",$("#status_id").serialize(),callback)
}

function DateiDetailsAusblenden()
{
    $("#details").html('');
}

function Bilddetails(id = -1)
{
    var callback = ContentCallBack("#details");

    $.get("Webpage/bild/"+id, callback);
}

function Textdateidetails(id = -1)
{
    var callback = ContentCallBack("#details");

    $.get("Webpage/textdatei/"+id, callback);
}

function Textdetails(id = -1)
{
    var callback = ContentCallBack("#details");

    $.get("Webpage/texte/"+id, callback);
}

function BildEdit(action)
{
    var callback = ContentFunctionCallBack("#details",BilderListe);

    $.post("Webpage/bildedit/"+action,$("#BildEditForm").serialize(),callback)
}

function TextdateiEdit(action)
{
    var callback = ContentFunctionCallBack("#details",TextdateiListe);

    $.post("Webpage/textdateiedit/"+action,$("#TextdateiEditForm").serialize(),callback)
}

function TextdateiHochladen()
{

    var callback = ContentFunctionCallBack("#details",TextdateiListe);

    var form = $('#TextdateiForm')[0];
    
    var data = new FormData(form);

    $.ajax( {
        url: "Webpage/textdateiHochladen",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success:callback(data) 
        } );

}

function BildHochladen()
{
    var callback = ContentFunctionCallBack("#details",BilderListe);

    
    var form = $('#BildForm')[0];
    
    var data = new FormData(form);

    $.ajax( {
        url: "Webpage/bildHochladen",
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: callback(data)
        } );
}

function TextNeu()
{
    var callback = ContentFunctionCallBack("#details",TextListe);

    $.post("Webpage/textedit/new",$("#TextForm").serialize(),callback)
}

function TextEdit(action)
{
    var callback = ContentFunctionCallBack("#details",TextListe);

    $.post("Webpage/textedit/"+action,$("#TextEditForm").serialize(),callback)
}

function TextListe()
{
    var callback = ContentCallBack("#texte");

    $.get("Webpage/textliste/", callback);
}

function TextdateiListe()
{
    var callback = ContentCallBack("#textdateien");

    $.get("Webpage/textdateiliste/", callback);
}

function BilderListe()
{
    var callback = ContentCallBack("#bilder");

    $.get("Webpage/bilderliste/", callback);
}

