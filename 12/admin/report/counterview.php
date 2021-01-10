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
$counter_view = new ccounter_view();
$Page =& $counter_view;

// Page init
$counter_view->Page_Init();

// Page main
$counter_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($counter->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var counter_view = new ew_Page("counter_view");

// page properties
counter_view.PageID = "view"; // page ID
counter_view.FormID = "fcounterview"; // form ID
var EW_PAGE_ID = counter_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
counter_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
counter_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
counter_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $counter_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $counter->TableCaption() ?>
&nbsp;&nbsp;<?php $counter_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($counter->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $counter_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $counter_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $counter_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $counter_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $counter_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$counter_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($counter->cnid->Visible) { // cnid ?>
	<tr id="r_cnid"<?php echo $counter->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $counter->cnid->FldCaption() ?></td>
		<td<?php echo $counter->cnid->CellAttributes() ?>>
<div<?php echo $counter->cnid->ViewAttributes() ?>><?php echo $counter->cnid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($counter->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $counter->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $counter->reg_id->FldCaption() ?></td>
		<td<?php echo $counter->reg_id->CellAttributes() ?>>
<div<?php echo $counter->reg_id->ViewAttributes() ?>><?php echo $counter->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($counter->counter_1->Visible) { // counter ?>
	<tr id="r_counter_1"<?php echo $counter->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $counter->counter_1->FldCaption() ?></td>
		<td<?php echo $counter->counter_1->CellAttributes() ?>>
<div<?php echo $counter->counter_1->ViewAttributes() ?>><?php echo $counter->counter_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$counter_view->ShowPageFooter();
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
$counter_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccounter_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'counter';

	// Page object name
	var $PageObjName = 'counter_view';

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
	function ccounter_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (counter)
		if (!isset($GLOBALS["counter"])) {
			$GLOBALS["counter"] = new ccounter();
			$GLOBALS["Table"] =& $GLOBALS["counter"];
		}
		$KeyUrl = "";
		if (@$_GET["cnid"] <> "") {
			$this->RecKey["cnid"] = $_GET["cnid"];
			$KeyUrl .= "&cnid=" . urlencode($this->RecKey["cnid"]);
		}
		$this->ExportPrintUrl = $this->PageUrl() . "export=print" . $KeyUrl;
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html" . $KeyUrl;
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel" . $KeyUrl;
		$this->ExportWordUrl = $this->PageUrl() . "export=word" . $KeyUrl;
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml" . $KeyUrl;
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv" . $KeyUrl;
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf" . $KeyUrl;

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'counter', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();

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
	var $ExportOptions; // Export options
	var $DisplayRecs = 1;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $RecCnt;
	var $RecKey = array();
	var $Recordset;

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $counter;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["cnid"] <> "") {
				$counter->cnid->setQueryStringValue($_GET["cnid"]);
				$this->RecKey["cnid"] = $counter->cnid->QueryStringValue;
			} else {
				$sReturnUrl = "counterlist.php"; // Return to list
			}

			// Get action
			$counter->CurrentAction = "I"; // Display form
			switch ($counter->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "counterlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "counterlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$counter->RowType = EW_ROWTYPE_VIEW;
		$counter->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $counter;

		// Initialize URLs
		$this->AddUrl = $counter->AddUrl();
		$this->EditUrl = $counter->EditUrl();
		$this->CopyUrl = $counter->CopyUrl();
		$this->DeleteUrl = $counter->DeleteUrl();
		$this->ListUrl = $counter->ListUrl();

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
}
?>
