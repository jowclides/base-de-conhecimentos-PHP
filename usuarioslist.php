<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

// Autoload
include_once "autoload.php";

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	\Delight\Cookie\Session::start(Config("COOKIE_SAMESITE")); // Init session data

// Output buffering
ob_start();
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$usuarios_list = new usuarios_list();

// Run the page
$usuarios_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuarios_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$usuarios_list->isExport()) { ?>
<script>
var fusuarioslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fusuarioslist = currentForm = new ew.Form("fusuarioslist", "list");
	fusuarioslist.formKeyCountName = '<?php echo $usuarios_list->FormKeyCountName ?>';
	loadjs.done("fusuarioslist");
});
var fusuarioslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fusuarioslistsrch = currentSearchForm = new ew.Form("fusuarioslistsrch");

	// Dynamic selection lists
	// Filters

	fusuarioslistsrch.filterList = <?php echo $usuarios_list->getFilterList() ?>;
	loadjs.done("fusuarioslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$usuarios_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($usuarios_list->TotalRecords > 0 && $usuarios_list->ExportOptions->visible()) { ?>
<?php $usuarios_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($usuarios_list->ImportOptions->visible()) { ?>
<?php $usuarios_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($usuarios_list->SearchOptions->visible()) { ?>
<?php $usuarios_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($usuarios_list->FilterOptions->visible()) { ?>
<?php $usuarios_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$usuarios_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$usuarios_list->isExport() && !$usuarios->CurrentAction) { ?>
<form name="fusuarioslistsrch" id="fusuarioslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fusuarioslistsrch-search-panel" class="<?php echo $usuarios_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="usuarios">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $usuarios_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($usuarios_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($usuarios_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $usuarios_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($usuarios_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($usuarios_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($usuarios_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($usuarios_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $usuarios_list->showPageHeader(); ?>
<?php
$usuarios_list->showMessage();
?>
<?php if ($usuarios_list->TotalRecords > 0 || $usuarios->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($usuarios_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> usuarios">
<?php if (!$usuarios_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$usuarios_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $usuarios_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuarios_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fusuarioslist" id="fusuarioslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuarios">
<div id="gmp_usuarios" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($usuarios_list->TotalRecords > 0 || $usuarios_list->isGridEdit()) { ?>
<table id="tbl_usuarioslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$usuarios->RowType = ROWTYPE_HEADER;

// Render list options
$usuarios_list->renderListOptions();

// Render list options (header, left)
$usuarios_list->ListOptions->render("header", "left");
?>
<?php if ($usuarios_list->id->Visible) { // id ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $usuarios_list->id->headerCellClass() ?>"><div id="elh_usuarios_id" class="usuarios_id"><div class="ew-table-header-caption"><?php echo $usuarios_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $usuarios_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->id) ?>', 1);"><div id="elh_usuarios_id" class="usuarios_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuarios_list->usuario->Visible) { // usuario ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->usuario) == "") { ?>
		<th data-name="usuario" class="<?php echo $usuarios_list->usuario->headerCellClass() ?>"><div id="elh_usuarios_usuario" class="usuarios_usuario"><div class="ew-table-header-caption"><?php echo $usuarios_list->usuario->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="usuario" class="<?php echo $usuarios_list->usuario->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->usuario) ?>', 1);"><div id="elh_usuarios_usuario" class="usuarios_usuario">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->usuario->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->usuario->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->usuario->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuarios_list->senha->Visible) { // senha ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->senha) == "") { ?>
		<th data-name="senha" class="<?php echo $usuarios_list->senha->headerCellClass() ?>"><div id="elh_usuarios_senha" class="usuarios_senha"><div class="ew-table-header-caption"><?php echo $usuarios_list->senha->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="senha" class="<?php echo $usuarios_list->senha->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->senha) ?>', 1);"><div id="elh_usuarios_senha" class="usuarios_senha">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->senha->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->senha->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->senha->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuarios_list->_email->Visible) { // email ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $usuarios_list->_email->headerCellClass() ?>"><div id="elh_usuarios__email" class="usuarios__email"><div class="ew-table-header-caption"><?php echo $usuarios_list->_email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $usuarios_list->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->_email) ?>', 1);"><div id="elh_usuarios__email" class="usuarios__email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->_email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuarios_list->ativado->Visible) { // ativado ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->ativado) == "") { ?>
		<th data-name="ativado" class="<?php echo $usuarios_list->ativado->headerCellClass() ?>"><div id="elh_usuarios_ativado" class="usuarios_ativado"><div class="ew-table-header-caption"><?php echo $usuarios_list->ativado->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ativado" class="<?php echo $usuarios_list->ativado->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->ativado) ?>', 1);"><div id="elh_usuarios_ativado" class="usuarios_ativado">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->ativado->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->ativado->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->ativado->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($usuarios_list->userlevel->Visible) { // userlevel ?>
	<?php if ($usuarios_list->SortUrl($usuarios_list->userlevel) == "") { ?>
		<th data-name="userlevel" class="<?php echo $usuarios_list->userlevel->headerCellClass() ?>"><div id="elh_usuarios_userlevel" class="usuarios_userlevel"><div class="ew-table-header-caption"><?php echo $usuarios_list->userlevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="userlevel" class="<?php echo $usuarios_list->userlevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $usuarios_list->SortUrl($usuarios_list->userlevel) ?>', 1);"><div id="elh_usuarios_userlevel" class="usuarios_userlevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $usuarios_list->userlevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($usuarios_list->userlevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($usuarios_list->userlevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$usuarios_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($usuarios_list->ExportAll && $usuarios_list->isExport()) {
	$usuarios_list->StopRecord = $usuarios_list->TotalRecords;
} else {

	// Set the last record to display
	if ($usuarios_list->TotalRecords > $usuarios_list->StartRecord + $usuarios_list->DisplayRecords - 1)
		$usuarios_list->StopRecord = $usuarios_list->StartRecord + $usuarios_list->DisplayRecords - 1;
	else
		$usuarios_list->StopRecord = $usuarios_list->TotalRecords;
}
$usuarios_list->RecordCount = $usuarios_list->StartRecord - 1;
if ($usuarios_list->Recordset && !$usuarios_list->Recordset->EOF) {
	$usuarios_list->Recordset->moveFirst();
	$selectLimit = $usuarios_list->UseSelectLimit;
	if (!$selectLimit && $usuarios_list->StartRecord > 1)
		$usuarios_list->Recordset->move($usuarios_list->StartRecord - 1);
} elseif (!$usuarios->AllowAddDeleteRow && $usuarios_list->StopRecord == 0) {
	$usuarios_list->StopRecord = $usuarios->GridAddRowCount;
}

// Initialize aggregate
$usuarios->RowType = ROWTYPE_AGGREGATEINIT;
$usuarios->resetAttributes();
$usuarios_list->renderRow();
while ($usuarios_list->RecordCount < $usuarios_list->StopRecord) {
	$usuarios_list->RecordCount++;
	if ($usuarios_list->RecordCount >= $usuarios_list->StartRecord) {
		$usuarios_list->RowCount++;

		// Set up key count
		$usuarios_list->KeyCount = $usuarios_list->RowIndex;

		// Init row class and style
		$usuarios->resetAttributes();
		$usuarios->CssClass = "";
		if ($usuarios_list->isGridAdd()) {
		} else {
			$usuarios_list->loadRowValues($usuarios_list->Recordset); // Load row values
		}
		$usuarios->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$usuarios->RowAttrs->merge(["data-rowindex" => $usuarios_list->RowCount, "id" => "r" . $usuarios_list->RowCount . "_usuarios", "data-rowtype" => $usuarios->RowType]);

		// Render row
		$usuarios_list->renderRow();

		// Render list options
		$usuarios_list->renderListOptions();
?>
	<tr <?php echo $usuarios->rowAttributes() ?>>
<?php

// Render list options (body, left)
$usuarios_list->ListOptions->render("body", "left", $usuarios_list->RowCount);
?>
	<?php if ($usuarios_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $usuarios_list->id->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios_id">
<span<?php echo $usuarios_list->id->viewAttributes() ?>><?php echo $usuarios_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuarios_list->usuario->Visible) { // usuario ?>
		<td data-name="usuario" <?php echo $usuarios_list->usuario->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios_usuario">
<span<?php echo $usuarios_list->usuario->viewAttributes() ?>><?php echo $usuarios_list->usuario->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuarios_list->senha->Visible) { // senha ?>
		<td data-name="senha" <?php echo $usuarios_list->senha->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios_senha">
<span<?php echo $usuarios_list->senha->viewAttributes() ?>><?php echo $usuarios_list->senha->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuarios_list->_email->Visible) { // email ?>
		<td data-name="_email" <?php echo $usuarios_list->_email->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios__email">
<span<?php echo $usuarios_list->_email->viewAttributes() ?>><?php echo $usuarios_list->_email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuarios_list->ativado->Visible) { // ativado ?>
		<td data-name="ativado" <?php echo $usuarios_list->ativado->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios_ativado">
<span<?php echo $usuarios_list->ativado->viewAttributes() ?>><?php echo $usuarios_list->ativado->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($usuarios_list->userlevel->Visible) { // userlevel ?>
		<td data-name="userlevel" <?php echo $usuarios_list->userlevel->cellAttributes() ?>>
<span id="el<?php echo $usuarios_list->RowCount ?>_usuarios_userlevel">
<span<?php echo $usuarios_list->userlevel->viewAttributes() ?>><?php echo $usuarios_list->userlevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$usuarios_list->ListOptions->render("body", "right", $usuarios_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$usuarios_list->isGridAdd())
		$usuarios_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$usuarios->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($usuarios_list->Recordset)
	$usuarios_list->Recordset->Close();
?>
<?php if (!$usuarios_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$usuarios_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $usuarios_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $usuarios_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($usuarios_list->TotalRecords == 0 && !$usuarios->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $usuarios_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$usuarios_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$usuarios_list->isExport()) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php include_once "footer.php"; ?>
<?php
$usuarios_list->terminate();
?>