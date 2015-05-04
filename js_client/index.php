<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">

<html lang="en-us" style="min-width:320px;">
<head>

	<object id="plugin0" type="application/x-emotivlifesciences" width="0" height="0">
		<param name="onload" value="pluginLoaded" />
	</object>

    <title>Emotiv Control Panel</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"	>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" >
	<style>
		.bottom_content{
			float: none;
			clear: left;
		}
		
		.actClass{
			clear: left;
			float: left;
			padding-top: 10px;
			font-family: "Lucida Sans Unicode","Lucida Grande", sans-serif; 
			min-width: 200px;
		}
		
		.blinkLog{
			max-width: 1200px;
			height: 40px;
			float: left;
		}
		
		.nodLog{
			max-width: 1200px;
			height: 40px;
			float: left;
		}
	
		.data{
			float: left;
			width: 2px;
			height: 100%;
		}
		
		.oneSt{
			background-color: red;
		}
		
		.zeroSt{
			background-color: #eee;
		}
		
		.agreeSt{
			background-color: green;
		}
		
		.disagreeSt{
			background-color: red;
		}
		
	</style>
	
    <meta name="Keywords" content="emotiv, emotivinsight"/>
    <meta name="Description" content="emotiv.co"/>
    <meta http-equiv="Content-Type" content="text/html; charset=us-ascii">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no"><!-- Jquery core Library -->

	<script type="text/javascript" src = "js/plugin/EdkDll.js"></script>
	<script type="text/javascript" src = "js/plugin/EmoState.js"></script>
	<script type="text/javascript" src = "js/plugin/EmoEngine.js"></script>
	
	<script type="text/javascript">
	var test1 = function(){
		var engine = EmoEngine.instance();
		var es = new EmoState();
	
		EdkDll.EE_EngineGetNextEvent(); //Get next Events of EPOC
		es.ES_GetContactQualityFromAllChannels();//Get value of Contact Quality
		//engine.CognitivGetActionsEnabled(EdkDll.EE_EmoEngineEventGetUserId()); //return cognitiv actions enabled
		
		// Works!!
		//$("body").append(engine.CognitivGetActionsEnabled(0));
		//$("body").append("<br>");
		//$("body").append(EdkDll.EE_EmoEngineEventGetUserId());
/*		if(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()).pXOut > 20 || EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()).pYOut > 20){
			//$("body").append(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()));
			$("body").append("You're nodding!");
			$("body").append("<br>");	
		}
*/

/*
		if(EdkDll.ES_ExpressivIsBlink()){
			//$("body").append(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()));
			//$("body").append("You're blinking!");
			//$("body").append("<br>");
			$(".blinkLog").append("<div class='oneSt data'>1</div>");
		}
		else{
			$(".blinkLog").append("<div class='zeroSt data'>0</div>");
		}
*/

		if(!EdkDll.ES_ExpressivIsEyesOpen()){
			//$("body").append(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()));
			//$("body").append("You're blinking!");
			//$("body").append("<br>");
			$(".blinkLog").append("<div class='oneSt data'></div>");
		}
		else{
			$(".blinkLog").append("<div class='zeroSt data'></div>");
		}


		if(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()).pXOut > 20){
			$(".nodLog").append("<div class='disagreeSt data'></div>");
		}
		else if(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()).pYOut > 20){
			$(".nodLog").append("<div class='agreeSt data'></div>");
		}
		else{
			$(".nodLog").append("<div class='zeroSt data'></div>");
		}		


		//console.log(EdkDll.EE_HeadsetGetGyroDelta(EdkDll.EE_EmoEngineEventGetUserId()));
		//console.log(EdkDll.ES_ExpressivIsBlink());

		if(timeCt > 1200)
		{
			return;
		}
		
		setTimeout(test1,100);
		
		timeCt++;
		
	
	};
	
			
	</script>

	<script src="js/jquery-1.10.1.min.js" type="text/javascript"></script>

	<script type="text/javascript" src="js/page/Calibration.js"></script>

    <script type="text/javascript">
	function ELSPlugin()
	{
		return document.getElementById('plugin0');
	}
	//check plugin is exist
	function checkPluginExits()
	{
		var L = navigator.plugins.length;
		for(var i = 0; i < L; i++)
		{
			console.log(
				navigator.plugins[i].name +
				" | " +
				navigator.plugins[i].filename +
				" | " +
				navigator.plugins[i].description +
				" | " +
				navigator.plugins[i].version +
				"<br>"
			);
			if(navigator.plugins[i].name=="EmotivLifeSciences")
			{
				return true;
				break;
			}
		}
		return false;
	}
	function pluginLoaded()
    {
		//Uncomment below script to arlet plugin loaded
        //alert("Plugin loaded!");
    }
	//if not exist or older version, notify to download
	window.onload=function()
	{
		if(!checkPluginExits())
		{
			var confirmDownload = confirm("Download plugin (Please restart your browser after install plugin)?");
			if (confirmDownload == true)
			{
				window.location.href=('download.php');
			}
		}
		else
		{
			<?php

			//load file xml
			$xml = simplexml_load_file("http://brainmetrics.emotivinsight.com/Download/version.xml") or die("Unable to load XML file.");

			foreach($xml->version as $version)

			?>
			if(version != "<?php echo $version->number;?>")
			{
				var confirmUpdate = confirm("Update New Version (Please restart your browser after install plugin)?");
				if (confirmUpdate == true)
				{
					window.location.href=('download.php');
				}
			}
		}
		init();
	};

	// main javascript
	var version = ELSPlugin().version;
	var sysTime;
	var wirelessSignal;
	var batteryPower;
	var isEngineConnect;
	var isConnected;
	var engine = EmoEngine.instance();
	var userIdProfile = 0;
	var timeCt = 0;
	
	function init()
	{
		//for debug EdkDll function
		//EdkDll.DebugLog = true;
		AddValidLicenseDoneEvent();
		EdkDll.ELS_ValidLicense();
		//sysTime = document.getElementById("txtInputTime");
		//sysTime.value = "00.0000";
	}

	function AddValidLicenseDoneEvent()
	{
		EdkDll.addEvent(ELSPlugin(), 'valid', function(license){
			console.log("license");
			console.log(license);
			if(license.indexOf('"License":"EEG"') > -1) console.log("License is EEG License. You can get all data.");
			else if (license.indexOf('"License":"Non-EEG"') > -1) console.log("License is Non-EEG License. You can get all non-eeg data.");
			else console.log("The license is not valid. Please get valid license to get data");
			engine.Connect();
			updateEmoEngine();
        });
	}
	function updateEmoEngine()
	{
		try
		{
			engine.ProcessEvents(500);
			setTimeout("updateEmoEngine()",50);
			if (isConnected == true) StartEdk();
		}
		catch(e)
		{
			alert(e);
		}
	}
	// Handle UserAdded event
	$(document).bind("UserAdded",function(event,userId){
		isConnected = true;
		userIdProfile = userId;
		//alert("Added User");
		btnAddClick1();
	});

	// Handle UserRemoved event
	$(document).bind("UserRemoved",function(event,userId){
		isConnected = false;
		//alert("Removed User");
	});

	$(document).bind("EmoEngineErrorRemote",function(){
		isConnected = false;
		alert("Cannot connect to Composer - please make sure composer is open");
	});

	$(document).bind("EmoStateUpdated",function(event,userId,es){
		var getTime = es.GetTimeFromStart()
		var timefromStart = new String(getTime);
		var timeStart;
		if (getTime <10)
		{
			timeStart = timefromStart.substring(0,6);
		}
		else timeStart = timefromStart.substring(0,7);
		//sysTime.value = timeStart;<
		var wireSignal= es.GetWirelessSignalStatus();
		//throw wireSignal;
		var batteryArr = es.GetBatteryChargeLevel();
		//loadBatteryQuality(batteryArr["chargeLevel"]);
		//loadWirelessQuality(wireSignal);
	});

