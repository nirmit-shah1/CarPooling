<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "counterinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$counter_list = new ccounter_list();
$Page =& $counter_list;

// Page init
$counter_list->Page_Init();

// Page main
$counter_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($counter->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var counter_list = new ew_Page("counter_list");

// page properties
counter_list.PageID = "list"; // page ID
counter_list.FormID = "fcounterlist"; // form ID
var EW_PAGE_ID = counter_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
counter_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
counter_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
counter_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($counter->Export == "") || (EW_EXPORT_MASTER_RECORD && $counter->Export == "print")) { ?>
<?php } ?>
<?php $counter_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$counter_list->TotalRecs = $counter->SelectRecordCount();
	} else {
		if ($counter_list->Recordset = $counter_list->LoadRecordset())
			$counter_list->TotalRecs = $counter_list->Recordset->RecordCount();
	}
	$counter_list->StartRec = 1;
	if ($counter_list->DisplayRecs <= 0 || ($counter->Export <> "" && $counter->ExportAll)) // Display all records
		$counter_list->DisplayRecs = $counter_list->TotalRecs;
	if (!($counter->Export <> "" && $counter->ExportAll))
		$counter_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$counter_list->Recordset = $counter_list->LoadRecordset($counter_list->StartRec-1, $counter_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $counter->TableCaption() ?>
&nbsp;&nbsp;<?php $counter_list->ExportOptions->Render("body"); ?>
</p>
<?php
$counter_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcounterlist" id="fcounterlist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="counter">
<div id="gmp_counter" class="ewGridMiddlePanel">
<?php if ($counter_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $counter->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$counter_list->RenderListOptions();

// Render list options (header, left)
$counter_list->ListOptions->Render("header", "left");
?>
<?php if ($counter->cnid->Visible) { // cnid ?>
	<?php if ($counter->SortUrl($counter->cnid) == "") { ?>
		<td><?php echo $counter->cnid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $counter->SortUrl($counter->cnid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $counter->cnid->FldCaption() ?></td><td style="width: 10px;"><?php if ($counter->cnid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($counter->cnid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($counter->reg_id->Visible) { // reg_id ?>
	<?php if ($counter->SortUrl($counter->reg_id) == "") { ?>
		<td><?php echo $counter->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $counter->SortUrl($counter->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $counter->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($counter->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($counter->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($counter->counter_1->Visible) { // counter ?>
	<?php if ($counter->SortUrl($counter->counter_1) == "") { ?>
		<td><?php echo $counter->counter_1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $counter->SortUrl($counter->counter_1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $counter->counter_1->FldCaption() ?></td><td style="width: 10px;"><?php if ($counter->counter_1->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($counter->counter_1->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$counter_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($counter->ExportAll && $counter->Export <> "") {
	$counter_list->StopRec = $counter_list->TotalRecs;
} else {

	// Set the last record to display
	if ($counter_list->TotalRecs > $counter_list->StartRec + $counter_list->DisplayRecs - 1)
		$counter_list->StopRec = $counter_list->StartRec + $counter_list->DisplayRecs - 1;
	else
		$counter_list->StopRec = $counter_list->TotalRecs;
}
$counter_list->RecCnt = $counter_list->StartRec - 1;
if ($counter_list->Recordset && !$counter_list->Recordset->EOF) {
	$counter_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $counter_list->StartRec > 1)
		$counter_list->Recordset->Move($counter_list->StartRec - 1);
} elseif (!$counter->AllowAddDeleteRow && $counter_list->StopRec == 0) {
	$counter_list->StopRec = $counter->GridAddRowCount;
}

// Initialize aggregate
$counter->RowType = EW_ROWTYPE_AGGREGATEINIT;
$counter->ResetAttrs();
$counter_list->RenderRow();
$counter_list->RowCnt = 0;
while ($counter_list->RecCnt < $counter_list->StopRec) {
	$counter_list->RecCnt++;
	if (intval($counter_list->RecCnt) >= intval($counter_list->StartRec)) {
		$counter_list->RowCnt++;

		// Set up key count
		$counter_list->KeyCount = $counter_list->RowIndex;

		// Init row class and style
		$counter->ResetAttrs();
		$counter->CssClass = "";
		$counter->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($counter_list->RowIndex))
			$counter->RowAttrs = array_merge($counter->RowAttrs, array('data-rowindex'=>$counter_list->RowIndex, 'id'=>'r' . $counter_list->RowIndex . '_counter'));
		if ($counter->CurrentAction == "gridadd") {
			$counter_list->LoadDefaultValues(); // Load default values
		} else {
			$counter_list->LoadRowValues($counter_list->Recordset); // Load row values
		}
		$counter->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$counter_list->RenderRow();

		// Render list options
		$counter_list->RenderListOptions();
?>
	<tr<?php echo $counter->RowAttributes() ?>>
<?php

// Render list options (body, left)
$counter_list->ListOptions->Render("body", "left");
?>
	<?php if ($counter->cnid->Visible) { // cnid ?>
		<td<?php echo $counter->cnid->CellAttributes() ?>>
<div<?php echo $counter->cnid->ViewAttributes() ?>><?php echo $counter->cnid->ListViewValue() ?></div>
<a name="<?php echo $counter_list->PageObjName . "_row_" . $counter_list->RowCnt ?>" id="<?php echo $counter_list->PageObjName . "_row_" . $counter_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($counter->reg_id->Visible) { // reg_id ?>
		<td<?php echo $counter->reg_id->CellAttributes() ?>>
<div<?php echo $counter->reg_id->ViewAttributes() ?>><?php echo $counter->reg_id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($counter->counter_1->Visible) { // counter ?>
		<td<?php echo $counter->counter_1->CellAttributes() ?>>
<div<?php echo $counter->counter_1->ViewAttributes() ?>><?php echo $counter->counter_1->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$counter_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($counter->CurrentAction <> "gridadd")
		$counter_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($counter_list->Recordset)
	$counter_list->Recordset->Close();
?>
<?php if ($counter->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($counter->CurrentAction <> "gridadd" && $counter->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($counter_list->Pager)) $counter_list->Pager = new cPrevNextPager($counter_list->StartRec, $counter_list->DisplayRecs, $counter_list->TotalRecs) ?>
<?php if ($counter_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($counter_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $counter_list->PageUrl() ?>start=<?php echo $counter_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($counter_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $counter_list->PageUrl() ?>start=<?php echo $counter_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $counter_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($counter_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $counter_list->PageUrl() ?>start=<?php echo $counter_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($counter_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $counter_list->PageUrl() ?>start=<?php echo $counter_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $counter_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $counter_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $counter_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $counter_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($counter_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $counter_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($counter->Export == "" && $counter->CurrentAction == "") { ?>
<?php } ?>
<?php
$counter_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($counter->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$counter_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccounter_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'counter';

	// Page object name
	var $PageObjName = 'counter_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $counter;
		if ($counter->UseTokenInUrl) $PageUrl .= "t=" . $counter->TableVar . "&"; // Add page token
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
		global $objForm, $counter;
		if ($counter->UseTokenInUrl) {
			if ($objForm)
				return ($counter->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($counter->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccounter_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (counter)
		if (!isset($GLOBALS["counter"])) {
			$GLOBALS["counter"] = new ccounter();
			$GLOBALS["Table"] =& $GLOBALS["counter"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "counteradd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "counterdelete.php";
		$this->MultiUpdateUrl = "counterupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'counter', TRUE);

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
		global $counter;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$counter->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $counter;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($counter->Export <> "" ||
				$counter->CurrentAction == "gridadd" ||
				$counter->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($counter->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $counter->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build filter
		$sFilter = "";
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter in session
		$counter->setSessionWhere($sFilter);
		$counter->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $counter;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$counter->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$counter->CurrentOrderType = @$_GET["ordertype"];
			$counter->UpdateSort($counter->cnid); // cnid
			$counter->UpdateSort($counter->reg_id); // reg_id
			$counter->UpdateSort($counter->counter_1); // counter
			$counter->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $counter;
		$sOrderBy = $counter->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($counter->SqlOrderBy() <> "") {
				$sOrderBy = $counter->SqlOrderBy();
				$counter->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $counter;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$counter->setSessionOrderBy($sOrderBy);
				$counter->cnid->setSort("");
				$counter->reg_id->setSort("");
				$counter->counter_1->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$counter->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $counter;

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
		global $Security, $Language, $counter, $objForm;
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
		global $Security, $Language, $counter;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $counter;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$counter->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$counter->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $counter->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$counter->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$counter->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$counter->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $counter;

		// Call Recordset Selecting event
		$counter->Recordset_Selecting($counter->CurrentFilter);

		// Load List page SQL
		$sSql = $counter->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$counter->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $counter;
		$sFilter = $counter->KeyFilter();

		// Call Row Selecting event
		$counter->Row_Selecting($sFilter);

		// Load SQL based on filter
		$counter->CurrentFilter = $sFilter;
		$sSql = $counter->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$counter->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $counter;
		if (!$rs || $rs->EOF) return;
		$counter->cnid->setDbValue($rs->fields('cnid'));
		$counter->reg_id->setDbValue($rs->fields('reg_id'));
		$counter->counter_1->setDbValue($rs->fields('counter'));
	}

	// Load old record
	function LoadOldRecord() {
		global $counter;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($counter->getKey("cnid")) <> "")
			$counter->cnid->CurrentValue = $counter->getKey("cnid"); // cnid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$counter->CurrentFilter = $counter->KeyFilter();
			$sSql = $counter->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $counter;

		// Initialize URLs
		$this->ViewUrl = $counter->ViewUrl();
		$this->EditUrl = $counter->EditUrl();
		$this->InlineEditUrl = $counter->InlineEditUrl();
		$this->CopyUrl = $counter->CopyUrl();
		$this->InlineCopyUrl = $counter->InlineCopyUrl();
		$this->DeleteUrl = $counter->DeleteUrl();

		// Call Row_Rendering event
		$counter->Row_Rendering();

		// Common render codes for all row types
		// cnid
		// reg_id
		// counter

		if ($counter->RowType == EW_ROWTYPE_VIEW) { // View row

			// cnid
			$counter->cnid->ViewValue = $counter->cnid->CurrentValue;
			$counter->cnid->ViewCustomAttributes = "";

			// reg_id
			$counter->reg_id->ViewValue = $counter->reg_id->CurrentValue;
			$counter->reg_id->ViewCustomAttributes = "";

			// counter
			$counter->counter_1->ViewValue = $counter->counter_1->CurrentValue;
			$counter->counter_1->ViewCustomAttributes = "";

			// cnid
			$counter->cnid->LinkCustomAttributes = "";
			$counter->cnid->HrefValue = "";
			$counter->cnid->TooltipValue = "";

			// reg_id
			$counter->reg_id->LinkCustomAttributes = "";
			$counter->reg_id->HrefValue = "";
			$counter->reg_id->TooltipValue = "";

			// counter
			$counter->counter_1->LinkCustomAttributes = "";
			$counter->counter_1->HrefValue = "";
			$counter->counter_1->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($counter->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$counter->Row_Rendered();
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
