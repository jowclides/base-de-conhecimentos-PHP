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
$tarefas_status_list = new tarefas_status_list();

// Run the page
$tarefas_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$tarefas_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$tarefas_status_list->isExport()) { ?>
<script>
var ftarefas_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftarefas_statuslist = currentForm = new ew.Form("ftarefas_statuslist", "list");
	ftarefas_statuslist.formKeyCountName = '<?php echo $tarefas_status_list->FormKeyCountName ?>';
	loadjs.done("ftarefas_statuslist");
});
var ftarefas_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftarefas_statuslistsrch = currentSearchForm = new ew.Form("ftarefas_statuslistsrch");

	// Dynamic selection lists
	// Filters

	ftarefas_statuslistsrch.filterList = <?php echo $tarefas_status_list->getFilterList() ?>;
	loadjs.done("ftarefas_statuslistsrch");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$tarefas_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($tarefas_status_list->TotalRecords > 0 && $tarefas_status_list->ExportOptions->visible()) { ?>
<?php $tarefas_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_status_list->ImportOptions->visible()) { ?>
<?php $tarefas_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_status_list->SearchOptions->visible()) { ?>
<?php $tarefas_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($tarefas_status_list->FilterOptions->visible()) { ?>
<?php $tarefas_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$tarefas_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$tarefas_status_list->isExport() && !$tarefas_status->CurrentAction) { ?>
<form name="ftarefas_statuslistsrch" id="ftarefas_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftarefas_statuslistsrch-search-panel" class="<?php echo $tarefas_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="tarefas_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $tarefas_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($tarefas_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($tarefas_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $tarefas_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($tarefas_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($tarefas_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($tarefas_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($tarefas_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $tarefas_status_list->showPageHeader(); ?>
<?php
$tarefas_status_list->showMessage();
?>
<?php if ($tarefas_status_list->TotalRecords > 0 || $tarefas_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($tarefas_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> tarefas_status">
<?php if (!$tarefas_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$tarefas_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftarefas_statuslist" id="ftarefas_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="tarefas_status">
<div id="gmp_tarefas_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($tarefas_status_list->TotalRecords > 0 || $tarefas_status_list->isGridEdit()) { ?>
<table id="tbl_tarefas_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$tarefas_status->RowType = ROWTYPE_HEADER;

// Render list options
$tarefas_status_list->renderListOptions();

// Render list options (header, left)
$tarefas_status_list->ListOptions->render("header", "left");
?>
<?php if ($tarefas_status_list->id->Visible) { // id ?>
	<?php if ($tarefas_status_list->SortUrl($tarefas_status_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $tarefas_status_list->id->headerCellClass() ?>"><div id="elh_tarefas_status_id" class="tarefas_status_id"><div class="ew-table-header-caption"><?php echo $tarefas_status_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $tarefas_status_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_status_list->SortUrl($tarefas_status_list->id) ?>', 1);"><div id="elh_tarefas_status_id" class="tarefas_status_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_status_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($tarefas_status_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_status_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($tarefas_status_list->status->Visible) { // status ?>
	<?php if ($tarefas_status_list->SortUrl($tarefas_status_list->status) == "") { ?>
		<th data-name="status" class="<?php echo $tarefas_status_list->status->headerCellClass() ?>"><div id="elh_tarefas_status_status" class="tarefas_status_status"><div class="ew-table-header-caption"><?php echo $tarefas_status_list->status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $tarefas_status_list->status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $tarefas_status_list->SortUrl($tarefas_status_list->status) ?>', 1);"><div id="elh_tarefas_status_status" class="tarefas_status_status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $tarefas_status_list->status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($tarefas_status_list->status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($tarefas_status_list->status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$tarefas_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($tarefas_status_list->ExportAll && $tarefas_status_list->isExport()) {
	$tarefas_status_list->StopRecord = $tarefas_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($tarefas_status_list->TotalRecords > $tarefas_status_list->StartRecord + $tarefas_status_list->DisplayRecords - 1)
		$tarefas_status_list->StopRecord = $tarefas_status_list->StartRecord + $tarefas_status_list->DisplayRecords - 1;
	else
		$tarefas_status_list->StopRecord = $tarefas_status_list->TotalRecords;
}
$tarefas_status_list->RecordCount = $tarefas_status_list->StartRecord - 1;
if ($tarefas_status_list->Recordset && !$tarefas_status_list->Recordset->EOF) {
	$tarefas_status_list->Recordset->moveFirst();
	$selectLimit = $tarefas_status_list->UseSelectLimit;
	if (!$selectLimit && $tarefas_status_list->StartRecord > 1)
		$tarefas_status_list->Recordset->move($tarefas_status_list->StartRecord - 1);
} elseif (!$tarefas_status->AllowAddDeleteRow && $tarefas_status_list->StopRecord == 0) {
	$tarefas_status_list->StopRecord = $tarefas_status->GridAddRowCount;
}

// Initialize aggregate
$tarefas_status->RowType = ROWTYPE_AGGREGATEINIT;
$tarefas_status->resetAttributes();
$tarefas_status_list->renderRow();
while ($tarefas_status_list->RecordCount < $tarefas_status_list->StopRecord) {
	$tarefas_status_list->RecordCount++;
	if ($tarefas_status_list->RecordCount >= $tarefas_status_list->StartRecord) {
		$tarefas_status_list->RowCount++;

		// Set up key count
		$tarefas_status_list->KeyCount = $tarefas_status_list->RowIndex;

		// Init row class and style
		$tarefas_status->resetAttributes();
		$tarefas_status->CssClass = "";
		if ($tarefas_status_list->isGridAdd()) {
		} else {
			$tarefas_status_list->loadRowValues($tarefas_status_list->Recordset); // Load row values
		}
		$tarefas_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$tarefas_status->RowAttrs->merge(["data-rowindex" => $tarefas_status_list->RowCount, "id" => "r" . $tarefas_status_list->RowCount . "_tarefas_status", "data-rowtype" => $tarefas_status->RowType]);

		// Render row
		$tarefas_status_list->renderRow();

		// Render list options
		$tarefas_status_list->renderListOptions();
?>
	<tr <?php echo $tarefas_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$tarefas_status_list->ListOptions->render("body", "left", $tarefas_status_list->RowCount);
?>
	<?php if ($tarefas_status_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $tarefas_status_list->id->cellAttributes() ?>>
<span id="el<?php echo $tarefas_status_list->RowCount ?>_tarefas_status_id">
<span<?php echo $tarefas_status_list->id->viewAttributes() ?>><?php echo $tarefas_status_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($tarefas_status_list->status->Visible) { // status ?>
		<td data-name="status" <?php echo $tarefas_status_list->status->cellAttributes() ?>>
<span id="el<?php echo $tarefas_status_list->RowCount ?>_tarefas_status_status">
<span<?php echo $tarefas_status_list->status->viewAttributes() ?>><?php echo $tarefas_status_list->status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$tarefas_status_list->ListOptions->render("body", "right", $tarefas_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$tarefas_status_list->isGridAdd())
		$tarefas_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$tarefas_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($tarefas_status_list->Recordset)
	$tarefas_status_list->Recordset->Close();
?>
<?php if (!$tarefas_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$tarefas_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $tarefas_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $tarefas_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($tarefas_status_list->TotalRecords == 0 && !$tarefas_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $tarefas_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$tarefas_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$tarefas_status_list->isExport()) { ?>
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
$tarefas_status_list->terminate();
?>