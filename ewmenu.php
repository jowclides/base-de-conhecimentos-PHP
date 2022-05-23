<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

// Menu Language
if ($Language && function_exists(PROJECT_NAMESPACE . "Config") && $Language->LanguageFolder == Config("LANGUAGE_FOLDER")) {
	$MenuRelativePath = "";
	$MenuLanguage = &$Language;
} else { // Compat reports
	$LANGUAGE_FOLDER = "../lang/";
	$MenuRelativePath = "../";
	$MenuLanguage = new Language();
}

// Navbar menu
$topMenu = new Menu("navbar", TRUE, TRUE);
echo $topMenu->toScript();

// Sidebar menu
$sideMenu = new Menu("menu", TRUE, FALSE);
$sideMenu->addMenuItem(2, "mi_contatos", $MenuLanguage->MenuPhrase("2", "MenuText"), $MenuRelativePath . "contatoslist.php", -1, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}contatos'), FALSE, FALSE, "far fa-address-book", "", FALSE);
$sideMenu->addMenuItem(17, "mi_tarefas", $MenuLanguage->MenuPhrase("17", "MenuText"), $MenuRelativePath . "tarefaslist.php", -1, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}tarefas'), FALSE, FALSE, "fas fa-tasks", "", FALSE);
$sideMenu->addMenuItem(32, "mi_know_base", $MenuLanguage->MenuPhrase("32", "MenuText"), $MenuRelativePath . "know_baselist.php", -1, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}know_base'), FALSE, FALSE, "fa fa-database", "", FALSE);
$sideMenu->addMenuItem(7, "mci_Forms_Contatos", $MenuLanguage->MenuPhrase("7", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa fa-folder-open", "", FALSE);
$sideMenu->addMenuItem(1, "mi_cargos", $MenuLanguage->MenuPhrase("1", "MenuText"), $MenuRelativePath . "cargoslist.php", 7, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}cargos'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(3, "mi_empresas", $MenuLanguage->MenuPhrase("3", "MenuText"), $MenuRelativePath . "empresaslist.php", 7, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}empresas'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(31, "mci_Forms_Tarefas", $MenuLanguage->MenuPhrase("31", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa fa-check-square", "", FALSE);
$sideMenu->addMenuItem(18, "mi_tarefas_status", $MenuLanguage->MenuPhrase("18", "MenuText"), $MenuRelativePath . "tarefas_statuslist.php", 31, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}tarefas_status'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(53, "mi_tarefas_criticidade", $MenuLanguage->MenuPhrase("53", "MenuText"), $MenuRelativePath . "tarefas_criticidadelist.php", 31, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}tarefas_criticidade'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(50, "mci_Forms_Knowledge", $MenuLanguage->MenuPhrase("50", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fas fa-database", "", FALSE);
$sideMenu->addMenuItem(33, "mi_know_base_categorias", $MenuLanguage->MenuPhrase("33", "MenuText"), $MenuRelativePath . "know_base_categoriaslist.php", 50, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}know_base_categorias'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(9, "mci_Reports", $MenuLanguage->MenuPhrase("9", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa fa-list", "", FALSE);
$sideMenu->addMenuItem(14, "mi_view1", $MenuLanguage->MenuPhrase("14", "MenuText"), $MenuRelativePath . "view1list.php", 9, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}view1'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(16, "mi_view2", $MenuLanguage->MenuPhrase("16", "MenuText"), $MenuRelativePath . "view2list.php", 9, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}view2'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(13, "mi_all_contacts_new", $MenuLanguage->MenuPhrase("13", "MenuText"), $MenuRelativePath . "all_contacts_newlist.php", 9, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}all_contacts_new'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(8, "mci_Security", $MenuLanguage->MenuPhrase("8", "MenuText"), "", -1, "", TRUE, FALSE, TRUE, "fa fa-users", "", FALSE);
$sideMenu->addMenuItem(6, "mi_usuarios", $MenuLanguage->MenuPhrase("6", "MenuText"), $MenuRelativePath . "usuarioslist.php", 8, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}usuarios'), FALSE, FALSE, "", "", FALSE);
$sideMenu->addMenuItem(52, "mi_userlevels", $MenuLanguage->MenuPhrase("52", "MenuText"), $MenuRelativePath . "userlevelslist.php", 8, "", AllowListMenu('{EC5E5D8D-964F-4307-931C-849F6024B4A9}userlevels'), FALSE, FALSE, "", "", FALSE);
echo $sideMenu->toScript();
?>