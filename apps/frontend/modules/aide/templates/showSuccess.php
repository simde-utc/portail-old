<div id="aide" class="part">
  <h1>
    Aide
  </h1>
    
    <h2>
        Modifier ses informations
    </h2>
    <div class="well">
        <object id="MediaPlayer1"
            CLASSID="CLSID:22d6f312-b0f6-11d0-94ab-0080c74c7e95" type="application/x-oleobject"
            codebase="http://activex.microsoft.com/activex/controls/mplayer/en/nsmp2inf.cab#Version=6,4,5,715"
            standby="Chargement..."
            width="580" height="400">
            <!-- pour afficher le Windows Media player dans Internet Explorer: -->
            <param name="Filename" value="/videos/profile.avi">
            <param name="AnimationAtStart" value="True">
            <param name="AutoStart" value="False">
            <param name="showControls" value="True">
            <param name="ShowStatusBar" value="False">
            <param name="ShowDisplay" value="False">
            <param name="ShowTracker" value="False">
            <param name="AutoRewind" value="True">
            <param name="Volume" value="-200">

            <!-- pour afficher le media player par défaut dans Firefox: -->
            <embed type="application/x-mplayer2" 
                    name="MediaPlayer1"
                    width="580" height="400"
                    pluginspage="http://www.microsoft.com/Windows/MediaPlayer/" 
                    src="/videos/profile.avi" 
                    autostart="False"
                    showcontrols="True"
                    showstatusbar="False" 
                    showdisplay="False"
                    showtracker="False"
                    autorewind="True"
                    volume="-200"
            ></embed>

    </object> 
    </div>


</div>