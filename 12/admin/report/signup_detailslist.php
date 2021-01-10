<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "signup_detailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$signup_details_list = new csignup_details_list();
$Page =& $signup_details_list;

// Page init
$signup_details_list->Page_Init();

// Page main
$signup_details_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($signup_details->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var signup_details_list = new ew_Page("signup_details_list");

// page properties
signup_details_list.PageID = "list"; // page ID
signup_details_list.FormID = "fsignup_detailslist"; // form ID
var EW_PAGE_ID = signup_details_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
signup_details_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
signup_details_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
signup_details_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($signup_details->Export == "") || (EW_EXPORT_MASTER_RECORD && $signup_details->Export == "print")) { ?>
<?php } ?>
<?php $signup_details_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$signup_details_list->TotalRecs = $signup_details->SelectRecordCount();
	} else {
		if ($signup_details_list->Recordset = $signup_details_list->LoadRecordset())
			$signup_details_list->TotalRecs = $signup_details_list->Recordset->RecordCount();
	}
	$signup_details_list->StartRec = 1;
	if ($signup_details_list->DisplayRecs <= 0 || ($signup_details->Export <> "" && $signup_details->ExportAll)) // Display all records
		$signup_details_list->DisplayRecs = $signup_details_list->TotalRecs;
	if (!($signup_details->Export <> "" && $signup_details->ExportAll))
		$signup_details_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$signup_details_list->Recordset = $signup_details_list->LoadRecordset($signup_details_list->StartRec-1, $signup_details_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $signup_details->TableCaption() ?>
&nbsp;&nbsp;<?php $signup_details_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($signup_details->Export == "" && $signup_details->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(signup_details_list);" style="text-decoration: none;"><img id="signup_details_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="signup_details_list_SearchPanel">
<form name="fsignup_detailslistsrch" id="fsignup_detailslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="signup_details">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($signup_details->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $signup_details_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($signup_details->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($signup_details->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($signup_details->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$signup_details_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsignup_detailslist" id="fsignup_detailslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="signup_details">
<div id="gmp_signup_details" class="ewGridMiddlePanel">
<?php if ($signup_details_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $signup_details->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$signup_details_list->RenderListOptions();

// Render list options (header, left)
$signup_details_list->ListOptions->Render("header", "left");
?>
<?php if ($signup_details->reg_id->Visible) { // reg_id ?>
	<?php if ($signup_details->SortUrl($signup_details->reg_id) == "") { ?>
		<td><?php echo $signup_details->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($signup_details->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->firstname->Visible) { // firstname ?>
	<?php if ($signup_details->SortUrl($signup_details->firstname) == "") { ?>
		<td><?php echo $signup_details->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signup_details->firstname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->firstname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->lastname->Visible) { // lastname ?>
	<?php if ($signup_details->SortUrl($signup_details->lastname) == "") { ?>
		<td><?php echo $signup_details->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signup_details->lastname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->lastname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->contactno->Visible) { // contactno ?>
	<?php if ($signup_details->SortUrl($signup_details->contactno) == "") { ?>
		<td><?php echo $signup_details->contactno->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->contactno) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->contactno->FldCaption() ?></td><td style="width: 10px;"><?php if ($signup_details->contactno->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->contactno->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->gender->Visible) { // gender ?>
	<?php if ($signup_details->SortUrl($signup_details->gender) == "") { ?>
		<td><?php echo $signup_details->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->gender->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signup_details->gender->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->gender->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->bio->Visible) { // bio ?>
	<?php if ($signup_details->SortUrl($signup_details->bio) == "") { ?>
		<td><?php echo $signup_details->bio->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->bio) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->bio->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signup_details->bio->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->bio->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signup_details->date->Visible) { // date ?>
	<?php if ($signup_details->SortUrl($signup_details->date) == "") { ?>
		<td><?php echo $signup_details->date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signup_details->SortUrl($signup_details->date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signup_details->date->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signup_details->date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signup_details->date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$signup_details_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($signup_details->ExportAll && $signup_details->Export <> "") {
	$signup_details_list->StopRec = $signup_details_list->TotalRecs;
} else {

	// Set the last record to display
	if ($signup_details_list->TotalRecs > $signup_details_list->StartRec + $signup_details_list->DisplayRecs - 1)
		$signup_details_list->StopRec = $signup_details_list->StartRec + $signup_details_list->DisplayRecs - 1;
	else
		$signup_details_list->StopRec = $signup_details_list->TotalRecs;
}
$signup_details_list->RecCnt = $signup_details_list->StartRec - 1;
if ($signup_details_list->Recordset && !$signup_details_list->Recordset->EOF) {
	$signup_details_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $signup_details_list->StartRec > 1)
		$signup_details_list->Recordset->Move($signup_details_list->StartRec - 1);
} elseif (!$signup_details->AllowAddDeleteRow && $signup_details_list->StopRec == 0) {
	$signup_details_list->StopRec = $signup_details->GridAddRowCount;
}

// Initialize aggregate
$signup_details->RowType = EW_ROWTYPE_AGGREGATEINIT;
$signup_details->ResetAttrs();
$signup_details_list->RenderRow();
$signup_details_list->RowCnt = 0;
while ($signup_details_list->RecCnt < $signup_details_list->StopRec) {
	$signup_details_list->RecCnt++;
	if (intval($signup_details_list->RecCnt) >= intval($signup_details_list->StartRec)) {
		$signup_details_list->RowCnt++;

		// Set up key count
		$signup_details_list->KeyCount = $signup_details_list->RowIndex;

		// Init row class and style
		$signup_details->ResetAttrs();
		$signup_details->CssClass = "";
		$signup_details->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($signup_details_list->RowIndex))
			$signup_details->RowAttrs = array_merge($signup_details->RowAttrs, array('data-rowindex'=>$signup_details_list->RowIndex, 'id'=>'r' . $signup_details_list->RowIndex . '_signup_details'));
		if ($signup_details->CurrentAction == "gridadd") {
			$signup_details_list->LoadDefaultValues(); // Load default values
		} else {
			$signup_details_list->LoadRowValues($signup_details_list->Recordset); // Load row values
		}
		$signup_details->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$signup_details_list->RenderRow();

		// Render list options
		$signup_details_list->RenderListOptions();
?>
	<tr<?php echo $signup_details->RowAttributes() ?>>
<?php

// Render list options (body, left)
$signup_details_list->ListOptions->Render("body", "left");
?>
	<?php if ($signup_details->reg_id->Visible) { // reg_id ?>
		<td<?php echo $signup_details->reg_id->CellAttributes() ?>>
<div<?php echo $signup_details->reg_id->ViewAttributes() ?>><?php echo $signup_details->reg_id->ListViewValue() ?></div>
<a name="<?php echo $signup_details_list->PageObjName . "_row_" . $signup_details_list->RowCnt ?>" id="<?php echo $signup_details_list->PageObjName . "_row_" . $signup_details_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($signup_details->firstname->Visible) { // firstname ?>
		<td<?php echo $signup_details->firstname->CellAttributes() ?>>
<div<?php echo $signup_details->firstname->ViewAttributes() ?>><?php echo $signup_details->firstname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signup_details->lastname->Visible) { // lastname ?>
		<td<?php echo $signup_details->lastname->CellAttributes() ?>>
<div<?php echo $signup_details->lastname->ViewAttributes() ?>><?php echo $signup_details->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signup_details->contactno->Visible) { // contactno ?>
		<td<?php echo $signup_details->contactno->CellAttributes() ?>>
<div<?php echo $signup_details->contactno->ViewAttributes() ?>><?php echo $signup_details->contactno->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signup_details->gender->Visible) { // gender ?>
		<td<?php echo $signup_details->gender->CellAttributes() ?>>
<div<?php echo $signup_details->gender->ViewAttributes() ?>><?php echo $signup_details->gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signup_details->bio->Visible) { // bio ?>
		<td<?php echo $signup_details->bio->CellAttributes() ?>>
<div<?php echo $signup_details->bio->ViewAttributes() ?>><?php echo $signup_details->bio->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signup_details->date->Visible) { // date ?>
		<td<?php echo $signup_details->date->CellAttributes() ?>>
<div<?php echo $signup_details->date->ViewAttributes() ?>><?php echo $signup_details->date->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$signup_details_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($signup_details->CurrentAction <> "gridadd")
		$signup_details_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($signup_details_list->Recordset)
	$signup_details_list->Recordset->Close();
?>
<?php if ($signup_details->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($signup_details->CurrentAction <> "gridadd" && $signup_details->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($signup_details_list->Pager)) $signup_details_list->Pager = new cPrevNextPager($signup_details_list->StartRec, $signup_details_list->DisplayRecs, $signup_details_list->TotalRecs) ?>
<?php if ($signup_details_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($signup_details_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $signup_details_list->PageUrl() ?>start=<?php echo $signup_details_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($signup_details_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $signup_details_list->PageUrl() ?>start=<?php echo $signup_details_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $signup_details_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($signup_details_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $signup_details_list->PageUrl() ?>start=<?php echo $signup_details_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($signup_details_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $signup_details_list->PageUrl() ?>start=<?php echo $signup_details_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $signup_details_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $signup_details_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $signup_details_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $signup_details_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($signup_details_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $signup_details_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($signup_details->Export == "" && $signup_details->CurrentAction == "") { ?>
<?php } ?>
<?php
$signup_details_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($signup_details->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$signup_details_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csignup_details_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'signup_details';

	// Page object name
	var $PageObjName = 'signup_details_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $signup_details;
		if ($signup_details->UseTokenInUrl) $PageUrl .= "t=" . $signup_details->TableVar . "&"; // Add page token
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
		global $objForm, $signup_details;
		if ($signup_details->UseTokenInUrl) {
			if ($objForm)
				return ($signup_details->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($signup_details->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csignup_details_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (signup_details)
		if (!isset($GLOBALS["signup_details"])) {
			$GLOBALS["signup_details"] = new csignup_details();
			$GLOBALS["Table"] =& $GLOBALS["signup_details"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "signup_detailsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "signup_detailsdelete.php";
		$this->MultiUpdateUrl = "signup_detailsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'signup_details', TRUE);

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
		global $signup_details;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$signup_details->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $signup_details;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($signup_details->Export <> "" ||
				$signup_details->CurrentAction == "gridadd" ||
				$signup_details->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$signup_details->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($signup_details->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $signup_details->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$signup_details->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$signup_details->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$signup_details->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $signup_details->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$signup_details->setSessionWhere($sFilter);
		$signup_details->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $signup_details;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $signup_details->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signup_details->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signup_details->gender, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signup_details->bio, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signup_details->date, $Keyword);
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
		global $Security, $signup_details;
		$sSearchStr = "";
		$sSearchKeyword = $signup_details->BasicSearchKeyword;
		$sSearchType = $signup_details->BasicSearchType;
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
			$signup_details->setSessionBasicSearchKeyword($sSearchKeyword);
			$signup_details->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $signup_details;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$signup_details->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $signup_details;
		$signup_details->setSessionBasicSearchKeyword("");
		$signup_details->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $signup_details;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$signup_details->BasicSearchKeyword = $signup_details->getSessionBasicSearchKeyword();
			$signup_details->BasicSearchType = $signup_details->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $signup_details;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$signup_details->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$signup_details->CurrentOrderType = @$_GET["ordertype"];
			$signup_details->UpdateSort($signup_details->reg_id); // reg_id
			$signup_details->UpdateSort($signup_details->firstname); // firstname
			$signup_details->UpdateSort($signup_details->lastname); // lastname
			$signup_details->UpdateSort($signup_details->contactno); // contactno
			$signup_details->UpdateSort($signup_details->gender); // gender
			$signup_details->UpdateSort($signup_details->bio); // bio
			$signup_details->UpdateSort($signup_details->date); // date
			$signup_details->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $signup_details;
		$sOrderBy = $signup_details->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($signup_details->SqlOrderBy() <> "") {
				$sOrderBy = $signup_details->SqlOrderBy();
				$signup_details->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $signup_details;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$signup_details->setSessionOrderBy($sOrderBy);
				$signup_details->reg_id->setSort("");
				$signup_details->firstname->setSort("");
				$signup_details->lastname->setSort("");
				$signup_details->contactno->setSort("");
				$signup_details->gender->setSort("");
				$signup_details->bio->setSort("");
				$signup_details->date->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$signup_details->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $signup_details;

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
		global $Security, $Language, $signup_details, $objForm;
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
		global $Security, $Language, $signup_details;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $signup_details;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$signup_details->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$signup_details->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $signup_details->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$signup_details->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$signup_details->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$signup_details->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $signup_details;
		$signup_details->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$signup_details->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $signup_details;

		// Call Recordset Selecting event
		$signup_details->Recordset_Selecting($signup_details->CurrentFilter);

		// Load List page SQL
		$sSql = $signup_details->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$signup_details->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $signup_details;
		$sFilter = $signup_details->KeyFilter();

		// Call Row Selecting event
		$signup_details->Row_Selecting($sFilter);

		// Load SQL based on filter
		$signup_details->CurrentFilter = $sFilter;
		$sSql = $signup_details->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$signup_details->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $signup_details;
		if (!$rs || $rs->EOF) return;
		$signup_details->reg_id->setDbValue($rs->fields('reg_id'));
		$signup_details->firstname->setDbValue($rs->fields('firstname'));
		$signup_details->lastname->setDbValue($rs->fields('lastname'));
		$signup_details->contactno->setDbValue($rs->fields('contactno'));
		$signup_details->gender->setDbValue($rs->fields('gender'));
		$signup_details->bio->setDbValue($rs->fields('bio'));
		$signup_details->date->setDbValue($rs->fields('date'));
	}

	// Load old record
	function LoadOldRecord() {
		global $signup_details;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($signup_details->getKey("contactno")) <> "")
			$signup_details->contactno->CurrentValue = $signup_details->getKey("contactno"); // contactno
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$signup_details->CurrentFilter = $signup_details->KeyFilter();
			$sSql = $signup_details->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $signup_details;

		// Initialize URLs
		$this->ViewUrl = $signup_details->ViewUrl();
		$this->EditUrl = $signup_details->EditUrl();
		$this->InlineEditUrl = $signup_details->InlineEditUrl();
		$this->CopyUrl = $signup_details->CopyUrl();
		$this->InlineCopyUrl = $signup_details->InlineCopyUrl();
		$this->DeleteUrl = $signup_details->DeleteUrl();

		// Call Row_Rendering event
		$signup_details->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// firstname
		// lastname
		// contactno
		// gender
		// bio
		// date

		if ($signup_details->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$signup_details->reg_id->ViewValue = $signup_details->reg_id->CurrentValue;
			$signup_details->reg_id->ViewCustomAttributes = "";

			// firstname
			$signup_details->firstname->ViewValue = $signup_details->firstname->CurrentValue;
			$signup_details->firstname->ViewCustomAttributes = "";

			// lastname
			$signup_details->lastname->ViewValue = $signup_details->lastname->CurrentValue;
			$signup_details->lastname->ViewCustomAttributes = "";

			// contactno
			$signup_details->contactno->ViewValue = $signup_details->contactno->CurrentValue;
			$signup_details->contactno->ViewCustomAttributes = "";

			// gender
			$signup_details->gender->ViewValue = $signup_details->gender->CurrentValue;
			$signup_details->gender->ViewCustomAttributes = "";

			// bio
			$signup_details->bio->ViewValue = $signup_details->bio->CurrentValue;
			$signup_details->bio->ViewCustomAttributes = "";

			// date
			$signup_details->date->ViewValue = $signup_details->date->CurrentValue;
			$signup_details->date->ViewCustomAttributes = "";

			// reg_id
			$signup_details->reg_id->LinkCustomAttributes = "";
			$signup_details->reg_id->HrefValue = "";
			$signup_details->reg_id->TooltipValue = "";

			// firstname
			$signup_details->firstname->LinkCustomAttributes = "";
			$signup_details->firstname->HrefValue = "";
			$signup_details->firstname->TooltipValue = "";

			// lastname
			$signup_details->lastname->LinkCustomAttributes = "";
			$signup_details->lastname->HrefValue = "";
			$signup_details->lastname->TooltipValue = "";

			// contactno
			$signup_details->contactno->LinkCustomAttributes = "";
			$signup_details->contactno->HrefValue = "";
			$signup_details->contactno->TooltipValue = "";

			// gender
			$signup_details->gender->LinkCustomAttributes = "";
			$signup_details->gender->HrefValue = "";
			$signup_details->gender->TooltipValue = "";

			// bio
			$signup_details->bio->LinkCustomAttributes = "";
			$signup_details->bio->HrefValue = "";
			$signup_details->bio->TooltipValue = "";

			// date
			$signup_details->date->LinkCustomAttributes = "";
			$signup_details->date->HrefValue = "";
			$signup_details->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($signup_details->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$signup_details->Row_Rendered();
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
