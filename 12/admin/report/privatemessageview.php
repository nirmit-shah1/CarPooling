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
$privatemessage_view = new cprivatemessage_view();
$Page =& $privatemessage_view;

// Page init
$privatemessage_view->Page_Init();

// Page main
$privatemessage_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($privatemessage->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var privatemessage_view = new ew_Page("privatemessage_view");

// page properties
privatemessage_view.PageID = "view"; // page ID
privatemessage_view.FormID = "fprivatemessageview"; // form ID
var EW_PAGE_ID = privatemessage_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
privatemessage_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
privatemessage_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
privatemessage_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $privatemessage_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $privatemessage->TableCaption() ?>
&nbsp;&nbsp;<?php $privatemessage_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($privatemessage->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $privatemessage_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $privatemessage_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $privatemessage_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $privatemessage_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $privatemessage_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$privatemessage_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($privatemessage->messageid->Visible) { // messageid ?>
	<tr id="r_messageid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->messageid->FldCaption() ?></td>
		<td<?php echo $privatemessage->messageid->CellAttributes() ?>>
<div<?php echo $privatemessage->messageid->ViewAttributes() ?>><?php echo $privatemessage->messageid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->senderid->Visible) { // senderid ?>
	<tr id="r_senderid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->senderid->FldCaption() ?></td>
		<td<?php echo $privatemessage->senderid->CellAttributes() ?>>
<div<?php echo $privatemessage->senderid->ViewAttributes() ?>><?php echo $privatemessage->senderid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->receiverid->Visible) { // receiverid ?>
	<tr id="r_receiverid"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->receiverid->FldCaption() ?></td>
		<td<?php echo $privatemessage->receiverid->CellAttributes() ?>>
<div<?php echo $privatemessage->receiverid->ViewAttributes() ?>><?php echo $privatemessage->receiverid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->message->Visible) { // message ?>
	<tr id="r_message"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->message->FldCaption() ?></td>
		<td<?php echo $privatemessage->message->CellAttributes() ?>>
<div<?php echo $privatemessage->message->ViewAttributes() ?>><?php echo $privatemessage->message->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($privatemessage->counter->Visible) { // counter ?>
	<tr id="r_counter"<?php echo $privatemessage->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $privatemessage->counter->FldCaption() ?></td>
		<td<?php echo $privatemessage->counter->CellAttributes() ?>>
<div<?php echo $privatemessage->counter->ViewAttributes() ?>><?php echo $privatemessage->counter->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$privatemessage_view->ShowPageFooter();
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
$privatemessage_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cprivatemessage_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'privatemessage';

	// Page object name
	var $PageObjName = 'privatemessage_view';

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
	function cprivatemessage_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (privatemessage)
		if (!isset($GLOBALS["privatemessage"])) {
			$GLOBALS["privatemessage"] = new cprivatemessage();
			$GLOBALS["Table"] =& $GLOBALS["privatemessage"];
		}
		$KeyUrl = "";
		if (@$_GET["messageid"] <> "") {
			$this->RecKey["messageid"] = $_GET["messageid"];
			$KeyUrl .= "&messageid=" . urlencode($this->RecKey["messageid"]);
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
			define("EW_TABLE_NAME", 'privatemessage', TRUE);

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
		global $privatemessage;

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
		global $Language, $privatemessage;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["messageid"] <> "") {
				$privatemessage->messageid->setQueryStringValue($_GET["messageid"]);
				$this->RecKey["messageid"] = $privatemessage->messageid->QueryStringValue;
			} else {
				$sReturnUrl = "privatemessagelist.php"; // Return to list
			}

			// Get action
			$privatemessage->CurrentAction = "I"; // Display form
			switch ($privatemessage->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "privatemessagelist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "privatemessagelist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$privatemessage->RowType = EW_ROWTYPE_VIEW;
		$privatemessage->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $privatemessage;

		// Initialize URLs
		$this->AddUrl = $privatemessage->AddUrl();
		$this->EditUrl = $privatemessage->EditUrl();
		$this->CopyUrl = $privatemessage->CopyUrl();
		$this->DeleteUrl = $privatemessage->DeleteUrl();
		$this->ListUrl = $privatemessage->ListUrl();

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

			// message
			$privatemessage->message->ViewValue = $privatemessage->message->CurrentValue;
			$privatemessage->message->ViewCustomAttributes = "";

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

			// message
			$privatemessage->message->LinkCustomAttributes = "";
			$privatemessage->message->HrefValue = "";
			$privatemessage->message->TooltipValue = "";

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
}
?>
