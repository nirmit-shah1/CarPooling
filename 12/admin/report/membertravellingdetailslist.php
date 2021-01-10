<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membertravellingdetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$membertravellingdetails_list = new cmembertravellingdetails_list();
$Page =& $membertravellingdetails_list;

// Page init
$membertravellingdetails_list->Page_Init();

// Page main
$membertravellingdetails_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($membertravellingdetails->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var membertravellingdetails_list = new ew_Page("membertravellingdetails_list");

// page properties
membertravellingdetails_list.PageID = "list"; // page ID
membertravellingdetails_list.FormID = "fmembertravellingdetailslist"; // form ID
var EW_PAGE_ID = membertravellingdetails_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
membertravellingdetails_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
membertravellingdetails_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
membertravellingdetails_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($membertravellingdetails->Export == "") || (EW_EXPORT_MASTER_RECORD && $membertravellingdetails->Export == "print")) { ?>
<?php } ?>
<?php $membertravellingdetails_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$membertravellingdetails_list->TotalRecs = $membertravellingdetails->SelectRecordCount();
	} else {
		if ($membertravellingdetails_list->Recordset = $membertravellingdetails_list->LoadRecordset())
			$membertravellingdetails_list->TotalRecs = $membertravellingdetails_list->Recordset->RecordCount();
	}
	$membertravellingdetails_list->StartRec = 1;
	if ($membertravellingdetails_list->DisplayRecs <= 0 || ($membertravellingdetails->Export <> "" && $membertravellingdetails->ExportAll)) // Display all records
		$membertravellingdetails_list->DisplayRecs = $membertravellingdetails_list->TotalRecs;
	if (!($membertravellingdetails->Export <> "" && $membertravellingdetails->ExportAll))
		$membertravellingdetails_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$membertravellingdetails_list->Recordset = $membertravellingdetails_list->LoadRecordset($membertravellingdetails_list->StartRec-1, $membertravellingdetails_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $membertravellingdetails->TableCaption() ?>
&nbsp;&nbsp;<?php $membertravellingdetails_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($membertravellingdetails->Export == "" && $membertravellingdetails->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(membertravellingdetails_list);" style="text-decoration: none;"><img id="membertravellingdetails_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="membertravellingdetails_list_SearchPanel">
<form name="fmembertravellingdetailslistsrch" id="fmembertravellingdetailslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="membertravellingdetails">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($membertravellingdetails->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $membertravellingdetails_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($membertravellingdetails->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($membertravellingdetails->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($membertravellingdetails->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$membertravellingdetails_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmembertravellingdetailslist" id="fmembertravellingdetailslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="membertravellingdetails">
<div id="gmp_membertravellingdetails" class="ewGridMiddlePanel">
<?php if ($membertravellingdetails_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $membertravellingdetails->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$membertravellingdetails_list->RenderListOptions();

// Render list options (header, left)
$membertravellingdetails_list->ListOptions->Render("header", "left");
?>
<?php if ($membertravellingdetails->reg_id->Visible) { // reg_id ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->reg_id) == "") { ?>
		<td><?php echo $membertravellingdetails->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->mid->Visible) { // mid ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->mid) == "") { ?>
		<td><?php echo $membertravellingdetails->mid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->mid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->mid->FldCaption() ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->mid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->mid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->pricepertraveler->Visible) { // pricepertraveler ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->pricepertraveler) == "") { ?>
		<td><?php echo $membertravellingdetails->pricepertraveler->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->pricepertraveler) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->pricepertraveler->FldCaption() ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->pricepertraveler->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->pricepertraveler->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->seatsavail->Visible) { // seatsavail ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->seatsavail) == "") { ?>
		<td><?php echo $membertravellingdetails->seatsavail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->seatsavail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->seatsavail->FldCaption() ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->seatsavail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->seatsavail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->luggage->Visible) { // luggage ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->luggage) == "") { ?>
		<td><?php echo $membertravellingdetails->luggage->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->luggage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->luggage->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->luggage->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->luggage->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->leave->Visible) { // leave ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->leave) == "") { ?>
		<td><?php echo $membertravellingdetails->leave->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->leave) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->leave->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->leave->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->leave->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($membertravellingdetails->detour->Visible) { // detour ?>
	<?php if ($membertravellingdetails->SortUrl($membertravellingdetails->detour) == "") { ?>
		<td><?php echo $membertravellingdetails->detour->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $membertravellingdetails->SortUrl($membertravellingdetails->detour) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $membertravellingdetails->detour->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($membertravellingdetails->detour->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($membertravellingdetails->detour->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$membertravellingdetails_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($membertravellingdetails->ExportAll && $membertravellingdetails->Export <> "") {
	$membertravellingdetails_list->StopRec = $membertravellingdetails_list->TotalRecs;
} else {

	// Set the last record to display
	if ($membertravellingdetails_list->TotalRecs > $membertravellingdetails_list->StartRec + $membertravellingdetails_list->DisplayRecs - 1)
		$membertravellingdetails_list->StopRec = $membertravellingdetails_list->StartRec + $membertravellingdetails_list->DisplayRecs - 1;
	else
		$membertravellingdetails_list->StopRec = $membertravellingdetails_list->TotalRecs;
}
$membertravellingdetails_list->RecCnt = $membertravellingdetails_list->StartRec - 1;
if ($membertravellingdetails_list->Recordset && !$membertravellingdetails_list->Recordset->EOF) {
	$membertravellingdetails_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $membertravellingdetails_list->StartRec > 1)
		$membertravellingdetails_list->Recordset->Move($membertravellingdetails_list->StartRec - 1);
} elseif (!$membertravellingdetails->AllowAddDeleteRow && $membertravellingdetails_list->StopRec == 0) {
	$membertravellingdetails_list->StopRec = $membertravellingdetails->GridAddRowCount;
}

// Initialize aggregate
$membertravellingdetails->RowType = EW_ROWTYPE_AGGREGATEINIT;
$membertravellingdetails->ResetAttrs();
$membertravellingdetails_list->RenderRow();
$membertravellingdetails_list->RowCnt = 0;
while ($membertravellingdetails_list->RecCnt < $membertravellingdetails_list->StopRec) {
	$membertravellingdetails_list->RecCnt++;
	if (intval($membertravellingdetails_list->RecCnt) >= intval($membertravellingdetails_list->StartRec)) {
		$membertravellingdetails_list->RowCnt++;

		// Set up key count
		$membertravellingdetails_list->KeyCount = $membertravellingdetails_list->RowIndex;

		// Init row class and style
		$membertravellingdetails->ResetAttrs();
		$membertravellingdetails->CssClass = "";
		$membertravellingdetails->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($membertravellingdetails_list->RowIndex))
			$membertravellingdetails->RowAttrs = array_merge($membertravellingdetails->RowAttrs, array('data-rowindex'=>$membertravellingdetails_list->RowIndex, 'id'=>'r' . $membertravellingdetails_list->RowIndex . '_membertravellingdetails'));
		if ($membertravellingdetails->CurrentAction == "gridadd") {
			$membertravellingdetails_list->LoadDefaultValues(); // Load default values
		} else {
			$membertravellingdetails_list->LoadRowValues($membertravellingdetails_list->Recordset); // Load row values
		}
		$membertravellingdetails->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$membertravellingdetails_list->RenderRow();

		// Render list options
		$membertravellingdetails_list->RenderListOptions();
?>
	<tr<?php echo $membertravellingdetails->RowAttributes() ?>>
<?php

// Render list options (body, left)
$membertravellingdetails_list->ListOptions->Render("body", "left");
?>
	<?php if ($membertravellingdetails->reg_id->Visible) { // reg_id ?>
		<td<?php echo $membertravellingdetails->reg_id->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->reg_id->ViewAttributes() ?>><?php echo $membertravellingdetails->reg_id->ListViewValue() ?></div>
<a name="<?php echo $membertravellingdetails_list->PageObjName . "_row_" . $membertravellingdetails_list->RowCnt ?>" id="<?php echo $membertravellingdetails_list->PageObjName . "_row_" . $membertravellingdetails_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($membertravellingdetails->mid->Visible) { // mid ?>
		<td<?php echo $membertravellingdetails->mid->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->mid->ViewAttributes() ?>><?php echo $membertravellingdetails->mid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($membertravellingdetails->pricepertraveler->Visible) { // pricepertraveler ?>
		<td<?php echo $membertravellingdetails->pricepertraveler->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->pricepertraveler->ViewAttributes() ?>><?php echo $membertravellingdetails->pricepertraveler->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($membertravellingdetails->seatsavail->Visible) { // seatsavail ?>
		<td<?php echo $membertravellingdetails->seatsavail->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->seatsavail->ViewAttributes() ?>><?php echo $membertravellingdetails->seatsavail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($membertravellingdetails->luggage->Visible) { // luggage ?>
		<td<?php echo $membertravellingdetails->luggage->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->luggage->ViewAttributes() ?>><?php echo $membertravellingdetails->luggage->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($membertravellingdetails->leave->Visible) { // leave ?>
		<td<?php echo $membertravellingdetails->leave->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->leave->ViewAttributes() ?>><?php echo $membertravellingdetails->leave->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($membertravellingdetails->detour->Visible) { // detour ?>
		<td<?php echo $membertravellingdetails->detour->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->detour->ViewAttributes() ?>><?php echo $membertravellingdetails->detour->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$membertravellingdetails_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($membertravellingdetails->CurrentAction <> "gridadd")
		$membertravellingdetails_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($membertravellingdetails_list->Recordset)
	$membertravellingdetails_list->Recordset->Close();
?>
<?php if ($membertravellingdetails->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($membertravellingdetails->CurrentAction <> "gridadd" && $membertravellingdetails->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($membertravellingdetails_list->Pager)) $membertravellingdetails_list->Pager = new cPrevNextPager($membertravellingdetails_list->StartRec, $membertravellingdetails_list->DisplayRecs, $membertravellingdetails_list->TotalRecs) ?>
<?php if ($membertravellingdetails_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($membertravellingdetails_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $membertravellingdetails_list->PageUrl() ?>start=<?php echo $membertravellingdetails_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($membertravellingdetails_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $membertravellingdetails_list->PageUrl() ?>start=<?php echo $membertravellingdetails_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $membertravellingdetails_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($membertravellingdetails_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $membertravellingdetails_list->PageUrl() ?>start=<?php echo $membertravellingdetails_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($membertravellingdetails_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $membertravellingdetails_list->PageUrl() ?>start=<?php echo $membertravellingdetails_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $membertravellingdetails_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $membertravellingdetails_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $membertravellingdetails_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $membertravellingdetails_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($membertravellingdetails_list->SearchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<span class="phpmaker">
<a href="<?php echo $membertravellingdetails_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($membertravellingdetails->Export == "" && $membertravellingdetails->CurrentAction == "") { ?>
<?php } ?>
<?php
$membertravellingdetails_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($membertravellingdetails->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$membertravellingdetails_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembertravellingdetails_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'membertravellingdetails';

	// Page object name
	var $PageObjName = 'membertravellingdetails_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) $PageUrl .= "t=" . $membertravellingdetails->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			echo "<p class=\"ewMessage\">" . $sMessage . "</p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			echo "<p class=\"ewSuccessMessage\">" . $sSuccessMessage . "</p>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			echo "<p class=\"ewErrorMessage\">" . $sErrorMessage . "</p>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p class=\"phpmaker\">" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Fotoer exists, display
			echo "<p class=\"phpmaker\">" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) {
			if ($objForm)
				return ($membertravellingdetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($membertravellingdetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembertravellingdetails_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (membertravellingdetails)
		if (!isset($GLOBALS["membertravellingdetails"])) {
			$GLOBALS["membertravellingdetails"] = new cmembertravellingdetails();
			$GLOBALS["Table"] =& $GLOBALS["membertravellingdetails"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "membertravellingdetailsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "membertravellingdetailsdelete.php";
		$this->MultiUpdateUrl = "membertravellingdetailsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'membertravellingdetails', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "span";
		$this->ExportOptions->Separator = "&nbsp;&nbsp;";
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $membertravellingdetails;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$membertravellingdetails->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $RowCnt;
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RecPerRow = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $RestoreSearch;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $membertravellingdetails;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($membertravellingdetails->Export <> "" ||
				$membertravellingdetails->CurrentAction == "gridadd" ||
				$membertravellingdetails->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$membertravellingdetails->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($membertravellingdetails->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $membertravellingdetails->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$membertravellingdetails->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$membertravellingdetails->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$membertravellingdetails->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $membertravellingdetails->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$membertravellingdetails->setSessionWhere($sFilter);
		$membertravellingdetails->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $membertravellingdetails;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $membertravellingdetails->luggage, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $membertravellingdetails->leave, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $membertravellingdetails->detour, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", $lFldDataType));
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $membertravellingdetails;
		$sSearchStr = "";
		$sSearchKeyword = $membertravellingdetails->BasicSearchKeyword;
		$sSearchType = $membertravellingdetails->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$membertravellingdetails->setSessionBasicSearchKeyword($sSearchKeyword);
			$membertravellingdetails->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $membertravellingdetails;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$membertravellingdetails->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $membertravellingdetails;
		$membertravellingdetails->setSessionBasicSearchKeyword("");
		$membertravellingdetails->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $membertravellingdetails;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$membertravellingdetails->BasicSearchKeyword = $membertravellingdetails->getSessionBasicSearchKeyword();
			$membertravellingdetails->BasicSearchType = $membertravellingdetails->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $membertravellingdetails;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$membertravellingdetails->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$membertravellingdetails->CurrentOrderType = @$_GET["ordertype"];
			$membertravellingdetails->UpdateSort($membertravellingdetails->reg_id); // reg_id
			$membertravellingdetails->UpdateSort($membertravellingdetails->mid); // mid
			$membertravellingdetails->UpdateSort($membertravellingdetails->pricepertraveler); // pricepertraveler
			$membertravellingdetails->UpdateSort($membertravellingdetails->seatsavail); // seatsavail
			$membertravellingdetails->UpdateSort($membertravellingdetails->luggage); // luggage
			$membertravellingdetails->UpdateSort($membertravellingdetails->leave); // leave
			$membertravellingdetails->UpdateSort($membertravellingdetails->detour); // detour
			$membertravellingdetails->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $membertravellingdetails;
		$sOrderBy = $membertravellingdetails->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($membertravellingdetails->SqlOrderBy() <> "") {
				$sOrderBy = $membertravellingdetails->SqlOrderBy();
				$membertravellingdetails->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $membertravellingdetails;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$membertravellingdetails->setSessionOrderBy($sOrderBy);
				$membertravellingdetails->reg_id->setSort("");
				$membertravellingdetails->mid->setSort("");
				$membertravellingdetails->pricepertraveler->setSort("");
				$membertravellingdetails->seatsavail->setSort("");
				$membertravellingdetails->luggage->setSort("");
				$membertravellingdetails->leave->setSort("");
				$membertravellingdetails->detour->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $membertravellingdetails;

		// "view"
		$item =& $this->ListOptions->Add("view");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "edit"
		$item =& $this->ListOptions->Add("edit");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "copy"
		$item =& $this->ListOptions->Add("copy");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// "delete"
		$item =& $this->ListOptions->Add("delete");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $membertravellingdetails, $objForm;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $membertravellingdetails;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $membertravellingdetails;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$membertravellingdetails->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$membertravellingdetails->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $membertravellingdetails->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $membertravellingdetails;
		$membertravellingdetails->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$membertravellingdetails->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $membertravellingdetails;

		// Call Recordset Selecting event
		$membertravellingdetails->Recordset_Selecting($membertravellingdetails->CurrentFilter);

		// Load List page SQL
		$sSql = $membertravellingdetails->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$membertravellingdetails->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $membertravellingdetails;
		$sFilter = $membertravellingdetails->KeyFilter();

		// Call Row Selecting event
		$membertravellingdetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$membertravellingdetails->CurrentFilter = $sFilter;
		$sSql = $membertravellingdetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$membertravellingdetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $membertravellingdetails;
		if (!$rs || $rs->EOF) return;
		$membertravellingdetails->reg_id->setDbValue($rs->fields('reg_id'));
		$membertravellingdetails->mid->setDbValue($rs->fields('mid'));
		$membertravellingdetails->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$membertravellingdetails->seatsavail->setDbValue($rs->fields('seatsavail'));
		$membertravellingdetails->luggage->setDbValue($rs->fields('luggage'));
		$membertravellingdetails->leave->setDbValue($rs->fields('leave'));
		$membertravellingdetails->detour->setDbValue($rs->fields('detour'));
	}

	// Load old record
	function LoadOldRecord() {
		global $membertravellingdetails;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($membertravellingdetails->getKey("mid")) <> "")
			$membertravellingdetails->mid->CurrentValue = $membertravellingdetails->getKey("mid"); // mid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$membertravellingdetails->CurrentFilter = $membertravellingdetails->KeyFilter();
			$sSql = $membertravellingdetails->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $membertravellingdetails;

		// Initialize URLs
		$this->ViewUrl = $membertravellingdetails->ViewUrl();
		$this->EditUrl = $membertravellingdetails->EditUrl();
		$this->InlineEditUrl = $membertravellingdetails->InlineEditUrl();
		$this->CopyUrl = $membertravellingdetails->CopyUrl();
		$this->InlineCopyUrl = $membertravellingdetails->InlineCopyUrl();
		$this->DeleteUrl = $membertravellingdetails->DeleteUrl();

		// Call Row_Rendering event
		$membertravellingdetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour

		if ($membertravellingdetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$membertravellingdetails->reg_id->ViewValue = $membertravellingdetails->reg_id->CurrentValue;
			$membertravellingdetails->reg_id->ViewCustomAttributes = "";

			// mid
			$membertravellingdetails->mid->ViewValue = $membertravellingdetails->mid->CurrentValue;
			$membertravellingdetails->mid->ViewCustomAttributes = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->ViewValue = $membertravellingdetails->pricepertraveler->CurrentValue;
			$membertravellingdetails->pricepertraveler->ViewCustomAttributes = "";

			// seatsavail
			$membertravellingdetails->seatsavail->ViewValue = $membertravellingdetails->seatsavail->CurrentValue;
			$membertravellingdetails->seatsavail->ViewCustomAttributes = "";

			// luggage
			$membertravellingdetails->luggage->ViewValue = $membertravellingdetails->luggage->CurrentValue;
			$membertravellingdetails->luggage->ViewCustomAttributes = "";

			// leave
			$membertravellingdetails->leave->ViewValue = $membertravellingdetails->leave->CurrentValue;
			$membertravellingdetails->leave->ViewCustomAttributes = "";

			// detour
			$membertravellingdetails->detour->ViewValue = $membertravellingdetails->detour->CurrentValue;
			$membertravellingdetails->detour->ViewCustomAttributes = "";

			// reg_id
			$membertravellingdetails->reg_id->LinkCustomAttributes = "";
			$membertravellingdetails->reg_id->HrefValue = "";
			$membertravellingdetails->reg_id->TooltipValue = "";

			// mid
			$membertravellingdetails->mid->LinkCustomAttributes = "";
			$membertravellingdetails->mid->HrefValue = "";
			$membertravellingdetails->mid->TooltipValue = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->LinkCustomAttributes = "";
			$membertravellingdetails->pricepertraveler->HrefValue = "";
			$membertravellingdetails->pricepertraveler->TooltipValue = "";

			// seatsavail
			$membertravellingdetails->seatsavail->LinkCustomAttributes = "";
			$membertravellingdetails->seatsavail->HrefValue = "";
			$membertravellingdetails->seatsavail->TooltipValue = "";

			// luggage
			$membertravellingdetails->luggage->LinkCustomAttributes = "";
			$membertravellingdetails->luggage->HrefValue = "";
			$membertravellingdetails->luggage->TooltipValue = "";

			// leave
			$membertravellingdetails->leave->LinkCustomAttributes = "";
			$membertravellingdetails->leave->HrefValue = "";
			$membertravellingdetails->leave->TooltipValue = "";

			// detour
			$membertravellingdetails->detour->LinkCustomAttributes = "";
			$membertravellingdetails->detour->HrefValue = "";
			$membertravellingdetails->detour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($membertravellingdetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$membertravellingdetails->Row_Rendered();
	}

	// PDF Export
	function ExportPDF($html) {
		echo($html);
		ew_DeleteTmpImages();
		exit();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt =& $this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
