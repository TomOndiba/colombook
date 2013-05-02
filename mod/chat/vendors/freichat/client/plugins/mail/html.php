<html>
    <head>
        <title>
	Send Conversation as mail
        </title>
           <style type="text/css">
.frei_upload_button {
	box-shadow:inset 0px 1px 0px 0px #bbdaf7;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #79bbff), color-stop(1, #378de5) );
	background:-moz-linear-gradient( center top, #79bbff 5%, #378de5 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#79bbff', endColorstr='#378de5');
	background-color:#79bbff;
	border-radius:6px;
	border:1px solid #84bbf3;
	display:inline-block;
	color:#ffffff;
	font-family:arial;
	font-size:15px;
	font-weight:bold;
	padding:6px 24px;
	text-decoration:none;
	text-shadow:1px 1px 0px #528ecc;
}.frei_upload_button:hover {
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #378de5), color-stop(1, #79bbff) );
	background:-moz-linear-gradient( center top, #378de5 5%, #79bbff 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#378de5', endColorstr='#79bbff');
	background-color:#378de5;
}.frei_upload_button:active {
	position:relative;
	top:1px;
}

body{
    font-family: "Arial Black";
}

    </style>
    </head>
    <body>
        <h4> FreiChat Email </h4>
        <br/>
        <form name="upload" action="sendmail.php" method="post">

            Subject : <br/>
            <input size="50px" type="text" id="subject" name="subject" value=""/>

            <input id ="fromid" type="hidden" name="fromid"/>
            <input id="fromname" type="hidden" name="fromname"/>
            <input id="toid" type="hidden" name="toid"/>
            <input id="toname" type="hidden" name="toname"/>

            <br/><br/> Receiver's email address :<br/>
            <input size="50px" type="text" id="mailto" name="mailto"/>

            <br /><br/>
            <input  class="frei_upload_button" type="submit" name="submit" value="Send" />
        </form>


    </body>

</html>
<script>
    function freiVal(name,value)
    {
        var element = document.getElementById(name);

        if(element != null)
        {
            element.value=value;
        }
        else
        {
            alert("element does not exists");
        }
    }

    freiVal("subject","Conversation with "+opener.FreiChat.touser);
    freiVal("toid",opener.FreiChat.toid);
    freiVal("fromid",opener.freidefines.reidfrom);
    freiVal("toname",opener.FreiChat.touser);
    freiVal("fromname",opener.freidefines.fromname);
</script>