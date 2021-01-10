<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "areainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$area_list = new carea_list();
$Page =& $area_list;

// Page init
$area_list->Page_Init();

// Page main
$area_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($area->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var area_list = new ew_Page("area_list");

// page properties
area_list.PageID = "list"; // page ID
area_list.FormID = "farealist"; // form ID
var EW_PAGE_ID = area_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
area_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
area_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
area_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($area->Export == "") || (EW_EXPORT_MASTER_RECORD && $area->Export == "print")) { ?>
<?php } ?>
<?php $area_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$area_list->TotalRecs = $area->SelectRecordCount();
	} else {
		if ($area_list->Recordset = $area_list->LoadRecordset())
			$area_list->TotalRecs = $area_list->Recordset->RecordCount();
	}
	$area_list->StartRec = 1;
	if ($area_list->DisplayRecs <= 0 || ($area->Export <> "" && $area->ExportAll)) // Display all records
		$area_list->DisplayRecs = $area_list->TotalRecs;
	if (!($area->Export <> "" && $area->ExportAll))
		$area_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$area_list->Recordset = $area_list->LoadRecordset($area_list->StartRec-1, $area_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $area->TableCaption() ?>
&nbsp;&nbsp;<?php $area_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($area->Export == "" && $area->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(area_list);" style="text-decoration: none;"><img id="area_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="area_list_SearchPanel">
<form name="farealistsrch" id="farealistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="area">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($area->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $area_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($area->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($area->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($area->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$area_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="farealist" id="farealist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="area">
<div id="gmp_area" class="ewGridMiddlePanel">
<?php if ($area_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $area->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$area_list->RenderListOptions();

// Render list options (header, left)
$area_list->ListOptions->Render("header", "left");
?>
<?php if ($area->aid->Visible) { // aid ?>
	<?php if ($area->SortUrl($area->aid) == "") { ?>
		<td><?php echo $area->aid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $area->SortUrl($area->aid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $area->aid->FldCaption() ?></td><td style="width: 10px;"><?php if ($area->aid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($area->aid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($area->sid->Visible) { // sid ?>
	<?php if ($area->SortUrl($area->sid) == "") { ?>
		<td><?php echo $area->sid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $area->SortUrl($area->sid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $area->sid->FldCaption() ?></td><td style="width: 10px;"><?php if ($area->sid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($area->sid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($area->cid->Visible) { // cid ?>
	<?php if ($area->SortUrl($area->cid) == "") { ?>
		<td><?php echo $area->cid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $area->SortUrl($area->cid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $area->cid->FldCaption() ?></td><td style="width: 10px;"><?php if ($area->cid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($area->cid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($area->area_name->Visible) { // area_name ?>
	<?php if ($area->SortUrl($area->area_name) == "") { ?>
		<td><?php echo $area->area_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $area->SortUrl($area->area_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $area->area_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($area->area_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($area->area_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$area_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($area->ExportAll && $area->Export <> "") {
	$area_list->StopRec = $area_list->TotalRecs;
} else {

	// Set the last record to display
	if ($area_list->TotalRecs > $area_list->StartRec + $area_list->DisplayRecs - 1)
		$area_list->StopRec = $area_list->StartRec + $area_list->DisplayRecs - 1;
	else
		$area_list->StopRec = $area_list->TotalRecs;
}
$area_list->RecCnt = $area_list->StartRec - 1;
if ($area_list->Recordset && !$area_list->Recordset->EOF) {
	$area_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $area_list->StartRec > 1)
		$area_list->Recordset->Move($area_list->StartRec - 1);
} elseif (!$area->AllowAddDeleteRow && $area_list->StopRec == 0) {
	$area_list->StopRec = $area->GridAddRowCount;
}

// Initialize aggregate
$area->RowType = EW_ROWTYPE_AGGREGATEINIT;
$area->ResetAttrs();
$area_list->RenderRow();
$area_list->RowCnt = 0;
while ($area_list->RecCnt < $area_list->StopRec) {
	$area_list->RecCnt++;
	if (intval($area_list->RecCnt) >= intval($area_list->StartRec)) {
		$area_list->RowCnt++;

		// Set up key count
		$area_list->KeyCount = $area_list->RowIndex;

		// Init row class and style
		$area->ResetAttrs();
		$area->CssClass = "";
		$area->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($area_list->RowIndex))
			$area->RowAttrs = array_merge($area->RowAttrs, array('data-rowindex'=>$area_list->RowIndex, 'id'=>'r' . $area_list->RowIndex . '_area'));
		if ($area->CurrentAction == "gridadd") {
			$area_list->LoadDefaultValues(); // Load default values
		} else {
			$area_list->LoadRowValues($area_list->Recordset); // Load row values
		}
		$area->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$area_list->RenderRow();

		// Render list options
		$area_list->RenderListOptions();
?>
	<tr<?php echo $area->RowAttributes() ?>>
<?php

// Render list options (body, left)
$area_list->ListOptions->Render("body", "left");
?>
	<?php if ($area->aid->Visible) { // aid ?>
		<td<?php echo $area->aid->CellAttributes() ?>>
<div<?php echo $area->aid->ViewAttributes() ?>><?php echo $area->aid->ListViewValue() ?></div>
<a name="<?php echo $area_list->PageObjName . "_row_" . $area_list->RowCnt ?>" id="<?php echo $area_list->PageObjName . "_row_" . $area_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($area->sid->Visible) { // sid ?>
		<td<?php echo $area->sid->CellAttributes() ?>>
<div<?php echo $area->sid->ViewAttributes() ?>><?php echo $area->sid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($area->cid->Visible) { // cid ?>
		<td<?php echo $area->cid->CellAttributes() ?>>
<div<?php echo $area->cid->ViewAttributes() ?>><?php echo $area->cid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($area->area_name->Visible) { // area_name ?>
		<td<?php echo $area->area_name->CellAttributes() ?>>
<div<?php echo $area->area_name->ViewAttributes() ?>><?php echo $area->area_name->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$area_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($area->CurrentAction <> "gridadd")
		$area_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($area_list->Recordset)
	$area_list->Recordset->Close();
?>
<?php if ($area->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($area->CurrentAction <> "gridadd" && $area->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($area_list->Pager)) $area_list->Pager = new cPrevNextPager($area_list->StartRec, $area_list->DisplayRecs, $area_list->TotalRecs) ?>
<?php if ($area_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($area_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $area_list->PageUrl() ?>start=<?php echo $area_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($area_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $area_list->PageUrl() ?>start=<?php echo $area_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $area_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($area_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $area_list->PageUrl() ?>start=<?php echo $area_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($area_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $area_list->PageUrl() ?>start=<?php echo $area_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $area_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $area_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $area_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $area_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($area_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $area_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($area->Export == "" && $area->CurrentAction == "") { ?>
<?php } ?>
<?php
$area_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($area->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$area_list->Page_Terminate();
?>
<?php

//
// Page class
//
class carea_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'area';

	// Page object name
	var $PageObjName = 'area_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $area;
		if ($area->UseTokenInUrl) $PageUrl .= "t=" . $area->TableVar . "&"; // Add page token
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
		global $objForm, $area;
		if ($area->UseTokenInUrl) {
			if ($objForm)
				return ($area->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($area->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function carea_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (area)
		if (!isset($GLOBALS["area"])) {
			$GLOBALS["area"] = new carea();
			$GLOBALS["Table"] =& $GLOBALS["area"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "areaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "areadelete.php";
		$this->MultiUpdateUrl = "areaupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'area', TRUE);

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
		global $area;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$area->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $area;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($area->Export <> "" ||
				$area->CurrentAction == "gridadd" ||
				$area->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$area->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($area->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $area->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$area->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$area->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$area->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $area->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$area->setSessionWhere($sFilter);
		$area->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $area;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $area->area_name, $Keyword);
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
		global $Security, $area;
		$sSearchStr = "";
		$sSearchKeyword = $area->BasicSearchKeyword;
		$sSearchType = $area->BasicSearchType;
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
			$area->setSessionBasicSearchKeyword($sSearchKeyword);
			$area->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $area;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$area->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $area;
		$area->setSessionBasicSearchKeyword("");
		$area->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $area;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$area->BasicSearchKeyword = $area->getSessionBasicSearchKeyword();
			$area->BasicSearchType = $area->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $area;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$area->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$area->CurrentOrderType = @$_GET["ordertype"];
			$area->UpdateSort($area->aid); // aid
			$area->UpdateSort($area->sid); // sid
			$area->UpdateSort($area->cid); // cid
			$area->UpdateSort($area->area_name); // area_name
			$area->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $area;
		$sOrderBy = $area->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($area->SqlOrderBy() <> "") {
				$sOrderBy = $area->SqlOrderBy();
				$area->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $area;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$area->setSessionOrderBy($sOrderBy);
				$area->aid->setSort("");
				$area->sid->setSort("");
				$area->cid->setSort("");
				$area->area_name->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$area->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $area;

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
		global $Security, $Language, $area, $objForm;
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
		global $Security, $Language, $area;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $area;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$area->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$area->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $area->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$area->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$area->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$area->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $area;
		$area->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$area->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $area;

		// Call Recordset Selecting event
		$area->Recordset_Selecting($area->CurrentFilter);

		// Load List page SQL
		$sSql = $area->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$area->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $area;
		$sFilter = $area->KeyFilter();

		// Call Row Selecting event
		$area->Row_Selecting($sFilter);

		// Load SQL based on filter
		$area->CurrentFilter = $sFilter;
		$sSql = $area->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$area->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $area;
		if (!$rs || $rs->EOF) return;
		$area->aid->setDbValue($rs->fields('aid'));
		$area->sid->setDbValue($rs->fields('sid'));
		$area->cid->setDbValue($rs->fields('cid'));
		$area->area_name->setDbValue($rs->fields('area_name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $area;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($area->getKey("area_name")) <> "")
			$area->area_name->CurrentValue = $area->getKey("area_name"); // area_name
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$area->CurrentFilter = $area->KeyFilter();
			$sSql = $area->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $area;

		// Initialize URLs
		$this->ViewUrl = $area->ViewUrl();
		$this->EditUrl = $area->EditUrl();
		$this->InlineEditUrl = $area->InlineEditUrl();
		$this->CopyUrl = $area->CopyUrl();
		$this->InlineCopyUrl = $area->InlineCopyUrl();
		$this->DeleteUrl = $area->DeleteUrl();

		// Call Row_Rendering event
		$area->Row_Rendering();

		// Common render codes for all row types
		// aid
		// sid
		// cid
		// area_name

		if ($area->RowType == EW_ROWTYPE_VIEW) { // View row

			// aid
			$area->aid->ViewValue = $area->aid->CurrentValue;
			$area->aid->ViewCustomAttributes = "";

			// sid
			$area->sid->ViewValue = $area->sid->CurrentValue;
			$area->sid->ViewCustomAttributes = "";

			// cid
			$area->cid->ViewValue = $area->cid->CurrentValue;
			$area->cid->ViewCustomAttributes = "";

			// area_name
			$area->area_name->ViewValue = $area->area_name->CurrentValue;
			$area->area_name->ViewCustomAttributes = "";

			// aid
			$area->aid->LinkCustomAttributes = "";
			$area->aid->HrefValue = "";
			$area->aid->TooltipValue = "";

			// sid
			$area->sid->LinkCustomAttributes = "";
			$area->sid->HrefValue = "";
			$area->sid->TooltipValue = "";

			// cid
			$area->cid->LinkCustomAttributes = "";
			$area->cid->HrefValue = "";
			$area->cid->TooltipValue = "";

			// area_name
			$area->area_name->LinkCustomAttributes = "";
			$area->area_name->HrefValue = "";
			$area->area_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($area->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$area->Row_Rendered();
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
