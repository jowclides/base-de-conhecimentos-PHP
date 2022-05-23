<?php
namespace PHPMaker2020\project1;

// Session
if (session_status() !== PHP_SESSION_ACTIVE)
	session_start(); // Init session data

// Output buffering
ob_start();

// Autoload
include_once "autoload.php";
?>
<?php

// Write header
WriteHeader(FALSE);

// Create page object
$grupos_list = new grupos_list();

// Run the page
$grupos_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$grupos_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$grupos_list->isExport()) { ?>
<script>
var fgruposlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgruposlist = currentForm = new ew.Form("fgruposlist", "list");
	fgruposlist.formKeyCountName = '<?php echo $grupos_list->FormKeyCountName ?>';
	loadjs.done("fgruposlist");
});
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<?php if (!$grupos_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($grupos_list->TotalRecords > 0 && $grupos_list->ExportOptions->visible()) { ?>
<?php $grupos_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($grupos_list->ImportOptions->visible()) { ?>
<?php $grupos_list->ImportOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$grupos_list->renderOtherOptions();
?>
<?php $grupos_list->showPageHeader(); ?>
<?php
$grupos_list->showMessage();
?>
<?php if ($grupos_list->TotalRecords > 0 || $grupos->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($grupos_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> grupos">
<form name="fgruposlist" id="fgruposlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="grupos">
<div id="gmp_grupos" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($grupos_list->TotalRecords > 0 || $grupos_list->isGridEdit()) { ?>
<table id="tbl_gruposlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$grupos->RowType = ROWTYPE_HEADER;

// Render list options
$grupos_list->renderListOptions();

// Render list options (header, left)
$grupos_list->ListOptions->render("header", "left");
?>
<?php if ($grupos_list->id->Visible) { // id ?>
	<?php if ($grupos_list->SortUrl($grupos_list->id) == "") { ?>
		<th data-name="id" class="<?php echo $grupos_list->id->headerCellClass() ?>"><div id="elh_grupos_id" class="grupos_id"><div class="ew-table-header-caption"><?php echo $grupos_list->id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $grupos_list->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grupos_list->SortUrl($grupos_list->id) ?>', 1);"><div id="elh_grupos_id" class="grupos_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grupos_list->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($grupos_list->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grupos_list->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($grupos_list->nome_grupo->Visible) { // nome_grupo ?>
	<?php if ($grupos_list->SortUrl($grupos_list->nome_grupo) == "") { ?>
		<th data-name="nome_grupo" class="<?php echo $grupos_list->nome_grupo->headerCellClass() ?>"><div id="elh_grupos_nome_grupo" class="grupos_nome_grupo"><div class="ew-table-header-caption"><?php echo $grupos_list->nome_grupo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nome_grupo" class="<?php echo $grupos_list->nome_grupo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $grupos_list->SortUrl($grupos_list->nome_grupo) ?>', 1);"><div id="elh_grupos_nome_grupo" class="grupos_nome_grupo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $grupos_list->nome_grupo->caption() ?></span><span class="ew-table-header-sort"><?php if ($grupos_list->nome_grupo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($grupos_list->nome_grupo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$grupos_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($grupos_list->ExportAll && $grupos_list->isExport()) {
	$grupos_list->StopRecord = $grupos_list->TotalRecords;
} else {

	// Set the last record to display
	if ($grupos_list->TotalRecords > $grupos_list->StartRecord + $grupos_list->DisplayRecords - 1)
		$grupos_list->StopRecord = $grupos_list->StartRecord + $grupos_list->DisplayRecords - 1;
	else
		$grupos_list->StopRecord = $grupos_list->TotalRecords;
}
$grupos_list->RecordCount = $grupos_list->StartRecord - 1;
if ($grupos_list->Recordset && !$grupos_list->Recordset->EOF) {
	$grupos_list->Recordset->moveFirst();
	$selectLimit = $grupos_list->UseSelectLimit;
	if (!$selectLimit && $grupos_list->StartRecord > 1)
		$grupos_list->Recordset->move($grupos_list->StartRecord - 1);
} elseif (!$grupos->AllowAddDeleteRow && $grupos_list->StopRecord == 0) {
	$grupos_list->StopRecord = $grupos->GridAddRowCount;
}

// Initialize aggregate
$grupos->RowType = ROWTYPE_AGGREGATEINIT;
$grupos->resetAttributes();
$grupos_list->renderRow();
while ($grupos_list->RecordCount < $grupos_list->StopRecord) {
	$grupos_list->RecordCount++;
	if ($grupos_list->RecordCount >= $grupos_list->StartRecord) {
		$grupos_list->RowCount++;

		// Set up key count
		$grupos_list->KeyCount = $grupos_list->RowIndex;

		// Init row class and style
		$grupos->resetAttributes();
		$grupos->CssClass = "";
		if ($grupos_list->isGridAdd()) {
		} else {
			$grupos_list->loadRowValues($grupos_list->Recordset); // Load row values
		}
		$grupos->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$grupos->RowAttrs->merge(["data-rowindex" => $grupos_list->RowCount, "id" => "r" . $grupos_list->RowCount . "_grupos", "data-rowtype" => $grupos->RowType]);

		// Render row
		$grupos_list->renderRow();

		// Render list options
		$grupos_list->renderListOptions();
?>
	<tr <?php echo $grupos->rowAttributes() ?>>
<?php

// Render list options (body, left)
$grupos_list->ListOptions->render("body", "left", $grupos_list->RowCount);
?>
	<?php if ($grupos_list->id->Visible) { // id ?>
		<td data-name="id" <?php echo $grupos_list->id->cellAttributes() ?>>
<span id="el<?php echo $grupos_list->RowCount ?>_grupos_id">
<span<?php echo $grupos_list->id->viewAttributes() ?>><?php echo $grupos_list->id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($grupos_list->nome_grupo->Visible) { // nome_grupo ?>
		<td data-name="nome_grupo" <?php echo $grupos_list->nome_grupo->cellAttributes() ?>>
<span id="el<?php echo $grupos_list->RowCount ?>_grupos_nome_grupo">
<span<?php echo $grupos_list->nome_grupo->viewAttributes() ?>><?php echo $grupos_list->nome_grupo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$grupos_list->ListOptions->render("body", "right", $grupos_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$grupos_list->isGridAdd())
		$grupos_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$grupos->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($grupos_list->Recordset)
	$grupos_list->Recordset->Close();
?>
<?php if (!$grupos_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$grupos_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $grupos_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $grupos_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($grupos_list->TotalRecords == 0 && !$grupos->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $grupos_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$grupos_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$grupos_list->isExport()) { ?>
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
$grupos_list->terminate();
?>