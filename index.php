<?php
namespace lib;
ini_set('display_errors', true);

require('./lib/content/menu.php');

use lib\content\Menu;

spl_autoload_extensions('.php');
spl_autoload_register();

//Template maitre, les pages supplémentaires sont à mettre dans le dossier pages

// Menu principal
if (empty($_GET['page'])) {
    header('Location: /home');
    exit();
}
$_GET['page'] = empty($_GET['page'])?'home':$_GET['page'];
$masterMenuLinks = array('home' => 'Accueil',
                         'page1' => 'Pages 1',
                         'page2' => 'Pages 2',
                         'page3' => 'Pages 3');
$masterMenu = new Menu();
foreach($masterMenuLinks as $page => $title){
    $masterMenu->addlink($title, $page, ($_GET['page'] == $page));
}

// Contenu de la page
str_replace("\0", '', $_GET['page']); //Protection bytenull
str_replace(DIRECTORY_SEPARATOR, '', $_GET['page']); //Protection navigation
$contentPage = 'pages/'.$_GET['page'].'.php';
$contentPage = file_exists($contentPage)?$contentPage:'pages/404.php';

//Affichage
?><!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="author" content="EnsiLAN" />
        <meta http-equiv="X-UA-Compatible" content="chrome=1" />
        <meta name="viewport" content="width=device-width" />
        <meta name="robots" content="index, follow, archive" />
        <meta name="keywords" content="XID, ENSISA, Nuit de l'info, Mulhouse, ingénieur" />
        <meta name="description" content="Template du site de la nuit de l'info du XID de l’ENSISA !" />
        
        <title>Template Nuit de l'info - XID</title>
        
        <!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
        <link rel="stylesheet" media="screen" href="/css/style.css" />
        
        <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" /> 
		<link rel="icon" type="image/png" href="/favicon.png" />
    </head>
    
    <body>
        
        <header>
            <h1><a href="/" title="Template Nuit de l'info - XID">Template Nuit de l'info - XID</a></h1>
            <nav id="header-menu">
                <?php echo $masterMenu; ?>
            </nav>
        </header>
        
        <div id="content">
            <?php include($contentPage); ?>
        </div>
        
        <footer>
            <p>
                <span><a href="http://xid.ensisa.info/">XID -  Mis à jour : <?php include('maj.php')?></a>
                <br />&copy; 2012 &ndash; XID <img src="/favicon.png" alt="PacMan" width="16" height="16" /> <a href="/mentions">mentions</a></p>
                </span>
        </footer>
        
    </body>
</html>
