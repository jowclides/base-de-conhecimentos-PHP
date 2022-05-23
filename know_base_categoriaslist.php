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
$know_base_categorias_list = new know_base_categorias_list();

// Run the page
$know_base_categorias_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$know_base_categorias_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$know_base_categorias_list->isExport()) { ?>
<script>
var fknow_base_categoriaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fknow_base_categoriaslist = currentForm = new ew.Form("fknow_base_categoriaslist", "list");
	fknow_base_categoriaslist.formKeyCountName = '<?php echo $know_base_categorias_list->FormKeyCountName ?>';
	loadjs.done("fknow_base_categoriaslist");
});
var fknow_base_categoriaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fknow_base_categoriaslistsrch = currentSearchForm = new ew.Form("fknow_base_categoriaslistsrch");

	// Dynamic selection lists
	// Filters

	fknow_base_categoriaslistsrch.filterList = <?php echo $know_base_categorias_list->getFilterList() ?>;
	loadjs.done("fknow_base_categoriaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$know_base_categorias_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($know_base_categorias_list->TotalRecords > 0 && $know_base_categorias_list->ExportOptions->visible()) { ?>
<?php $know_base_categorias_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_categorias_list->ImportOptions->visible()) { ?>
<?php $know_base_categorias_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_categorias_list->SearchOptions->visible()) { ?>
<?php $know_base_categorias_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($know_base_categorias_list->FilterOptions->visible()) { ?>
<?php $know_base_categorias_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$know_base_categorias_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$know_base_categorias_list->isExport() && !$know_base_categorias->CurrentAction) { ?>
<form name="fknow_base_categoriaslistsrch" id="fknow_base_categoriaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fknow_base_categoriaslistsrch-search-panel" class="<?php echo $know_base_categorias_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="know_base_categorias">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $know_base_categorias_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($know_base_categorias_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($know_base_categorias_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $know_base_categorias_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($know_base_categorias_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($know_base_categorias_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($know_base_categorias_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($know_base_categorias_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $know_base_categorias_list->showPageHeader(); ?>
<?php
$know_base_categorias_list->showMessage();
?>
<?php if ($know_base_categorias_list->TotalRecords > 0 || $know_base_categorias->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($know_base_categorias_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> know_base_categorias">
<?php if (!$know_base_categorias_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$know_base_categorias_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_categorias_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $know_base_categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fknow_base_categoriaslist" id="fknow_base_categoriaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="know_base_categorias">
<div id="gmp_know_base_categorias" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($know_base_categorias_list->TotalRecords > 0 || $know_base_categorias_list->isGridEdit()) { ?>
<table id="tbl_know_base_categoriaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$know_base_categorias->RowType = ROWTYPE_HEADER;

// Render list options
$know_base_categorias_list->renderListOptions();

// Render list options (header, left)
$know_base_categorias_list->ListOptions->render("header", "left");
?>
<?php if ($know_base_categorias_list->id->Visible) { // id ?>
	<?php if ($know_base_categorias_list->SortUrl($know_base_categorias_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $know_base_categorias_list->id->headerCellClass() ?>"><div id="elh_know_base_categorias_id" class="know_base_categorias_id"><div class="ew-table-header-caption"><?php echo $know_base_categorias_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $know_base_categorias_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_categorias_list->SortUrl($know_base_categorias_list->id) ?>', 1);"><div id="elh_know_base_categorias_id" class="know_base_categorias_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_categorias_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($know_base_categorias_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_categorias_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($know_base_categorias_list->nome_categoria->Visible) { // nome_categoria ?>
	<?php if ($know_base_categorias_list->SortUrl($know_base_categorias_list->nome_categoria) == "") { ?>
		<th data-name="nome_categoria" class="<?php echo $know_base_categorias_list->nome_categoria->headerCellClass() ?>"><div id="elh_know_base_categorias_nome_categoria" class="know_base_categorias_nome_categoria"><div class="ew-table-header-caption"><?php echo $know_base_categorias_list->nome_categoria->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_categoria" class="<?php echo $know_base_categorias_list->nome_categoria->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $know_base_categorias_list->SortUrl($know_base_categorias_list->nome_categoria) ?>', 1);"><div id="elh_know_base_categorias_nome_categoria" class="know_base_categorias_nome_categoria">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $know_base_categorias_list->nome_categoria->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($know_base_categorias_list->nome_categoria->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($know_base_categorias_list->nome_categoria->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$know_base_categorias_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($know_base_categorias_list->ExportAll && $know_base_categorias_list->isExport()) {
	$know_base_categorias_list->StopRecord = $know_base_categorias_list->TotalRecords;
} else {

	// Set the last record to display
	if ($know_base_categorias_list->TotalRecords > $know_base_categorias_list->StartRecord + $know_base_categorias_list->DisplayRecords - 1)
		$know_base_categorias_list->StopRecord = $know_base_categorias_list->StartRecord + $know_base_categorias_list->DisplayRecords - 1;
	else
		$know_base_categorias_list->StopRecord = $know_base_categorias_list->TotalRecords;
}
$know_base_categorias_list->RecordCount = $know_base_categorias_list->StartRecord - 1;
if ($know_base_categorias_list->Recordset && !$know_base_categorias_list->Recordset->EOF) {
	$know_base_categorias_list->Recordset->moveFirst();
	$selectLimit = $know_base_categorias_list->UseSelectLimit;
	if (!$selectLimit && $know_base_categorias_list->StartRecord > 1)
		$know_base_categorias_list->Recordset->move($know_base_categorias_list->StartRecord - 1);
} elseif (!$know_base_categorias->AllowAddDeleteRow && $know_base_categorias_list->StopRecord == 0) {
	$know_base_categorias_list->StopRecord = $know_base_categorias->GridAddRowCount;
}

// Initialize aggregate
$know_base_categorias->RowType = ROWTYPE_AGGREGATEINIT;
$know_base_categorias->resetAttributes();
$know_base_categorias_list->renderRow();
while ($know_base_categorias_list->RecordCount < $know_base_categorias_list->StopRecord) {
	$know_base_categorias_list->RecordCount++;
	if ($know_base_categorias_list->RecordCount >= $know_base_categorias_list->StartRecord) {
		$know_base_categorias_list->RowCount++;

		// Set up key count
		$know_base_categorias_list->KeyCount = $know_base_categorias_list->RowIndex;

		// Init row class and style
		$know_base_categorias->resetAttributes();
		$know_base_categorias->CssClass = "";
		if ($know_base_categorias_list->isGridAdd()) {
		} else {
			$know_base_categorias_list->loadRowValues($know_base_categorias_list->Recordset); // Load row values
		}
		$know_base_categorias->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$know_base_categorias->RowAttrs->merge(["data-rowindex" => $know_base_categorias_list->RowCount, "id" => "r" . $know_base_categorias_list->RowCount . "_know_base_categorias", "data-rowtype" => $know_base_categorias->RowType]);

		// Render row
		$know_base_categorias_list->renderRow();

		// Render list options
		$know_base_categorias_list->renderListOptions();
?>
	<tr <?php echo $know_base_categorias->rowAttributes() ?>>
<?php

// Render list options (body, left)
$know_base_categorias_list->ListOptions->render("body", "left", $know_base_categorias_list->RowCount);
?>
	<?php if ($know_base_categorias_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $know_base_categorias_list->id->cellAttributes() ?>>
<span id="el<?php echo $know_base_categorias_list->RowCount ?>_know_base_categorias_id">
<span<?php echo $know_base_categorias_list->id->viewAttributes() ?>><?php echo $know_base_categorias_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($know_base_categorias_list->nome_categoria->Visible) { // nome_categoria ?>
		<td data-name="nome_categoria" <?php echo $know_base_categorias_list->nome_categoria->cellAttributes() ?>>
<span id="el<?php echo $know_base_categorias_list->RowCount ?>_know_base_categorias_nome_categoria">
<span<?php echo $know_base_categorias_list->nome_categoria->viewAttributes() ?>><?php echo $know_base_categorias_list->nome_categoria->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$know_base_categorias_list->ListOptions->render("body", "right", $know_base_categorias_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$know_base_categorias_list->isGridAdd())
		$know_base_categorias_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$know_base_categorias->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($know_base_categorias_list->Recordset)
	$know_base_categorias_list->Recordset->Close();
?>
<?php if (!$know_base_categorias_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$know_base_categorias_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $know_base_categorias_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $know_base_categorias_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($know_base_categorias_list->TotalRecords == 0 && !$know_base_categorias->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $know_base_categorias_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$know_base_categorias_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$know_base_categorias_list->isExport()) { ?>
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
$know_base_categorias_list->terminate();
?>