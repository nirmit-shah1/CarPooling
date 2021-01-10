<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "privatemessageinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$privatemessage_list = new cprivatemessage_list();
$Page =& $privatemessage_list;

// Page init
$privatemessage_list->Page_Init();

// Page main
$privatemessage_list->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($privatemessage->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var privatemessage_list = new ew_Page("privatemessage_list");

// page properties
privatemessage_list.PageID = "list"; // page ID
privatemessage_list.FormID = "fprivatemessagelist"; // form ID
var EW_PAGE_ID = privatemessage_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
privatemessage_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
privatemessage_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
privatemessage_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php if (($privatemessage->Export == "") || (EW_EXPORT_MASTER_RECORD && $privatemessage->Export == "print")) { ?>
<?php } ?>
<?php $privatemessage_list->ShowPageHeader(); ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$privatemessage_list->TotalRecs = $privatemessage->SelectRecordCount();
	} else {
		if ($privatemessage_list->Recordset = $privatemessage_list->LoadRecordset())
			$privatemessage_list->TotalRecs = $privatemessage_list->Recordset->RecordCount();
	}
	$privatemessage_list->StartRec = 1;
	if ($privatemessage_list->DisplayRecs <= 0 || ($privatemessage->Export <> "" && $privatemessage->ExportAll)) // Display all records
		$privatemessage_list->DisplayRecs = $privatemessage_list->TotalRecs;
	if (!($privatemessage->Export <> "" && $privatemessage->ExportAll))
		$privatemessage_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$privatemessage_list->Recordset = $privatemessage_list->LoadRecordset($privatemessage_list->StartRec-1, $privatemessage_list->DisplayRecs);
