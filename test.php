<?php  
/*------------------------------------------------------------------------
# author    Hakiri Atef Dtcad-engineering
# copyright Copyright © 2012. All rights reserved.
# @license  http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Website   http://www.dtcad-engineering.com
-------------------------------------------------------------------------*/

defined( '_JEXEC' ) or die; 

JHTML::_('behavior.mootools');
JHTML::_('behavior.modal');
JHtml::_('behavior.framework', true);
// parameters (template)
 $today = getdate();

$modernizr = $this->params->get('modernizr');
$bootstrap = $this->params->get('bootstrap');
$pie = $this->params->get('pie');
$db =& JFactory::getDBO();
// variables
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$params = $app->getTemplate(true)->params;
//$pageclass = $params->get('pageclass_sfx'); // parameter (menu entry)
$tpath = $this->baseurl.'/templates/'.$this->template;
//echo "<pre>"; print_r($doc); echo "</pre>"; 
$doc->addScript($this->baseurl.'/templates/'.$this->template.'/js/md_stylechanger.js', 'text/javascript', true);
?>
<?php
//echo "<pre>"; print_r($doc); echo "</pre>"; 
?>
<?php
// load sheets and scripts
$doc->addStyleSheet($tpath.'/css/bootstrap.min.css'); 
$doc->addStyleSheet($tpath.'/css/bootstrap-theme.min.css'); 
?>
<?php
$doc->addStyleSheet($tpath.'/css/product_detail.css'); 
$doc->addStyleSheet($tpath.'/css/templatev5.css');
$doc->addStyleSheet($tpath.'/css/font-awesome.min.css'); 

$doc->addStyleSheet($tpath.'/css/style.css'); 
if ($modernizr==1) $doc->addScript($tpath.'/js/modernizr.js'); // <- this script must be in the head

// unset scripts, put them into /js/template.js.php to minify http requests
unset($doc->_scripts[$this->baseurl.'/media/system/js/mootools-core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/core.js']);
unset($doc->_scripts[$this->baseurl.'/media/system/js/caption.js']);

?><!doctype html>
<!--[if IEMobile]><html class="iemobile" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="<?php echo $this->language; ?>"> <![endif]-->
<!--[if gt IE 8]><!-->  <html class="no-js" lang="<?php echo $this->language; ?>"> <!--<![endif]-->

<head> 
   <meta name="revisit-after" content="1 day">
   <meta name="robots" content="index, follow">
  <?php  $query = "SELECT params  FROM #__menu where  id = ".JRequest::getVar('Itemid')."";
		  $db->setQuery($query);
		  $result = $db->loadObject();
		  $obj = json_decode($result->params);
	?>
  <?php if($obj->{'menu-meta_description'}!='') {?>
  
  <meta content="<?php  echo $obj->{'menu-meta_description'} ;?>" name="description">
  <meta content="<?php  echo $obj->{'menu-meta_keywords'} ;?>" name="keywords">
  <?php } ?>
  <?php if(JRequest::getVar('view')=='productdetails') {
	      $productdetails = "SELECT product_s_desc  FROM #__virtuemart_products_fr_fr where  virtuemart_product_id = ".JRequest::getVar('virtuemart_product_id')."";
		  $db->setQuery($productdetails);
		  $resultdtatil = $db->loadObject();
		  ?>
  <meta content="<?php  echo $resultdtatil->product_s_desc ;?>" name="description">
  <?php } ?>
  <script type="text/javascript" src="<?php echo $tpath.'/js/script.js';?>"></script>
  <script type="text/javascript" src="<?php echo $tpath.'/js/template.js.php?b='.$bootstrap.'v=1'; ?>"></script>
  <?php /*?><script type="text/javascript" src="<?php echo $tpath.'/js/jquery-1.4.2.min.js'; ?>" ></script><?php */?>
  <script  type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo $tpath.'/js/bootstrap.min.js';?>"></script>

  <jdoc:include type="head" />
  
  <?php if ($pie==1) : ?>
    <!--[if lte IE 8]>
      <style> 
        {behavior:url(<?php echo $tpath; ?>/js/PIE.htc);}
      </style>
    <![endif]-->
  <?php endif; ?>
  <style type="text/css">
  	#slider202 li img
  	{
  		max-width: 130px !important;
  	}
  	#djslider202 ul#slider202 li
  	{
  		max-width: 150px !important;
  	}
  	.agrement h3
  	{
  		margin-bottom: 0 !important;
  	}
  	div#slider-container202 li {
    line-height: 94px; 
    }
    div#djslider202 li {
    min-width: 180px;
    }
  </style>
