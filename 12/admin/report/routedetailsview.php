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
$routedetails_view = new croutedetails_view();
$Page =& $routedetails_view;

// Page init
$routedetails_view->Page_Init();

// Page main
$routedetails_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($routedetails->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var routedetails_view = new ew_Page("routedetails_view");

// page properties
routedetails_view.PageID = "view"; // page ID
routedetails_view.FormID = "froutedetailsview"; // form ID
var EW_PAGE_ID = routedetails_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
routedetails_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
routedetails_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
routedetails_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $routedetails_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $routedetails->TableCaption() ?>
&nbsp;&nbsp;<?php $routedetails_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($routedetails->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $routedetails_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $routedetails_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $routedetails_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $routedetails_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $routedetails_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$routedetails_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($routedetails->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->reg_id->FldCaption() ?></td>
		<td<?php echo $routedetails->reg_id->CellAttributes() ?>>
<div<?php echo $routedetails->reg_id->ViewAttributes() ?>><?php echo $routedetails->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($routedetails->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->mid->FldCaption() ?></td>
		<td<?php echo $routedetails->mid->CellAttributes() ?>>
<div<?php echo $routedetails->mid->ViewAttributes() ?>><?php echo $routedetails->mid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($routedetails->source->Visible) { // source ?>
	<tr id="r_source"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->source->FldCaption() ?></td>
		<td<?php echo $routedetails->source->CellAttributes() ?>>
<div<?php echo $routedetails->source->ViewAttributes() ?>><?php echo $routedetails->source->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($routedetails->destination->Visible) { // destination ?>
	<tr id="r_destination"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->destination->FldCaption() ?></td>
		<td<?php echo $routedetails->destination->CellAttributes() ?>>
<div<?php echo $routedetails->destination->ViewAttributes() ?>><?php echo $routedetails->destination->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($routedetails->intermediatedestination1->Visible) { // intermediatedestination1 ?>
	<tr id="r_intermediatedestination1"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->intermediatedestination1->FldCaption() ?></td>
		<td<?php echo $routedetails->intermediatedestination1->CellAttributes() ?>>
<div<?php echo $routedetails->intermediatedestination1->ViewAttributes() ?>><?php echo $routedetails->intermediatedestination1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($routedetails->intermediatedestination2->Visible) { // intermediatedestination2 ?>
	<tr id="r_intermediatedestination2"<?php echo $routedetails->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $routedetails->intermediatedestination2->FldCaption() ?></td>
		<td<?php echo $routedetails->intermediatedestination2->CellAttributes() ?>>
<div<?php echo $routedetails->intermediatedestination2->ViewAttributes() ?>><?php echo $routedetails->intermediatedestination2->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$routedetails_view->ShowPageFooter();
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
$routedetails_view->Page_Terminate();
?>
<?php

//
// Page class
//
class croutedetails_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'routedetails';

	// Page object name
	var $PageObjName = 'routedetails_view';

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
	function croutedetails_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (routedetails)
		if (!isset($GLOBALS["routedetails"])) {
			$GLOBALS["routedetails"] = new croutedetails();
			$GLOBALS["Table"] =& $GLOBALS["routedetails"];
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
			define("EW_TABLE_NAME", 'routedetails', TRUE);

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
		global $routedetails;

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
		global $Language, $routedetails;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["mid"] <> "") {
				$routedetails->mid->setQueryStringValue($_GET["mid"]);
				$this->RecKey["mid"] = $routedetails->mid->QueryStringValue;
			} else {
				$sReturnUrl = "routedetailslist.php"; // Return to list
			}

			// Get action
			$routedetails->CurrentAction = "I"; // Display form
			switch ($routedetails->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "routedetailslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "routedetailslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$routedetails->RowType = EW_ROWTYPE_VIEW;
		$routedetails->ResetAttrs();
		$this->RenderRow();
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

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $routedetails;

		// Initialize URLs
		$this->AddUrl = $routedetails->AddUrl();
		$this->EditUrl = $routedetails->EditUrl();
		$this->CopyUrl = $routedetails->CopyUrl();
		$this->DeleteUrl = $routedetails->DeleteUrl();
		$this->ListUrl = $routedetails->ListUrl();

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

			// source
			$routedetails->source->ViewValue = $routedetails->source->CurrentValue;
			$routedetails->source->ViewCustomAttributes = "";

			// destination
			$routedetails->destination->ViewValue = $routedetails->destination->CurrentValue;
			$routedetails->destination->ViewCustomAttributes = "";

			// intermediatedestination1
			$routedetails->intermediatedestination1->ViewValue = $routedetails->intermediatedestination1->CurrentValue;
			$routedetails->intermediatedestination1->ViewCustomAttributes = "";

			// intermediatedestination2
			$routedetails->intermediatedestination2->ViewValue = $routedetails->intermediatedestination2->CurrentValue;
			$routedetails->intermediatedestination2->ViewCustomAttributes = "";

			// reg_id
			$routedetails->reg_id->LinkCustomAttributes = "";
			$routedetails->reg_id->HrefValue = "";
			$routedetails->reg_id->TooltipValue = "";

			// mid
			$routedetails->mid->LinkCustomAttributes = "";
			$routedetails->mid->HrefValue = "";
			$routedetails->mid->TooltipValue = "";

			// source
			$routedetails->source->LinkCustomAttributes = "";
			$routedetails->source->HrefValue = "";
			$routedetails->source->TooltipValue = "";

			// destination
			$routedetails->destination->LinkCustomAttributes = "";
			$routedetails->destination->HrefValue = "";
			$routedetails->destination->TooltipValue = "";

			// intermediatedestination1
			$routedetails->intermediatedestination1->LinkCustomAttributes = "";
			$routedetails->intermediatedestination1->HrefValue = "";
			$routedetails->intermediatedestination1->TooltipValue = "";

			// intermediatedestination2
			$routedetails->intermediatedestination2->LinkCustomAttributes = "";
			$routedetails->intermediatedestination2->HrefValue = "";
			$routedetails->intermediatedestination2->TooltipValue = "";
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
}
?>
