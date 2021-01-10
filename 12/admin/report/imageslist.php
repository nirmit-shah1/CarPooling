<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "imagesinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$images_list = new cimages_list();
$Page =& $images_list;

// Page init
$images_list->Page_Init();

// Page main
$images_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($images->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var images_list = new ew_Page("images_list");

// page properties
images_list.PageID = "list"; // page ID
images_list.FormID = "fimageslist"; // form ID
var EW_PAGE_ID = images_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
images_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
images_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
images_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($images->Export == "") || (EW_EXPORT_MASTER_RECORD && $images->Export == "print")) { ?>
<?php } ?>
<?php $images_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$images_list->TotalRecs = $images->SelectRecordCount();
	} else {
		if ($images_list->Recordset = $images_list->LoadRecordset())
			$images_list->TotalRecs = $images_list->Recordset->RecordCount();
	}
	$images_list->StartRec = 1;
	if ($images_list->DisplayRecs <= 0 || ($images->Export <> "" && $images->ExportAll)) // Display all records
		$images_list->DisplayRecs = $images_list->TotalRecs;
	if (!($images->Export <> "" && $images->ExportAll))
		$images_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$images_list->Recordset = $images_list->LoadRecordset($images_list->StartRec-1, $images_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $images->TableCaption() ?>
&nbsp;&nbsp;<?php $images_list->ExportOptions->Render("body"); ?>
</p>
<?php
$images_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fimageslist" id="fimageslist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="images">
<div id="gmp_images" class="ewGridMiddlePanel">
<?php if ($images_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $images->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$images_list->RenderListOptions();

// Render list options (header, left)
$images_list->ListOptions->Render("header", "left");
?>
<?php if ($images->reg_id->Visible) { // reg_id ?>
	<?php if ($images->SortUrl($images->reg_id) == "") { ?>
		<td><?php echo $images->reg_id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $images->SortUrl($images->reg_id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $images->reg_id->FldCaption() ?></td><td style="width: 10px;"><?php if ($images->reg_id->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($images->reg_id->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$images_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($images->ExportAll && $images->Export <> "") {
	$images_list->StopRec = $images_list->TotalRecs;
} else {

	// Set the last record to display
	if ($images_list->TotalRecs > $images_list->StartRec + $images_list->DisplayRecs - 1)
		$images_list->StopRec = $images_list->StartRec + $images_list->DisplayRecs - 1;
	else
		$images_list->StopRec = $images_list->TotalRecs;
}
$images_list->RecCnt = $images_list->StartRec - 1;
if ($images_list->Recordset && !$images_list->Recordset->EOF) {
	$images_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $images_list->StartRec > 1)
		$images_list->Recordset->Move($images_list->StartRec - 1);
} elseif (!$images->AllowAddDeleteRow && $images_list->StopRec == 0) {
	$images_list->StopRec = $images->GridAddRowCount;
}

// Initialize aggregate
$images->RowType = EW_ROWTYPE_AGGREGATEINIT;
$images->ResetAttrs();
$images_list->RenderRow();
$images_list->RowCnt = 0;
while ($images_list->RecCnt < $images_list->StopRec) {
	$images_list->RecCnt++;
	if (intval($images_list->RecCnt) >= intval($images_list->StartRec)) {
		$images_list->RowCnt++;

		// Set up key count
		$images_list->KeyCount = $images_list->RowIndex;

		// Init row class and style
		$images->ResetAttrs();
		$images->CssClass = "";
		$images->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($images_list->RowIndex))
			$images->RowAttrs = array_merge($images->RowAttrs, array('data-rowindex'=>$images_list->RowIndex, 'id'=>'r' . $images_list->RowIndex . '_images'));
		if ($images->CurrentAction == "gridadd") {
			$images_list->LoadDefaultValues(); // Load default values
		} else {
			$images_list->LoadRowValues($images_list->Recordset); // Load row values
		}
		$images->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$images_list->RenderRow();

		// Render list options
		$images_list->RenderListOptions();
?>
	<tr<?php echo $images->RowAttributes() ?>>
<?php

// Render list options (body, left)
$images_list->ListOptions->Render("body", "left");
?>
	<?php if ($images->reg_id->Visible) { // reg_id ?>
		<td<?php echo $images->reg_id->CellAttributes() ?>>
<div<?php echo $images->reg_id->ViewAttributes() ?>><?php echo $images->reg_id->ListViewValue() ?></div>
<a name="<?php echo $images_list->PageObjName . "_row_" . $images_list->RowCnt ?>" id="<?php echo $images_list->PageObjName . "_row_" . $images_list->RowCnt ?>"></a></td>
	<?php } ?>
<?php

// Render list options (body, right)
$images_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($images->CurrentAction <> "gridadd")
		$images_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($images_list->Recordset)
	$images_list->Recordset->Close();
?>
<?php if ($images->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($images->CurrentAction <> "gridadd" && $images->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($images_list->Pager)) $images_list->Pager = new cPrevNextPager($images_list->StartRec, $images_list->DisplayRecs, $images_list->TotalRecs) ?>
<?php if ($images_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($images_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $images_list->PageUrl() ?>start=<?php echo $images_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($images_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $images_list->PageUrl() ?>start=<?php echo $images_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $images_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($images_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $images_list->PageUrl() ?>start=<?php echo $images_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($images_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $images_list->PageUrl() ?>start=<?php echo $images_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $images_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $images_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $images_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $images_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($images_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $images_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($images->Export == "" && $images->CurrentAction == "") { ?>
<?php } ?>
<?php
$images_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($images->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$images_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cimages_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'images';

	// Page object name
	var $PageObjName = 'images_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $images;
		if ($images->UseTokenInUrl) $PageUrl .= "t=" . $images->TableVar . "&"; // Add page token
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
		global $objForm, $images;
		if ($images->UseTokenInUrl) {
			if ($objForm)
				return ($images->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($images->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cimages_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (images)
		if (!isset($GLOBALS["images"])) {
			$GLOBALS["images"] = new cimages();
			$GLOBALS["Table"] =& $GLOBALS["images"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "imagesadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "imagesdelete.php";
		$this->MultiUpdateUrl = "imagesupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'images', TRUE);

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
		global $images;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$images->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $images;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($images->Export <> "" ||
				$images->CurrentAction == "gridadd" ||
				$images->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($images->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $images->getRecordsPerPage(); // Restore from Session
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
		$images->setSessionWhere($sFilter);
		$images->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $images;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$images->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$images->CurrentOrderType = @$_GET["ordertype"];
			$images->UpdateSort($images->reg_id); // reg_id
			$images->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $images;
		$sOrderBy = $images->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($images->SqlOrderBy() <> "") {
				$sOrderBy = $images->SqlOrderBy();
				$images->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $images;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$images->setSessionOrderBy($sOrderBy);
				$images->reg_id->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$images->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $images;

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
		global $Security, $Language, $images, $objForm;
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
		global $Security, $Language, $images;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $images;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$images->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$images->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $images->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$images->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$images->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$images->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $images;

		// Call Recordset Selecting event
		$images->Recordset_Selecting($images->CurrentFilter);

		// Load List page SQL
		$sSql = $images->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$images->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $images;
		$sFilter = $images->KeyFilter();

		// Call Row Selecting event
		$images->Row_Selecting($sFilter);

		// Load SQL based on filter
		$images->CurrentFilter = $sFilter;
		$sSql = $images->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$images->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $images;
		if (!$rs || $rs->EOF) return;
		$images->reg_id->setDbValue($rs->fields('reg_id'));
		$images->name->setDbValue($rs->fields('name'));
	}

	// Load old record
	function LoadOldRecord() {
		global $images;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($images->getKey("reg_id")) <> "")
			$images->reg_id->CurrentValue = $images->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$images->CurrentFilter = $images->KeyFilter();
			$sSql = $images->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $images;

		// Initialize URLs
		$this->ViewUrl = $images->ViewUrl();
		$this->EditUrl = $images->EditUrl();
		$this->InlineEditUrl = $images->InlineEditUrl();
		$this->CopyUrl = $images->CopyUrl();
		$this->InlineCopyUrl = $images->InlineCopyUrl();
		$this->DeleteUrl = $images->DeleteUrl();

		// Call Row_Rendering event
		$images->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// name

		if ($images->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$images->reg_id->ViewValue = $images->reg_id->CurrentValue;
			$images->reg_id->ViewCustomAttributes = "";

			// reg_id
			$images->reg_id->LinkCustomAttributes = "";
			$images->reg_id->HrefValue = "";
			$images->reg_id->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($images->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$images->Row_Rendered();
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
