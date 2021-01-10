<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "typeoftripinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$typeoftrip_view = new ctypeoftrip_view();
$Page =& $typeoftrip_view;

// Page init
$typeoftrip_view->Page_Init();

// Page main
$typeoftrip_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($typeoftrip->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var typeoftrip_view = new ew_Page("typeoftrip_view");

// page properties
typeoftrip_view.PageID = "view"; // page ID
typeoftrip_view.FormID = "ftypeoftripview"; // form ID
var EW_PAGE_ID = typeoftrip_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
typeoftrip_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
typeoftrip_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
typeoftrip_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $typeoftrip_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $typeoftrip->TableCaption() ?>
&nbsp;&nbsp;<?php $typeoftrip_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($typeoftrip->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $typeoftrip_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $typeoftrip_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $typeoftrip_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $typeoftrip_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $typeoftrip_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$typeoftrip_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($typeoftrip->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->reg_id->FldCaption() ?></td>
		<td<?php echo $typeoftrip->reg_id->CellAttributes() ?>>
<div<?php echo $typeoftrip->reg_id->ViewAttributes() ?>><?php echo $typeoftrip->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->mid->Visible) { // mid ?>
	<tr id="r_mid"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->mid->FldCaption() ?></td>
		<td<?php echo $typeoftrip->mid->CellAttributes() ?>>
<div<?php echo $typeoftrip->mid->ViewAttributes() ?>><?php echo $typeoftrip->mid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->triptype->Visible) { // triptype ?>
	<tr id="r_triptype"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->triptype->FldCaption() ?></td>
		<td<?php echo $typeoftrip->triptype->CellAttributes() ?>>
<div<?php echo $typeoftrip->triptype->ViewAttributes() ?>><?php echo $typeoftrip->triptype->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->departuredate->Visible) { // departuredate ?>
	<tr id="r_departuredate"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->departuredate->FldCaption() ?></td>
		<td<?php echo $typeoftrip->departuredate->CellAttributes() ?>>
<div<?php echo $typeoftrip->departuredate->ViewAttributes() ?>><?php echo $typeoftrip->departuredate->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($typeoftrip->departuretime->Visible) { // departuretime ?>
	<tr id="r_departuretime"<?php echo $typeoftrip->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $typeoftrip->departuretime->FldCaption() ?></td>
		<td<?php echo $typeoftrip->departuretime->CellAttributes() ?>>
<div<?php echo $typeoftrip->departuretime->ViewAttributes() ?>><?php echo $typeoftrip->departuretime->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$typeoftrip_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($typeoftrip->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$typeoftrip_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ctypeoftrip_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'typeoftrip';

	// Page object name
	var $PageObjName = 'typeoftrip_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) $PageUrl .= "t=" . $typeoftrip->TableVar . "&"; // Add page token
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
		global $objForm, $typeoftrip;
		if ($typeoftrip->UseTokenInUrl) {
			if ($objForm)
				return ($typeoftrip->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($typeoftrip->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ctypeoftrip_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (typeoftrip)
		if (!isset($GLOBALS["typeoftrip"])) {
			$GLOBALS["typeoftrip"] = new ctypeoftrip();
			$GLOBALS["Table"] =& $GLOBALS["typeoftrip"];
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
			define("EW_TABLE_NAME", 'typeoftrip', TRUE);

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
		global $typeoftrip;

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
		global $Language, $typeoftrip;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["mid"] <> "") {
				$typeoftrip->mid->setQueryStringValue($_GET["mid"]);
				$this->RecKey["mid"] = $typeoftrip->mid->QueryStringValue;
			} else {
				$sReturnUrl = "typeoftriplist.php"; // Return to list
			}

			// Get action
			$typeoftrip->CurrentAction = "I"; // Display form
			switch ($typeoftrip->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "typeoftriplist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "typeoftriplist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$typeoftrip->RowType = EW_ROWTYPE_VIEW;
		$typeoftrip->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $typeoftrip;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$typeoftrip->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$typeoftrip->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $typeoftrip->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$typeoftrip->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$typeoftrip->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$typeoftrip->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $typeoftrip;
		$sFilter = $typeoftrip->KeyFilter();

		// Call Row Selecting event
		$typeoftrip->Row_Selecting($sFilter);

		// Load SQL based on filter
		$typeoftrip->CurrentFilter = $sFilter;
		$sSql = $typeoftrip->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$typeoftrip->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $typeoftrip;
		if (!$rs || $rs->EOF) return;
		$typeoftrip->reg_id->setDbValue($rs->fields('reg_id'));
		$typeoftrip->mid->setDbValue($rs->fields('mid'));
		$typeoftrip->triptype->setDbValue($rs->fields('triptype'));
		$typeoftrip->departuredate->setDbValue($rs->fields('departuredate'));
		$typeoftrip->departuretime->setDbValue($rs->fields('departuretime'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $typeoftrip;

		// Initialize URLs
		$this->AddUrl = $typeoftrip->AddUrl();
		$this->EditUrl = $typeoftrip->EditUrl();
		$this->CopyUrl = $typeoftrip->CopyUrl();
		$this->DeleteUrl = $typeoftrip->DeleteUrl();
		$this->ListUrl = $typeoftrip->ListUrl();

		// Call Row_Rendering event
		$typeoftrip->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// mid
		// triptype
		// departuredate
		// departuretime

		if ($typeoftrip->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$typeoftrip->reg_id->ViewValue = $typeoftrip->reg_id->CurrentValue;
			$typeoftrip->reg_id->ViewCustomAttributes = "";

			// mid
			$typeoftrip->mid->ViewValue = $typeoftrip->mid->CurrentValue;
			$typeoftrip->mid->ViewCustomAttributes = "";

			// triptype
			$typeoftrip->triptype->ViewValue = $typeoftrip->triptype->CurrentValue;
			$typeoftrip->triptype->ViewCustomAttributes = "";

			// departuredate
			$typeoftrip->departuredate->ViewValue = $typeoftrip->departuredate->CurrentValue;
			$typeoftrip->departuredate->ViewCustomAttributes = "";

			// departuretime
			$typeoftrip->departuretime->ViewValue = $typeoftrip->departuretime->CurrentValue;
			$typeoftrip->departuretime->ViewCustomAttributes = "";

			// reg_id
			$typeoftrip->reg_id->LinkCustomAttributes = "";
			$typeoftrip->reg_id->HrefValue = "";
			$typeoftrip->reg_id->TooltipValue = "";

			// mid
			$typeoftrip->mid->LinkCustomAttributes = "";
			$typeoftrip->mid->HrefValue = "";
			$typeoftrip->mid->TooltipValue = "";

			// triptype
			$typeoftrip->triptype->LinkCustomAttributes = "";
			$typeoftrip->triptype->HrefValue = "";
			$typeoftrip->triptype->TooltipValue = "";

			// departuredate
			$typeoftrip->departuredate->LinkCustomAttributes = "";
			$typeoftrip->departuredate->HrefValue = "";
			$typeoftrip->departuredate->TooltipValue = "";

			// departuretime
			$typeoftrip->departuretime->LinkCustomAttributes = "";
			$typeoftrip->departuretime->HrefValue = "";
			$typeoftrip->departuretime->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($typeoftrip->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$typeoftrip->Row_Rendered();
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
