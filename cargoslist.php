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
$cargos_list = new cargos_list();

// Run the page
$cargos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cargos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cargos_list->isExport()) { ?>
<script>
var fcargoslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcargoslist = currentForm = new ew.Form("fcargoslist", "list");
	fcargoslist.formKeyCountName = '<?php echo $cargos_list->FormKeyCountName ?>';
	loadjs.done("fcargoslist");
});
var fcargoslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcargoslistsrch = currentSearchForm = new ew.Form("fcargoslistsrch");

	// Dynamic selection lists
	// Filters

	fcargoslistsrch.filterList = <?php echo $cargos_list->getFilterList() ?>;
	loadjs.done("fcargoslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$cargos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cargos_list->TotalRecords > 0 && $cargos_list->ExportOptions->visible()) { ?>
<?php $cargos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cargos_list->ImportOptions->visible()) { ?>
<?php $cargos_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cargos_list->SearchOptions->visible()) { ?>
<?php $cargos_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cargos_list->FilterOptions->visible()) { ?>
<?php $cargos_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cargos_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cargos_list->isExport() && !$cargos->CurrentAction) { ?>
<form name="fcargoslistsrch" id="fcargoslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcargoslistsrch-search-panel" class="<?php echo $cargos_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cargos">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cargos_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cargos_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cargos_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cargos_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cargos_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cargos_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cargos_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cargos_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cargos_list->showPageHeader(); ?>
<?php
$cargos_list->showMessage();
?>
<?php if ($cargos_list->TotalRecords > 0 || $cargos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cargos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cargos">
<?php if (!$cargos_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cargos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cargos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cargos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcargoslist" id="fcargoslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cargos">
<div id="gmp_cargos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cargos_list->TotalRecords > 0 || $cargos_list->isGridEdit()) { ?>
<table id="tbl_cargoslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cargos->RowType = ROWTYPE_HEADER;

// Render list options
$cargos_list->renderListOptions();

// Render list options (header, left)
$cargos_list->ListOptions->render("header", "left");
?>
<?php if ($cargos_list->id->Visible) { // id ?>
	<?php if ($cargos_list->SortUrl($cargos_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $cargos_list->id->headerCellClass() ?>"><div id="elh_cargos_id" class="cargos_id"><div class="ew-table-header-caption"><?php echo $cargos_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $cargos_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cargos_list->SortUrl($cargos_list->id) ?>', 1);"><div id="elh_cargos_id" class="cargos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cargos_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($cargos_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cargos_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cargos_list->nome_cargo->Visible) { // nome_cargo ?>
	<?php if ($cargos_list->SortUrl($cargos_list->nome_cargo) == "") { ?>
		<th data-name="nome_cargo" class="<?php echo $cargos_list->nome_cargo->headerCellClass() ?>"><div id="elh_cargos_nome_cargo" class="cargos_nome_cargo"><div class="ew-table-header-caption"><?php echo $cargos_list->nome_cargo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_cargo" class="<?php echo $cargos_list->nome_cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cargos_list->SortUrl($cargos_list->nome_cargo) ?>', 1);"><div id="elh_cargos_nome_cargo" class="cargos_nome_cargo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cargos_list->nome_cargo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cargos_list->nome_cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cargos_list->nome_cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cargos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cargos_list->ExportAll && $cargos_list->isExport()) {
	$cargos_list->StopRecord = $cargos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cargos_list->TotalRecords > $cargos_list->StartRecord + $cargos_list->DisplayRecords - 1)
		$cargos_list->StopRecord = $cargos_list->StartRecord + $cargos_list->DisplayRecords - 1;
	else
		$cargos_list->StopRecord = $cargos_list->TotalRecords;
}
$cargos_list->RecordCount = $cargos_list->StartRecord - 1;
if ($cargos_list->Recordset && !$cargos_list->Recordset->EOF) {
	$cargos_list->Recordset->moveFirst();
	$selectLimit = $cargos_list->UseSelectLimit;
	if (!$selectLimit && $cargos_list->StartRecord > 1)
		$cargos_list->Recordset->move($cargos_list->StartRecord - 1);
} elseif (!$cargos->AllowAddDeleteRow && $cargos_list->StopRecord == 0) {
	$cargos_list->StopRecord = $cargos->GridAddRowCount;
}

// Initialize aggregate
$cargos->RowType = ROWTYPE_AGGREGATEINIT;
$cargos->resetAttributes();
$cargos_list->renderRow();
while ($cargos_list->RecordCount < $cargos_list->StopRecord) {
	$cargos_list->RecordCount++;
	if ($cargos_list->RecordCount >= $cargos_list->StartRecord) {
		$cargos_list->RowCount++;

		// Set up key count
		$cargos_list->KeyCount = $cargos_list->RowIndex;

		// Init row class and style
		$cargos->resetAttributes();
		$cargos->CssClass = "";
		if ($cargos_list->isGridAdd()) {
		} else {
			$cargos_list->loadRowValues($cargos_list->Recordset); // Load row values
		}
		$cargos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cargos->RowAttrs->merge(["data-rowindex" => $cargos_list->RowCount, "id" => "r" . $cargos_list->RowCount . "_cargos", "data-rowtype" => $cargos->RowType]);

		// Render row
		$cargos_list->renderRow();

		// Render list options
		$cargos_list->renderListOptions();
?>
	<tr <?php echo $cargos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cargos_list->ListOptions->render("body", "left", $cargos_list->RowCount);
?>
	<?php if ($cargos_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $cargos_list->id->cellAttributes() ?>>
<span id="el<?php echo $cargos_list->RowCount ?>_cargos_id">
<span<?php echo $cargos_list->id->viewAttributes() ?>><?php echo $cargos_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cargos_list->nome_cargo->Visible) { // nome_cargo ?>
		<td data-name="nome_cargo" <?php echo $cargos_list->nome_cargo->cellAttributes() ?>>
<span id="el<?php echo $cargos_list->RowCount ?>_cargos_nome_cargo">
<span<?php echo $cargos_list->nome_cargo->viewAttributes() ?>><?php echo $cargos_list->nome_cargo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cargos_list->ListOptions->render("body", "right", $cargos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cargos_list->isGridAdd())
		$cargos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cargos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cargos_list->Recordset)
	$cargos_list->Recordset->Close();
?>
<?php if (!$cargos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cargos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cargos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cargos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cargos_list->TotalRecords == 0 && !$cargos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cargos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cargos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cargos_list->isExport()) { ?>
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
$cargos_list->terminate();
?>