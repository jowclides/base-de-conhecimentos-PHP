<?php
namespace PHPMaker2020\PHPMAKER_Contatos;

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
$Summary_Report_summary = new Summary_Report_summary();

// Run the page
$Summary_Report_summary->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$Summary_Report_summary->Page_Render();
?>
<?php if (!$DashboardReport) { ?>
<?php include_once "header.php"; ?>
<?php } ?>
<?php if (!$Summary_Report_summary->isExport() && !$Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<script>
</script>
<script>
loadjs.ready("head", function() {

	// Client script
	// Write your client script here, no need to add script tags.

});
</script>
<?php } ?>
<a id="top"></a>
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Content Container -->
<div id="ew-report" class="ew-report container-fluid">
<?php } ?>
<div class="btn-toolbar ew-toolbar">
<?php
if (!$Summary_Report_summary->DrillDownInPanel) {
	$Summary_Report_summary->ExportOptions->render("body");
	$Summary_Report_summary->SearchOptions->render("body");
	$Summary_Report_summary->FilterOptions->render("body");
}
?>
</div>
<?php $Summary_Report_summary->showPageHeader(); ?>
<?php
$Summary_Report_summary->showMessage();
?>
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<div class="row">
<?php } ?>
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
<!-- Center Container -->
<div id="ew-center" class="<?php echo $Summary_Report_summary->CenterContentClass ?>">
<?php } ?>
<!-- Summary report (begin) -->
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
<div id="report_summary">
<?php } ?>
<?php if (!$Summary_Report_summary->isExport() && !$Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<?php } ?>
<?php
while ($Summary_Report_summary->RecordCount < count($Summary_Report_summary->DetailRecords) && $Summary_Report_summary->RecordCount < $Summary_Report_summary->DisplayGroups) {
?>
<?php

	// Show header
	if ($Summary_Report_summary->ShowHeader) {
?>
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
<div class="<?php if (!$Summary_Report_summary->isExport("word") && !$Summary_Report_summary->isExport("excel")) { ?>card ew-card <?php } ?>ew-grid"<?php echo $Summary_Report_summary->ReportTableStyle ?>>
<?php } ?>
<?php if (!$Summary_Report_summary->isExport() && !($Summary_Report_summary->DrillDown && $Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Top pager -->
<div class="card-header ew-grid-upper-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
<!-- Report grid (begin) -->
<div id="gmp_Summary_Report" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php } ?>
<table class="<?php echo $Summary_Report_summary->ReportTableClass ?>">
<thead>
	<!-- Table header -->
	<tr class="ew-table-header">
<?php if ($Summary_Report_summary->id->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->id) == "") { ?>
	<th data-name="id" class="<?php echo $Summary_Report_summary->id->headerCellClass() ?>"><div class="Summary_Report_id"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->id->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="id" class="<?php echo $Summary_Report_summary->id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->id) ?>', 1);"><div class="Summary_Report_id">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->id->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->avatar) == "") { ?>
	<th data-name="avatar" class="<?php echo $Summary_Report_summary->avatar->headerCellClass() ?>"><div class="Summary_Report_avatar"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->avatar->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="avatar" class="<?php echo $Summary_Report_summary->avatar->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->avatar) ?>', 1);"><div class="Summary_Report_avatar">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->avatar->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->avatar->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->avatar->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->nome_completo) == "") { ?>
	<th data-name="nome_completo" class="<?php echo $Summary_Report_summary->nome_completo->headerCellClass() ?>"><div class="Summary_Report_nome_completo"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->nome_completo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="nome_completo" class="<?php echo $Summary_Report_summary->nome_completo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->nome_completo) ?>', 1);"><div class="Summary_Report_nome_completo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->nome_completo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->nome_completo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->nome_completo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->_email) == "") { ?>
	<th data-name="_email" class="<?php echo $Summary_Report_summary->_email->headerCellClass() ?>"><div class="Summary_Report__email"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->_email->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="_email" class="<?php echo $Summary_Report_summary->_email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->_email) ?>', 1);"><div class="Summary_Report__email">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->_email->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->_email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->_email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->telefone) == "") { ?>
	<th data-name="telefone" class="<?php echo $Summary_Report_summary->telefone->headerCellClass() ?>"><div class="Summary_Report_telefone"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->telefone->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="telefone" class="<?php echo $Summary_Report_summary->telefone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->telefone) ?>', 1);"><div class="Summary_Report_telefone">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->telefone->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->telefone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->telefone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->celular) == "") { ?>
	<th data-name="celular" class="<?php echo $Summary_Report_summary->celular->headerCellClass() ?>"><div class="Summary_Report_celular"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->celular->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="celular" class="<?php echo $Summary_Report_summary->celular->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->celular) ?>', 1);"><div class="Summary_Report_celular">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->celular->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->celular->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->celular->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->empresa) == "") { ?>
	<th data-name="empresa" class="<?php echo $Summary_Report_summary->empresa->headerCellClass() ?>"><div class="Summary_Report_empresa"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->empresa->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="empresa" class="<?php echo $Summary_Report_summary->empresa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->empresa) ?>', 1);"><div class="Summary_Report_empresa">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->empresa->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->empresa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->empresa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->cargo) == "") { ?>
	<th data-name="cargo" class="<?php echo $Summary_Report_summary->cargo->headerCellClass() ?>"><div class="Summary_Report_cargo"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->cargo->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="cargo" class="<?php echo $Summary_Report_summary->cargo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->cargo) ?>', 1);"><div class="Summary_Report_cargo">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->cargo->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->cargo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->cargo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->responsabilidades) == "") { ?>
	<th data-name="responsabilidades" class="<?php echo $Summary_Report_summary->responsabilidades->headerCellClass() ?>"><div class="Summary_Report_responsabilidades"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->responsabilidades->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="responsabilidades" class="<?php echo $Summary_Report_summary->responsabilidades->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->responsabilidades) ?>', 1);"><div class="Summary_Report_responsabilidades">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->responsabilidades->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->responsabilidades->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->responsabilidades->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
	<?php if ($Summary_Report_summary->sortUrl($Summary_Report_summary->obs) == "") { ?>
	<th data-name="obs" class="<?php echo $Summary_Report_summary->obs->headerCellClass() ?>"><div class="Summary_Report_obs"><div class="ew-table-header-caption"><?php echo $Summary_Report_summary->obs->caption() ?></div></div></th>
	<?php } else { ?>
	<th data-name="obs" class="<?php echo $Summary_Report_summary->obs->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $Summary_Report_summary->sortUrl($Summary_Report_summary->obs) ?>', 1);"><div class="Summary_Report_obs">
		<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $Summary_Report_summary->obs->caption() ?></span><span class="ew-table-header-sort"><?php if ($Summary_Report_summary->obs->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($Summary_Report_summary->obs->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
	</div></div></th>
	<?php } ?>
<?php } ?>
	</tr>
</thead>
<tbody>
<?php
		if ($Summary_Report_summary->TotalGroups == 0)
			break; // Show header only
		$Summary_Report_summary->ShowHeader = FALSE;
	} // End show header
?>
<?php
	$Summary_Report_summary->loadRowValues($Summary_Report_summary->DetailRecords[$Summary_Report_summary->RecordCount]);
	$Summary_Report_summary->RecordCount++;
	$Summary_Report_summary->RecordIndex++;
?>
<?php

		// Render detail row
		$Summary_Report_summary->resetAttributes();
		$Summary_Report_summary->RowType = ROWTYPE_DETAIL;
		$Summary_Report_summary->renderRow();
?>
	<tr<?php echo $Summary_Report_summary->rowAttributes(); ?>>
<?php if ($Summary_Report_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Summary_Report_summary->id->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->id->viewAttributes() ?>><?php echo $Summary_Report_summary->id->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
		<td data-field="avatar"<?php echo $Summary_Report_summary->avatar->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->avatar->viewAttributes() ?>><?php echo GetFileViewTag($Summary_Report_summary->avatar, $Summary_Report_summary->avatar->getViewValue(), FALSE) ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
		<td data-field="nome_completo"<?php echo $Summary_Report_summary->nome_completo->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->nome_completo->viewAttributes() ?>><?php echo $Summary_Report_summary->nome_completo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Summary_Report_summary->_email->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->_email->viewAttributes() ?>><?php echo $Summary_Report_summary->_email->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
		<td data-field="telefone"<?php echo $Summary_Report_summary->telefone->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->telefone->viewAttributes() ?>><?php echo $Summary_Report_summary->telefone->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
		<td data-field="celular"<?php echo $Summary_Report_summary->celular->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->celular->viewAttributes() ?>><?php echo $Summary_Report_summary->celular->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
		<td data-field="empresa"<?php echo $Summary_Report_summary->empresa->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->empresa->viewAttributes() ?>><?php echo $Summary_Report_summary->empresa->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
		<td data-field="cargo"<?php echo $Summary_Report_summary->cargo->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->cargo->viewAttributes() ?>><?php echo $Summary_Report_summary->cargo->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
		<td data-field="responsabilidades"<?php echo $Summary_Report_summary->responsabilidades->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->responsabilidades->viewAttributes() ?>><?php echo $Summary_Report_summary->responsabilidades->getViewValue() ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
		<td data-field="obs"<?php echo $Summary_Report_summary->obs->cellAttributes() ?>>
<span<?php echo $Summary_Report_summary->obs->viewAttributes() ?>><?php echo $Summary_Report_summary->obs->getViewValue() ?></span>
</td>
<?php } ?>
	</tr>
<?php
} // End while
?>
<?php if ($Summary_Report_summary->TotalGroups > 0) { ?>
</tbody>
<tfoot>
<?php if (($Summary_Report_summary->StopGroup - $Summary_Report_summary->StartGroup + 1) != $Summary_Report_summary->TotalGroups) { ?>
<?php
	$Summary_Report_summary->resetAttributes();
	$Summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$Summary_Report_summary->RowTotalType = ROWTOTAL_PAGE;
	$Summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Summary_Report_summary->RowAttrs["class"] = "ew-rpt-page-summary";
	$Summary_Report_summary->renderRow();
?>
<?php if ($Summary_Report_summary->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Summary_Report_summary->rowAttributes(); ?>><td colspan="<?php echo ($Summary_Report_summary->GroupColumnCount + $Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Summary_Report_summary->PageTotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Summary_Report_summary->rowAttributes(); ?>>
<?php if ($Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Summary_Report_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
		<td data-field="avatar"<?php echo $Summary_Report_summary->avatar->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
		<td data-field="nome_completo"<?php echo $Summary_Report_summary->nome_completo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->nome_completo->viewAttributes() ?>><?php echo $Summary_Report_summary->nome_completo->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Summary_Report_summary->_email->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
		<td data-field="telefone"<?php echo $Summary_Report_summary->telefone->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
		<td data-field="celular"<?php echo $Summary_Report_summary->celular->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
		<td data-field="empresa"<?php echo $Summary_Report_summary->empresa->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->empresa->viewAttributes() ?>><?php echo $Summary_Report_summary->empresa->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
		<td data-field="cargo"<?php echo $Summary_Report_summary->cargo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->cargo->viewAttributes() ?>><?php echo $Summary_Report_summary->cargo->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
		<td data-field="responsabilidades"<?php echo $Summary_Report_summary->responsabilidades->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
		<td data-field="obs"<?php echo $Summary_Report_summary->obs->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Summary_Report_summary->rowAttributes(); ?>><td colspan="<?php echo ($Summary_Report_summary->GroupColumnCount + $Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptPageSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Summary_Report_summary->PageTotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Summary_Report_summary->rowAttributes(); ?>>
<?php if ($Summary_Report_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Summary_Report_summary->id->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
		<td data-field="avatar"<?php echo $Summary_Report_summary->avatar->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
		<td data-field="nome_completo"<?php echo $Summary_Report_summary->nome_completo->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->nome_completo->viewAttributes() ?>><?php echo $Summary_Report_summary->nome_completo->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Summary_Report_summary->_email->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
		<td data-field="telefone"<?php echo $Summary_Report_summary->telefone->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
		<td data-field="celular"<?php echo $Summary_Report_summary->celular->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
		<td data-field="empresa"<?php echo $Summary_Report_summary->empresa->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->empresa->viewAttributes() ?>><?php echo $Summary_Report_summary->empresa->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
		<td data-field="cargo"<?php echo $Summary_Report_summary->cargo->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->cargo->viewAttributes() ?>><?php echo $Summary_Report_summary->cargo->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
		<td data-field="responsabilidades"<?php echo $Summary_Report_summary->responsabilidades->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
		<td data-field="obs"<?php echo $Summary_Report_summary->obs->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
<?php } ?>
<?php
	$Summary_Report_summary->resetAttributes();
	$Summary_Report_summary->RowType = ROWTYPE_TOTAL;
	$Summary_Report_summary->RowTotalType = ROWTOTAL_GRAND;
	$Summary_Report_summary->RowTotalSubType = ROWTOTAL_FOOTER;
	$Summary_Report_summary->RowAttrs["class"] = "ew-rpt-grand-summary";
	$Summary_Report_summary->renderRow();
?>
<?php if ($Summary_Report_summary->ShowCompactSummaryFooter) { ?>
	<tr<?php echo $Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Summary_Report_summary->GroupColumnCount + $Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><?php echo FormatNumber($Summary_Report_summary->TotalCount, 0); ?></span>)</span></td></tr>
	<tr<?php echo $Summary_Report_summary->rowAttributes() ?>>
<?php if ($Summary_Report_summary->GroupColumnCount > 0) { ?>
		<td colspan="<?php echo $Summary_Report_summary->GroupColumnCount ?>" class="ew-rpt-grp-aggregate">&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Summary_Report_summary->id->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
		<td data-field="avatar"<?php echo $Summary_Report_summary->avatar->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
		<td data-field="nome_completo"<?php echo $Summary_Report_summary->nome_completo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->nome_completo->viewAttributes() ?>><?php echo $Summary_Report_summary->nome_completo->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Summary_Report_summary->_email->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
		<td data-field="telefone"<?php echo $Summary_Report_summary->telefone->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
		<td data-field="celular"<?php echo $Summary_Report_summary->celular->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
		<td data-field="empresa"<?php echo $Summary_Report_summary->empresa->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->empresa->viewAttributes() ?>><?php echo $Summary_Report_summary->empresa->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
		<td data-field="cargo"<?php echo $Summary_Report_summary->cargo->cellAttributes() ?>><span class="ew-aggregate-caption"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateEqual") ?><span class="ew-aggregate-value"><span<?php echo $Summary_Report_summary->cargo->viewAttributes() ?>><?php echo $Summary_Report_summary->cargo->CntViewValue ?></span></span></td>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
		<td data-field="responsabilidades"<?php echo $Summary_Report_summary->responsabilidades->cellAttributes() ?>></td>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
		<td data-field="obs"<?php echo $Summary_Report_summary->obs->cellAttributes() ?>></td>
<?php } ?>
	</tr>
<?php } else { ?>
	<tr<?php echo $Summary_Report_summary->rowAttributes() ?>><td colspan="<?php echo ($Summary_Report_summary->GroupColumnCount + $Summary_Report_summary->DetailColumnCount) ?>"><?php echo $Language->phrase("RptGrandSummary") ?> <span class="ew-summary-count">(<?php echo FormatNumber($Summary_Report_summary->TotalCount, 0); ?><?php echo $Language->phrase("RptDtlRec") ?>)</span></td></tr>
	<tr<?php echo $Summary_Report_summary->rowAttributes() ?>>
<?php if ($Summary_Report_summary->id->Visible) { ?>
		<td data-field="id"<?php echo $Summary_Report_summary->id->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->avatar->Visible) { ?>
		<td data-field="avatar"<?php echo $Summary_Report_summary->avatar->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->nome_completo->Visible) { ?>
		<td data-field="nome_completo"<?php echo $Summary_Report_summary->nome_completo->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->nome_completo->viewAttributes() ?>><?php echo $Summary_Report_summary->nome_completo->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->_email->Visible) { ?>
		<td data-field="_email"<?php echo $Summary_Report_summary->_email->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->telefone->Visible) { ?>
		<td data-field="telefone"<?php echo $Summary_Report_summary->telefone->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->celular->Visible) { ?>
		<td data-field="celular"<?php echo $Summary_Report_summary->celular->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->empresa->Visible) { ?>
		<td data-field="empresa"<?php echo $Summary_Report_summary->empresa->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->empresa->viewAttributes() ?>><?php echo $Summary_Report_summary->empresa->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->cargo->Visible) { ?>
		<td data-field="cargo"<?php echo $Summary_Report_summary->cargo->cellAttributes() ?>><span class="ew-aggregate"><?php echo $Language->phrase("RptCnt") ?></span><?php echo $Language->phrase("AggregateColon") ?>
<span<?php echo $Summary_Report_summary->cargo->viewAttributes() ?>><?php echo $Summary_Report_summary->cargo->CntViewValue ?></span>
</td>
<?php } ?>
<?php if ($Summary_Report_summary->responsabilidades->Visible) { ?>
		<td data-field="responsabilidades"<?php echo $Summary_Report_summary->responsabilidades->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
<?php if ($Summary_Report_summary->obs->Visible) { ?>
		<td data-field="obs"<?php echo $Summary_Report_summary->obs->cellAttributes() ?>>&nbsp;</td>
<?php } ?>
	</tr>
<?php } ?>
</tfoot>
</table>
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid-middle-panel -->
<!-- Report grid (end) -->
<?php } ?>
<?php if ($Summary_Report_summary->TotalGroups > 0) { ?>
<?php if (!$Summary_Report_summary->isExport() && !($Summary_Report_summary->DrillDown && $Summary_Report_summary->TotalGroups > 0)) { ?>
<!-- Bottom pager -->
<div class="card-footer ew-grid-lower-panel">
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $Summary_Report_summary->Pager->render() ?>
</form>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php } ?>
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /.ew-grid -->
<?php } ?>
<?php } ?>
<?php if (!$Summary_Report_summary->isExport("pdf")) { ?>
</div>
<!-- /#report-summary -->
<?php } ?>
<!-- Summary report (end) -->
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /#ew-center -->
<?php } ?>
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.row -->
<?php } ?>
<?php if ((!$Summary_Report_summary->isExport() || $Summary_Report_summary->isExport("print")) && !$DashboardReport) { ?>
</div>
<!-- /.ew-report -->
<?php } ?>
<?php
$Summary_Report_summary->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$Summary_Report_summary->isExport() && !$Summary_Report_summary->DrillDown && !$DashboardReport) { ?>
<script>
loadjs.ready("load", function() {

	// Startup script
	// Write your table-specific startup script here
	// console.log("page loaded");

});
</script>
<?php } ?>
<?php if (!$DashboardReport) { ?>
<?php include_once "footer.php"; ?>
<?php } ?>
<?php
$Summary_Report_summary->terminate();
?>