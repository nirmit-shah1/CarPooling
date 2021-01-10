<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "routedetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$routedetails_list = new croutedetails_list();
$Page =& $routedetails_list;

// Page init
$routedetails_list->Page_Init();

// Page main
$routedetails_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($routedetails->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var routedetails_list = new ew_Page("routedetails_list");

// page properties
routedetails_list.PageID = "list"; // page ID
routedetails_list.FormID = "froutedetailslist"; // form ID
var EW_PAGE_ID = routedetails_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
routedetails_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
routedetails_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
routedetails_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($routedetails->Export == "") || (EW_EXPORT_MASTER_RECORD && $routedetails->Export == "print")) { ?>
<?php } ?>
<?php $routedetails_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$routedetails_list->TotalRecs = $routedetails->SelectRecordCount();
	} else {
		if ($routedetails_list->Recordset = $routedetails_list->LoadRecordset())
			$routedetails_list->TotalRecs = $routedetails_list->Recordset->RecordCount();
	}
	$routedetails_list->StartRec = 1;
	if ($routedetails_list->DisplayRecs <= 0 || ($routedetails->Export <> "" && $routedetails->ExportAll)) // Display all records
		$routedetails_list->DisplayRecs = $routedetails_list->TotalRecs;
	if (!($routedetails->Export <> "" && $routedetails->ExportAll))
		$routedetails_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$routedetails_list->Recordset = $routedetails_list->LoadRecordset($routedetails_list->StartRec-1, $routedetails_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $routedetails->TableCaption() ?>
&nbsp;&nbsp;<?php $routedetails_list->ExportOptions->Render("body"); ?>
</p>
<?php
$routedetails_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="froutedetailslist" id="froutedetailslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="routedetails">
<div id="gmp_routedetails" class="ewGridMiddlePanel">
<?php if ($routedetails_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $routedetails->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$routedetails_list->RenderListOptions();

// Render list options (header, left)
$routedetails_list->ListOptions->Render("header", "left");
?>
<?php if ($routedetails->reg_id->Visible) { // reg_id ?>
	<?php if ($routedetails->SortUrl($routedetails->reg_id) == "") { ?>
		<td><?php echo $routedetails->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $routedetails->SortUrl($routedetails->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $routedetails->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($routedetails->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($routedetails->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($routedetails->mid->Visible) { // mid ?>
	<?php if ($routedetails->SortUrl($routedetails->mid) == "") { ?>
		<td><?php echo $routedetails->mid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $routedetails->SortUrl($routedetails->mid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $routedetails->mid->FldCaption() ?></td><td style="width: 10px;"><?php if ($routedetails->mid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($routedetails->mid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$routedetails_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($routedetails->ExportAll && $routedetails->Export <> "") {
	$routedetails_list->StopRec = $routedetails_list->TotalRecs;
} else {

	// Set the last record to display
	if ($routedetails_list->TotalRecs > $routedetails_list->StartRec + $routedetails_list->DisplayRecs - 1)
		$routedetails_list->StopRec = $routedetails_list->StartRec + $routedetails_list->DisplayRecs - 1;
	else
		$routedetails_list->StopRec = $routedetails_list->TotalRecs;
}
$routedetails_list->RecCnt = $routedetails_list->StartRec - 1;
if ($routedetails_list->Recordset && !$routedetails_list->Recordset->EOF) {
	$routedetails_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $routedetails_list->StartRec > 1)
		$routedetails_list->Recordset->Move($routedetails_list->StartRec - 1);
} elseif (!$routedetails->AllowAddDeleteRow && $routedetails_list->StopRec == 0) {
	$routedetails_list->StopRec = $routedetails->GridAddRowCount;
}

// Initialize aggregate
$routedetails->RowType = EW_ROWTYPE_AGGREGATEINIT;
$routedetails->ResetAttrs();
$routedetails_list->RenderRow();
$routedetails_list->RowCnt = 0;
while ($routedetails_list->RecCnt < $routedetails_list->StopRec) {
	$routedetails_list->RecCnt++;
	if (intval($routedetails_list->RecCnt) >= intval($routedetails_list->StartRec)) {
		$routedetails_list->RowCnt++;

		// Set up key count
		$routedetails_list->KeyCount = $routedetails_list->RowIndex;

		// Init row class and style
		$routedetails->ResetAttrs();
		$routedetails->CssClass = "";
		$routedetails->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($routedetails_list->RowIndex))
			$routedetails->RowAttrs = array_merge($routedetails->RowAttrs, array('data-rowindex'=>$routedetails_list->RowIndex, 'id'=>'r' . $routedetails_list->RowIndex . '_routedetails'));
		if ($routedetails->CurrentAction == "gridadd") {
			$routedetails_list->LoadDefaultValues(); // Load default values
		} else {
			$routedetails_list->LoadRowValues($routedetails_list->Recordset); // Load row values
		}
		$routedetails->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$routedetails_list->RenderRow();

		// Render list options
		$routedetails_list->RenderListOptions();
?>
	<tr<?php echo $routedetails->RowAttributes() ?>>
<?php

// Render list options (body, left)
$routedetails_list->ListOptions->Render("body", "left");
?>
	<?php if ($routedetails->reg_id->Visible) { // reg_id ?>
		<td<?php echo $routedetails->reg_id->CellAttributes() ?>>
<div<?php echo $routedetails->reg_id->ViewAttributes() ?>><?php echo $routedetails->reg_id->ListViewValue() ?></div>
<a name="<?php echo $routedetails_list->PageObjName . "_row_" . $routedetails_list->RowCnt ?>" id="<?php echo $routedetails_list->PageObjName . "_row_" . $routedetails_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($routedetails->mid->Visible) { // mid ?>
		<td<?php echo $routedetails->mid->CellAttributes() ?>>
<div<?php echo $routedetails->mid->ViewAttributes() ?>><?php echo $routedetails->mid->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$routedetails_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($routedetails->CurrentAction <> "gridadd")
		$routedetails_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($routedetails_list->Recordset)
	$routedetails_list->Recordset->Close();
?>
<?php if ($routedetails->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($routedetails->CurrentAction <> "gridadd" && $routedetails->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($routedetails_list->Pager)) $routedetails_list->Pager = new cPrevNextPager($routedetails_list->StartRec, $routedetails_list->DisplayRecs, $routedetails_list->TotalRecs) ?>
<?php if ($routedetails_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($routedetails_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $routedetails_list->PageUrl() ?>start=<?php echo $routedetails_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($routedetails_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $routedetails_list->PageUrl() ?>start=<?php echo $routedetails_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $routedetails_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($routedetails_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $routedetails_list->PageUrl() ?>start=<?php echo $routedetails_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($routedetails_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $routedetails_list->PageUrl() ?>start=<?php echo $routedetails_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $routedetails_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $routedetails_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $routedetails_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $routedetails_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($routedetails_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $routedetails_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($routedetails->Export == "" && $routedetails->CurrentAction == "") { ?>
<?php } ?>
<?php
$routedetails_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($routedetails->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$routedetails_list->Page_Terminate();
?>
<?php

//
// Page class
//
class croutedetails_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'routedetails';

	// Page object name
	var $PageObjName = 'routedetails_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $routedetails;
		if ($routedetails->UseTokenInUrl) $PageUrl .= "t=" . $routedetails->TableVar . "&"; // Add page token
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
		global $objForm, $routedetails;
		if ($routedetails->UseTokenInUrl) {
			if ($objForm)
				return ($routedetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($routedetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function croutedetails_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (routedetails)
		if (!isset($GLOBALS["routedetails"])) {
			$GLOBALS["routedetails"] = new croutedetails();
			$GLOBALS["Table"] =& $GLOBALS["routedetails"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "routedetailsadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "routedetailsdelete.php";
		$this->MultiUpdateUrl = "routedetailsupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'routedetails', TRUE);

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
		global $routedetails;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$routedetails->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $routedetails;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($routedetails->Export <> "" ||
				$routedetails->CurrentAction == "gridadd" ||
				$routedetails->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($routedetails->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $routedetails->getRecordsPerPage(); // Restore from Session
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
		$routedetails->setSessionWhere($sFilter);
		$routedetails->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $routedetails;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$routedetails->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$routedetails->CurrentOrderType = @$_GET["ordertype"];
			$routedetails->UpdateSort($routedetails->reg_id); // reg_id
			$routedetails->UpdateSort($routedetails->mid); // mid
			$routedetails->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $routedetails;
		$sOrderBy = $routedetails->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($routedetails->SqlOrderBy() <> "") {
				$sOrderBy = $routedetails->SqlOrderBy();
				$routedetails->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $routedetails;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$routedetails->setSessionOrderBy($sOrderBy);
				$routedetails->reg_id->setSort("");
				$routedetails->mid->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$routedetails->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $routedetails;

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
		global $Security, $Language, $routedetails, $objForm;
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
		global $Security, $Language, $routedetails;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $routedetails;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$routedetails->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$routedetails->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $routedetails->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$routedetails->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$routedetails->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$routedetails->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $routedetails;

		// Call Recordset Selecting event
		$routedetails->Recordset_Selecting($routedetails->CurrentFilter);

		// Load List page SQL
		$sSql = $routedetails->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$routedetails->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $routedetails;
		$sFilter = $routedetails->KeyFilter();

		// Call Row Selecting event
		$routedetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$routedetails->CurrentFilter = $sFilter;
		$sSql = $routedetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$routedetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $routedetails;
		if (!$rs || $rs->EOF) return;
		$routedetails->reg_id->setDbValue($rs->fields('reg_id'));
		$routedetails->mid->setDbValue($rs->fields('mid'));
		$routedetails->source->setDbValue($rs->fields('source'));
		$routedetails->destination->setDbValue($rs->fields('destination'));
		$routedetails->intermediatedestination1->setDbValue($rs->fields('intermediatedestination1'));
		$routedetails->intermediatedestination2->setDbValue($rs->fields('intermediatedestination2'));
	}

	// Load old record
	function LoadOldRecord() {
		global $routedetails;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($routedetails->getKey("mid")) <> "")
			$routedetails->mid->CurrentValue = $routedetails->getKey("mid"); // mid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$routedetails->CurrentFilter = $routedetails->KeyFilter();
			$sSql = $routedetails->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $routedetails;

		// Initialize URLs
		$this->ViewUrl = $routedetails->ViewUrl();
		$this->EditUrl = $routedetails->EditUrl();
		$this->InlineEditUrl = $routedetails->InlineEditUrl();
		$this->CopyUrl = $routedetails->CopyUrl();
		$this->InlineCopyUrl = $routedetails->InlineCopyUrl();
		$this->DeleteUrl = $routedetails->DeleteUrl();

		// Call Row_Rendering event
		$routedetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// source
		// destination
		// intermediatedestination1
		// intermediatedestination2

		if ($routedetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$routedetails->reg_id->ViewValue = $routedetails->reg_id->CurrentValue;
			$routedetails->reg_id->ViewCustomAttributes = "";

			// mid
			$routedetails->mid->ViewValue = $routedetails->mid->CurrentValue;
			$routedetails->mid->ViewCustomAttributes = "";

			// reg_id
			$routedetails->reg_id->LinkCustomAttributes = "";
			$routedetails->reg_id->HrefValue = "";
			$routedetails->reg_id->TooltipValue = "";

			// mid
			$routedetails->mid->LinkCustomAttributes = "";
			$routedetails->mid->HrefValue = "";
			$routedetails->mid->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($routedetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$routedetails->Row_Rendered();
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