</script>

</head>

<body>

	<header>
	    <div class="row text-center">
		 <img src="icon.png">
		</div>
	</header>

	<div class="container">

    <!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
		<div class="row text-center>
			<div class="player-container row">
				<div class="row text-center">
					<div id="player"></div>
				</div>
			<p class="text-center" style="font-size:33px">Watch this get <i class="fa fa-bitcoin"></i>0.0525</p>

				</div>
		
			<div class="row text-left" style="padding:13px">
				<div class="actClass">
				Blink / Eyes Closed:
				</div>
				<div class="blinkLog"></div>
			</div>
			<div class="row text-left" style="padding:13px">
				<div class="actClass">
				Agree or Disagree?:
				</div>	
				<div class="nodLog"></div>

			</div>
			
			 <div class="bottom_content row text-center" style="padding:23px">
				<a name="strRecording" class="playButton btn btn-success btn-lg" id="strRecording" value="Play" /><i class="fa fa-check-circle"></i> Play</a>
				<a name="stpRecording" class="stopButton btn btn-danger btn-lg" id="stpRecording" value="Stop" /><i class="fa fa-stop"></i> Stop</a>
			 </div>
		<div>
	</div>
	
	<script>
      // 2. This code loads the IFrame Player API code asynchronously.
      var tag = document.createElement('script');

      tag.src = "https://www.youtube.com/iframe_api";
      var firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

      // 3. This function creates an <iframe> (and YouTube player)
      //    after the API code downloads.
      var player;
      function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
          height: '390',
          width: '640',
          videoId: 'dKUy-tfrIHY',  //'M7lc1UVf-VE'
          events: {
          
            'onStateChange': onPlayerStateChange
          }
        });
      }

	  $('.playButton').on('click', function(event) {
		player.playVideo();
		test1();
	  });
      // 4. The API will call this function when the video player is ready.
    //  function onPlayerReady(event) {
      //  event.target.playVideo();
     // }

      // 5. The API calls this function when the player's state changes.
      //    The function indicates that when playing a video (state=1),
      //    the player should play for six seconds and then stop.
      var done = false;
      function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
          setTimeout(stopVideo, 60000);
          done = true;
        }
      }
      function stopVideo() {
        player.stopVideo();
      }
	  
	  $('.stopButton').on('click', function() {
		player.stopVideo();
	  });
    </script>
</body>
</html>
