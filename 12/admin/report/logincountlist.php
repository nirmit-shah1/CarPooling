<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "logincountinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$logincount_list = new clogincount_list();
$Page =& $logincount_list;

// Page init
$logincount_list->Page_Init();

// Page main
$logincount_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($logincount->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logincount_list = new ew_Page("logincount_list");

// page properties
logincount_list.PageID = "list"; // page ID
logincount_list.FormID = "flogincountlist"; // form ID
var EW_PAGE_ID = logincount_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
logincount_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logincount_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logincount_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($logincount->Export == "") || (EW_EXPORT_MASTER_RECORD && $logincount->Export == "print")) { ?>
<?php } ?>
<?php $logincount_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$logincount_list->TotalRecs = $logincount->SelectRecordCount();
	} else {
		if ($logincount_list->Recordset = $logincount_list->LoadRecordset())
			$logincount_list->TotalRecs = $logincount_list->Recordset->RecordCount();
	}
	$logincount_list->StartRec = 1;
	if ($logincount_list->DisplayRecs <= 0 || ($logincount->Export <> "" && $logincount->ExportAll)) // Display all records
		$logincount_list->DisplayRecs = $logincount_list->TotalRecs;
	if (!($logincount->Export <> "" && $logincount->ExportAll))
		$logincount_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$logincount_list->Recordset = $logincount_list->LoadRecordset($logincount_list->StartRec-1, $logincount_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logincount->TableCaption() ?>
&nbsp;&nbsp;<?php $logincount_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($logincount->Export == "" && $logincount->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(logincount_list);" style="text-decoration: none;"><img id="logincount_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="logincount_list_SearchPanel">
<form name="flogincountlistsrch" id="flogincountlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="logincount">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($logincount->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $logincount_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($logincount->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($logincount->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($logincount->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$logincount_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="flogincountlist" id="flogincountlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="logincount">
<div id="gmp_logincount" class="ewGridMiddlePanel">
<?php if ($logincount_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $logincount->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$logincount_list->RenderListOptions();

// Render list options (header, left)
$logincount_list->ListOptions->Render("header", "left");
?>
<?php if ($logincount->dt_id->Visible) { // dt_id ?>
	<?php if ($logincount->SortUrl($logincount->dt_id) == "") { ?>
		<td><?php echo $logincount->dt_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logincount->SortUrl($logincount->dt_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logincount->dt_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($logincount->dt_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logincount->dt_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logincount->reg_id->Visible) { // reg_id ?>
	<?php if ($logincount->SortUrl($logincount->reg_id) == "") { ?>
		<td><?php echo $logincount->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logincount->SortUrl($logincount->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logincount->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($logincount->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logincount->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logincount->logincounter->Visible) { // logincounter ?>
	<?php if ($logincount->SortUrl($logincount->logincounter) == "") { ?>
		<td><?php echo $logincount->logincounter->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logincount->SortUrl($logincount->logincounter) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logincount->logincounter->FldCaption() ?></td><td style="width: 10px;"><?php if ($logincount->logincounter->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logincount->logincounter->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($logincount->date->Visible) { // date ?>
	<?php if ($logincount->SortUrl($logincount->date) == "") { ?>
		<td><?php echo $logincount->date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $logincount->SortUrl($logincount->date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $logincount->date->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($logincount->date->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($logincount->date->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$logincount_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($logincount->ExportAll && $logincount->Export <> "") {
	$logincount_list->StopRec = $logincount_list->TotalRecs;
} else {

	// Set the last record to display
	if ($logincount_list->TotalRecs > $logincount_list->StartRec + $logincount_list->DisplayRecs - 1)
		$logincount_list->StopRec = $logincount_list->StartRec + $logincount_list->DisplayRecs - 1;
	else
		$logincount_list->StopRec = $logincount_list->TotalRecs;
}
$logincount_list->RecCnt = $logincount_list->StartRec - 1;
if ($logincount_list->Recordset && !$logincount_list->Recordset->EOF) {
	$logincount_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $logincount_list->StartRec > 1)
		$logincount_list->Recordset->Move($logincount_list->StartRec - 1);
} elseif (!$logincount->AllowAddDeleteRow && $logincount_list->StopRec == 0) {
	$logincount_list->StopRec = $logincount->GridAddRowCount;
}

// Initialize aggregate
$logincount->RowType = EW_ROWTYPE_AGGREGATEINIT;
$logincount->ResetAttrs();
$logincount_list->RenderRow();
$logincount_list->RowCnt = 0;
while ($logincount_list->RecCnt < $logincount_list->StopRec) {
	$logincount_list->RecCnt++;
	if (intval($logincount_list->RecCnt) >= intval($logincount_list->StartRec)) {
		$logincount_list->RowCnt++;

		// Set up key count
		$logincount_list->KeyCount = $logincount_list->RowIndex;

		// Init row class and style
		$logincount->ResetAttrs();
		$logincount->CssClass = "";
		$logincount->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($logincount_list->RowIndex))
			$logincount->RowAttrs = array_merge($logincount->RowAttrs, array('data-rowindex'=>$logincount_list->RowIndex, 'id'=>'r' . $logincount_list->RowIndex . '_logincount'));
		if ($logincount->CurrentAction == "gridadd") {
			$logincount_list->LoadDefaultValues(); // Load default values
		} else {
			$logincount_list->LoadRowValues($logincount_list->Recordset); // Load row values
		}
		$logincount->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$logincount_list->RenderRow();

		// Render list options
		$logincount_list->RenderListOptions();
?>
	<tr<?php echo $logincount->RowAttributes() ?>>
<?php

// Render list options (body, left)
$logincount_list->ListOptions->Render("body", "left");
?>
	<?php if ($logincount->dt_id->Visible) { // dt_id ?>
		<td<?php echo $logincount->dt_id->CellAttributes() ?>>
<div<?php echo $logincount->dt_id->ViewAttributes() ?>><?php echo $logincount->dt_id->ListViewValue() ?></div>
<a name="<?php echo $logincount_list->PageObjName . "_row_" . $logincount_list->RowCnt ?>" id="<?php echo $logincount_list->PageObjName . "_row_" . $logincount_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($logincount->reg_id->Visible) { // reg_id ?>
		<td<?php echo $logincount->reg_id->CellAttributes() ?>>
<div<?php echo $logincount->reg_id->ViewAttributes() ?>><?php echo $logincount->reg_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logincount->logincounter->Visible) { // logincounter ?>
		<td<?php echo $logincount->logincounter->CellAttributes() ?>>
<div<?php echo $logincount->logincounter->ViewAttributes() ?>><?php echo $logincount->logincounter->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($logincount->date->Visible) { // date ?>
		<td<?php echo $logincount->date->CellAttributes() ?>>
<div<?php echo $logincount->date->ViewAttributes() ?>><?php echo $logincount->date->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$logincount_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($logincount->CurrentAction <> "gridadd")
		$logincount_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($logincount_list->Recordset)
	$logincount_list->Recordset->Close();
?>
<?php if ($logincount->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($logincount->CurrentAction <> "gridadd" && $logincount->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($logincount_list->Pager)) $logincount_list->Pager = new cPrevNextPager($logincount_list->StartRec, $logincount_list->DisplayRecs, $logincount_list->TotalRecs) ?>
<?php if ($logincount_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($logincount_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $logincount_list->PageUrl() ?>start=<?php echo $logincount_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($logincount_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $logincount_list->PageUrl() ?>start=<?php echo $logincount_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $logincount_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($logincount_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $logincount_list->PageUrl() ?>start=<?php echo $logincount_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($logincount_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $logincount_list->PageUrl() ?>start=<?php echo $logincount_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $logincount_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $logincount_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $logincount_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $logincount_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($logincount_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $logincount_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($logincount->Export == "" && $logincount->CurrentAction == "") { ?>
<?php } ?>
<?php
$logincount_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($logincount->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$logincount_list->Page_Terminate();
?>
<?php

//
// Page class
//
class clogincount_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'logincount';

	// Page object name
	var $PageObjName = 'logincount_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logincount;
		if ($logincount->UseTokenInUrl) $PageUrl .= "t=" . $logincount->TableVar . "&"; // Add page token
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
		global $objForm, $logincount;
		if ($logincount->UseTokenInUrl) {
			if ($objForm)
				return ($logincount->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logincount->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function clogincount_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (logincount)
		if (!isset($GLOBALS["logincount"])) {
			$GLOBALS["logincount"] = new clogincount();
			$GLOBALS["Table"] =& $GLOBALS["logincount"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "logincountadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "logincountdelete.php";
		$this->MultiUpdateUrl = "logincountupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'logincount', TRUE);

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
		global $logincount;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$logincount->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $logincount;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($logincount->Export <> "" ||
				$logincount->CurrentAction == "gridadd" ||
				$logincount->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$logincount->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($logincount->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $logincount->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$logincount->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$logincount->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$logincount->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $logincount->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$logincount->setSessionWhere($sFilter);
		$logincount->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $logincount;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $logincount->date, $Keyword);
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
		global $Security, $logincount;
		$sSearchStr = "";
		$sSearchKeyword = $logincount->BasicSearchKeyword;
		$sSearchType = $logincount->BasicSearchType;
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
			$logincount->setSessionBasicSearchKeyword($sSearchKeyword);
			$logincount->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $logincount;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$logincount->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $logincount;
		$logincount->setSessionBasicSearchKeyword("");
		$logincount->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $logincount;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$logincount->BasicSearchKeyword = $logincount->getSessionBasicSearchKeyword();
			$logincount->BasicSearchType = $logincount->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $logincount;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$logincount->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$logincount->CurrentOrderType = @$_GET["ordertype"];
			$logincount->UpdateSort($logincount->dt_id); // dt_id
			$logincount->UpdateSort($logincount->reg_id); // reg_id
			$logincount->UpdateSort($logincount->logincounter); // logincounter
			$logincount->UpdateSort($logincount->date); // date
			$logincount->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $logincount;
		$sOrderBy = $logincount->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($logincount->SqlOrderBy() <> "") {
				$sOrderBy = $logincount->SqlOrderBy();
				$logincount->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $logincount;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$logincount->setSessionOrderBy($sOrderBy);
				$logincount->dt_id->setSort("");
				$logincount->reg_id->setSort("");
				$logincount->logincounter->setSort("");
				$logincount->date->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$logincount->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $logincount;

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
		global $Security, $Language, $logincount, $objForm;
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
		global $Security, $Language, $logincount;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $logincount;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$logincount->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$logincount->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $logincount->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$logincount->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$logincount->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$logincount->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $logincount;
		$logincount->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$logincount->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $logincount;

		// Call Recordset Selecting event
		$logincount->Recordset_Selecting($logincount->CurrentFilter);

		// Load List page SQL
		$sSql = $logincount->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$logincount->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logincount;
		$sFilter = $logincount->KeyFilter();

		// Call Row Selecting event
		$logincount->Row_Selecting($sFilter);

		// Load SQL based on filter
		$logincount->CurrentFilter = $sFilter;
		$sSql = $logincount->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$logincount->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $logincount;
		if (!$rs || $rs->EOF) return;
		$logincount->dt_id->setDbValue($rs->fields('dt_id'));
		$logincount->reg_id->setDbValue($rs->fields('reg_id'));
		$logincount->logincounter->setDbValue($rs->fields('logincounter'));
		$logincount->date->setDbValue($rs->fields('date'));
	}

	// Load old record
	function LoadOldRecord() {
		global $logincount;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($logincount->getKey("dt_id")) <> "")
			$logincount->dt_id->CurrentValue = $logincount->getKey("dt_id"); // dt_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$logincount->CurrentFilter = $logincount->KeyFilter();
			$sSql = $logincount->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $logincount;

		// Initialize URLs
		$this->ViewUrl = $logincount->ViewUrl();
		$this->EditUrl = $logincount->EditUrl();
		$this->InlineEditUrl = $logincount->InlineEditUrl();
		$this->CopyUrl = $logincount->CopyUrl();
		$this->InlineCopyUrl = $logincount->InlineCopyUrl();
		$this->DeleteUrl = $logincount->DeleteUrl();

		// Call Row_Rendering event
		$logincount->Row_Rendering();

		// Common render codes for all row types
		// dt_id
		// reg_id
		// logincounter
		// date

		if ($logincount->RowType == EW_ROWTYPE_VIEW) { // View row

			// dt_id
			$logincount->dt_id->ViewValue = $logincount->dt_id->CurrentValue;
			$logincount->dt_id->ViewCustomAttributes = "";

			// reg_id
			$logincount->reg_id->ViewValue = $logincount->reg_id->CurrentValue;
			$logincount->reg_id->ViewCustomAttributes = "";

			// logincounter
			$logincount->logincounter->ViewValue = $logincount->logincounter->CurrentValue;
			$logincount->logincounter->ViewCustomAttributes = "";

			// date
			$logincount->date->ViewValue = $logincount->date->CurrentValue;
			$logincount->date->ViewCustomAttributes = "";

			// dt_id
			$logincount->dt_id->LinkCustomAttributes = "";
			$logincount->dt_id->HrefValue = "";
			$logincount->dt_id->TooltipValue = "";

			// reg_id
			$logincount->reg_id->LinkCustomAttributes = "";
			$logincount->reg_id->HrefValue = "";
			$logincount->reg_id->TooltipValue = "";

			// logincounter
			$logincount->logincounter->LinkCustomAttributes = "";
			$logincount->logincounter->HrefValue = "";
			$logincount->logincounter->TooltipValue = "";

			// date
			$logincount->date->LinkCustomAttributes = "";
			$logincount->date->HrefValue = "";
			$logincount->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($logincount->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$logincount->Row_Rendered();
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
