<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "member_signupinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$member_signup_list = new cmember_signup_list();
$Page =& $member_signup_list;

// Page init
$member_signup_list->Page_Init();

// Page main
$member_signup_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($member_signup->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var member_signup_list = new ew_Page("member_signup_list");

// page properties
member_signup_list.PageID = "list"; // page ID
member_signup_list.FormID = "fmember_signuplist"; // form ID
var EW_PAGE_ID = member_signup_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
member_signup_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
member_signup_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
member_signup_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($member_signup->Export == "") || (EW_EXPORT_MASTER_RECORD && $member_signup->Export == "print")) { ?>
<?php } ?>
<?php $member_signup_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$member_signup_list->TotalRecs = $member_signup->SelectRecordCount();
	} else {
		if ($member_signup_list->Recordset = $member_signup_list->LoadRecordset())
			$member_signup_list->TotalRecs = $member_signup_list->Recordset->RecordCount();
	}
	$member_signup_list->StartRec = 1;
	if ($member_signup_list->DisplayRecs <= 0 || ($member_signup->Export <> "" && $member_signup->ExportAll)) // Display all records
		$member_signup_list->DisplayRecs = $member_signup_list->TotalRecs;
	if (!($member_signup->Export <> "" && $member_signup->ExportAll))
		$member_signup_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$member_signup_list->Recordset = $member_signup_list->LoadRecordset($member_signup_list->StartRec-1, $member_signup_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $member_signup->TableCaption() ?>
&nbsp;&nbsp;<?php $member_signup_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($member_signup->Export == "" && $member_signup->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(member_signup_list);" style="text-decoration: none;"><img id="member_signup_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="member_signup_list_SearchPanel">
<form name="fmember_signuplistsrch" id="fmember_signuplistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="member_signup">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($member_signup->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $member_signup_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($member_signup->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($member_signup->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($member_signup->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$member_signup_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmember_signuplist" id="fmember_signuplist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="member_signup">
<div id="gmp_member_signup" class="ewGridMiddlePanel">
<?php if ($member_signup_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $member_signup->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$member_signup_list->RenderListOptions();

// Render list options (header, left)
$member_signup_list->ListOptions->Render("header", "left");
?>
<?php if ($member_signup->reg_id->Visible) { // reg_id ?>
	<?php if ($member_signup->SortUrl($member_signup->reg_id) == "") { ?>
		<td><?php echo $member_signup->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($member_signup->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member_signup->category->Visible) { // category ?>
	<?php if ($member_signup->SortUrl($member_signup->category) == "") { ?>
		<td><?php echo $member_signup->category->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->category) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->category->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member_signup->category->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->category->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member_signup->product->Visible) { // product ?>
	<?php if ($member_signup->SortUrl($member_signup->product) == "") { ?>
		<td><?php echo $member_signup->product->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->product) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->product->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member_signup->product->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->product->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member_signup->seats->Visible) { // seats ?>
	<?php if ($member_signup->SortUrl($member_signup->seats) == "") { ?>
		<td><?php echo $member_signup->seats->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->seats) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->seats->FldCaption() ?></td><td style="width: 10px;"><?php if ($member_signup->seats->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->seats->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member_signup->ac->Visible) { // ac ?>
	<?php if ($member_signup->SortUrl($member_signup->ac) == "") { ?>
		<td><?php echo $member_signup->ac->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->ac) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->ac->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member_signup->ac->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->ac->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($member_signup->colour->Visible) { // colour ?>
	<?php if ($member_signup->SortUrl($member_signup->colour) == "") { ?>
		<td><?php echo $member_signup->colour->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $member_signup->SortUrl($member_signup->colour) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $member_signup->colour->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($member_signup->colour->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($member_signup->colour->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$member_signup_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($member_signup->ExportAll && $member_signup->Export <> "") {
	$member_signup_list->StopRec = $member_signup_list->TotalRecs;
} else {

	// Set the last record to display
	if ($member_signup_list->TotalRecs > $member_signup_list->StartRec + $member_signup_list->DisplayRecs - 1)
		$member_signup_list->StopRec = $member_signup_list->StartRec + $member_signup_list->DisplayRecs - 1;
	else
		$member_signup_list->StopRec = $member_signup_list->TotalRecs;
}
$member_signup_list->RecCnt = $member_signup_list->StartRec - 1;
if ($member_signup_list->Recordset && !$member_signup_list->Recordset->EOF) {
	$member_signup_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $member_signup_list->StartRec > 1)
		$member_signup_list->Recordset->Move($member_signup_list->StartRec - 1);
} elseif (!$member_signup->AllowAddDeleteRow && $member_signup_list->StopRec == 0) {
	$member_signup_list->StopRec = $member_signup->GridAddRowCount;
}

// Initialize aggregate
$member_signup->RowType = EW_ROWTYPE_AGGREGATEINIT;
$member_signup->ResetAttrs();
$member_signup_list->RenderRow();
$member_signup_list->RowCnt = 0;
while ($member_signup_list->RecCnt < $member_signup_list->StopRec) {
	$member_signup_list->RecCnt++;
	if (intval($member_signup_list->RecCnt) >= intval($member_signup_list->StartRec)) {
		$member_signup_list->RowCnt++;

		// Set up key count
		$member_signup_list->KeyCount = $member_signup_list->RowIndex;

		// Init row class and style
		$member_signup->ResetAttrs();
		$member_signup->CssClass = "";
		$member_signup->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($member_signup_list->RowIndex))
			$member_signup->RowAttrs = array_merge($member_signup->RowAttrs, array('data-rowindex'=>$member_signup_list->RowIndex, 'id'=>'r' . $member_signup_list->RowIndex . '_member_signup'));
		if ($member_signup->CurrentAction == "gridadd") {
			$member_signup_list->LoadDefaultValues(); // Load default values
		} else {
			$member_signup_list->LoadRowValues($member_signup_list->Recordset); // Load row values
		}
		$member_signup->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$member_signup_list->RenderRow();

		// Render list options
		$member_signup_list->RenderListOptions();
?>
	<tr<?php echo $member_signup->RowAttributes() ?>>
<?php

// Render list options (body, left)
$member_signup_list->ListOptions->Render("body", "left");
?>
	<?php if ($member_signup->reg_id->Visible) { // reg_id ?>
		<td<?php echo $member_signup->reg_id->CellAttributes() ?>>
<div<?php echo $member_signup->reg_id->ViewAttributes() ?>><?php echo $member_signup->reg_id->ListViewValue() ?></div>
<a name="<?php echo $member_signup_list->PageObjName . "_row_" . $member_signup_list->RowCnt ?>" id="<?php echo $member_signup_list->PageObjName . "_row_" . $member_signup_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($member_signup->category->Visible) { // category ?>
		<td<?php echo $member_signup->category->CellAttributes() ?>>
<div<?php echo $member_signup->category->ViewAttributes() ?>><?php echo $member_signup->category->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member_signup->product->Visible) { // product ?>
		<td<?php echo $member_signup->product->CellAttributes() ?>>
<div<?php echo $member_signup->product->ViewAttributes() ?>><?php echo $member_signup->product->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member_signup->seats->Visible) { // seats ?>
		<td<?php echo $member_signup->seats->CellAttributes() ?>>
<div<?php echo $member_signup->seats->ViewAttributes() ?>><?php echo $member_signup->seats->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member_signup->ac->Visible) { // ac ?>
		<td<?php echo $member_signup->ac->CellAttributes() ?>>
<div<?php echo $member_signup->ac->ViewAttributes() ?>><?php echo $member_signup->ac->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($member_signup->colour->Visible) { // colour ?>
		<td<?php echo $member_signup->colour->CellAttributes() ?>>
<div<?php echo $member_signup->colour->ViewAttributes() ?>><?php echo $member_signup->colour->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$member_signup_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($member_signup->CurrentAction <> "gridadd")
		$member_signup_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($member_signup_list->Recordset)
	$member_signup_list->Recordset->Close();
?>
<?php if ($member_signup->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($member_signup->CurrentAction <> "gridadd" && $member_signup->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($member_signup_list->Pager)) $member_signup_list->Pager = new cPrevNextPager($member_signup_list->StartRec, $member_signup_list->DisplayRecs, $member_signup_list->TotalRecs) ?>
<?php if ($member_signup_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($member_signup_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $member_signup_list->PageUrl() ?>start=<?php echo $member_signup_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($member_signup_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $member_signup_list->PageUrl() ?>start=<?php echo $member_signup_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $member_signup_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($member_signup_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $member_signup_list->PageUrl() ?>start=<?php echo $member_signup_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($member_signup_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $member_signup_list->PageUrl() ?>start=<?php echo $member_signup_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $member_signup_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $member_signup_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $member_signup_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $member_signup_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($member_signup_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $member_signup_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($member_signup->Export == "" && $member_signup->CurrentAction == "") { ?>
<?php } ?>
<?php
$member_signup_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($member_signup->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$member_signup_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmember_signup_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'member_signup';

	// Page object name
	var $PageObjName = 'member_signup_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $member_signup;
		if ($member_signup->UseTokenInUrl) $PageUrl .= "t=" . $member_signup->TableVar . "&"; // Add page token
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
		global $objForm, $member_signup;
		if ($member_signup->UseTokenInUrl) {
			if ($objForm)
				return ($member_signup->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($member_signup->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmember_signup_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (member_signup)
		if (!isset($GLOBALS["member_signup"])) {
			$GLOBALS["member_signup"] = new cmember_signup();
			$GLOBALS["Table"] =& $GLOBALS["member_signup"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "member_signupadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "member_signupdelete.php";
		$this->MultiUpdateUrl = "member_signupupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'member_signup', TRUE);

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
		global $member_signup;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$member_signup->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $member_signup;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($member_signup->Export <> "" ||
				$member_signup->CurrentAction == "gridadd" ||
				$member_signup->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$member_signup->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($member_signup->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $member_signup->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$member_signup->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$member_signup->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$member_signup->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $member_signup->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$member_signup->setSessionWhere($sFilter);
		$member_signup->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $member_signup;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $member_signup->category, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member_signup->product, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member_signup->ac, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $member_signup->colour, $Keyword);
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
		global $Security, $member_signup;
		$sSearchStr = "";
		$sSearchKeyword = $member_signup->BasicSearchKeyword;
		$sSearchType = $member_signup->BasicSearchType;
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
			$member_signup->setSessionBasicSearchKeyword($sSearchKeyword);
			$member_signup->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $member_signup;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$member_signup->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $member_signup;
		$member_signup->setSessionBasicSearchKeyword("");
		$member_signup->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $member_signup;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$member_signup->BasicSearchKeyword = $member_signup->getSessionBasicSearchKeyword();
			$member_signup->BasicSearchType = $member_signup->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $member_signup;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$member_signup->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$member_signup->CurrentOrderType = @$_GET["ordertype"];
			$member_signup->UpdateSort($member_signup->reg_id); // reg_id
			$member_signup->UpdateSort($member_signup->category); // category
			$member_signup->UpdateSort($member_signup->product); // product
			$member_signup->UpdateSort($member_signup->seats); // seats
			$member_signup->UpdateSort($member_signup->ac); // ac
			$member_signup->UpdateSort($member_signup->colour); // colour
			$member_signup->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $member_signup;
		$sOrderBy = $member_signup->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($member_signup->SqlOrderBy() <> "") {
				$sOrderBy = $member_signup->SqlOrderBy();
				$member_signup->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $member_signup;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$member_signup->setSessionOrderBy($sOrderBy);
				$member_signup->reg_id->setSort("");
				$member_signup->category->setSort("");
				$member_signup->product->setSort("");
				$member_signup->seats->setSort("");
				$member_signup->ac->setSort("");
				$member_signup->colour->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$member_signup->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $member_signup;

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
		global $Security, $Language, $member_signup, $objForm;
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
		global $Security, $Language, $member_signup;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $member_signup;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$member_signup->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$member_signup->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $member_signup->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$member_signup->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$member_signup->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$member_signup->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $member_signup;
		$member_signup->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$member_signup->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $member_signup;

		// Call Recordset Selecting event
		$member_signup->Recordset_Selecting($member_signup->CurrentFilter);

		// Load List page SQL
		$sSql = $member_signup->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$member_signup->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $member_signup;
		$sFilter = $member_signup->KeyFilter();

		// Call Row Selecting event
		$member_signup->Row_Selecting($sFilter);

		// Load SQL based on filter
		$member_signup->CurrentFilter = $sFilter;
		$sSql = $member_signup->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$member_signup->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $member_signup;
		if (!$rs || $rs->EOF) return;
		$member_signup->reg_id->setDbValue($rs->fields('reg_id'));
		$member_signup->category->setDbValue($rs->fields('category'));
		$member_signup->product->setDbValue($rs->fields('product'));
		$member_signup->seats->setDbValue($rs->fields('seats'));
		$member_signup->ac->setDbValue($rs->fields('ac'));
		$member_signup->colour->setDbValue($rs->fields('colour'));
	}

	// Load old record
	function LoadOldRecord() {
		global $member_signup;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($member_signup->getKey("reg_id")) <> "")
			$member_signup->reg_id->CurrentValue = $member_signup->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$member_signup->CurrentFilter = $member_signup->KeyFilter();
			$sSql = $member_signup->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $member_signup;

		// Initialize URLs
		$this->ViewUrl = $member_signup->ViewUrl();
		$this->EditUrl = $member_signup->EditUrl();
		$this->InlineEditUrl = $member_signup->InlineEditUrl();
		$this->CopyUrl = $member_signup->CopyUrl();
		$this->InlineCopyUrl = $member_signup->InlineCopyUrl();
		$this->DeleteUrl = $member_signup->DeleteUrl();

		// Call Row_Rendering event
		$member_signup->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// category
		// product
		// seats
		// ac
		// colour

		if ($member_signup->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$member_signup->reg_id->ViewValue = $member_signup->reg_id->CurrentValue;
			$member_signup->reg_id->ViewCustomAttributes = "";

			// category
			$member_signup->category->ViewValue = $member_signup->category->CurrentValue;
			$member_signup->category->ViewCustomAttributes = "";

			// product
			$member_signup->product->ViewValue = $member_signup->product->CurrentValue;
			$member_signup->product->ViewCustomAttributes = "";

			// seats
			$member_signup->seats->ViewValue = $member_signup->seats->CurrentValue;
			$member_signup->seats->ViewCustomAttributes = "";

			// ac
			$member_signup->ac->ViewValue = $member_signup->ac->CurrentValue;
			$member_signup->ac->ViewCustomAttributes = "";

			// colour
			$member_signup->colour->ViewValue = $member_signup->colour->CurrentValue;
			$member_signup->colour->ViewCustomAttributes = "";

			// reg_id
			$member_signup->reg_id->LinkCustomAttributes = "";
			$member_signup->reg_id->HrefValue = "";
			$member_signup->reg_id->TooltipValue = "";

			// category
			$member_signup->category->LinkCustomAttributes = "";
			$member_signup->category->HrefValue = "";
			$member_signup->category->TooltipValue = "";

			// product
			$member_signup->product->LinkCustomAttributes = "";
			$member_signup->product->HrefValue = "";
			$member_signup->product->TooltipValue = "";

			// seats
			$member_signup->seats->LinkCustomAttributes = "";
			$member_signup->seats->HrefValue = "";
			$member_signup->seats->TooltipValue = "";

			// ac
			$member_signup->ac->LinkCustomAttributes = "";
			$member_signup->ac->HrefValue = "";
			$member_signup->ac->TooltipValue = "";

			// colour
			$member_signup->colour->LinkCustomAttributes = "";
			$member_signup->colour->HrefValue = "";
			$member_signup->colour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($member_signup->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$member_signup->Row_Rendered();
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