?>
<p class="phpmaker ewTitle" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $privatemessage->TableCaption() ?>
&nbsp;&nbsp;<?php $privatemessage_list->ExportOptions->Render("body"); ?>
</p>
<?php
$privatemessage_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fprivatemessagelist" id="fprivatemessagelist" class="ewForm" action="" method="post">
<input type="hidden" name="t" id="t" value="privatemessage">
<div id="gmp_privatemessage" class="ewGridMiddlePanel">
<?php if ($privatemessage_list->TotalRecs > 0) { ?>
<table cellspacing="0" data-rowhighlightclass="ewTableHighlightRow" data-rowselectclass="ewTableSelectRow" data-roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $privatemessage->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$privatemessage_list->RenderListOptions();

// Render list options (header, left)
$privatemessage_list->ListOptions->Render("header", "left");
?>
<?php if ($privatemessage->messageid->Visible) { // messageid ?>
	<?php if ($privatemessage->SortUrl($privatemessage->messageid) == "") { ?>
		<td><?php echo $privatemessage->messageid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $privatemessage->SortUrl($privatemessage->messageid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $privatemessage->messageid->FldCaption() ?></td><td style="width: 10px;"><?php if ($privatemessage->messageid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($privatemessage->messageid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($privatemessage->senderid->Visible) { // senderid ?>
	<?php if ($privatemessage->SortUrl($privatemessage->senderid) == "") { ?>
		<td><?php echo $privatemessage->senderid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $privatemessage->SortUrl($privatemessage->senderid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $privatemessage->senderid->FldCaption() ?></td><td style="width: 10px;"><?php if ($privatemessage->senderid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($privatemessage->senderid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($privatemessage->receiverid->Visible) { // receiverid ?>
	<?php if ($privatemessage->SortUrl($privatemessage->receiverid) == "") { ?>
		<td><?php echo $privatemessage->receiverid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $privatemessage->SortUrl($privatemessage->receiverid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $privatemessage->receiverid->FldCaption() ?></td><td style="width: 10px;"><?php if ($privatemessage->receiverid->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($privatemessage->receiverid->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($privatemessage->counter->Visible) { // counter ?>
	<?php if ($privatemessage->SortUrl($privatemessage->counter) == "") { ?>
		<td><?php echo $privatemessage->counter->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $privatemessage->SortUrl($privatemessage->counter) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $privatemessage->counter->FldCaption() ?></td><td style="width: 10px;"><?php if ($privatemessage->counter->getSort() == "ASC") { ?><img src="phpimages/sortup.gif" width="10" height="9" border="0"><?php } elseif ($privatemessage->counter->getSort() == "DESC") { ?><img src="phpimages/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$privatemessage_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($privatemessage->ExportAll && $privatemessage->Export <> "") {
	$privatemessage_list->StopRec = $privatemessage_list->TotalRecs;
} else {

	// Set the last record to display
	if ($privatemessage_list->TotalRecs > $privatemessage_list->StartRec + $privatemessage_list->DisplayRecs - 1)
		$privatemessage_list->StopRec = $privatemessage_list->StartRec + $privatemessage_list->DisplayRecs - 1;
	else
		$privatemessage_list->StopRec = $privatemessage_list->TotalRecs;
}
$privatemessage_list->RecCnt = $privatemessage_list->StartRec - 1;
if ($privatemessage_list->Recordset && !$privatemessage_list->Recordset->EOF) {
	$privatemessage_list->Recordset->MoveFirst();
	if (!$bSelectLimit && $privatemessage_list->StartRec > 1)
		$privatemessage_list->Recordset->Move($privatemessage_list->StartRec - 1);
} elseif (!$privatemessage->AllowAddDeleteRow && $privatemessage_list->StopRec == 0) {
	$privatemessage_list->StopRec = $privatemessage->GridAddRowCount;
}

// Initialize aggregate
$privatemessage->RowType = EW_ROWTYPE_AGGREGATEINIT;
$privatemessage->ResetAttrs();
$privatemessage_list->RenderRow();
$privatemessage_list->RowCnt = 0;
while ($privatemessage_list->RecCnt < $privatemessage_list->StopRec) {
	$privatemessage_list->RecCnt++;
	if (intval($privatemessage_list->RecCnt) >= intval($privatemessage_list->StartRec)) {
		$privatemessage_list->RowCnt++;

		// Set up key count
		$privatemessage_list->KeyCount = $privatemessage_list->RowIndex;

		// Init row class and style
		$privatemessage->ResetAttrs();
		$privatemessage->CssClass = "";
		$privatemessage->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
		if (!empty($privatemessage_list->RowIndex))
			$privatemessage->RowAttrs = array_merge($privatemessage->RowAttrs, array('data-rowindex'=>$privatemessage_list->RowIndex, 'id'=>'r' . $privatemessage_list->RowIndex . '_privatemessage'));
		if ($privatemessage->CurrentAction == "gridadd") {
			$privatemessage_list->LoadDefaultValues(); // Load default values
		} else {
			$privatemessage_list->LoadRowValues($privatemessage_list->Recordset); // Load row values
		}
		$privatemessage->RowType = EW_ROWTYPE_VIEW; // Render view

		// Render row
		$privatemessage_list->RenderRow();

		// Render list options
		$privatemessage_list->RenderListOptions();
?>
	<tr<?php echo $privatemessage->RowAttributes() ?>>
<?php

// Render list options (body, left)
$privatemessage_list->ListOptions->Render("body", "left");
?>
	<?php if ($privatemessage->messageid->Visible) { // messageid ?>
		<td<?php echo $privatemessage->messageid->CellAttributes() ?>>
<div<?php echo $privatemessage->messageid->ViewAttributes() ?>><?php echo $privatemessage->messageid->ListViewValue() ?></div>
<a name="<?php echo $privatemessage_list->PageObjName . "_row_" . $privatemessage_list->RowCnt ?>" id="<?php echo $privatemessage_list->PageObjName . "_row_" . $privatemessage_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($privatemessage->senderid->Visible) { // senderid ?>
		<td<?php echo $privatemessage->senderid->CellAttributes() ?>>
<div<?php echo $privatemessage->senderid->ViewAttributes() ?>><?php echo $privatemessage->senderid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($privatemessage->receiverid->Visible) { // receiverid ?>
		<td<?php echo $privatemessage->receiverid->CellAttributes() ?>>
<div<?php echo $privatemessage->receiverid->ViewAttributes() ?>><?php echo $privatemessage->receiverid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($privatemessage->counter->Visible) { // counter ?>
		<td<?php echo $privatemessage->counter->CellAttributes() ?>>
<div<?php echo $privatemessage->counter->ViewAttributes() ?>><?php echo $privatemessage->counter->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$privatemessage_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($privatemessage->CurrentAction <> "gridadd")
		$privatemessage_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($privatemessage_list->Recordset)
	$privatemessage_list->Recordset->Close();
?>
<?php if ($privatemessage->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($privatemessage->CurrentAction <> "gridadd" && $privatemessage->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($privatemessage_list->Pager)) $privatemessage_list->Pager = new cPrevNextPager($privatemessage_list->StartRec, $privatemessage_list->DisplayRecs, $privatemessage_list->TotalRecs) ?>
<?php if ($privatemessage_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($privatemessage_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $privatemessage_list->PageUrl() ?>start=<?php echo $privatemessage_list->Pager->FirstButton->Start ?>"><img src="phpimages/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($privatemessage_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $privatemessage_list->PageUrl() ?>start=<?php echo $privatemessage_list->Pager->PrevButton->Start ?>"><img src="phpimages/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="phpimages/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $privatemessage_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($privatemessage_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $privatemessage_list->PageUrl() ?>start=<?php echo $privatemessage_list->Pager->NextButton->Start ?>"><img src="phpimages/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($privatemessage_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $privatemessage_list->PageUrl() ?>start=<?php echo $privatemessage_list->Pager->LastButton->Start ?>"><img src="phpimages/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="phpimages/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $privatemessage_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $privatemessage_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $privatemessage_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $privatemessage_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($privatemessage_list->SearchWhere == "0=101") { ?>
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
<a href="<?php echo $privatemessage_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
</span>
</div>
<?php } ?>
</td></tr></table>
<?php if ($privatemessage->Export == "" && $privatemessage->CurrentAction == "") { ?>
<?php } ?>
<?php
$privatemessage_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($privatemessage->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$privatemessage_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cprivatemessage_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'privatemessage';

	// Page object name
	var $PageObjName = 'privatemessage_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $privatemessage;
		if ($privatemessage->UseTokenInUrl) $PageUrl .= "t=" . $privatemessage->TableVar . "&"; // Add page token
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
		global $objForm, $privatemessage;
		if ($privatemessage->UseTokenInUrl) {
			if ($objForm)
				return ($privatemessage->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($privatemessage->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cprivatemessage_list() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (privatemessage)
		if (!isset($GLOBALS["privatemessage"])) {
			$GLOBALS["privatemessage"] = new cprivatemessage();
			$GLOBALS["Table"] =& $GLOBALS["privatemessage"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "privatemessageadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "privatemessagedelete.php";
		$this->MultiUpdateUrl = "privatemessageupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'privatemessage', TRUE);

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
		global $privatemessage;

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$privatemessage->GridAddRowCount = $gridaddcnt;

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
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $privatemessage;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Hide all options
			if ($privatemessage->Export <> "" ||
				$privatemessage->CurrentAction == "gridadd" ||
				$privatemessage->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ExportOptions->HideAllOptions();
			}

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($privatemessage->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $privatemessage->getRecordsPerPage(); // Restore from Session
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
		$privatemessage->setSessionWhere($sFilter);
		$privatemessage->CurrentFilter = "";
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $privatemessage;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$privatemessage->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$privatemessage->CurrentOrderType = @$_GET["ordertype"];
			$privatemessage->UpdateSort($privatemessage->messageid); // messageid
			$privatemessage->UpdateSort($privatemessage->senderid); // senderid
			$privatemessage->UpdateSort($privatemessage->receiverid); // receiverid
			$privatemessage->UpdateSort($privatemessage->counter); // counter
			$privatemessage->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $privatemessage;
		$sOrderBy = $privatemessage->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($privatemessage->SqlOrderBy() <> "") {
				$sOrderBy = $privatemessage->SqlOrderBy();
				$privatemessage->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $privatemessage;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$privatemessage->setSessionOrderBy($sOrderBy);
				$privatemessage->messageid->setSort("");
				$privatemessage->senderid->setSort("");
				$privatemessage->receiverid->setSort("");
				$privatemessage->counter->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$privatemessage->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language, $privatemessage;

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
		global $Security, $Language, $privatemessage, $objForm;
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
		global $Security, $Language, $privatemessage;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $privatemessage;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$privatemessage->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$privatemessage->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $privatemessage->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$privatemessage->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$privatemessage->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$privatemessage->setStartRecordNumber($this->StartRec);
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $privatemessage;

		// Call Recordset Selecting event
		$privatemessage->Recordset_Selecting($privatemessage->CurrentFilter);

		// Load List page SQL
		$sSql = $privatemessage->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $rowcnt OFFSET $offset";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$privatemessage->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $privatemessage;
		$sFilter = $privatemessage->KeyFilter();

		// Call Row Selecting event
		$privatemessage->Row_Selecting($sFilter);

		// Load SQL based on filter
		$privatemessage->CurrentFilter = $sFilter;
		$sSql = $privatemessage->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$privatemessage->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $privatemessage;
		if (!$rs || $rs->EOF) return;
		$privatemessage->messageid->setDbValue($rs->fields('messageid'));
		$privatemessage->senderid->setDbValue($rs->fields('senderid'));
		$privatemessage->receiverid->setDbValue($rs->fields('receiverid'));
		$privatemessage->message->setDbValue($rs->fields('message'));
		$privatemessage->counter->setDbValue($rs->fields('counter'));
	}

	// Load old record
	function LoadOldRecord() {
		global $privatemessage;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($privatemessage->getKey("messageid")) <> "")
			$privatemessage->messageid->CurrentValue = $privatemessage->getKey("messageid"); // messageid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$privatemessage->CurrentFilter = $privatemessage->KeyFilter();
			$sSql = $privatemessage->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $privatemessage;

		// Initialize URLs
		$this->ViewUrl = $privatemessage->ViewUrl();
		$this->EditUrl = $privatemessage->EditUrl();
		$this->InlineEditUrl = $privatemessage->InlineEditUrl();
		$this->CopyUrl = $privatemessage->CopyUrl();
		$this->InlineCopyUrl = $privatemessage->InlineCopyUrl();
		$this->DeleteUrl = $privatemessage->DeleteUrl();

		// Call Row_Rendering event
		$privatemessage->Row_Rendering();

		// Common render codes for all row types
		// messageid
		// senderid
		// receiverid
		// message
		// counter

		if ($privatemessage->RowType == EW_ROWTYPE_VIEW) { // View row

			// messageid
			$privatemessage->messageid->ViewValue = $privatemessage->messageid->CurrentValue;
			$privatemessage->messageid->ViewCustomAttributes = "";

			// senderid
			$privatemessage->senderid->ViewValue = $privatemessage->senderid->CurrentValue;
			$privatemessage->senderid->ViewCustomAttributes = "";

			// receiverid
			$privatemessage->receiverid->ViewValue = $privatemessage->receiverid->CurrentValue;
			$privatemessage->receiverid->ViewCustomAttributes = "";

			// counter
			$privatemessage->counter->ViewValue = $privatemessage->counter->CurrentValue;
			$privatemessage->counter->ViewCustomAttributes = "";

			// messageid
			$privatemessage->messageid->LinkCustomAttributes = "";
			$privatemessage->messageid->HrefValue = "";
			$privatemessage->messageid->TooltipValue = "";

			// senderid
			$privatemessage->senderid->LinkCustomAttributes = "";
			$privatemessage->senderid->HrefValue = "";
			$privatemessage->senderid->TooltipValue = "";

			// receiverid
			$privatemessage->receiverid->LinkCustomAttributes = "";
			$privatemessage->receiverid->HrefValue = "";
			$privatemessage->receiverid->TooltipValue = "";

			// counter
			$privatemessage->counter->LinkCustomAttributes = "";
			$privatemessage->counter->HrefValue = "";
			$privatemessage->counter->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($privatemessage->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$privatemessage->Row_Rendered();
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
