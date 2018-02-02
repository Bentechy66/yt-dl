<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
?>
<?php
    if(isset($_GET["url"])) {
         $url = $_GET["url"];
         if(isset($_GET["filename"])) {
             $fn = $_GET["filename"];
         } else {
             $fn="Download.mp3";
         }
         if(strpos($fn, '.mp3') == false) {
             $fn = $fn . ".mp3";
        }

         //header("Content-disposition: attachment; filename=\"" . $fn  ."\"");
         
        exec("youtube-dl --extract-audio -o '" . $fn . "' --audio-format mp3 " . escapeshellarg($url));
        $file_url = $fn;
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url);
         
         
        die();
}

   /* if(strpos($filename, '.mp3') !== false || strpos($filename, ' ') !== false) {
    header( 'Location: http://ben.mctrees.net/ytdl.html?err=filename') ;
    } else {
    header( 'Location: http://ben.mctrees.net/' . $filename . '.mp3' ) ;
    }*/

    ?>




    <?php
    $err = "null";
    if(isset($_GET["err"]))
    {
        if($_GET["err"] == "filename") {
            $err = "filename";
        }
    }
    ?>


<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.5.3/css/bulma.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
    <title>YT2MP3</title>
    
    <!-- Global site tag (gtag.js) - Google Analytics -->

<script async src="https://www.googletagmanager.com/gtag/js?id=UA-96357632-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-96357632-1');
</script>

    
    <!--this is for testing please dont kill me thank you-->
    <style>
    html {
    position: relative;
    min-height: 100%;
}
body {
    margin: 0 0 0px;
    /* bottom = footer height */
    padding: 0px;
}
footer {
    position: absolute;
    left: 0;
    bottom: 0;
    height: 100px;
    width: 100%;
    overflow:hidden;
}
    </style>
    
    <script>
    
    function GetElement()
    {
        var changeIt = document.getElementById('loading');
        changeIt.style.visibility = 'hidden';
    }
    function load(){
        var changeIt = document.getElementById('loading');
        changeIt.style.visibility = 'visible';
        document.getElementById("submit").classList.add('is-loading');
        }
        
        
    </script>
    
</head>


<body onload="GetElement();">


<div class="has-text-centered">
    <!--<h1 class="title">YT<b>2</b>MP3</h1>-->
    
<section class="hero is-primary is-bold">
  <div class="hero-body">
    <div class="container">
      <h1 class="title">
        YT<strong>2</strong>MP3
      </h1>
      <h2 class="subtitle">
        A simple, no-nonsense youtube downloader.
      </h2>
    </div>
  </div>
</section>
    
    <section class="section">
    <div id="YTform" class="notification">
    <form action="#" method="get">
    
    <div class="field">
    <label class="label">Video URL</label>
    <input class="input" name="url" type="input" placeholder="URL of YT video" required>
    </div>
    
    <div class="field">
    <label class="label">Filename to be saved as</label>
    <input class="input<?php if($err == "filename") { echo " is-danger"; }?>" name="filename" type="input" placeholder="Download.mp3">
    </div>
    <div class="has-text-centered field">
        <div class="has-text-centered control">
            <button onclick="load();" id="submit" class="button is-success">Begin!</button>
        </div>
        <div class="has-text-centered control">
            <button onclick="alert('Go away then')" class="button is-text">Cancel</button>
       </div>
    </div>
    </form>
    
    <br><p id="loading">Please wait a few moments while we get your video!</p>
    
    </div>
    </section>
    <?php
    if(isset($_GET["err"]))
    {
        if($_GET["err"] == "filename") {
            $err = "filename";
            echo("There was a problem with your filename. Please check it doesn't contain special charecters or spaces, and it shouldn't have the .mp3 on the end.<br><br>");
        }
    }
    ?>
    <p>Once you submit the form, the page will load for a few seconds, then you'll be redirected to your mp3.</p>
</div>
    
    
    <footer class="footer"><center><p>YT2MP3 &copy; Ben Griffiths 2017</p><p>Uses youtube-dl and Bulma</p></center></footer>
    
    <script>   
//document.getElementsByTagName("form")[0].onsubmit = function(e) {
    //e.preventDefault();
    //return false;
//}
</script>
</body>
</html>
