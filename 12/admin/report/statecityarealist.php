<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "statecityareainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$statecityarea_list = new cstatecityarea_list();
$Page =& $statecityarea_list;

// Page init
$statecityarea_list->Page_Init();

// Page main
$statecityarea_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($statecityarea->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var statecityarea_list = new ew_Page("statecityarea_list");

// page properties
statecityarea_list.PageID = "list"; // page ID
statecityarea_list.FormID = "fstatecityarealist"; // form ID
var EW_PAGE_ID = statecityarea_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
statecityarea_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
statecityarea_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
statecityarea_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($statecityarea->Export == "") || (EW_EXPORT_MASTER_RECORD && $statecityarea->Export == "print")) { ?>
<?php } ?>
<?php $statecityarea_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$statecityarea_list->TotalRecs = $statecityarea->SelectRecordCount();
	} else {
		if ($statecityarea_list->Recordset = $statecityarea_list->LoadRecordset())
			$statecityarea_list->TotalRecs = $statecityarea_list->Recordset->RecordCount();
	}
	$statecityarea_list->StartRec = 1;
	if ($statecityarea_list->DisplayRecs <= 0 || ($statecityarea->Export <> "" && $statecityarea->ExportAll)) // Display all records
		$statecityarea_list->DisplayRecs = $statecityarea_list->TotalRecs;
	if (!($statecityarea->Export <> "" && $statecityarea->ExportAll))
		$statecityarea_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$statecityarea_list->Recordset = $statecityarea_list->LoadRecordset($statecityarea_list->StartRec-1, $statecityarea_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeVIEW") ?><?php echo $statecityarea->TableCaption() ?>
&nbsp;&nbsp;<?php $statecityarea_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($statecityarea->Export == "" && $statecityarea->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(statecityarea_list);" style="text-decoration: none;"><img id="statecityarea_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="statecityarea_list_SearchPanel">
<form name="fstatecityarealistsrch" id="fstatecityarealistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="statecityarea">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($statecityarea->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $statecityarea_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($statecityarea->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($statecityarea->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($statecityarea->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$statecityarea_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fstatecityarealist" id="fstatecityarealist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="statecityarea">
<div id="gmp_statecityarea" class="ewGridMiddlePanel">
<?php if ($statecityarea_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $statecityarea->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$statecityarea_list->RenderListOptions();

// Render list options (header, left)
$statecityarea_list->ListOptions->Render("header", "left");
?>
<?php if ($statecityarea->state_name->Visible) { // state_name ?>
	<?php if ($statecityarea->SortUrl($statecityarea->state_name) == "") { ?>
		<td><?php echo $statecityarea->state_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $statecityarea->SortUrl($statecityarea->state_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $statecityarea->state_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($statecityarea->state_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($statecityarea->state_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($statecityarea->city_name->Visible) { // city_name ?>
	<?php if ($statecityarea->SortUrl($statecityarea->city_name) == "") { ?>
		<td><?php echo $statecityarea->city_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $statecityarea->SortUrl($statecityarea->city_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $statecityarea->city_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($statecityarea->city_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($statecityarea->city_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($statecityarea->area_name->Visible) { // area_name ?>
	<?php if ($statecityarea->SortUrl($statecityarea->area_name) == "") { ?>
		<td><?php echo $statecityarea->area_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $statecityarea->SortUrl($statecityarea->area_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $statecityarea->area_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($statecityarea->area_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($statecityarea->area_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$statecityarea_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($statecityarea->ExportAll && $statecityarea->Export <> "") {
	$statecityarea_list->StopRec = $statecityarea_list->TotalRecs;
} else {

	// Set the last record to display
	if ($statecityarea_list->TotalRecs > $statecityarea_list->StartRec + $statecityarea_list->DisplayRecs - 1)
		$statecityarea_list->StopRec = $statecityarea_list->StartRec + $statecityarea_list->DisplayRecs - 1;
	else
		$statecityarea_list->StopRec = $statecityarea_list->TotalRecs;
}
$statecityarea_list->RecCnt = $statecityarea_list->StartRec - 1;
if ($statecityarea_list->Recordset && !$statecityarea_list->Recordset->EOF) {
	$statecityarea_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $statecityarea_list->StartRec > 1)
		$statecityarea_list->Recordset->Move($statecityarea_list->StartRec - 1);
} elseif (!$statecityarea->AllowAddDeleteRow && $statecityarea_list->StopRec == 0) {
	$statecityarea_list->StopRec = $statecityarea->GridAddRowCount;
}

// Initialize aggregate
$statecityarea->RowType = EW_ROWTYPE_AGGREGATEINIT;
$statecityarea->ResetAttrs();
$statecityarea_list->RenderRow();
$statecityarea_list->RowCnt = 0;
while ($statecityarea_list->RecCnt < $statecityarea_list->StopRec) {
	$statecityarea_list->RecCnt++;
	if (intval($statecityarea_list->RecCnt) >= intval($statecityarea_list->StartRec)) {
		$statecityarea_list->RowCnt++;

		// Set up key count
		$statecityarea_list->KeyCount = $statecityarea_list->RowIndex;

		// Init row class and style
		$statecityarea->ResetAttrs();
		$statecityarea->CssClass = "";
		$statecityarea->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($statecityarea_list->RowIndex))
			$statecityarea->RowAttrs = array_merge($statecityarea->RowAttrs, array('data-rowindex'=>$statecityarea_list->RowIndex, 'id'=>'r' . $statecityarea_list->RowIndex . '_statecityarea'));
		if ($statecityarea->CurrentAction == "gridadd") {
			$statecityarea_list->LoadDefaultValues(); // Load default values
		} else {
			$statecityarea_list->LoadRowValues($statecityarea_list->Recordset); // Load row values
		}
		$statecityarea->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$statecityarea_list->RenderRow();

		// Render list options
		$statecityarea_list->RenderListOptions();
?>
	<tr<?php echo $statecityarea->RowAttributes() ?>>
<?php

// Render list options (body, left)
$statecityarea_list->ListOptions->Render("body", "left");
?>
	<?php if ($statecityarea->state_name->Visible) { // state_name ?>
		<td<?php echo $statecityarea->state_name->CellAttributes() ?>>
<div<?php echo $statecityarea->state_name->ViewAttributes() ?>><?php echo $statecityarea->state_name->ListViewValue() ?></div>
<a name="<?php echo $statecityarea_list->PageObjName . "_row_" . $statecityarea_list->RowCnt ?>" id="<?php echo $statecityarea_list->PageObjName . "_row_" . $statecityarea_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($statecityarea->city_name->Visible) { // city_name ?>
		<td<?php echo $statecityarea->city_name->CellAttributes() ?>>
<div<?php echo $statecityarea->city_name->ViewAttributes() ?>><?php echo $statecityarea->city_name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($statecityarea->area_name->Visible) { // area_name ?>
		<td<?php echo $statecityarea->area_name->CellAttributes() ?>>
<div<?php echo $statecityarea->area_name->ViewAttributes() ?>><?php echo $statecityarea->area_name->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$statecityarea_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($statecityarea->CurrentAction <> "gridadd")
		$statecityarea_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($statecityarea_list->Recordset)
	$statecityarea_list->Recordset->Close();
?>
<?php if ($statecityarea->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($statecityarea->CurrentAction <> "gridadd" && $statecityarea->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($statecityarea_list->Pager)) $statecityarea_list->Pager = new cPrevNextPager($statecityarea_list->StartRec, $statecityarea_list->DisplayRecs, $statecityarea_list->TotalRecs) ?>
<?php if ($statecityarea_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($statecityarea_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $statecityarea_list->PageUrl() ?>start=<?php echo $statecityarea_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($statecityarea_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $statecityarea_list->PageUrl() ?>start=<?php echo $statecityarea_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $statecityarea_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($statecityarea_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $statecityarea_list->PageUrl() ?>start=<?php echo $statecityarea_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($statecityarea_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $statecityarea_list->PageUrl() ?>start=<?php echo $statecityarea_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $statecityarea_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $statecityarea_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $statecityarea_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $statecityarea_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($statecityarea_list->SearchWhere == "0=101") { ?>
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
<?php if ($statecityarea->Export == "" && $statecityarea->CurrentAction == "") { ?>
<?php } ?>
<?php
$statecityarea_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($statecityarea->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$statecityarea_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cstatecityarea_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'statecityarea';

	// Page object name
	var $PageObjName = 'statecityarea_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $statecityarea;
		if ($statecityarea->UseTokenInUrl) $PageUrl .= "t=" . $statecityarea->TableVar . "&"; // Add page token
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
		global $objForm, $statecityarea;
		if ($statecityarea->UseTokenInUrl) {
			if ($objForm)
				return ($statecityarea->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($statecityarea->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cstatecityarea_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (statecityarea)
		if (!isset($GLOBALS["statecityarea"])) {
			$GLOBALS["statecityarea"] = new cstatecityarea();
			$GLOBALS["Table"] =& $GLOBALS["statecityarea"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "statecityareaadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "statecityareadelete.php";
		$this->MultiUpdateUrl = "statecityareaupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'statecityarea', TRUE);

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
		global $statecityarea;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$statecityarea->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $statecityarea;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($statecityarea->Export <> "" ||
				$statecityarea->CurrentAction == "gridadd" ||
				$statecityarea->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$statecityarea->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($statecityarea->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $statecityarea->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$statecityarea->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$statecityarea->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$statecityarea->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $statecityarea->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$statecityarea->setSessionWhere($sFilter);
		$statecityarea->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $statecityarea;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $statecityarea->state_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $statecityarea->city_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $statecityarea->area_name, $Keyword);
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
		global $Security, $statecityarea;
		$sSearchStr = "";
		$sSearchKeyword = $statecityarea->BasicSearchKeyword;
		$sSearchType = $statecityarea->BasicSearchType;
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
			$statecityarea->setSessionBasicSearchKeyword($sSearchKeyword);
			$statecityarea->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $statecityarea;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$statecityarea->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $statecityarea;
		$statecityarea->setSessionBasicSearchKeyword("");
		$statecityarea->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $statecityarea;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$statecityarea->BasicSearchKeyword = $statecityarea->getSessionBasicSearchKeyword();
			$statecityarea->BasicSearchType = $statecityarea->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $statecityarea;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$statecityarea->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$statecityarea->CurrentOrderType = @$_GET["ordertype"];
			$statecityarea->UpdateSort($statecityarea->state_name); // state_name
			$statecityarea->UpdateSort($statecityarea->city_name); // city_name
			$statecityarea->UpdateSort($statecityarea->area_name); // area_name
			$statecityarea->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $statecityarea;
		$sOrderBy = $statecityarea->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($statecityarea->SqlOrderBy() <> "") {
				$sOrderBy = $statecityarea->SqlOrderBy();
				$statecityarea->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $statecityarea;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$statecityarea->setSessionOrderBy($sOrderBy);
				$statecityarea->state_name->setSort("");
				$statecityarea->city_name->setSort("");
				$statecityarea->area_name->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$statecityarea->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $statecityarea;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $statecityarea, $objForm;
		$this->ListOptions->LoadDefault();
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $statecityarea;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $statecityarea;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$statecityarea->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$statecityarea->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $statecityarea->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$statecityarea->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$statecityarea->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$statecityarea->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $statecityarea;
		$statecityarea->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$statecityarea->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $statecityarea;

		// Call Recordset Selecting event
		$statecityarea->Recordset_Selecting($statecityarea->CurrentFilter);

		// Load List page SQL
		$sSql = $statecityarea->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$statecityarea->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $statecityarea;
		$sFilter = $statecityarea->KeyFilter();

		// Call Row Selecting event
		$statecityarea->Row_Selecting($sFilter);

		// Load SQL based on filter
		$statecityarea->CurrentFilter = $sFilter;
		$sSql = $statecityarea->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$statecityarea->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $statecityarea;
		if (!$rs || $rs->EOF) return;
		$statecityarea->state_name->setDbValue($rs->fields('state_name'));
		$statecityarea->city_name->setDbValue($rs->fields('city_name'));
		$statecityarea->area_name->setDbValue($rs->fields('area_name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $statecityarea;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($statecityarea->getKey("state_name")) <> "")
			$statecityarea->state_name->CurrentValue = $statecityarea->getKey("state_name"); // state_name
		else
			$bValidKey = FALSE;
		if (strval($statecityarea->getKey("city_name")) <> "")
			$statecityarea->city_name->CurrentValue = $statecityarea->getKey("city_name"); // city_name
		else
			$bValidKey = FALSE;
		if (strval($statecityarea->getKey("area_name")) <> "")
			$statecityarea->area_name->CurrentValue = $statecityarea->getKey("area_name"); // area_name
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$statecityarea->CurrentFilter = $statecityarea->KeyFilter();
			$sSql = $statecityarea->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $statecityarea;

		// Initialize URLs
		$this->ViewUrl = $statecityarea->ViewUrl();
		$this->EditUrl = $statecityarea->EditUrl();
		$this->InlineEditUrl = $statecityarea->InlineEditUrl();
		$this->CopyUrl = $statecityarea->CopyUrl();
		$this->InlineCopyUrl = $statecityarea->InlineCopyUrl();
		$this->DeleteUrl = $statecityarea->DeleteUrl();

		// Call Row_Rendering event
		$statecityarea->Row_Rendering();

		// Common render codes for all row types
		// state_name
		// city_name
		// area_name

		if ($statecityarea->RowType == EW_ROWTYPE_VIEW) { // View row

			// state_name
			$statecityarea->state_name->ViewValue = $statecityarea->state_name->CurrentValue;
			$statecityarea->state_name->ViewCustomAttributes = "";

			// city_name
			$statecityarea->city_name->ViewValue = $statecityarea->city_name->CurrentValue;
			$statecityarea->city_name->ViewCustomAttributes = "";

			// area_name
			$statecityarea->area_name->ViewValue = $statecityarea->area_name->CurrentValue;
			$statecityarea->area_name->ViewCustomAttributes = "";

			// state_name
			$statecityarea->state_name->LinkCustomAttributes = "";
			$statecityarea->state_name->HrefValue = "";
			$statecityarea->state_name->TooltipValue = "";

			// city_name
			$statecityarea->city_name->LinkCustomAttributes = "";
			$statecityarea->city_name->HrefValue = "";
			$statecityarea->city_name->TooltipValue = "";

			// area_name
			$statecityarea->area_name->LinkCustomAttributes = "";
			$statecityarea->area_name->HrefValue = "";
			$statecityarea->area_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($statecityarea->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$statecityarea->Row_Rendered();
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
