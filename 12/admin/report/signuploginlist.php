<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "signuplogininfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$signuplogin_list = new csignuplogin_list();
$Page =& $signuplogin_list;

// Page init
$signuplogin_list->Page_Init();

// Page main
$signuplogin_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($signuplogin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var signuplogin_list = new ew_Page("signuplogin_list");

// page properties
signuplogin_list.PageID = "list"; // page ID
signuplogin_list.FormID = "fsignuploginlist"; // form ID
var EW_PAGE_ID = signuplogin_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
signuplogin_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
signuplogin_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
signuplogin_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($signuplogin->Export == "") || (EW_EXPORT_MASTER_RECORD && $signuplogin->Export == "print")) { ?>
<?php } ?>
<?php $signuplogin_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$signuplogin_list->TotalRecs = $signuplogin->SelectRecordCount();
	} else {
		if ($signuplogin_list->Recordset = $signuplogin_list->LoadRecordset())
			$signuplogin_list->TotalRecs = $signuplogin_list->Recordset->RecordCount();
	}
	$signuplogin_list->StartRec = 1;
	if ($signuplogin_list->DisplayRecs <= 0 || ($signuplogin->Export <> "" && $signuplogin->ExportAll)) // Display all records
		$signuplogin_list->DisplayRecs = $signuplogin_list->TotalRecs;
	if (!($signuplogin->Export <> "" && $signuplogin->ExportAll))
		$signuplogin_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$signuplogin_list->Recordset = $signuplogin_list->LoadRecordset($signuplogin_list->StartRec-1, $signuplogin_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $signuplogin->TableCaption() ?>
&nbsp;&nbsp;<?php $signuplogin_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($signuplogin->Export == "" && $signuplogin->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(signuplogin_list);" style="text-decoration: none;"><img id="signuplogin_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="signuplogin_list_SearchPanel">
<form name="fsignuploginlistsrch" id="fsignuploginlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="signuplogin">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($signuplogin->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $signuplogin_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($signuplogin->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($signuplogin->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($signuplogin->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$signuplogin_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fsignuploginlist" id="fsignuploginlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="signuplogin">
<div id="gmp_signuplogin" class="ewGridMiddlePanel">
<?php if ($signuplogin_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $signuplogin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$signuplogin_list->RenderListOptions();

// Render list options (header, left)
$signuplogin_list->ListOptions->Render("header", "left");
?>
<?php if ($signuplogin->firstname->Visible) { // firstname ?>
	<?php if ($signuplogin->SortUrl($signuplogin->firstname) == "") { ?>
		<td><?php echo $signuplogin->firstname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signuplogin->SortUrl($signuplogin->firstname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signuplogin->firstname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signuplogin->firstname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signuplogin->firstname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signuplogin->lastname->Visible) { // lastname ?>
	<?php if ($signuplogin->SortUrl($signuplogin->lastname) == "") { ?>
		<td><?php echo $signuplogin->lastname->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signuplogin->SortUrl($signuplogin->lastname) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signuplogin->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signuplogin->lastname->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signuplogin->lastname->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signuplogin->gender->Visible) { // gender ?>
	<?php if ($signuplogin->SortUrl($signuplogin->gender) == "") { ?>
		<td><?php echo $signuplogin->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signuplogin->SortUrl($signuplogin->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signuplogin->gender->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signuplogin->gender->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signuplogin->gender->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signuplogin->password->Visible) { // password ?>
	<?php if ($signuplogin->SortUrl($signuplogin->password) == "") { ?>
		<td><?php echo $signuplogin->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signuplogin->SortUrl($signuplogin->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signuplogin->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signuplogin->password->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signuplogin->password->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($signuplogin->zemail->Visible) { // email ?>
	<?php if ($signuplogin->SortUrl($signuplogin->zemail) == "") { ?>
		<td><?php echo $signuplogin->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $signuplogin->SortUrl($signuplogin->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $signuplogin->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($signuplogin->zemail->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($signuplogin->zemail->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$signuplogin_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($signuplogin->ExportAll && $signuplogin->Export <> "") {
	$signuplogin_list->StopRec = $signuplogin_list->TotalRecs;
} else {

	// Set the last record to display
	if ($signuplogin_list->TotalRecs > $signuplogin_list->StartRec + $signuplogin_list->DisplayRecs - 1)
		$signuplogin_list->StopRec = $signuplogin_list->StartRec + $signuplogin_list->DisplayRecs - 1;
	else
		$signuplogin_list->StopRec = $signuplogin_list->TotalRecs;
}
$signuplogin_list->RecCnt = $signuplogin_list->StartRec - 1;
if ($signuplogin_list->Recordset && !$signuplogin_list->Recordset->EOF) {
	$signuplogin_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $signuplogin_list->StartRec > 1)
		$signuplogin_list->Recordset->Move($signuplogin_list->StartRec - 1);
} elseif (!$signuplogin->AllowAddDeleteRow && $signuplogin_list->StopRec == 0) {
	$signuplogin_list->StopRec = $signuplogin->GridAddRowCount;
}

// Initialize aggregate
$signuplogin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$signuplogin->ResetAttrs();
$signuplogin_list->RenderRow();
$signuplogin_list->RowCnt = 0;
while ($signuplogin_list->RecCnt < $signuplogin_list->StopRec) {
	$signuplogin_list->RecCnt++;
	if (intval($signuplogin_list->RecCnt) >= intval($signuplogin_list->StartRec)) {
		$signuplogin_list->RowCnt++;

		// Set up key count
		$signuplogin_list->KeyCount = $signuplogin_list->RowIndex;

		// Init row class and style
		$signuplogin->ResetAttrs();
		$signuplogin->CssClass = "";
		$signuplogin->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($signuplogin_list->RowIndex))
			$signuplogin->RowAttrs = array_merge($signuplogin->RowAttrs, array('data-rowindex'=>$signuplogin_list->RowIndex, 'id'=>'r' . $signuplogin_list->RowIndex . '_signuplogin'));
		if ($signuplogin->CurrentAction == "gridadd") {
			$signuplogin_list->LoadDefaultValues(); // Load default values
		} else {
			$signuplogin_list->LoadRowValues($signuplogin_list->Recordset); // Load row values
		}
		$signuplogin->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$signuplogin_list->RenderRow();

		// Render list options
		$signuplogin_list->RenderListOptions();
?>
	<tr<?php echo $signuplogin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$signuplogin_list->ListOptions->Render("body", "left");
?>
	<?php if ($signuplogin->firstname->Visible) { // firstname ?>
		<td<?php echo $signuplogin->firstname->CellAttributes() ?>>
<div<?php echo $signuplogin->firstname->ViewAttributes() ?>><?php echo $signuplogin->firstname->ListViewValue() ?></div>
<a name="<?php echo $signuplogin_list->PageObjName . "_row_" . $signuplogin_list->RowCnt ?>" id="<?php echo $signuplogin_list->PageObjName . "_row_" . $signuplogin_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($signuplogin->lastname->Visible) { // lastname ?>
		<td<?php echo $signuplogin->lastname->CellAttributes() ?>>
<div<?php echo $signuplogin->lastname->ViewAttributes() ?>><?php echo $signuplogin->lastname->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signuplogin->gender->Visible) { // gender ?>
		<td<?php echo $signuplogin->gender->CellAttributes() ?>>
<div<?php echo $signuplogin->gender->ViewAttributes() ?>><?php echo $signuplogin->gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signuplogin->password->Visible) { // password ?>
		<td<?php echo $signuplogin->password->CellAttributes() ?>>
<div<?php echo $signuplogin->password->ViewAttributes() ?>><?php echo $signuplogin->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($signuplogin->zemail->Visible) { // email ?>
		<td<?php echo $signuplogin->zemail->CellAttributes() ?>>
<div<?php echo $signuplogin->zemail->ViewAttributes() ?>><?php echo $signuplogin->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$signuplogin_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($signuplogin->CurrentAction <> "gridadd")
		$signuplogin_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($signuplogin_list->Recordset)
	$signuplogin_list->Recordset->Close();
?>
<?php if ($signuplogin->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($signuplogin->CurrentAction <> "gridadd" && $signuplogin->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($signuplogin_list->Pager)) $signuplogin_list->Pager = new cPrevNextPager($signuplogin_list->StartRec, $signuplogin_list->DisplayRecs, $signuplogin_list->TotalRecs) ?>
<?php if ($signuplogin_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($signuplogin_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $signuplogin_list->PageUrl() ?>start=<?php echo $signuplogin_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($signuplogin_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $signuplogin_list->PageUrl() ?>start=<?php echo $signuplogin_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $signuplogin_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($signuplogin_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $signuplogin_list->PageUrl() ?>start=<?php echo $signuplogin_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($signuplogin_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $signuplogin_list->PageUrl() ?>start=<?php echo $signuplogin_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $signuplogin_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $signuplogin_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $signuplogin_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $signuplogin_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($signuplogin_list->SearchWhere == "0=101") { ?>
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
<?php if ($signuplogin->Export == "" && $signuplogin->CurrentAction == "") { ?>
<?php } ?>
<?php
$signuplogin_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($signuplogin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$signuplogin_list->Page_Terminate();
?>
<?php

//
// Page class
//
class csignuplogin_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'signuplogin';

	// Page object name
	var $PageObjName = 'signuplogin_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $signuplogin;
		if ($signuplogin->UseTokenInUrl) $PageUrl .= "t=" . $signuplogin->TableVar . "&"; // Add page token
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
		global $objForm, $signuplogin;
		if ($signuplogin->UseTokenInUrl) {
			if ($objForm)
				return ($signuplogin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($signuplogin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csignuplogin_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (signuplogin)
		if (!isset($GLOBALS["signuplogin"])) {
			$GLOBALS["signuplogin"] = new csignuplogin();
			$GLOBALS["Table"] =& $GLOBALS["signuplogin"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "signuploginadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "signuplogindelete.php";
		$this->MultiUpdateUrl = "signuploginupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'signuplogin', TRUE);

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
		global $signuplogin;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$signuplogin->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $signuplogin;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($signuplogin->Export <> "" ||
				$signuplogin->CurrentAction == "gridadd" ||
				$signuplogin->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$signuplogin->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($signuplogin->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $signuplogin->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$signuplogin->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$signuplogin->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$signuplogin->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $signuplogin->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$signuplogin->setSessionWhere($sFilter);
		$signuplogin->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $signuplogin;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $signuplogin->firstname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signuplogin->lastname, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signuplogin->gender, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signuplogin->password, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $signuplogin->zemail, $Keyword);
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
		global $Security, $signuplogin;
		$sSearchStr = "";
		$sSearchKeyword = $signuplogin->BasicSearchKeyword;
		$sSearchType = $signuplogin->BasicSearchType;
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
			$signuplogin->setSessionBasicSearchKeyword($sSearchKeyword);
			$signuplogin->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $signuplogin;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$signuplogin->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $signuplogin;
		$signuplogin->setSessionBasicSearchKeyword("");
		$signuplogin->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $signuplogin;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$signuplogin->BasicSearchKeyword = $signuplogin->getSessionBasicSearchKeyword();
			$signuplogin->BasicSearchType = $signuplogin->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $signuplogin;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$signuplogin->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$signuplogin->CurrentOrderType = @$_GET["ordertype"];
			$signuplogin->UpdateSort($signuplogin->firstname); // firstname
			$signuplogin->UpdateSort($signuplogin->lastname); // lastname
			$signuplogin->UpdateSort($signuplogin->gender); // gender
			$signuplogin->UpdateSort($signuplogin->password); // password
			$signuplogin->UpdateSort($signuplogin->zemail); // email
			$signuplogin->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $signuplogin;
		$sOrderBy = $signuplogin->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($signuplogin->SqlOrderBy() <> "") {
				$sOrderBy = $signuplogin->SqlOrderBy();
				$signuplogin->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $signuplogin;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$signuplogin->setSessionOrderBy($sOrderBy);
				$signuplogin->firstname->setSort("");
				$signuplogin->lastname->setSort("");
				$signuplogin->gender->setSort("");
				$signuplogin->password->setSort("");
				$signuplogin->zemail->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$signuplogin->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $signuplogin;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $signuplogin, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $signuplogin;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $signuplogin;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$signuplogin->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$signuplogin->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $signuplogin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$signuplogin->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$signuplogin->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$signuplogin->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $signuplogin;
		$signuplogin->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$signuplogin->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $signuplogin;

		// Call Recordset Selecting event
		$signuplogin->Recordset_Selecting($signuplogin->CurrentFilter);

		// Load List page SQL
		$sSql = $signuplogin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$signuplogin->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $signuplogin;
		$sFilter = $signuplogin->KeyFilter();

		// Call Row Selecting event
		$signuplogin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$signuplogin->CurrentFilter = $sFilter;
		$sSql = $signuplogin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$signuplogin->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $signuplogin;
		if (!$rs || $rs->EOF) return;
		$signuplogin->firstname->setDbValue($rs->fields('firstname'));
		$signuplogin->lastname->setDbValue($rs->fields('lastname'));
		$signuplogin->gender->setDbValue($rs->fields('gender'));
		$signuplogin->password->setDbValue($rs->fields('password'));
		$signuplogin->zemail->setDbValue($rs->fields('email'));
	}

	// Load old record
	function LoadOldRecord() {
		global $signuplogin;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($signuplogin->getKey("zemail")) <> "")
			$signuplogin->zemail->CurrentValue = $signuplogin->getKey("zemail"); // email
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$signuplogin->CurrentFilter = $signuplogin->KeyFilter();
			$sSql = $signuplogin->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $signuplogin;

		// Initialize URLs
		$this->ViewUrl = $signuplogin->ViewUrl();
		$this->EditUrl = $signuplogin->EditUrl();
		$this->InlineEditUrl = $signuplogin->InlineEditUrl();
		$this->CopyUrl = $signuplogin->CopyUrl();
		$this->InlineCopyUrl = $signuplogin->InlineCopyUrl();
		$this->DeleteUrl = $signuplogin->DeleteUrl();

		// Call Row_Rendering event
		$signuplogin->Row_Rendering();

		// Common render codes for all row types
		// firstname
		// lastname
		// gender
		// password
		// email

		if ($signuplogin->RowType == EW_ROWTYPE_VIEW) { // View row

			// firstname
			$signuplogin->firstname->ViewValue = $signuplogin->firstname->CurrentValue;
			$signuplogin->firstname->ViewCustomAttributes = "";

			// lastname
			$signuplogin->lastname->ViewValue = $signuplogin->lastname->CurrentValue;
			$signuplogin->lastname->ViewCustomAttributes = "";

			// gender
			$signuplogin->gender->ViewValue = $signuplogin->gender->CurrentValue;
			$signuplogin->gender->ViewCustomAttributes = "";

			// password
			$signuplogin->password->ViewValue = $signuplogin->password->CurrentValue;
			$signuplogin->password->ViewCustomAttributes = "";

			// email
			$signuplogin->zemail->ViewValue = $signuplogin->zemail->CurrentValue;
			$signuplogin->zemail->ViewCustomAttributes = "";

			// firstname
			$signuplogin->firstname->LinkCustomAttributes = "";
			$signuplogin->firstname->HrefValue = "";
			$signuplogin->firstname->TooltipValue = "";

			// lastname
			$signuplogin->lastname->LinkCustomAttributes = "";
			$signuplogin->lastname->HrefValue = "";
			$signuplogin->lastname->TooltipValue = "";

			// gender
			$signuplogin->gender->LinkCustomAttributes = "";
			$signuplogin->gender->HrefValue = "";
			$signuplogin->gender->TooltipValue = "";

			// password
			$signuplogin->password->LinkCustomAttributes = "";
			$signuplogin->password->HrefValue = "";
			$signuplogin->password->TooltipValue = "";

			// email
			$signuplogin->zemail->LinkCustomAttributes = "";
			$signuplogin->zemail->HrefValue = "";
			$signuplogin->zemail->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($signuplogin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$signuplogin->Row_Rendered();
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
