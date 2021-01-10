<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "signup_detailsinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$signup_details_view = new csignup_details_view();
$Page =& $signup_details_view;

// Page init
$signup_details_view->Page_Init();

// Page main
$signup_details_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($signup_details->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var signup_details_view = new ew_Page("signup_details_view");

// page properties
signup_details_view.PageID = "view"; // page ID
signup_details_view.FormID = "fsignup_detailsview"; // form ID
var EW_PAGE_ID = signup_details_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
signup_details_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
signup_details_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
signup_details_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $signup_details_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $signup_details->TableCaption() ?>
&nbsp;&nbsp;<?php $signup_details_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($signup_details->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $signup_details_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $signup_details_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $signup_details_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $signup_details_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $signup_details_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$signup_details_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($signup_details->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->reg_id->FldCaption() ?></td>
		<td<?php echo $signup_details->reg_id->CellAttributes() ?>>
<div<?php echo $signup_details->reg_id->ViewAttributes() ?>><?php echo $signup_details->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->firstname->Visible) { // firstname ?>
	<tr id="r_firstname"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->firstname->FldCaption() ?></td>
		<td<?php echo $signup_details->firstname->CellAttributes() ?>>
<div<?php echo $signup_details->firstname->ViewAttributes() ?>><?php echo $signup_details->firstname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->lastname->Visible) { // lastname ?>
	<tr id="r_lastname"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->lastname->FldCaption() ?></td>
		<td<?php echo $signup_details->lastname->CellAttributes() ?>>
<div<?php echo $signup_details->lastname->ViewAttributes() ?>><?php echo $signup_details->lastname->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->contactno->Visible) { // contactno ?>
	<tr id="r_contactno"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->contactno->FldCaption() ?></td>
		<td<?php echo $signup_details->contactno->CellAttributes() ?>>
<div<?php echo $signup_details->contactno->ViewAttributes() ?>><?php echo $signup_details->contactno->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->gender->Visible) { // gender ?>
	<tr id="r_gender"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->gender->FldCaption() ?></td>
		<td<?php echo $signup_details->gender->CellAttributes() ?>>
<div<?php echo $signup_details->gender->ViewAttributes() ?>><?php echo $signup_details->gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->bio->Visible) { // bio ?>
	<tr id="r_bio"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->bio->FldCaption() ?></td>
		<td<?php echo $signup_details->bio->CellAttributes() ?>>
<div<?php echo $signup_details->bio->ViewAttributes() ?>><?php echo $signup_details->bio->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($signup_details->date->Visible) { // date ?>
	<tr id="r_date"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->date->FldCaption() ?></td>
		<td<?php echo $signup_details->date->CellAttributes() ?>>
<div<?php echo $signup_details->date->ViewAttributes() ?>><?php echo $signup_details->date->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$signup_details_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($signup_details->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$signup_details_view->Page_Terminate();
?>
<?php

//
// Page class
//
class csignup_details_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'signup_details';

	// Page object name
	var $PageObjName = 'signup_details_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $signup_details;
		if ($signup_details->UseTokenInUrl) $PageUrl .= "t=" . $signup_details->TableVar . "&"; // Add page token
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
		global $objForm, $signup_details;
		if ($signup_details->UseTokenInUrl) {
			if ($objForm)
				return ($signup_details->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($signup_details->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function csignup_details_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (signup_details)
		if (!isset($GLOBALS["signup_details"])) {
			$GLOBALS["signup_details"] = new csignup_details();
			$GLOBALS["Table"] =& $GLOBALS["signup_details"];
		}
		$KeyUrl = "";
		if (@$_GET["contactno"] <> "") {
			$this->RecKey["contactno"] = $_GET["contactno"];
			$KeyUrl .= "&contactno=" . urlencode($this->RecKey["contactno"]);
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
			define("EW_TABLE_NAME", 'signup_details', TRUE);

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
		global $signup_details;

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
		global $Language, $signup_details;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["contactno"] <> "") {
				$signup_details->contactno->setQueryStringValue($_GET["contactno"]);
				$this->RecKey["contactno"] = $signup_details->contactno->QueryStringValue;
			} else {
				$sReturnUrl = "signup_detailslist.php"; // Return to list
			}

			// Get action
			$signup_details->CurrentAction = "I"; // Display form
			switch ($signup_details->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "signup_detailslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "signup_detailslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$signup_details->RowType = EW_ROWTYPE_VIEW;
		$signup_details->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $signup_details;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$signup_details->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$signup_details->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $signup_details->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$signup_details->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$signup_details->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$signup_details->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $signup_details;
		$sFilter = $signup_details->KeyFilter();

		// Call Row Selecting event
		$signup_details->Row_Selecting($sFilter);

		// Load SQL based on filter
		$signup_details->CurrentFilter = $sFilter;
		$sSql = $signup_details->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$signup_details->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $signup_details;
		if (!$rs || $rs->EOF) return;
		$signup_details->reg_id->setDbValue($rs->fields('reg_id'));
		$signup_details->firstname->setDbValue($rs->fields('firstname'));
		$signup_details->lastname->setDbValue($rs->fields('lastname'));
		$signup_details->contactno->setDbValue($rs->fields('contactno'));
		$signup_details->gender->setDbValue($rs->fields('gender'));
		$signup_details->bio->setDbValue($rs->fields('bio'));
		$signup_details->date->setDbValue($rs->fields('date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $signup_details;

		// Initialize URLs
		$this->AddUrl = $signup_details->AddUrl();
		$this->EditUrl = $signup_details->EditUrl();
		$this->CopyUrl = $signup_details->CopyUrl();
		$this->DeleteUrl = $signup_details->DeleteUrl();
		$this->ListUrl = $signup_details->ListUrl();

		// Call Row_Rendering event
		$signup_details->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// firstname
		// lastname
		// contactno
		// gender
		// bio
		// date

		if ($signup_details->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$signup_details->reg_id->ViewValue = $signup_details->reg_id->CurrentValue;
			$signup_details->reg_id->ViewCustomAttributes = "";

			// firstname
			$signup_details->firstname->ViewValue = $signup_details->firstname->CurrentValue;
			$signup_details->firstname->ViewCustomAttributes = "";

			// lastname
			$signup_details->lastname->ViewValue = $signup_details->lastname->CurrentValue;
			$signup_details->lastname->ViewCustomAttributes = "";

			// contactno
			$signup_details->contactno->ViewValue = $signup_details->contactno->CurrentValue;
			$signup_details->contactno->ViewCustomAttributes = "";

			// gender
			$signup_details->gender->ViewValue = $signup_details->gender->CurrentValue;
			$signup_details->gender->ViewCustomAttributes = "";

			// bio
			$signup_details->bio->ViewValue = $signup_details->bio->CurrentValue;
			$signup_details->bio->ViewCustomAttributes = "";

			// date
			$signup_details->date->ViewValue = $signup_details->date->CurrentValue;
			$signup_details->date->ViewCustomAttributes = "";

			// reg_id
			$signup_details->reg_id->LinkCustomAttributes = "";
			$signup_details->reg_id->HrefValue = "";
			$signup_details->reg_id->TooltipValue = "";

			// firstname
			$signup_details->firstname->LinkCustomAttributes = "";
			$signup_details->firstname->HrefValue = "";
			$signup_details->firstname->TooltipValue = "";

			// lastname
			$signup_details->lastname->LinkCustomAttributes = "";
			$signup_details->lastname->HrefValue = "";
			$signup_details->lastname->TooltipValue = "";

			// contactno
			$signup_details->contactno->LinkCustomAttributes = "";
			$signup_details->contactno->HrefValue = "";
			$signup_details->contactno->TooltipValue = "";

			// gender
			$signup_details->gender->LinkCustomAttributes = "";
			$signup_details->gender->HrefValue = "";
			$signup_details->gender->TooltipValue = "";

			// bio
			$signup_details->bio->LinkCustomAttributes = "";
			$signup_details->bio->HrefValue = "";
			$signup_details->bio->TooltipValue = "";

			// date
			$signup_details->date->LinkCustomAttributes = "";
			$signup_details->date->HrefValue = "";
			$signup_details->date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($signup_details->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$signup_details->Row_Rendered();
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
