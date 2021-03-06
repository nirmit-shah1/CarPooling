<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modelinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$model_list = new cmodel_list();
$Page =& $model_list;

// Page init
$model_list->Page_Init();

// Page main
$model_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($model->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var model_list = new ew_Page("model_list");

// page properties
model_list.PageID = "list"; // page ID
model_list.FormID = "fmodellist"; // form ID
var EW_PAGE_ID = model_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
model_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
model_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
model_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($model->Export == "") || (EW_EXPORT_MASTER_RECORD && $model->Export == "print")) { ?>
<?php } ?>
<?php $model_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$model_list->TotalRecs = $model->SelectRecordCount();
	} else {
		if ($model_list->Recordset = $model_list->LoadRecordset())
			$model_list->TotalRecs = $model_list->Recordset->RecordCount();
	}
	$model_list->StartRec = 1;
	if ($model_list->DisplayRecs <= 0 || ($model->Export <> "" && $model->ExportAll)) // Display all records
		$model_list->DisplayRecs = $model_list->TotalRecs;
	if (!($model->Export <> "" && $model->ExportAll))
		$model_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$model_list->Recordset = $model_list->LoadRecordset($model_list->StartRec-1, $model_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $model->TableCaption() ?>
&nbsp;&nbsp;<?php $model_list->ExportOptions->Render("body"); ?>
</p>
<?php if ($model->Export == "" && $model->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(model_list);" style="text-decoration: none;"><img id="model_list_SearchImage" src="phpimages/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="model_list_SearchPanel">
<form name="fmodellistsrch" id="fmodellistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="model">
<div class="ewBasicSearch">
<div id="xsr_1" class="ewCssTableRow">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($model->getSessionBasicSearchKeyword()) ?>">
	<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
	<a href="<?php echo $model_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
</div>
<div id="xsr_2" class="ewCssTableRow">
	<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($model->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($model->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($model->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label>
</div>
</div>
</form>
</div>
<?php } ?>
<?php
$model_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmodellist" id="fmodellist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="model">
<div id="gmp_model" class="ewGridMiddlePanel">
<?php if ($model_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $model->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$model_list->RenderListOptions();

// Render list options (header, left)
$model_list->ListOptions->Render("header", "left");
?>
<?php if ($model->coid->Visible) { // coid ?>
	<?php if ($model->SortUrl($model->coid) == "") { ?>
		<td><?php echo $model->coid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $model->SortUrl($model->coid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $model->coid->FldCaption() ?></td><td style="width: 10px;"><?php if ($model->coid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($model->coid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($model->moid->Visible) { // moid ?>
	<?php if ($model->SortUrl($model->moid) == "") { ?>
		<td><?php echo $model->moid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $model->SortUrl($model->moid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $model->moid->FldCaption() ?></td><td style="width: 10px;"><?php if ($model->moid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($model->moid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($model->model_name->Visible) { // model_name ?>
	<?php if ($model->SortUrl($model->model_name) == "") { ?>
		<td><?php echo $model->model_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $model->SortUrl($model->model_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $model->model_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($model->model_name->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($model->model_name->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$model_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($model->ExportAll && $model->Export <> "") {
	$model_list->StopRec = $model_list->TotalRecs;
} else {

	// Set the last record to display
	if ($model_list->TotalRecs > $model_list->StartRec + $model_list->DisplayRecs - 1)
		$model_list->StopRec = $model_list->StartRec + $model_list->DisplayRecs - 1;
	else
		$model_list->StopRec = $model_list->TotalRecs;
}
$model_list->RecCnt = $model_list->StartRec - 1;
if ($model_list->Recordset && !$model_list->Recordset->EOF) {
	$model_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $model_list->StartRec > 1)
		$model_list->Recordset->Move($model_list->StartRec - 1);
} elseif (!$model->AllowAddDeleteRow && $model_list->StopRec == 0) {
	$model_list->StopRec = $model->GridAddRowCount;
}

// Initialize aggregate
$model->RowType = EW_ROWTYPE_AGGREGATEINIT;
$model->ResetAttrs();
$model_list->RenderRow();
$model_list->RowCnt = 0;
while ($model_list->RecCnt < $model_list->StopRec) {
	$model_list->RecCnt++;
	if (intval($model_list->RecCnt) >= intval($model_list->StartRec)) {
		$model_list->RowCnt++;

		// Set up key count
		$model_list->KeyCount = $model_list->RowIndex;

		// Init row class and style
		$model->ResetAttrs();
		$model->CssClass = "";
		$model->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($model_list->RowIndex))
			$model->RowAttrs = array_merge($model->RowAttrs, array('data-rowindex'=>$model_list->RowIndex, 'id'=>'r' . $model_list->RowIndex . '_model'));
		if ($model->CurrentAction == "gridadd") {
			$model_list->LoadDefaultValues(); // Load default values
		} else {
			$model_list->LoadRowValues($model_list->Recordset); // Load row values
		}
		$model->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$model_list->RenderRow();

		// Render list options
		$model_list->RenderListOptions();
?>
	<tr<?php echo $model->RowAttributes() ?>>
<?php

// Render list options (body, left)
$model_list->ListOptions->Render("body", "left");
?>
	<?php if ($model->coid->Visible) { // coid ?>
		<td<?php echo $model->coid->CellAttributes() ?>>
<div<?php echo $model->coid->ViewAttributes() ?>><?php echo $model->coid->ListViewValue() ?></div>
<a name="<?php echo $model_list->PageObjName . "_row_" . $model_list->RowCnt ?>" id="<?php echo $model_list->PageObjName . "_row_" . $model_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($model->moid->Visible) { // moid ?>
		<td<?php echo $model->moid->CellAttributes() ?>>
<div<?php echo $model->moid->ViewAttributes() ?>><?php echo $model->moid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($model->model_name->Visible) { // model_name ?>
		<td<?php echo $model->model_name->CellAttributes() ?>>
<div<?php echo $model->model_name->ViewAttributes() ?>><?php echo $model->model_name->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$model_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($model->CurrentAction <> "gridadd")
		$model_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($model_list->Recordset)
	$model_list->Recordset->Close();
?>
<?php if ($model->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($model->CurrentAction <> "gridadd" && $model->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($model_list->Pager)) $model_list->Pager = new cPrevNextPager($model_list->StartRec, $model_list->DisplayRecs, $model_list->TotalRecs) ?>
<?php if ($model_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($model_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $model_list->PageUrl() ?>start=<?php echo $model_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($model_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $model_list->PageUrl() ?>start=<?php echo $model_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $model_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($model_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $model_list->PageUrl() ?>start=<?php echo $model_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($model_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $model_list->PageUrl() ?>start=<?php echo $model_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $model_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $model_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $model_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $model_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($model_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $model_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($model->Export == "" && $model->CurrentAction == "") { ?>
<?php } ?>
<?php
$model_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($model->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$model_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodel_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'model';

	// Page object name
	var $PageObjName = 'model_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $model;
		if ($model->UseTokenInUrl) $PageUrl .= "t=" . $model->TableVar . "&"; // Add page token
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
		global $objForm, $model;
		if ($model->UseTokenInUrl) {
			if ($objForm)
				return ($model->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($model->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodel_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (model)
		if (!isset($GLOBALS["model"])) {
			$GLOBALS["model"] = new cmodel();
			$GLOBALS["Table"] =& $GLOBALS["model"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "modeladd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "modeldelete.php";
		$this->MultiUpdateUrl = "modelupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'model', TRUE);

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
		global $model;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$model->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $model;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($model->Export <> "" ||
				$model->CurrentAction == "gridadd" ||
				$model->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$model->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($model->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $model->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$model->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->SearchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$model->setSearchWhere($this->SearchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->StartRec = 1; // Reset start record counter
				$model->setStartRecordNumber($this->StartRec);
			}
		} else {
			$this->SearchWhere = $model->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$model->setSessionWhere($sFilter);
		$model->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $model;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $model->model_name, $Keyword);
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
		global $Security, $model;
		$sSearchStr = "";
		$sSearchKeyword = $model->BasicSearchKeyword;
		$sSearchType = $model->BasicSearchType;
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
			$model->setSessionBasicSearchKeyword($sSearchKeyword);
			$model->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $model;

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$model->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $model;
		$model->setSessionBasicSearchKeyword("");
		$model->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $model;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$model->BasicSearchKeyword = $model->getSessionBasicSearchKeyword();
			$model->BasicSearchType = $model->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $model;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$model->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$model->CurrentOrderType = @$_GET["ordertype"];
			$model->UpdateSort($model->coid); // coid
			$model->UpdateSort($model->moid); // moid
			$model->UpdateSort($model->model_name); // model_name
			$model->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $model;
		$sOrderBy = $model->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($model->SqlOrderBy() <> "") {
				$sOrderBy = $model->SqlOrderBy();
				$model->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $model;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$model->setSessionOrderBy($sOrderBy);
				$model->coid->setSort("");
				$model->moid->setSort("");
				$model->model_name->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$model->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $model;

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
		global $Security, $Language, $model, $objForm;
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
		global $Security, $Language, $model;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $model;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$model->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$model->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $model->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$model->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$model->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$model->setStartRecordNumber($this->StartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $model;
		$model->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$model->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $model;

		// Call Recordset Selecting event
		$model->Recordset_Selecting($model->CurrentFilter);

		// Load List page SQL
		$sSql = $model->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$model->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $model;
		$sFilter = $model->KeyFilter();

		// Call Row Selecting event
		$model->Row_Selecting($sFilter);

		// Load SQL based on filter
		$model->CurrentFilter = $sFilter;
		$sSql = $model->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$model->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $model;
		if (!$rs || $rs->EOF) return;
		$model->coid->setDbValue($rs->fields('coid'));
		$model->moid->setDbValue($rs->fields('moid'));
		$model->model_name->setDbValue($rs->fields('model_name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $model;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($model->getKey("model_name")) <> "")
			$model->model_name->CurrentValue = $model->getKey("model_name"); // model_name
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$model->CurrentFilter = $model->KeyFilter();
			$sSql = $model->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $model;

		// Initialize URLs
		$this->ViewUrl = $model->ViewUrl();
		$this->EditUrl = $model->EditUrl();
		$this->InlineEditUrl = $model->InlineEditUrl();
		$this->CopyUrl = $model->CopyUrl();
		$this->InlineCopyUrl = $model->InlineCopyUrl();
		$this->DeleteUrl = $model->DeleteUrl();

		// Call Row_Rendering event
		$model->Row_Rendering();

		// Common render codes for all row types
		// coid
		// moid
		// model_name

		if ($model->RowType == EW_ROWTYPE_VIEW) { // View row

			// coid
			$model->coid->ViewValue = $model->coid->CurrentValue;
			$model->coid->ViewCustomAttributes = "";

			// moid
			$model->moid->ViewValue = $model->moid->CurrentValue;
			$model->moid->ViewCustomAttributes = "";

			// model_name
			$model->model_name->ViewValue = $model->model_name->CurrentValue;
			$model->model_name->ViewCustomAttributes = "";

			// coid
			$model->coid->LinkCustomAttributes = "";
			$model->coid->HrefValue = "";
			$model->coid->TooltipValue = "";

			// moid
			$model->moid->LinkCustomAttributes = "";
			$model->moid->HrefValue = "";
			$model->moid->TooltipValue = "";

			// model_name
			$model->model_name->LinkCustomAttributes = "";
			$model->model_name->HrefValue = "";
			$model->model_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($model->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$model->Row_Rendered();
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