</head>
	
<body class="<?php echo $pageclass; ?>">
<header id="logo" class="header_top">
    	<div class="row header">
		<div class="container">
			<div class="logo_tamari col-md-2 col-sm-2">
					   <a href="<?php echo $this->baseurl;?>/index.php"> <img src="<?php echo $tpath; ?>/images/logo_tamari06.png" /></a>
			</div> <!-- logo -->
			<div class=" col-md-7 col-sm-7 col-sm-offset-1 col-md-offset-1">
            		<div class="row">
                         <div class=" ">
                          <?php if ($this->countModules('auto')): ?>
                     <jdoc:include type="modules" name="auto" style="xhtml" />
                 <?php endif ; ?>
                        
                         </div>
                     </div>
			</div> <!-- logo -->
			<div class="logo_vfl col-md-2 col-sm-2">
				<?php $user = JFactory::getUser();?>
				<div class="name">
				<?php if($user->id=='') {?> <style> .logo_vfl{margin-top:10px !important;}</style><?php }
					else{?><style> .name {border-bottom: 1px solid #606060;margin-bottom: 6px;}</style>
					<?php }if($user->id) {
					echo "Bonjour ".$user->prenom; echo"  ";$user->name ?>
				</div>
				<div class="deconnexion"><span class="vert"><i class="fa fa-check-square"></i>Connecté</span> |<span class="red"><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&d=d&lang=fr'); ?>"> Déconnexion</a></span>
				<?php } ?>
				</div>
				<a href="<?php echo $this->baseurl;?>/index.php"> <img src="<?php echo $tpath; ?>/images/logo_vfl.png" /></a>
			</div> <!-- logo -->
			</div>
			<div class="col-lg-12 col-md-12 col-xs-12  header_border"></div>
			<div class="col-lg-12 col-md-12 col-xs-12  header_menu">
				<div class="container">
					<?php if ($this->countModules('mainnav')): ?>
						<div class="headerbottom">
							<nav class="navbar navbar-default navbar-static-top" role="navigation">
								<!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
								<div  style="float:left;padding-left: 0px;">
									<div class="navbar-header">
										<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>								
									<!-- Collect the nav links, forms, and other content for toggling -->
									<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
										<jdoc:include type="modules" name="mainnav" style="xhtml" />
									</div> <!-- headerbottom -->
								</div><!-- /.navbar-collapse -->
							</nav>
							<?php endif ; ?>
						</div> 
				</div>
			</div>
            </div>
			<div class="header_bottom">
                   <div class="container">
                       <div class="row">
                        <?php /*?><jdoc:include type="modules" name="banner" style="xhtml" /><?php */?>
                       <?php if(JRequest::getVar('virtuemart_product_id')=='2146341029'){ ?>
                        <img class="slider" src="<?php echo $tpath; ?>/images/banners/PARISBREASTDAY1.jpg" />
                        <?php } else {?>
                        <img class="slider" src="<?php echo $tpath; ?>/images/banners/slide1.png" />
                        <?php } ?>
                     </div> 
                  </div> 
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 content_border"></div>
		
      
</header>
  <section id="content">
  <div class="container search "<?php if(JRequest::getVar('formation')!=''){?> style=" background: #fff; padding: 20px; "<?php }?>>
		<div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<?php if(JRequest::getVar('option')=='com_acesearch'){ ?>
				<div class="fileariane">
					<div class="moduletable">          
						<div class="breadcrumbs">
						<span class="showHere">Vous êtes ici : </span><a class="pathway" href="index.php?lang=fr">Accueil</a>  &gt; 
						<?php if(JRequest::getVar('type')=='sem'){?>
						<?php if(JRequest::getVar('Itemid')==376 && JRequest::getVar('specialite')==''  ) { ?>Liste des thèmes    <?php }?>
						<?php if(JRequest::getVar('Itemid')==374 && JRequest::getVar('specialite')=='') { ?>Recherche par profession<?php } ?>
						<?php if(JRequest::getVar('virtuemart_country_code') ) { ?>Recherche par ville<?php } ?>
						<?php if(JRequest::getVar('specialite')==2) { ?>Profession : PHARMACIEN <?php } ?>
						<?php if(JRequest::getVar('specialite')==3) { ?>Profession : INFIRMIER <?php } ?>
						<?php if(JRequest::getVar('specialite')==4) { ?>Profession : DENTISTE<?php } ?>
						<?php if(JRequest::getVar('specialite')==5) { ?>Profession : KINESITHERAPEUTE <?php } ?>
						<?php if(JRequest::getVar('specialite')==6) { ?>Profession : SAGE FEMME<?php } 
						}
						else{
						if(JRequest::getVar('Itemid')==376) { ?>Recherche par thème : <?php }?>
						<?php if(JRequest::getVar('Itemid')==375 || JRequest::getVar('date_debut')!='' && JRequest::getVar('Itemid')!= 376) { ?>Recherche par date : <?php } ?>
						<?php if(JRequest::getVar('virtuemart_country_code')) { ?>Formations pour le département
						<?php if(JRequest::getVar('virtuemart_country_code')=='2A') {echo 'Corse du Sud';}?>
						<?php if(JRequest::getVar('virtuemart_country_code')=='2B') {echo 'Haute Corse';}?>
						<?php 
						// Tableau des départements français !
						switch(JRequest::getVar('virtuemart_country_code')) {
						case 01:  echo  'Ain'; break;
						case 02:  echo  'Aisne'; break;
						case 03:  echo  'Allier'; break;
						case 04:  echo  'Alpes de Haute Provence'; break;
						case 05:  echo  'Hautes Alpes'; break;
						case 06:  echo  'Alpes Maritimes'; break;
						case 07:  echo  'Ardèche'; break;
						case 08:  echo  'Ardennes'; break;
						case 09:  echo  'Ariège'; break;
						case 10:  echo  'Aube'; break;
						case 11:  echo  'Aude'; break;
						case 12:  echo  'Aveyron'; break;
						case 13:  echo  'Bouches du Rhône'; break;
						case 14:  echo  'Calvados'; break;
						case 15:  echo  'Cantal'; break;
						case 16:  echo  'Charente'; break;
						case 17:  echo  'Charente Maritime'; break;
						case 18:  echo  'Cher'; break;
						case 19:  echo  'Corrèze'; break;
						case 21:  echo  'Côte d\'Or'; break;
						case 22:  echo  'Côtes d\'Armor'; break;
						case 23:  echo  'Creuse'; break;
						case 24:  echo  'Dordogne'; break;
						case 25:  echo  'Doubs'; break;
						case 26:  echo  'Drôme'; break;
						case 27:  echo  'Eure'; break;
						case 28:  echo  'Eure et Loir'; break;
						case 29:  echo  'Finistère'; break;
						case 30:  echo  'Gard'; break;
						case 31:  echo  'Haute Garonne'; break;
						case 32:  echo  'Gers'; break;
						case 33:  echo  'Gironde'; break;
						case 34:  echo  'Hérault'; break;
						case 35:  echo  'Ille et Vilaine'; break;
						case 36:  echo  'Indre'; break;
						case 37:  echo  'Indre et Loire'; break;
						case 38:  echo  'Isère'; break;
						case 39:  echo  'Jura'; break;
						case 40:  echo  'Landes'; break;
						case 41:  echo  'Loir et Cher'; break;
						case 42:  echo  'Loire'; break;
						case 43:  echo  'Haute Loire'; break;
						case 44:  echo  'Loire Atlantique'; break;
						case 45:  echo  'Loiret'; break;
						case 46:  echo  'Lot'; break;
						case 47:  echo  'Lot et Garonne'; break;
						case 48:  echo  'Lozère'; break;
						case 49:  echo  'Maine et Loire'; break;
						case 50:  echo  'Manche'; break;
						case 51:  echo  'Marne'; break;
						case 52:  echo  'Haute Marne'; break;
						case 53:  echo  'Mayenne'; break;
						case 54:  echo  'Meurthe et Moselle'; break;
						case 55:  echo  'Meuse'; break;
						case 56:  echo  'Morbihan'; break;
						case 57:  echo  'Moselle'; break;
						case 58:  echo  'Nièvre'; break;
						case 59:  echo  'Nord'; break;
						case 60:  echo  'Oise'; break;
						case 61:  echo  'Orne'; break;
						case 62:  echo  'Pas de Calais'; break;
						case 63:  echo  'Puy de Dôme'; break;
						case 64:  echo  'Pyrénées Atlantiques'; break;
						case 65:  echo  'Hautes Pyrénées'; break;
						case 66:  echo  'Pyrénées Orientales'; break;
						case 67:  echo  'Bas Rhin'; break;
						case 68:  echo  'Haut Rhin'; break;
						case 69:  echo  'Rhône-Alpes'; break;
						case 70:  echo  'Haute Saône'; break;
						case 71:  echo  'Saône et Loire'; break;
						case 72:  echo  'Sarthe'; break;
						case 73:  echo  'Savoie'; break;
						case 74:  echo  'Haute Savoie'; break;
						case 75:  echo  'Paris'; break;
						case 76:  echo  'Seine Maritime'; break;
						case 77:  echo  'Seine et Marne'; break;
						case 78:  echo  'Yvelines'; break;
						case 79:  echo  'Deux Sèvres'; break;
						case 80:  echo  'Somme'; break;
						case 81:  echo  'Tarn'; break;
						case 82:  echo  'Tarn et Garonne'; break;
						case 83:  echo  'Var'; break;
						case 84:  echo  'Vaucluse'; break;
						case 85:  echo  'Vendée'; break;
						case 86:  echo  'Vienne'; break;
						case 87:  echo  'Haute Vienne'; break;
						case 88:  echo  'Vosges'; break;
						case 89:  echo  'Yonne'; break;
						case 90:  echo  'Territoire de Belfort'; break;
						case 91:  echo  'Essonne'; break;
						case 92:  echo  'Hauts de Seine'; break;
						case 93:  echo  'Seine St Denis'; break;
						case 94:  echo  'Val de Marne'; break;
						case 95:  echo  'Val d\'Oise'; break;
						case 97:  echo  'DOM'; break;
						case 971:  echo  'Guadeloupe'; break;
						case 972:  echo  'Martinique'; break;
						case 973:  echo  'Guyane'; break;
						case 974:  echo  'Réunion'; break;
						case 975:  echo  'Saint Pierre et Miquelon'; break;
						case 976:  echo  'Mayotte'; break;
						}
						?>  
						<?php } ?>
						<?php if(JRequest::getVar('date_debut')){echo'  '. JRequest::getVar('date_debut') ;}?>
						<?php if(JRequest::getVar('lieu')){echo' / '. JRequest::getVar('lieu') ;}
						}
						?>
						</div>
					</div>

				</div>
				<?php }
				else
				{
					if(JRequest::getVar('option')=='com_charte'){?>
					<div class="fileariane">
						<div class="moduletable">          
							<div class="breadcrumbs">
								<span class="showHere">Vous êtes ici : </span>
								<a class="pathway" href="index.php?lang=fr">Accueil</a>  &gt;
								Selectionnez le département de votre choix
							</div>
						</div>
					</div>
					<?php 
					}
					else
					{
						if($this->countModules('breadcrumbs'))
						{ ?>
						<div class="fileariane">
							<jdoc:include type="modules" name="breadcrumbs" style="xhtml" />
						</div>
						<?php }
					} 
				}
				?>
			</div>
		</div>
		<div class="row search">
                <?php 
                  if($_SERVER['REQUEST_URI']=='/index.php' || $_SERVER['REQUEST_URI']=='/' || $_SERVER['REQUEST_URI']=='/index.php?lang=fr' || $_SERVER['REQUEST_URI']=='/?lang=fr'){  ?>
                 <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6  theme" >
					<a href="<?php echo JRoute::_('index.php?option=com_acesearch&view=search&type=sem&query=&filter=&Itemid=376&lang=fr'); ?>">
					<img src="<?php echo $tpath; ?>/images/theme.png" /><br>
					<h1>recherche par thème</h1><br></a>
					<a class="rechercher" href="<?php echo JRoute::_('index.php?option=com_acesearch&view=search&type=sem&query=&filter=&Itemid=376&lang=fr'); ?>">RECHERCHER</a>
				</div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6 date">
					<!--<a href="<?php // echo JRoute::_('index.php?option=com_acesearch&view=search&type=sess&query=&filter=&Itemid=375&lang=fr'); ?>">-->
					<img src="<?php echo $tpath; ?>/images/date.png" /><br>
					<h1> recherche par date</h1>
                   <!-- </a>-->
					<br>
					<form action="<?php echo JRoute::_('index.php?option=com_acesearch&view=search&type=sess&lang=fr&Itemid=375'); ?>" method="post" style="display:flex;">
						<select class="form-control" id="specialite_date" name="date_debut">
						   <option value="">Selectionnez mois</option>
							<option value="01-01-2019">Janvier</option>
							<option value="01-02-2019">Février</option>
							<option value="01-03-2019">Mars</option>
							<option value="01-04-2019">Avril</option>
							<option value="01-05-2019">Mai</option>
							<option value="01-06-2019">Juin</option>
							<option value="01-07-2019">Juillet</option>
							<option value="01-08-2019">Août</option>
							<option value="01-09-2019">Septembre</option>
							<option value="01-10-2019">Octobre</option>
							<option value="01-11-2019">Novembre</option>
							<option value="01-12-2019">Décembre</option>
						</select>
						<input type="hidden" name="type" value="sess">
						<input type="submit" value="Rechercher" class="rechercher" id="rechercher_date" style="margin-left: 5px;">
					</form>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6   ville" >
					<a href="http://www.tamari06.org/index.php?option=com_charte&view=charte&lang=fr&Itemid=537">
					<img src="<?php echo $tpath; ?>/images/ville.png" /><br>
					<h1> recherche par ville</h1></a>
					</br><a class="rechercher" href="http://www.tamari06.org/index.php?option=com_charte&view=charte&lang=fr&Itemid=537">RECHERCHER</a>
                </div>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6   specialite">
					<img src="<?php echo $tpath; ?>/images/specialite.png" /><br>
					<?php  
					$query = "SELECT pfr.virtuemart_category_id ,pfr.category_name,pfr.statut  FROM #__virtuemart_categories_fr_fr pfr LEFT JOIN #__virtuemart_categories as cc ON   pfr.virtuemart_category_id = cc.virtuemart_category_id  LEFT JOIN  #__virtuemart_category_categories  as c ON pfr.virtuemart_category_id = c.category_child_id  WHERE cc.published = 1 AND  (c.category_parent_id = 1 OR c.category_parent_id = 2 OR c.category_parent_id = 3) AND pfr.statut != 1008 AND pfr.statut != 1006  AND pfr.statut != 1011  AND pfr.statut  != 1012  ORDER BY pfr.category_name";
					$db->setQuery($query);
					$categorie = $db->loadObjectList();
					?>                    
					<h1> recherche par profession</h1>
					</br>
					<form action="<?php echo JRoute::_('index.php?option=com_acesearch&view=search&type=sem&libelle=libelle&lang=fr&Itemid=374'); ?>" method="post">
						<select class="form-control" id="specialite" name="specialite">
						<option value="">Votre profession</option>
						<?php //foreach($categorie as $cat){   ?>
						   <option value="1">MEDECIN</option>
						   <option value="3">INFIRMIER</option>
						   <option value="2">PHARMACIEN</option>
						   <option value="4">DENTISTE</option>
						   <option value="5">KINESITHERAPEUTE</option>
						   <option value="6">SAGE FEMME</option>
						<?php //} ?>
						</select>
						<input type="hidden" name="type" value="sem">
						 <input type="hidden" name="reload" value="reload">
						<input type="hidden" name="pro" value="<?php echo $cat->category_name?>">
						<input type="submit" value="Rechercher" class="rechercher">
					</form>
                </div>
			</div> <!-- row -->
			<div class="row">
				<div class="actualite col-md-6 ">
				 <?php if ($this->countModules('even')): ?>
				 <jdoc:include type="modules" name="even" style="xhtml" />
				 <?php endif ; ?>
				</div>
				<div class="elearning col-md-6">
				<?php if ($this->countModules('elearning')): ?>
				 <jdoc:include type="modules" name="elearning" style="xhtml" />
				 <?php endif ; ?>
				</div>
			</div> <!-- row -->
			<div class="row">
				<div class="col-md-6 col-xs-12 col-sm-12 newsletter">
					<?php if ($this->countModules('right')): ?>
					<jdoc:include type="modules" name="newsletter" style="xhtml" />
					<?php endif ; ?>
				</div>
				<div class="agrement col-md-6 col-xs-12 col-sm-12">
				
						<jdoc:include type="modules" name="agrement" style="xhtml" />
						<jdoc:include type="modules" name="agrem" style="xhtml" />

					
				</div>
                <?php }else
                {?>
                 <jdoc:include type="message" />
                 <jdoc:include type="component" />
                  <?php if ($this->countModules('contact')): ?>
                     <jdoc:include type="modules" name="contact" style="xhtml" />
                     <?php endif ; ?>
                 <?php } ?>
            </div>
        </div>
</section>
<footer class="footer">
	<div class="container">
		
		<div class "row">
			<div class="col-md-3 col-sm-3 col-xs-12">		
			<nav class="navbar navbar-default navbar-static-top" role="navigation">
				<!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
				<div  style="padding-left: 0px;">
				<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-8">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
                <h3>Tamari</h3>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-8">
				<ul>
                   <li><a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=13&Itemid=209&lang=fr'); ?>">L'Association</a></li>
                   <li><a href="http://www.tamari06.org/2017-12-15-09-36-52">Actualités</a></li>
                   <li><a href="<?php echo JRoute::_('index.php?option=com_aicontactsafe&view=message&layout=message&pf=1&redirect_on_success=&Itemid=161&lang=fr'); ?>">Contact</a></li>
               </ul>
               </div><!-- /.navbar-collapse -->
				</div>
			</nav>
			</div>
			<div  class="col-md-3 col-sm-3 col-xs-12"> 
				<nav class="navbar navbar-default navbar-static-top" role="navigation">
					<!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
					<div  style="padding-left: 0px;">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-9">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
                            <h3>formations</h3>
						</div>
						<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
							<ul>
                                <li class="item-551">
                                <a href="<?php echo JRoute::_('index.php?option=com_acesearch&amp;view=search&amp;type=sem&amp;query=&amp;filter=&amp;Itemid=376&amp;lang=fr'); ?>">Recherche par thème</a>
                                </li>
                                <li class="item-374"><a href="<?php echo JRoute::_('index.php?option=com_acesearch&amp;view=search&amp;type=sem&amp;query=&amp;filter=&amp;Itemid=374&amp;lang=fr'); ?>">Recherche par profession</a>
                                </li>
                                <li class="item-375"><a href="<?php echo JRoute::_('index.php?option=com_acesearch&amp;view=search&amp;type=sess&amp;query=&amp;filter=&amp;Itemid=375&amp;lang=fr'); ?>">Recherche par date</a>
                                </li>
                                <li class="item-537"><a href="/index.php?option=com_charte&amp;view=charte&amp;lang=fr&amp;Itemid=377">Recherche par ville</a>
                                
                                </li>
                                <li><a href="/nos-themes-elearning">Formations elearning</a></li>
                              </ul></div><!-- /.navbar-collapse -->
					</div>
				</nav>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<nav class="navbar navbar-default navbar-static-top" role="navigation">
					<!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
					<div  style="padding-left: 0px;">
					<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-10">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
                    <h3>infos pratiques</h3>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-10">
					<ul>
					<li><a href="/events/has/dernieres-publications">Informations pratiques</a></li>
					<li><a href="/events/has/dernieres-publications">HAS</a></li>
					<li><a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=3260&Itemid=383&lang=fr'); ?>">Les financeurs</a></li>
					<li><a href="<?php echo JRoute::_('index.php?option=com_content&view=article&id=1379&Itemid=430&lang=fr'); ?>">Informations sur le DPC</a></li>  
					</ul>
					</div><!-- /.navbar-collapse -->
					</div>
				</nav>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-12">
				<nav class="navbar navbar-default navbar-static-top" role="navigation">
					<!-- We use the fluid option here to avoid overriding the fixed width of a normal container within the narrow content columns. -->
					<div  style="padding-left: 0px;">
					<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-11">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
                    <h3>restez informés</h3>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-11">
					<ul>
                        <li><a href="<?php echo JRoute::_('index.php?option=com_users&view=registration&Itemid=474&lang=fr'); ?>">Création de compte</a></li>
                        <li><a href="<?php echo JRoute::_('index.php?option=com_users&view=login&Itemid=474&lang=fr'); ?>">Connexion</a></li>
                    </ul>
                    </div><!-- /.navbar-collapse -->
                    </div>
                </nav>
       </div>
        <div class="copyright">
        <div class="container">
	       <p>Copyright&nbsp; Tamari06 <?php echo $today['year'];?>. Tous droits réservés</p></div>
           </div></div>
<div id="creation" align="right">
<p>Réalisation <a target="_blank" href="http://www.dtcad-engineering.com">DTCad Engineering</a></p>
</div>
        </div>
       
    <script type="text/javascript">
           $('#rechercher_date').click(function(event){
           	 
           	event.preventDefault();
           	var val =$('#specialite_date').val();
           	console.log(val);



            var lien = 'www';
            if(val=='01-01-2019'){console.log('Janvier');
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-02-2019%20&date_debut=01-01-2019%20'; }
            if(val=='01-02-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-03-2019%20&date_debut=01-02-2019%20'; }
             if(val=='01-03-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-04-2019%20&date_debut=01-03-2019%20'; }
             if(val=='01-04-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-05-2019%20&date_debut=01-04-2019'; }
             if(val=='01-05-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-06-2019%20&date_debut=01-05-2019%20'; }
             if(val=='01-06-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-07-2019%20&date_debut=01-06-2019%20'; }
             if(val=='01-07-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-08-2019%20&date_debut=01-07-2019%20'; }
             if(val=='01-08-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-09-2019%20&date_debut=01-08-2019%20'; }
             if(val=='01-09-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-10-2019%20&date_debut=01-09-2019%20'; }
             if(val=='01-10-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-11-2019%20&date_debut=01-10-2019'; }
             if(val=='01-11-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=01-12-2019%20&date_debut=01-11-2019%20'; }
             if(val=='01-12-2019'){
            window.location.href = '/dpc-formations/formation-medecin-infirmier?type=sess&mot_cle2=&lieu=&virtuemart_country_code=&specialite=&date_fin=31-12-2019%20&date_debut=01-12-2019'; }

           
            

           })
  







  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

 

  ga('create', 'UA-61230510-1', 'auto');

  ga('send', 'pageview');

 

</script>
     </footer>
	
</body>
</html>