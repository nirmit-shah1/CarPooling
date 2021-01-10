<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "personalinfoinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$personalinfo_list = new cpersonalinfo_list();
$Page =& $personalinfo_list;

// Page init
$personalinfo_list->Page_Init();

// Page main
$personalinfo_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($personalinfo->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var personalinfo_list = new ew_Page("personalinfo_list");

// page properties
personalinfo_list.PageID = "list"; // page ID
personalinfo_list.FormID = "fpersonalinfolist"; // form ID
var EW_PAGE_ID = personalinfo_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
personalinfo_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
personalinfo_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
personalinfo_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($personalinfo->Export == "") || (EW_EXPORT_MASTER_RECORD && $personalinfo->Export == "print")) { ?>
<?php } ?>
<?php $personalinfo_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$personalinfo_list->TotalRecs = $personalinfo->SelectRecordCount();
	} else {
		if ($personalinfo_list->Recordset = $personalinfo_list->LoadRecordset())
			$personalinfo_list->TotalRecs = $personalinfo_list->Recordset->RecordCount();
	}
	$personalinfo_list->StartRec = 1;
	if ($personalinfo_list->DisplayRecs <= 0 || ($personalinfo->Export <> "" && $personalinfo->ExportAll)) // Display all records
		$personalinfo_list->DisplayRecs = $personalinfo_list->TotalRecs;
	if (!($personalinfo->Export <> "" && $personalinfo->ExportAll))
		$personalinfo_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$personalinfo_list->Recordset = $personalinfo_list->LoadRecordset($personalinfo_list->StartRec-1, $personalinfo_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $personalinfo->TableCaption() ?>
&nbsp;&nbsp;<?php $personalinfo_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($personalinfo->Export == "" && $personalinfo->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(personalinfo_list);" style="text-decoration: none;"><img id="personalinfo_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="personalinfo_list_SearchPanel">
<form name="fpersonalinfolistsrch" id="fpersonalinfolistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="personalinfo">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($personalinfo->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $personalinfo_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($personalinfo->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($personalinfo->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($personalinfo->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$personalinfo_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpersonalinfolist" id="fpersonalinfolist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="personalinfo">
<div id="gmp_personalinfo" class="ewGridMiddlePanel">
<?php if ($personalinfo_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $personalinfo->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$personalinfo_list->RenderListOptions();

// Render list options (header, left)
$personalinfo_list->ListOptions->Render("header", "left");
?>
<?php if ($personalinfo->firstname->Visible) { // firstname ?>
	<?php if ($personalinfo->SortUrl($personalinfo->firstname) == "") { ?>
		<td><?php echo $personalinfo->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $personalinfo->SortUrl($personalinfo->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $personalinfo->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($personalinfo->firstname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($personalinfo->firstname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($personalinfo->lastname->Visible) { // lastname ?>
	<?php if ($personalinfo->SortUrl($personalinfo->lastname) == "") { ?>
		<td><?php echo $personalinfo->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $personalinfo->SortUrl($personalinfo->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $personalinfo->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($personalinfo->lastname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($personalinfo->lastname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($personalinfo->postalcode->Visible) { // postalcode ?>
	<?php if ($personalinfo->SortUrl($personalinfo->postalcode) == "") { ?>
		<td><?php echo $personalinfo->postalcode->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $personalinfo->SortUrl($personalinfo->postalcode) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $personalinfo->postalcode->FldCaption() ?></td><td style="width: 10px;"><?php if ($personalinfo->postalcode->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($personalinfo->postalcode->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($personalinfo->state->Visible) { // state ?>
	<?php if ($personalinfo->SortUrl($personalinfo->state) == "") { ?>
		<td><?php echo $personalinfo->state->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $personalinfo->SortUrl($personalinfo->state) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $personalinfo->state->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($personalinfo->state->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($personalinfo->state->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($personalinfo->city->Visible) { // city ?>
	<?php if ($personalinfo->SortUrl($personalinfo->city) == "") { ?>
		<td><?php echo $personalinfo->city->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $personalinfo->SortUrl($personalinfo->city) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $personalinfo->city->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($personalinfo->city->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($personalinfo->city->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$personalinfo_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($personalinfo->ExportAll && $personalinfo->Export <> "") {
	$personalinfo_list->StopRec = $personalinfo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($personalinfo_list->TotalRecs > $personalinfo_list->StartRec + $personalinfo_list->DisplayRecs - 1)
		$personalinfo_list->StopRec = $personalinfo_list->StartRec + $personalinfo_list->DisplayRecs - 1;
	else
		$personalinfo_list->StopRec = $personalinfo_list->TotalRecs;
}
$personalinfo_list->RecCnt = $personalinfo_list->StartRec - 1;
if ($personalinfo_list->Recordset && !$personalinfo_list->Recordset->EOF) {
	$personalinfo_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $personalinfo_list->StartRec > 1)
		$personalinfo_list->Recordset->Move($personalinfo_list->StartRec - 1);
} elseif (!$personalinfo->AllowAddDeleteRow && $personalinfo_list->StopRec == 0) {
	$personalinfo_list->StopRec = $personalinfo->GridAddRowCount;
}

// Initialize aggregate
$personalinfo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$personalinfo->ResetAttrs();
$personalinfo_list->RenderRow();
$personalinfo_list->RowCnt = 0;
while ($personalinfo_list->RecCnt < $personalinfo_list->StopRec) {
	$personalinfo_list->RecCnt++;
	if (intval($personalinfo_list->RecCnt) >= intval($personalinfo_list->StartRec)) {
		$personalinfo_list->RowCnt++;

		// Set up key count
		$personalinfo_list->KeyCount = $personalinfo_list->RowIndex;

		// Init row class and style
		$personalinfo->ResetAttrs();
		$personalinfo->CssClass = "";
		$personalinfo->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($personalinfo_list->RowIndex))
			$personalinfo->RowAttrs = array_merge($personalinfo->RowAttrs, array('data-rowindex'=>$personalinfo_list->RowIndex, 'id'=>'r' . $personalinfo_list->RowIndex . '_personalinfo'));
		if ($personalinfo->CurrentAction == "gridadd") {
			$personalinfo_list->LoadDefaultValues(); // Load default values
		} else {
			$personalinfo_list->LoadRowValues($personalinfo_list->Recordset); // Load row values
		}
		$personalinfo->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$personalinfo_list->RenderRow();

		// Render list options
		$personalinfo_list->RenderListOptions();
?>
	<tr<?php echo $personalinfo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$personalinfo_list->ListOptions->Render("body", "left");
?>
	<?php if ($personalinfo->firstname->Visible) { // firstname ?>
		<td<?php echo $personalinfo->firstname->CellAttributes() ?>>
<div<?php echo $personalinfo->firstname->ViewAttributes() ?>><?php echo $personalinfo->firstname->ListViewValue() ?></div>
<a name="<?php echo $personalinfo_list->PageObjName . "_row_" . $personalinfo_list->RowCnt ?>" id="<?php echo $personalinfo_list->PageObjName . "_row_" . $personalinfo_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($personalinfo->lastname->Visible) { // lastname ?>
		<td<?php echo $personalinfo->lastname->CellAttributes() ?>>
<div<?php echo $personalinfo->lastname->ViewAttributes() ?>><?php echo $personalinfo->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($personalinfo->postalcode->Visible) { // postalcode ?>
		<td<?php echo $personalinfo->postalcode->CellAttributes() ?>>
<div<?php echo $personalinfo->postalcode->ViewAttributes() ?>><?php echo $personalinfo->postalcode->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($personalinfo->state->Visible) { // state ?>
		<td<?php echo $personalinfo->state->CellAttributes() ?>>
<div<?php echo $personalinfo->state->ViewAttributes() ?>><?php echo $personalinfo->state->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($personalinfo->city->Visible) { // city ?>
		<td<?php echo $personalinfo->city->CellAttributes() ?>>
<div<?php echo $personalinfo->city->ViewAttributes() ?>><?php echo $personalinfo->city->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$personalinfo_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($personalinfo->CurrentAction <> "gridadd")
		$personalinfo_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($personalinfo_list->Recordset)
	$personalinfo_list->Recordset->Close();
?>
<?php if ($personalinfo->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($personalinfo->CurrentAction <> "gridadd" && $personalinfo->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($personalinfo_list->Pager)) $personalinfo_list->Pager = new cPrevNextPager($personalinfo_list->StartRec, $personalinfo_list->DisplayRecs, $personalinfo_list->TotalRecs) ?>
<?php if ($personalinfo_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($personalinfo_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $personalinfo_list->PageUrl() ?>start=<?php echo $personalinfo_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($personalinfo_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $personalinfo_list->PageUrl() ?>start=<?php echo $personalinfo_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $personalinfo_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($personalinfo_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $personalinfo_list->PageUrl() ?>start=<?php echo $personalinfo_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($personalinfo_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $personalinfo_list->PageUrl() ?>start=<?php echo $personalinfo_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $personalinfo_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $personalinfo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $personalinfo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $personalinfo_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($personalinfo_list->SearchWhere == "0=101") { ?>
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
<?php if ($personalinfo->Export == "" && $personalinfo->CurrentAction == "") { ?>
<?php } ?>
<?php
$personalinfo_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($personalinfo->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$personalinfo_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpersonalinfo_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'personalinfo';

	// Page object name
	var $PageObjName = 'personalinfo_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $personalinfo;
		if ($personalinfo->UseTokenInUrl) $PageUrl .= "t=" . $personalinfo->TableVar . "&"; // Add page token
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
		global $objForm, $personalinfo;
		if ($personalinfo->UseTokenInUrl) {
			if ($objForm)
				return ($personalinfo->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($personalinfo->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpersonalinfo_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (personalinfo)
		if (!isset($GLOBALS["personalinfo"])) {
			$GLOBALS["personalinfo"] = new cpersonalinfo();
			$GLOBALS["Table"] =& $GLOBALS["personalinfo"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "personalinfoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "personalinfodelete.php";
		$this->MultiUpdateUrl = "personalinfoupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'personalinfo', TRUE);

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
		global $personalinfo;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$personalinfo->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $personalinfo;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($personalinfo->Export <> "" ||
				$personalinfo->CurrentAction == "gridadd" ||
				$personalinfo->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$personalinfo->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($personalinfo->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $personalinfo->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$personalinfo->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$personalinfo->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$personalinfo->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $personalinfo->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$personalinfo->setSessionWhere($sFilter);
		$personalinfo->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $personalinfo;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->address1, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->address2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->state, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->city, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $personalinfo->name, $Keyword);
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
		global $Security, $personalinfo;
		$sSearchStr = "";
		$sSearchKeyword = $personalinfo->BasicSearchKeyword;
		$sSearchType = $personalinfo->BasicSearchType;
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
			$personalinfo->setSessionBasicSearchKeyword($sSearchKeyword);
			$personalinfo->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $personalinfo;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$personalinfo->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $personalinfo;
		$personalinfo->setSessionBasicSearchKeyword("");
		$personalinfo->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $personalinfo;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$personalinfo->BasicSearchKeyword = $personalinfo->getSessionBasicSearchKeyword();
			$personalinfo->BasicSearchType = $personalinfo->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $personalinfo;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$personalinfo->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$personalinfo->CurrentOrderType = @$_GET["ordertype"];
			$personalinfo->UpdateSort($personalinfo->firstname); // firstname
			$personalinfo->UpdateSort($personalinfo->lastname); // lastname
			$personalinfo->UpdateSort($personalinfo->postalcode); // postalcode
			$personalinfo->UpdateSort($personalinfo->state); // state
			$personalinfo->UpdateSort($personalinfo->city); // city
			$personalinfo->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $personalinfo;
		$sOrderBy = $personalinfo->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($personalinfo->SqlOrderBy() <> "") {
				$sOrderBy = $personalinfo->SqlOrderBy();
				$personalinfo->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $personalinfo;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$personalinfo->setSessionOrderBy($sOrderBy);
				$personalinfo->firstname->setSort("");
				$personalinfo->lastname->setSort("");
				$personalinfo->postalcode->setSort("");
				$personalinfo->state->setSort("");
				$personalinfo->city->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$personalinfo->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $personalinfo;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $personalinfo, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $personalinfo;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $personalinfo;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$personalinfo->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$personalinfo->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $personalinfo->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$personalinfo->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$personalinfo->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$personalinfo->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $personalinfo;
		$personalinfo->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$personalinfo->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $personalinfo;

		// Call Recordset Selecting event
		$personalinfo->Recordset_Selecting($personalinfo->CurrentFilter);

		// Load List page SQL
		$sSql = $personalinfo->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$personalinfo->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $personalinfo;
		$sFilter = $personalinfo->KeyFilter();

		// Call Row Selecting event
		$personalinfo->Row_Selecting($sFilter);

		// Load SQL based on filter
		$personalinfo->CurrentFilter = $sFilter;
		$sSql = $personalinfo->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$personalinfo->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $personalinfo;
		if (!$rs || $rs->EOF) return;
		$personalinfo->firstname->setDbValue($rs->fields('firstname'));
		$personalinfo->lastname->setDbValue($rs->fields('lastname'));
		$personalinfo->address1->setDbValue($rs->fields('address1'));
		$personalinfo->address2->setDbValue($rs->fields('address2'));
		$personalinfo->postalcode->setDbValue($rs->fields('postalcode'));
		$personalinfo->state->setDbValue($rs->fields('state'));
		$personalinfo->city->setDbValue($rs->fields('city'));
		$personalinfo->name->setDbValue($rs->fields('name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $personalinfo;

		// Load key values from Session
		$bValidKey = TRUE;

		// Load old recordset
		if ($bValidKey) {
			$personalinfo->CurrentFilter = $personalinfo->KeyFilter();
			$sSql = $personalinfo->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $personalinfo;

		// Initialize URLs
		$this->ViewUrl = $personalinfo->ViewUrl();
		$this->EditUrl = $personalinfo->EditUrl();
		$this->InlineEditUrl = $personalinfo->InlineEditUrl();
		$this->CopyUrl = $personalinfo->CopyUrl();
		$this->InlineCopyUrl = $personalinfo->InlineCopyUrl();
		$this->DeleteUrl = $personalinfo->DeleteUrl();

		// Call Row_Rendering event
		$personalinfo->Row_Rendering();

		// Common render codes for all row types
		// firstname
		// lastname
		// address1
		// address2
		// postalcode
		// state
		// city
		// name

		if ($personalinfo->RowType == EW_ROWTYPE_VIEW) { // View row

			// firstname
			$personalinfo->firstname->ViewValue = $personalinfo->firstname->CurrentValue;
			$personalinfo->firstname->ViewCustomAttributes = "";

			// lastname
			$personalinfo->lastname->ViewValue = $personalinfo->lastname->CurrentValue;
			$personalinfo->lastname->ViewCustomAttributes = "";

			// postalcode
			$personalinfo->postalcode->ViewValue = $personalinfo->postalcode->CurrentValue;
			$personalinfo->postalcode->ViewCustomAttributes = "";

			// state
			$personalinfo->state->ViewValue = $personalinfo->state->CurrentValue;
			$personalinfo->state->ViewCustomAttributes = "";

			// city
			$personalinfo->city->ViewValue = $personalinfo->city->CurrentValue;
			$personalinfo->city->ViewCustomAttributes = "";

			// firstname
			$personalinfo->firstname->LinkCustomAttributes = "";
			$personalinfo->firstname->HrefValue = "";
			$personalinfo->firstname->TooltipValue = "";

			// lastname
			$personalinfo->lastname->LinkCustomAttributes = "";
			$personalinfo->lastname->HrefValue = "";
			$personalinfo->lastname->TooltipValue = "";

			// postalcode
			$personalinfo->postalcode->LinkCustomAttributes = "";
			$personalinfo->postalcode->HrefValue = "";
			$personalinfo->postalcode->TooltipValue = "";

			// state
			$personalinfo->state->LinkCustomAttributes = "";
			$personalinfo->state->HrefValue = "";
			$personalinfo->state->TooltipValue = "";

			// city
			$personalinfo->city->LinkCustomAttributes = "";
			$personalinfo->city->HrefValue = "";
			$personalinfo->city->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($personalinfo->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$personalinfo->Row_Rendered();
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
