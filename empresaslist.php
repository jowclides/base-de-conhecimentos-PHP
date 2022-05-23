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
$empresas_list = new empresas_list();

// Run the page
$empresas_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$empresas_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$empresas_list->isExport()) { ?>
<script>
var fempresaslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fempresaslist = currentForm = new ew.Form("fempresaslist", "list");
	fempresaslist.formKeyCountName = '<?php echo $empresas_list->FormKeyCountName ?>';
	loadjs.done("fempresaslist");
});
var fempresaslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fempresaslistsrch = currentSearchForm = new ew.Form("fempresaslistsrch");

	// Dynamic selection lists
	// Filters

	fempresaslistsrch.filterList = <?php echo $empresas_list->getFilterList() ?>;
	loadjs.done("fempresaslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$empresas_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($empresas_list->TotalRecords > 0 && $empresas_list->ExportOptions->visible()) { ?>
<?php $empresas_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($empresas_list->ImportOptions->visible()) { ?>
<?php $empresas_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($empresas_list->SearchOptions->visible()) { ?>
<?php $empresas_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($empresas_list->FilterOptions->visible()) { ?>
<?php $empresas_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$empresas_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$empresas_list->isExport() && !$empresas->CurrentAction) { ?>
<form name="fempresaslistsrch" id="fempresaslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fempresaslistsrch-search-panel" class="<?php echo $empresas_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="empresas">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $empresas_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($empresas_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($empresas_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $empresas_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($empresas_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($empresas_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($empresas_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($empresas_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $empresas_list->showPageHeader(); ?>
<?php
$empresas_list->showMessage();
?>
<?php if ($empresas_list->TotalRecords > 0 || $empresas->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($empresas_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> empresas">
<?php if (!$empresas_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$empresas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $empresas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $empresas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fempresaslist" id="fempresaslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="empresas">
<div id="gmp_empresas" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($empresas_list->TotalRecords > 0 || $empresas_list->isGridEdit()) { ?>
<table id="tbl_empresaslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$empresas->RowType = ROWTYPE_HEADER;

// Render list options
$empresas_list->renderListOptions();

// Render list options (header, left)
$empresas_list->ListOptions->render("header", "left");
?>
<?php if ($empresas_list->id->Visible) { // id ?>
	<?php if ($empresas_list->SortUrl($empresas_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $empresas_list->id->headerCellClass() ?>"><div id="elh_empresas_id" class="empresas_id"><div class="ew-table-header-caption"><?php echo $empresas_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $empresas_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $empresas_list->SortUrl($empresas_list->id) ?>', 1);"><div id="elh_empresas_id" class="empresas_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $empresas_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($empresas_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($empresas_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($empresas_list->nome_empreasa->Visible) { // nome_empreasa ?>
	<?php if ($empresas_list->SortUrl($empresas_list->nome_empreasa) == "") { ?>
		<th data-name="nome_empreasa" class="<?php echo $empresas_list->nome_empreasa->headerCellClass() ?>"><div id="elh_empresas_nome_empreasa" class="empresas_nome_empreasa"><div class="ew-table-header-caption"><?php echo $empresas_list->nome_empreasa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_empreasa" class="<?php echo $empresas_list->nome_empreasa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $empresas_list->SortUrl($empresas_list->nome_empreasa) ?>', 1);"><div id="elh_empresas_nome_empreasa" class="empresas_nome_empreasa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $empresas_list->nome_empreasa->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($empresas_list->nome_empreasa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($empresas_list->nome_empreasa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$empresas_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($empresas_list->ExportAll && $empresas_list->isExport()) {
	$empresas_list->StopRecord = $empresas_list->TotalRecords;
} else {

	// Set the last record to display
	if ($empresas_list->TotalRecords > $empresas_list->StartRecord + $empresas_list->DisplayRecords - 1)
		$empresas_list->StopRecord = $empresas_list->StartRecord + $empresas_list->DisplayRecords - 1;
	else
		$empresas_list->StopRecord = $empresas_list->TotalRecords;
}
$empresas_list->RecordCount = $empresas_list->StartRecord - 1;
if ($empresas_list->Recordset && !$empresas_list->Recordset->EOF) {
	$empresas_list->Recordset->moveFirst();
	$selectLimit = $empresas_list->UseSelectLimit;
	if (!$selectLimit && $empresas_list->StartRecord > 1)
		$empresas_list->Recordset->move($empresas_list->StartRecord - 1);
} elseif (!$empresas->AllowAddDeleteRow && $empresas_list->StopRecord == 0) {
	$empresas_list->StopRecord = $empresas->GridAddRowCount;
}

// Initialize aggregate
$empresas->RowType = ROWTYPE_AGGREGATEINIT;
$empresas->resetAttributes();
$empresas_list->renderRow();
while ($empresas_list->RecordCount < $empresas_list->StopRecord) {
	$empresas_list->RecordCount++;
	if ($empresas_list->RecordCount >= $empresas_list->StartRecord) {
		$empresas_list->RowCount++;

		// Set up key count
		$empresas_list->KeyCount = $empresas_list->RowIndex;

		// Init row class and style
		$empresas->resetAttributes();
		$empresas->CssClass = "";
		if ($empresas_list->isGridAdd()) {
		} else {
			$empresas_list->loadRowValues($empresas_list->Recordset); // Load row values
		}
		$empresas->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$empresas->RowAttrs->merge(["data-rowindex" => $empresas_list->RowCount, "id" => "r" . $empresas_list->RowCount . "_empresas", "data-rowtype" => $empresas->RowType]);

		// Render row
		$empresas_list->renderRow();

		// Render list options
		$empresas_list->renderListOptions();
?>
	<tr <?php echo $empresas->rowAttributes() ?>>
<?php

// Render list options (body, left)
$empresas_list->ListOptions->render("body", "left", $empresas_list->RowCount);
?>
	<?php if ($empresas_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $empresas_list->id->cellAttributes() ?>>
<span id="el<?php echo $empresas_list->RowCount ?>_empresas_id">
<span<?php echo $empresas_list->id->viewAttributes() ?>><?php echo $empresas_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($empresas_list->nome_empreasa->Visible) { // nome_empreasa ?>
		<td data-name="nome_empreasa" <?php echo $empresas_list->nome_empreasa->cellAttributes() ?>>
<span id="el<?php echo $empresas_list->RowCount ?>_empresas_nome_empreasa">
<span<?php echo $empresas_list->nome_empreasa->viewAttributes() ?>><?php echo $empresas_list->nome_empreasa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$empresas_list->ListOptions->render("body", "right", $empresas_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$empresas_list->isGridAdd())
		$empresas_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$empresas->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($empresas_list->Recordset)
	$empresas_list->Recordset->Close();
?>
<?php if (!$empresas_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$empresas_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $empresas_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $empresas_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($empresas_list->TotalRecords == 0 && !$empresas->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $empresas_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$empresas_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$empresas_list->isExport()) { ?>
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
$empresas_list->terminate();
?>