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
$tarefas_criticidade_list = new tarefas_criticidade_list();

// Run the page
$tarefas_criticidade_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_criticidade_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tarefas_criticidade_list->isExport()) { ?>
<script>
var ftarefas_criticidadelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftarefas_criticidadelist = currentForm = new ew.Form("ftarefas_criticidadelist", "list");
	ftarefas_criticidadelist.formKeyCountName = '<?php echo $tarefas_criticidade_list->FormKeyCountName ?>';
	loadjs.done("ftarefas_criticidadelist");
});
var ftarefas_criticidadelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftarefas_criticidadelistsrch = currentSearchForm = new ew.Form("ftarefas_criticidadelistsrch");

	// Dynamic selection lists
	// Filters

	ftarefas_criticidadelistsrch.filterList = <?php echo $tarefas_criticidade_list->getFilterList() ?>;
	loadjs.done("ftarefas_criticidadelistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tarefas_criticidade_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tarefas_criticidade_list->TotalRecords > 0 && $tarefas_criticidade_list->ExportOptions->visible()) { ?>
<?php $tarefas_criticidade_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_criticidade_list->ImportOptions->visible()) { ?>
<?php $tarefas_criticidade_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_criticidade_list->SearchOptions->visible()) { ?>
<?php $tarefas_criticidade_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_criticidade_list->FilterOptions->visible()) { ?>
<?php $tarefas_criticidade_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tarefas_criticidade_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tarefas_criticidade_list->isExport() && !$tarefas_criticidade->CurrentAction) { ?>
<form name="ftarefas_criticidadelistsrch" id="ftarefas_criticidadelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftarefas_criticidadelistsrch-search-panel" class="<?php echo $tarefas_criticidade_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tarefas_criticidade">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tarefas_criticidade_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tarefas_criticidade_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tarefas_criticidade_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tarefas_criticidade_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tarefas_criticidade_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tarefas_criticidade_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tarefas_criticidade_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tarefas_criticidade_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tarefas_criticidade_list->showPageHeader(); ?>
<?php
$tarefas_criticidade_list->showMessage();
?>
<?php if ($tarefas_criticidade_list->TotalRecords > 0 || $tarefas_criticidade->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tarefas_criticidade_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tarefas_criticidade">
<?php if (!$tarefas_criticidade_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tarefas_criticidade_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_criticidade_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_criticidade_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftarefas_criticidadelist" id="ftarefas_criticidadelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_criticidade">
<div id="gmp_tarefas_criticidade" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tarefas_criticidade_list->TotalRecords > 0 || $tarefas_criticidade_list->isGridEdit()) { ?>
<table id="tbl_tarefas_criticidadelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tarefas_criticidade->RowType = ROWTYPE_HEADER;

// Render list options
$tarefas_criticidade_list->renderListOptions();

// Render list options (header, left)
$tarefas_criticidade_list->ListOptions->render("header", "left");
?>
<?php if ($tarefas_criticidade_list->id->Visible) { // id ?>
	<?php if ($tarefas_criticidade_list->SortUrl($tarefas_criticidade_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tarefas_criticidade_list->id->headerCellClass() ?>"><div id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id"><div class="ew-table-header-caption"><?php echo $tarefas_criticidade_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tarefas_criticidade_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_criticidade_list->SortUrl($tarefas_criticidade_list->id) ?>', 1);"><div id="elh_tarefas_criticidade_id" class="tarefas_criticidade_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_criticidade_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_criticidade_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_criticidade_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_criticidade_list->criticidade->Visible) { // criticidade ?>
	<?php if ($tarefas_criticidade_list->SortUrl($tarefas_criticidade_list->criticidade) == "") { ?>
		<th data-name="criticidade" class="<?php echo $tarefas_criticidade_list->criticidade->headerCellClass() ?>"><div id="elh_tarefas_criticidade_criticidade" class="tarefas_criticidade_criticidade"><div class="ew-table-header-caption"><?php echo $tarefas_criticidade_list->criticidade->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="criticidade" class="<?php echo $tarefas_criticidade_list->criticidade->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_criticidade_list->SortUrl($tarefas_criticidade_list->criticidade) ?>', 1);"><div id="elh_tarefas_criticidade_criticidade" class="tarefas_criticidade_criticidade">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_criticidade_list->criticidade->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tarefas_criticidade_list->criticidade->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_criticidade_list->criticidade->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tarefas_criticidade_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tarefas_criticidade_list->ExportAll && $tarefas_criticidade_list->isExport()) {
	$tarefas_criticidade_list->StopRecord = $tarefas_criticidade_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tarefas_criticidade_list->TotalRecords > $tarefas_criticidade_list->StartRecord + $tarefas_criticidade_list->DisplayRecords - 1)
		$tarefas_criticidade_list->StopRecord = $tarefas_criticidade_list->StartRecord + $tarefas_criticidade_list->DisplayRecords - 1;
	else
		$tarefas_criticidade_list->StopRecord = $tarefas_criticidade_list->TotalRecords;
}
$tarefas_criticidade_list->RecordCount = $tarefas_criticidade_list->StartRecord - 1;
if ($tarefas_criticidade_list->Recordset && !$tarefas_criticidade_list->Recordset->EOF) {
	$tarefas_criticidade_list->Recordset->moveFirst();
	$selectLimit = $tarefas_criticidade_list->UseSelectLimit;
	if (!$selectLimit && $tarefas_criticidade_list->StartRecord > 1)
		$tarefas_criticidade_list->Recordset->move($tarefas_criticidade_list->StartRecord - 1);
} elseif (!$tarefas_criticidade->AllowAddDeleteRow && $tarefas_criticidade_list->StopRecord == 0) {
	$tarefas_criticidade_list->StopRecord = $tarefas_criticidade->GridAddRowCount;
}

// Initialize aggregate
$tarefas_criticidade->RowType = ROWTYPE_AGGREGATEINIT;
$tarefas_criticidade->resetAttributes();
$tarefas_criticidade_list->renderRow();
while ($tarefas_criticidade_list->RecordCount < $tarefas_criticidade_list->StopRecord) {
	$tarefas_criticidade_list->RecordCount++;
	if ($tarefas_criticidade_list->RecordCount >= $tarefas_criticidade_list->StartRecord) {
		$tarefas_criticidade_list->RowCount++;

		// Set up key count
		$tarefas_criticidade_list->KeyCount = $tarefas_criticidade_list->RowIndex;

		// Init row class and style
		$tarefas_criticidade->resetAttributes();
		$tarefas_criticidade->CssClass = "";
		if ($tarefas_criticidade_list->isGridAdd()) {
		} else {
			$tarefas_criticidade_list->loadRowValues($tarefas_criticidade_list->Recordset); // Load row values
		}
		$tarefas_criticidade->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tarefas_criticidade->RowAttrs->merge(["data-rowindex" => $tarefas_criticidade_list->RowCount, "id" => "r" . $tarefas_criticidade_list->RowCount . "_tarefas_criticidade", "data-rowtype" => $tarefas_criticidade->RowType]);

		// Render row
		$tarefas_criticidade_list->renderRow();

		// Render list options
		$tarefas_criticidade_list->renderListOptions();
?>
	<tr <?php echo $tarefas_criticidade->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tarefas_criticidade_list->ListOptions->render("body", "left", $tarefas_criticidade_list->RowCount);
?>
	<?php if ($tarefas_criticidade_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tarefas_criticidade_list->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_criticidade_list->RowCount ?>_tarefas_criticidade_id">
<span<?php echo $tarefas_criticidade_list->id->viewAttributes() ?>><?php echo $tarefas_criticidade_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_criticidade_list->criticidade->Visible) { // criticidade ?>
		<td data-name="criticidade" <?php echo $tarefas_criticidade_list->criticidade->cellAttributes() ?>>
<span id="el<?php echo $tarefas_criticidade_list->RowCount ?>_tarefas_criticidade_criticidade">
<span<?php echo $tarefas_criticidade_list->criticidade->viewAttributes() ?>><?php echo $tarefas_criticidade_list->criticidade->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tarefas_criticidade_list->ListOptions->render("body", "right", $tarefas_criticidade_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tarefas_criticidade_list->isGridAdd())
		$tarefas_criticidade_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tarefas_criticidade->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tarefas_criticidade_list->Recordset)
	$tarefas_criticidade_list->Recordset->Close();
?>
<?php if (!$tarefas_criticidade_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tarefas_criticidade_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_criticidade_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_criticidade_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tarefas_criticidade_list->TotalRecords == 0 && !$tarefas_criticidade->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tarefas_criticidade_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tarefas_criticidade_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tarefas_criticidade_list->isExport()) { ?>
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
$tarefas_criticidade_list->terminate();
?>