<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "memberinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$member_list = new cmember_list();
$Page =& $member_list;

// Page init
$member_list->Page_Init();

// Page main
$member_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($member->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var member_list = new ew_Page("member_list");

// page properties
member_list.PageID = "list"; // page ID
member_list.FormID = "fmemberlist"; // form ID
var EW_PAGE_ID = member_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
member_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
member_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
member_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($member->Export == "") || (EW_EXPORT_MASTER_RECORD && $member->Export == "print")) { ?>
<?php } ?>
<?php $member_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$member_list->TotalRecs = $member->SelectRecordCount();
	} else {
		if ($member_list->Recordset = $member_list->LoadRecordset())
			$member_list->TotalRecs = $member_list->Recordset->RecordCount();
	}
	$member_list->StartRec = 1;
	if ($member_list->DisplayRecs <= 0 || ($member->Export <> "" && $member->ExportAll)) // Display all records
		$member_list->DisplayRecs = $member_list->TotalRecs;
	if (!($member->Export <> "" && $member->ExportAll))
		$member_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$member_list->Recordset = $member_list->LoadRecordset($member_list->StartRec-1, $member_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $member->TableCaption() ?>
&nbsp;&nbsp;<?php $member_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($member->Export == "" && $member->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(member_list);" style="text-decoration: none;"><img id="member_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="member_list_SearchPanel">
<form name="fmemberlistsrch" id="fmemberlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="member">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($member->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $member_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($member->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($member->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($member->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$member_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmemberlist" id="fmemberlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="member">
<div id="gmp_member" class="ewGridMiddlePanel">
<?php if ($member_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $member->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$member_list->RenderListOptions();

// Render list options (header, left)
$member_list->ListOptions->Render("header", "left");
?>
<?php if ($member->firstname->Visible) { // firstname ?>
	<?php if ($member->SortUrl($member->firstname) == "") { ?>
		<td><?php echo $member->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->firstname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->firstname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->lastname->Visible) { // lastname ?>
	<?php if ($member->SortUrl($member->lastname) == "") { ?>
		<td><?php echo $member->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->lastname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->lastname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->pricepertraveler->Visible) { // pricepertraveler ?>
	<?php if ($member->SortUrl($member->pricepertraveler) == "") { ?>
		<td><?php echo $member->pricepertraveler->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->pricepertraveler) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->pricepertraveler->FldCaption() ?></td><td style="width: 10px;"><?php if ($member->pricepertraveler->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->pricepertraveler->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->seatsavail->Visible) { // seatsavail ?>
	<?php if ($member->SortUrl($member->seatsavail) == "") { ?>
		<td><?php echo $member->seatsavail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->seatsavail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->seatsavail->FldCaption() ?></td><td style="width: 10px;"><?php if ($member->seatsavail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->seatsavail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->luggage->Visible) { // luggage ?>
	<?php if ($member->SortUrl($member->luggage) == "") { ?>
		<td><?php echo $member->luggage->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->luggage) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->luggage->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->luggage->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->luggage->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->leave->Visible) { // leave ?>
	<?php if ($member->SortUrl($member->leave) == "") { ?>
		<td><?php echo $member->leave->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->leave) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->leave->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->leave->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->leave->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->detour->Visible) { // detour ?>
	<?php if ($member->SortUrl($member->detour) == "") { ?>
		<td><?php echo $member->detour->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->detour) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->detour->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->detour->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->detour->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->triptype->Visible) { // triptype ?>
	<?php if ($member->SortUrl($member->triptype) == "") { ?>
		<td><?php echo $member->triptype->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->triptype) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->triptype->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->triptype->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->triptype->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->departuretime->Visible) { // departuretime ?>
	<?php if ($member->SortUrl($member->departuretime) == "") { ?>
		<td><?php echo $member->departuretime->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->departuretime) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->departuretime->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->departuretime->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->departuretime->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->departuredate->Visible) { // departuredate ?>
	<?php if ($member->SortUrl($member->departuredate) == "") { ?>
		<td><?php echo $member->departuredate->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->departuredate) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->departuredate->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->departuredate->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->departuredate->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->ac->Visible) { // ac ?>
	<?php if ($member->SortUrl($member->ac) == "") { ?>
		<td><?php echo $member->ac->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->ac) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->ac->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->ac->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->ac->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->product->Visible) { // product ?>
	<?php if ($member->SortUrl($member->product) == "") { ?>
		<td><?php echo $member->product->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->product) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->product->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->product->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->product->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member->category->Visible) { // category ?>
	<?php if ($member->SortUrl($member->category) == "") { ?>
		<td><?php echo $member->category->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member->SortUrl($member->category) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member->category->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member->category->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member->category->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$member_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($member->ExportAll && $member->Export <> "") {
	$member_list->StopRec = $member_list->TotalRecs;
} else {

	// Set the last record to display
	if ($member_list->TotalRecs > $member_list->StartRec + $member_list->DisplayRecs - 1)
		$member_list->StopRec = $member_list->StartRec + $member_list->DisplayRecs - 1;
	else
		$member_list->StopRec = $member_list->TotalRecs;
}
$member_list->RecCnt = $member_list->StartRec - 1;
if ($member_list->Recordset && !$member_list->Recordset->EOF) {
	$member_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $member_list->StartRec > 1)
		$member_list->Recordset->Move($member_list->StartRec - 1);
} elseif (!$member->AllowAddDeleteRow && $member_list->StopRec == 0) {
	$member_list->StopRec = $member->GridAddRowCount;
}

// Initialize aggregate
$member->RowType = EW_ROWTYPE_AGGREGATEINIT;
$member->ResetAttrs();
$member_list->RenderRow();
$member_list->RowCnt = 0;
while ($member_list->RecCnt < $member_list->StopRec) {
	$member_list->RecCnt++;
	if (intval($member_list->RecCnt) >= intval($member_list->StartRec)) {
		$member_list->RowCnt++;

		// Set up key count
		$member_list->KeyCount = $member_list->RowIndex;

		// Init row class and style
		$member->ResetAttrs();
		$member->CssClass = "";
		$member->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($member_list->RowIndex))
			$member->RowAttrs = array_merge($member->RowAttrs, array('data-rowindex'=>$member_list->RowIndex, 'id'=>'r' . $member_list->RowIndex . '_member'));
		if ($member->CurrentAction == "gridadd") {
			$member_list->LoadDefaultValues(); // Load default values
		} else {
			$member_list->LoadRowValues($member_list->Recordset); // Load row values
		}
		$member->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$member_list->RenderRow();

		// Render list options
		$member_list->RenderListOptions();
?>
	<tr<?php echo $member->RowAttributes() ?>>
<?php

// Render list options (body, left)
$member_list->ListOptions->Render("body", "left");
?>
	<?php if ($member->firstname->Visible) { // firstname ?>
		<td<?php echo $member->firstname->CellAttributes() ?>>
<div<?php echo $member->firstname->ViewAttributes() ?>><?php echo $member->firstname->ListViewValue() ?></div>
<a name="<?php echo $member_list->PageObjName . "_row_" . $member_list->RowCnt ?>" id="<?php echo $member_list->PageObjName . "_row_" . $member_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($member->lastname->Visible) { // lastname ?>
		<td<?php echo $member->lastname->CellAttributes() ?>>
<div<?php echo $member->lastname->ViewAttributes() ?>><?php echo $member->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->pricepertraveler->Visible) { // pricepertraveler ?>
		<td<?php echo $member->pricepertraveler->CellAttributes() ?>>
<div<?php echo $member->pricepertraveler->ViewAttributes() ?>><?php echo $member->pricepertraveler->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->seatsavail->Visible) { // seatsavail ?>
		<td<?php echo $member->seatsavail->CellAttributes() ?>>
<div<?php echo $member->seatsavail->ViewAttributes() ?>><?php echo $member->seatsavail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->luggage->Visible) { // luggage ?>
		<td<?php echo $member->luggage->CellAttributes() ?>>
<div<?php echo $member->luggage->ViewAttributes() ?>><?php echo $member->luggage->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->leave->Visible) { // leave ?>
		<td<?php echo $member->leave->CellAttributes() ?>>
<div<?php echo $member->leave->ViewAttributes() ?>><?php echo $member->leave->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->detour->Visible) { // detour ?>
		<td<?php echo $member->detour->CellAttributes() ?>>
<div<?php echo $member->detour->ViewAttributes() ?>><?php echo $member->detour->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->triptype->Visible) { // triptype ?>
		<td<?php echo $member->triptype->CellAttributes() ?>>
<div<?php echo $member->triptype->ViewAttributes() ?>><?php echo $member->triptype->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->departuretime->Visible) { // departuretime ?>
		<td<?php echo $member->departuretime->CellAttributes() ?>>
<div<?php echo $member->departuretime->ViewAttributes() ?>><?php echo $member->departuretime->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->departuredate->Visible) { // departuredate ?>
		<td<?php echo $member->departuredate->CellAttributes() ?>>
<div<?php echo $member->departuredate->ViewAttributes() ?>><?php echo $member->departuredate->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->ac->Visible) { // ac ?>
		<td<?php echo $member->ac->CellAttributes() ?>>
<div<?php echo $member->ac->ViewAttributes() ?>><?php echo $member->ac->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->product->Visible) { // product ?>
		<td<?php echo $member->product->CellAttributes() ?>>
<div<?php echo $member->product->ViewAttributes() ?>><?php echo $member->product->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member->category->Visible) { // category ?>
		<td<?php echo $member->category->CellAttributes() ?>>
<div<?php echo $member->category->ViewAttributes() ?>><?php echo $member->category->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$member_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($member->CurrentAction <> "gridadd")
		$member_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($member_list->Recordset)
	$member_list->Recordset->Close();
?>
<?php if ($member->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($member->CurrentAction <> "gridadd" && $member->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($member_list->Pager)) $member_list->Pager = new cPrevNextPager($member_list->StartRec, $member_list->DisplayRecs, $member_list->TotalRecs) ?>
<?php if ($member_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($member_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $member_list->PageUrl() ?>start=<?php echo $member_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($member_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $member_list->PageUrl() ?>start=<?php echo $member_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $member_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($member_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $member_list->PageUrl() ?>start=<?php echo $member_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($member_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $member_list->PageUrl() ?>start=<?php echo $member_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $member_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $member_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $member_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $member_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($member_list->SearchWhere == "0=101") { ?>
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
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($member->Export == "" && $member->CurrentAction == "") { ?>
<?php } ?>
<?php
$member_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($member->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$member_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmember_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'member';

	// Page object name
	var $PageObjName = 'member_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $member;
		if ($member->UseTokenInUrl) $PageUrl .= "t=" . $member->TableVar . "&"; // Add page token
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
		global $objForm, $member;
		if ($member->UseTokenInUrl) {
			if ($objForm)
				return ($member->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($member->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmember_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (member)
		if (!isset($GLOBALS["member"])) {
			$GLOBALS["member"] = new cmember();
			$GLOBALS["Table"] =& $GLOBALS["member"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "memberadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "memberdelete.php";
		$this->MultiUpdateUrl = "memberupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'member', TRUE);

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
		global $member;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$member->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $member;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($member->Export <> "" ||
				$member->CurrentAction == "gridadd" ||
				$member->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$member->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($member->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $member->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$member->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$member->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$member->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $member->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$member->setSessionWhere($sFilter);
		$member->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $member;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $member->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->source, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->destination, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->intermediatedestination1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->intermediatedestination2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->luggage, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->leave, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->detour, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->triptype, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->departuretime, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->departuredate, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->ac, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->product, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member->category, $Keyword);
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
		global $Security, $member;
		$sSearchStr = "";
		$sSearchKeyword = $member->BasicSearchKeyword;
		$sSearchType = $member->BasicSearchType;
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
			$member->setSessionBasicSearchKeyword($sSearchKeyword);
			$member->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $member;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$member->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $member;
		$member->setSessionBasicSearchKeyword("");
		$member->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $member;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$member->BasicSearchKeyword = $member->getSessionBasicSearchKeyword();
			$member->BasicSearchType = $member->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $member;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$member->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$member->CurrentOrderType = @$_GET["ordertype"];
			$member->UpdateSort($member->firstname); // firstname
			$member->UpdateSort($member->lastname); // lastname
			$member->UpdateSort($member->pricepertraveler); // pricepertraveler
			$member->UpdateSort($member->seatsavail); // seatsavail
			$member->UpdateSort($member->luggage); // luggage
			$member->UpdateSort($member->leave); // leave
			$member->UpdateSort($member->detour); // detour
			$member->UpdateSort($member->triptype); // triptype
			$member->UpdateSort($member->departuretime); // departuretime
			$member->UpdateSort($member->departuredate); // departuredate
			$member->UpdateSort($member->ac); // ac
			$member->UpdateSort($member->product); // product
			$member->UpdateSort($member->category); // category
			$member->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $member;
		$sOrderBy = $member->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($member->SqlOrderBy() <> "") {
				$sOrderBy = $member->SqlOrderBy();
				$member->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $member;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$member->setSessionOrderBy($sOrderBy);
				$member->firstname->setSort("");
				$member->lastname->setSort("");
				$member->pricepertraveler->setSort("");
				$member->seatsavail->setSort("");
				$member->luggage->setSort("");
				$member->leave->setSort("");
				$member->detour->setSort("");
				$member->triptype->setSort("");
				$member->departuretime->setSort("");
				$member->departuredate->setSort("");
				$member->ac->setSort("");
				$member->product->setSort("");
				$member->category->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$member->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $member;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $member, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $member;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $member;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$member->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$member->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $member->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$member->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$member->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$member->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $member;
		$member->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$member->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $member;

		// Call Recordset Selecting event
		$member->Recordset_Selecting($member->CurrentFilter);

		// Load List page SQL
		$sSql = $member->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$member->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $member;
		$sFilter = $member->KeyFilter();

		// Call Row Selecting event
		$member->Row_Selecting($sFilter);

		// Load SQL based on filter
		$member->CurrentFilter = $sFilter;
		$sSql = $member->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$member->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $member;
		if (!$rs || $rs->EOF) return;
		$member->firstname->setDbValue($rs->fields('firstname'));
		$member->lastname->setDbValue($rs->fields('lastname'));
		$member->source->setDbValue($rs->fields('source'));
		$member->destination->setDbValue($rs->fields('destination'));
		$member->intermediatedestination1->setDbValue($rs->fields('intermediatedestination1'));
		$member->intermediatedestination2->setDbValue($rs->fields('intermediatedestination2'));
		$member->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$member->seatsavail->setDbValue($rs->fields('seatsavail'));
		$member->luggage->setDbValue($rs->fields('luggage'));
		$member->leave->setDbValue($rs->fields('leave'));
		$member->detour->setDbValue($rs->fields('detour'));
		$member->triptype->setDbValue($rs->fields('triptype'));
		$member->departuretime->setDbValue($rs->fields('departuretime'));
		$member->departuredate->setDbValue($rs->fields('departuredate'));
		$member->ac->setDbValue($rs->fields('ac'));
		$member->product->setDbValue($rs->fields('product'));
		$member->category->setDbValue($rs->fields('category'));
	}

	// Load old record
	function LoadOldRecord() {
		global $member;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$member->CurrentFilter = $member->KeyFilter();
			$sSql = $member->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $member;

		// Initialize URLs
		$this->ViewUrl = $member->ViewUrl();
		$this->EditUrl = $member->EditUrl();
		$this->InlineEditUrl = $member->InlineEditUrl();
		$this->CopyUrl = $member->CopyUrl();
		$this->InlineCopyUrl = $member->InlineCopyUrl();
		$this->DeleteUrl = $member->DeleteUrl();

		// Call Row_Rendering event
		$member->Row_Rendering();

		// Common render codes for all row types
		// firstname
		// lastname
		// source
		// destination
		// intermediatedestination1
		// intermediatedestination2
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour
		// triptype
		// departuretime
		// departuredate
		// ac
		// product
		// category

		if ($member->RowType == EW_ROWTYPE_VIEW) { // View row

			// firstname
			$member->firstname->ViewValue = $member->firstname->CurrentValue;
			$member->firstname->ViewCustomAttributes = "";

			// lastname
			$member->lastname->ViewValue = $member->lastname->CurrentValue;
			$member->lastname->ViewCustomAttributes = "";

			// pricepertraveler
			$member->pricepertraveler->ViewValue = $member->pricepertraveler->CurrentValue;
			$member->pricepertraveler->ViewCustomAttributes = "";

			// seatsavail
			$member->seatsavail->ViewValue = $member->seatsavail->CurrentValue;
			$member->seatsavail->ViewCustomAttributes = "";

			// luggage
			$member->luggage->ViewValue = $member->luggage->CurrentValue;
			$member->luggage->ViewCustomAttributes = "";

			// leave
			$member->leave->ViewValue = $member->leave->CurrentValue;
			$member->leave->ViewCustomAttributes = "";

			// detour
			$member->detour->ViewValue = $member->detour->CurrentValue;
			$member->detour->ViewCustomAttributes = "";

			// triptype
			$member->triptype->ViewValue = $member->triptype->CurrentValue;
			$member->triptype->ViewCustomAttributes = "";

			// departuretime
			$member->departuretime->ViewValue = $member->departuretime->CurrentValue;
			$member->departuretime->ViewCustomAttributes = "";

			// departuredate
			$member->departuredate->ViewValue = $member->departuredate->CurrentValue;
			$member->departuredate->ViewCustomAttributes = "";

			// ac
			$member->ac->ViewValue = $member->ac->CurrentValue;
			$member->ac->ViewCustomAttributes = "";

			// product
			$member->product->ViewValue = $member->product->CurrentValue;
			$member->product->ViewCustomAttributes = "";

			// category
			$member->category->ViewValue = $member->category->CurrentValue;
			$member->category->ViewCustomAttributes = "";

			// firstname
			$member->firstname->LinkCustomAttributes = "";
			$member->firstname->HrefValue = "";
			$member->firstname->TooltipValue = "";

			// lastname
			$member->lastname->LinkCustomAttributes = "";
			$member->lastname->HrefValue = "";
			$member->lastname->TooltipValue = "";

			// pricepertraveler
			$member->pricepertraveler->LinkCustomAttributes = "";
			$member->pricepertraveler->HrefValue = "";
			$member->pricepertraveler->TooltipValue = "";

			// seatsavail
			$member->seatsavail->LinkCustomAttributes = "";
			$member->seatsavail->HrefValue = "";
			$member->seatsavail->TooltipValue = "";

			// luggage
			$member->luggage->LinkCustomAttributes = "";
			$member->luggage->HrefValue = "";
			$member->luggage->TooltipValue = "";

			// leave
			$member->leave->LinkCustomAttributes = "";
			$member->leave->HrefValue = "";
			$member->leave->TooltipValue = "";

			// detour
			$member->detour->LinkCustomAttributes = "";
			$member->detour->HrefValue = "";
			$member->detour->TooltipValue = "";

			// triptype
			$member->triptype->LinkCustomAttributes = "";
			$member->triptype->HrefValue = "";
			$member->triptype->TooltipValue = "";

			// departuretime
			$member->departuretime->LinkCustomAttributes = "";
			$member->departuretime->HrefValue = "";
			$member->departuretime->TooltipValue = "";

			// departuredate
			$member->departuredate->LinkCustomAttributes = "";
			$member->departuredate->HrefValue = "";
			$member->departuredate->TooltipValue = "";

			// ac
			$member->ac->LinkCustomAttributes = "";
			$member->ac->HrefValue = "";
			$member->ac->TooltipValue = "";

			// product
			$member->product->LinkCustomAttributes = "";
			$member->product->HrefValue = "";
			$member->product->TooltipValue = "";

			// category
			$member->category->LinkCustomAttributes = "";
			$member->category->HrefValue = "";
			$member->category->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($member->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$member->Row_Rendered();
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
