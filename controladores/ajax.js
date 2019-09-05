var respuestaAjax; 

function Ajax(url, parametros, manejarRespuesta)
{
    var peticionHTTP;
   
    if(window.XMLHttpRequest)
        peticionHTTP=new XMLHttpRequest();
    else
        peticionHTTP=new ActiveObject("Microsoft.XMLHTTP");

    peticionHTTP.onreadystatechange=funcionActuadora;
    peticionHTTP.open("POST", url, true);
    peticionHTTP.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    peticionHTTP.send(parametros); //No envian datos al servidor

    function funcionActuadora()
    {
        if(peticionHTTP.readyState==4 && peticionHTTP.status==200)
        {
            respuestaAjax=peticionHTTP.responseText;
            manejarRespuesta();
        }
    }
}