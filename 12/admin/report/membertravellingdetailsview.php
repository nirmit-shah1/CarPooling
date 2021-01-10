<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "membertravellingdetailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$membertravellingdetails_view = new cmembertravellingdetails_view();
$Page =& $membertravellingdetails_view;

// Page init
$membertravellingdetails_view->Page_Init();

// Page main
$membertravellingdetails_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($membertravellingdetails->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var membertravellingdetails_view = new ew_Page("membertravellingdetails_view");

// page properties
membertravellingdetails_view.PageID = "view"; // page ID
membertravellingdetails_view.FormID = "fmembertravellingdetailsview"; // form ID
var EW_PAGE_ID = membertravellingdetails_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
membertravellingdetails_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
membertravellingdetails_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
membertravellingdetails_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $membertravellingdetails_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $membertravellingdetails->TableCaption() ?>
&nbsp;&nbsp;<?php $membertravellingdetails_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($membertravellingdetails->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $membertravellingdetails_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $membertravellingdetails_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $membertravellingdetails_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $membertravellingdetails_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $membertravellingdetails_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$membertravellingdetails_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($membertravellingdetails->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->reg_id->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->reg_id->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->reg_id->ViewAttributes() ?>><?php echo $membertravellingdetails->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->mid->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->mid->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->mid->ViewAttributes() ?>><?php echo $membertravellingdetails->mid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->pricepertraveler->Visible) { // pricepertraveler ?>
	<tr id="r_pricepertraveler"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->pricepertraveler->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->pricepertraveler->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->pricepertraveler->ViewAttributes() ?>><?php echo $membertravellingdetails->pricepertraveler->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->seatsavail->Visible) { // seatsavail ?>
	<tr id="r_seatsavail"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->seatsavail->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->seatsavail->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->seatsavail->ViewAttributes() ?>><?php echo $membertravellingdetails->seatsavail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->luggage->Visible) { // luggage ?>
	<tr id="r_luggage"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->luggage->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->luggage->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->luggage->ViewAttributes() ?>><?php echo $membertravellingdetails->luggage->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->leave->Visible) { // leave ?>
	<tr id="r_leave"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->leave->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->leave->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->leave->ViewAttributes() ?>><?php echo $membertravellingdetails->leave->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($membertravellingdetails->detour->Visible) { // detour ?>
	<tr id="r_detour"<?php echo $membertravellingdetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $membertravellingdetails->detour->FldCaption() ?></td>
		<td<?php echo $membertravellingdetails->detour->CellAttributes() ?>>
<div<?php echo $membertravellingdetails->detour->ViewAttributes() ?>><?php echo $membertravellingdetails->detour->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$membertravellingdetails_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($membertravellingdetails->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$membertravellingdetails_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembertravellingdetails_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'membertravellingdetails';

	// Page object name
	var $PageObjName = 'membertravellingdetails_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) $PageUrl .= "t=" . $membertravellingdetails->TableVar . "&"; // Add page token
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
		global $objForm, $membertravellingdetails;
		if ($membertravellingdetails->UseTokenInUrl) {
			if ($objForm)
				return ($membertravellingdetails->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($membertravellingdetails->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembertravellingdetails_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (membertravellingdetails)
		if (!isset($GLOBALS["membertravellingdetails"])) {
			$GLOBALS["membertravellingdetails"] = new cmembertravellingdetails();
			$GLOBALS["Table"] =& $GLOBALS["membertravellingdetails"];
		}
		$KeyUrl = "";
		if (@$_GET["mid"] <> "") {
			$this->RecKey["mid"] = $_GET["mid"];
			$KeyUrl .= "&mid=" . urlencode($this->RecKey["mid"]);
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
			define("EW_TABLE_NAME", 'membertravellingdetails', TRUE);

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
		global $membertravellingdetails;

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
		global $Language, $membertravellingdetails;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["mid"] <> "") {
				$membertravellingdetails->mid->setQueryStringValue($_GET["mid"]);
				$this->RecKey["mid"] = $membertravellingdetails->mid->QueryStringValue;
			} else {
				$sReturnUrl = "membertravellingdetailslist.php"; // Return to list
			}

			// Get action
			$membertravellingdetails->CurrentAction = "I"; // Display form
			switch ($membertravellingdetails->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "membertravellingdetailslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "membertravellingdetailslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$membertravellingdetails->RowType = EW_ROWTYPE_VIEW;
		$membertravellingdetails->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $membertravellingdetails;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$membertravellingdetails->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$membertravellingdetails->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $membertravellingdetails->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$membertravellingdetails->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $membertravellingdetails;
		$sFilter = $membertravellingdetails->KeyFilter();

		// Call Row Selecting event
		$membertravellingdetails->Row_Selecting($sFilter);

		// Load SQL based on filter
		$membertravellingdetails->CurrentFilter = $sFilter;
		$sSql = $membertravellingdetails->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$membertravellingdetails->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $membertravellingdetails;
		if (!$rs || $rs->EOF) return;
		$membertravellingdetails->reg_id->setDbValue($rs->fields('reg_id'));
		$membertravellingdetails->mid->setDbValue($rs->fields('mid'));
		$membertravellingdetails->pricepertraveler->setDbValue($rs->fields('pricepertraveler'));
		$membertravellingdetails->seatsavail->setDbValue($rs->fields('seatsavail'));
		$membertravellingdetails->luggage->setDbValue($rs->fields('luggage'));
		$membertravellingdetails->leave->setDbValue($rs->fields('leave'));
		$membertravellingdetails->detour->setDbValue($rs->fields('detour'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $membertravellingdetails;

		// Initialize URLs
		$this->AddUrl = $membertravellingdetails->AddUrl();
		$this->EditUrl = $membertravellingdetails->EditUrl();
		$this->CopyUrl = $membertravellingdetails->CopyUrl();
		$this->DeleteUrl = $membertravellingdetails->DeleteUrl();
		$this->ListUrl = $membertravellingdetails->ListUrl();

		// Call Row_Rendering event
		$membertravellingdetails->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// pricepertraveler
		// seatsavail
		// luggage
		// leave
		// detour

		if ($membertravellingdetails->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$membertravellingdetails->reg_id->ViewValue = $membertravellingdetails->reg_id->CurrentValue;
			$membertravellingdetails->reg_id->ViewCustomAttributes = "";

			// mid
			$membertravellingdetails->mid->ViewValue = $membertravellingdetails->mid->CurrentValue;
			$membertravellingdetails->mid->ViewCustomAttributes = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->ViewValue = $membertravellingdetails->pricepertraveler->CurrentValue;
			$membertravellingdetails->pricepertraveler->ViewCustomAttributes = "";

			// seatsavail
			$membertravellingdetails->seatsavail->ViewValue = $membertravellingdetails->seatsavail->CurrentValue;
			$membertravellingdetails->seatsavail->ViewCustomAttributes = "";

			// luggage
			$membertravellingdetails->luggage->ViewValue = $membertravellingdetails->luggage->CurrentValue;
			$membertravellingdetails->luggage->ViewCustomAttributes = "";

			// leave
			$membertravellingdetails->leave->ViewValue = $membertravellingdetails->leave->CurrentValue;
			$membertravellingdetails->leave->ViewCustomAttributes = "";

			// detour
			$membertravellingdetails->detour->ViewValue = $membertravellingdetails->detour->CurrentValue;
			$membertravellingdetails->detour->ViewCustomAttributes = "";

			// reg_id
			$membertravellingdetails->reg_id->LinkCustomAttributes = "";
			$membertravellingdetails->reg_id->HrefValue = "";
			$membertravellingdetails->reg_id->TooltipValue = "";

			// mid
			$membertravellingdetails->mid->LinkCustomAttributes = "";
			$membertravellingdetails->mid->HrefValue = "";
			$membertravellingdetails->mid->TooltipValue = "";

			// pricepertraveler
			$membertravellingdetails->pricepertraveler->LinkCustomAttributes = "";
			$membertravellingdetails->pricepertraveler->HrefValue = "";
			$membertravellingdetails->pricepertraveler->TooltipValue = "";

			// seatsavail
			$membertravellingdetails->seatsavail->LinkCustomAttributes = "";
			$membertravellingdetails->seatsavail->HrefValue = "";
			$membertravellingdetails->seatsavail->TooltipValue = "";

			// luggage
			$membertravellingdetails->luggage->LinkCustomAttributes = "";
			$membertravellingdetails->luggage->HrefValue = "";
			$membertravellingdetails->luggage->TooltipValue = "";

			// leave
			$membertravellingdetails->leave->LinkCustomAttributes = "";
			$membertravellingdetails->leave->HrefValue = "";
			$membertravellingdetails->leave->TooltipValue = "";

			// detour
			$membertravellingdetails->detour->LinkCustomAttributes = "";
			$membertravellingdetails->detour->HrefValue = "";
			$membertravellingdetails->detour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($membertravellingdetails->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$membertravellingdetails->Row_Rendered();
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
