<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "logincountinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$logincount_view = new clogincount_view();
$Page =& $logincount_view;

// Page init
$logincount_view->Page_Init();

// Page main
$logincount_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($logincount->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var logincount_view = new ew_Page("logincount_view");

// page properties
logincount_view.PageID = "view"; // page ID
logincount_view.FormID = "flogincountview"; // form ID
var EW_PAGE_ID = logincount_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
logincount_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
logincount_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
logincount_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $logincount_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $logincount->TableCaption() ?>
&nbsp;&nbsp;<?php $logincount_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($logincount->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $logincount_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $logincount_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $logincount_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $logincount_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $logincount_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$logincount_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($logincount->dt_id->Visible) { // dt_id ?>
	<tr id="r_dt_id"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->dt_id->FldCaption() ?></td>
		<td<?php echo $logincount->dt_id->CellAttributes() ?>>
<div<?php echo $logincount->dt_id->ViewAttributes() ?>><?php echo $logincount->dt_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($logincount->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->reg_id->FldCaption() ?></td>
		<td<?php echo $logincount->reg_id->CellAttributes() ?>>
<div<?php echo $logincount->reg_id->ViewAttributes() ?>><?php echo $logincount->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($logincount->logincounter->Visible) { // logincounter ?>
	<tr id="r_logincounter"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->logincounter->FldCaption() ?></td>
		<td<?php echo $logincount->logincounter->CellAttributes() ?>>
<div<?php echo $logincount->logincounter->ViewAttributes() ?>><?php echo $logincount->logincounter->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($logincount->date->Visible) { // date ?>
	<tr id="r_date"<?php echo $logincount->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $logincount->date->FldCaption() ?></td>
		<td<?php echo $logincount->date->CellAttributes() ?>>
<div<?php echo $logincount->date->ViewAttributes() ?>><?php echo $logincount->date->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$logincount_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($logincount->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$logincount_view->Page_Terminate();
?>
<?php

//
// Page class
//
class clogincount_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'logincount';

	// Page object name
	var $PageObjName = 'logincount_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $logincount;
		if ($logincount->UseTokenInUrl) $PageUrl .= "t=" . $logincount->TableVar . "&"; // Add page token
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
		global $objForm, $logincount;
		if ($logincount->UseTokenInUrl) {
			if ($objForm)
				return ($logincount->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($logincount->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function clogincount_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (logincount)
		if (!isset($GLOBALS["logincount"])) {
			$GLOBALS["logincount"] = new clogincount();
			$GLOBALS["Table"] =& $GLOBALS["logincount"];
		}
		$KeyUrl = "";
		if (@$_GET["dt_id"] <> "") {
			$this->RecKey["dt_id"] = $_GET["dt_id"];
			$KeyUrl .= "&dt_id=" . urlencode($this->RecKey["dt_id"]);
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
			define("EW_TABLE_NAME", 'logincount', TRUE);

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
		global $logincount;

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
		global $Language, $logincount;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["dt_id"] <> "") {
				$logincount->dt_id->setQueryStringValue($_GET["dt_id"]);
				$this->RecKey["dt_id"] = $logincount->dt_id->QueryStringValue;
			} else {
				$sReturnUrl = "logincountlist.php"; // Return to list
			}

			// Get action
			$logincount->CurrentAction = "I"; // Display form
			switch ($logincount->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "logincountlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "logincountlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$logincount->RowType = EW_ROWTYPE_VIEW;
		$logincount->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $logincount;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$logincount->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$logincount->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $logincount->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$logincount->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$logincount->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$logincount->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $logincount;
		$sFilter = $logincount->KeyFilter();

		// Call Row Selecting event
		$logincount->Row_Selecting($sFilter);

		// Load SQL based on filter
		$logincount->CurrentFilter = $sFilter;
		$sSql = $logincount->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$logincount->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $logincount;
		if (!$rs || $rs->EOF) return;
		$logincount->dt_id->setDbValue($rs->fields('dt_id'));
		$logincount->reg_id->setDbValue($rs->fields('reg_id'));
		$logincount->logincounter->setDbValue($rs->fields('logincounter'));
		$logincount->date->setDbValue($rs->fields('date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $logincount;

		// Initialize URLs
		$this->AddUrl = $logincount->AddUrl();
		$this->EditUrl = $logincount->EditUrl();
		$this->CopyUrl = $logincount->CopyUrl();
		$this->DeleteUrl = $logincount->DeleteUrl();
		$this->ListUrl = $logincount->ListUrl();

		// Call Row_Rendering event
		$logincount->Row_Rendering();

		// Common render codes for all row types
		// dt_id
		// reg_id
		// logincounter
		// date

		if ($logincount->RowType == EW_ROWTYPE_VIEW) { // View row

			// dt_id
			$logincount->dt_id->ViewValue = $logincount->dt_id->CurrentValue;
			$logincount->dt_id->ViewCustomAttributes = "";

			// reg_id
			$logincount->reg_id->ViewValue = $logincount->reg_id->CurrentValue;
			$logincount->reg_id->ViewCustomAttributes = "";

			// logincounter
			$logincount->logincounter->ViewValue = $logincount->logincounter->CurrentValue;
			$logincount->logincounter->ViewCustomAttributes = "";

			// date
			$logincount->date->ViewValue = $logincount->date->CurrentValue;
			$logincount->date->ViewCustomAttributes = "";

			// dt_id
			$logincount->dt_id->LinkCustomAttributes = "";
			$logincount->dt_id->HrefValue = "";
			$logincount->dt_id->TooltipValue = "";

			// reg_id
			$logincount->reg_id->LinkCustomAttributes = "";
			$logincount->reg_id->HrefValue = "";
			$logincount->reg_id->TooltipValue = "";

			// logincounter
			$logincount->logincounter->LinkCustomAttributes = "";
			$logincount->logincounter->HrefValue = "";
			$logincount->logincounter->TooltipValue = "";

			// date
			$logincount->date->LinkCustomAttributes = "";
			$logincount->date->HrefValue = "";
			$logincount->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($logincount->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$logincount->Row_Rendered();
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
