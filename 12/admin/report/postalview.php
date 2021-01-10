<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "postalinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$postal_view = new cpostal_view();
$Page =& $postal_view;

// Page init
$postal_view->Page_Init();

// Page main
$postal_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($postal->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var postal_view = new ew_Page("postal_view");

// page properties
postal_view.PageID = "view"; // page ID
postal_view.FormID = "fpostalview"; // form ID
var EW_PAGE_ID = postal_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
postal_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
postal_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
postal_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $postal_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $postal->TableCaption() ?>
&nbsp;&nbsp;<?php $postal_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($postal->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $postal_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $postal_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $postal_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $postal_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $postal_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$postal_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($postal->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->reg_id->FldCaption() ?></td>
		<td<?php echo $postal->reg_id->CellAttributes() ?>>
<div<?php echo $postal->reg_id->ViewAttributes() ?>><?php echo $postal->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($postal->address1->Visible) { // address1 ?>
	<tr id="r_address1"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->address1->FldCaption() ?></td>
		<td<?php echo $postal->address1->CellAttributes() ?>>
<div<?php echo $postal->address1->ViewAttributes() ?>><?php echo $postal->address1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($postal->address2->Visible) { // address2 ?>
	<tr id="r_address2"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->address2->FldCaption() ?></td>
		<td<?php echo $postal->address2->CellAttributes() ?>>
<div<?php echo $postal->address2->ViewAttributes() ?>><?php echo $postal->address2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($postal->postalcode->Visible) { // postalcode ?>
	<tr id="r_postalcode"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->postalcode->FldCaption() ?></td>
		<td<?php echo $postal->postalcode->CellAttributes() ?>>
<div<?php echo $postal->postalcode->ViewAttributes() ?>><?php echo $postal->postalcode->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($postal->state->Visible) { // state ?>
	<tr id="r_state"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->state->FldCaption() ?></td>
		<td<?php echo $postal->state->CellAttributes() ?>>
<div<?php echo $postal->state->ViewAttributes() ?>><?php echo $postal->state->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($postal->city->Visible) { // city ?>
	<tr id="r_city"<?php echo $postal->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $postal->city->FldCaption() ?></td>
		<td<?php echo $postal->city->CellAttributes() ?>>
<div<?php echo $postal->city->ViewAttributes() ?>><?php echo $postal->city->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$postal_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($postal->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$postal_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpostal_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'postal';

	// Page object name
	var $PageObjName = 'postal_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $postal;
		if ($postal->UseTokenInUrl) $PageUrl .= "t=" . $postal->TableVar . "&"; // Add page token
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
		global $objForm, $postal;
		if ($postal->UseTokenInUrl) {
			if ($objForm)
				return ($postal->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($postal->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpostal_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (postal)
		if (!isset($GLOBALS["postal"])) {
			$GLOBALS["postal"] = new cpostal();
			$GLOBALS["Table"] =& $GLOBALS["postal"];
		}
		$KeyUrl = "";
		if (@$_GET["reg_id"] <> "") {
			$this->RecKey["reg_id"] = $_GET["reg_id"];
			$KeyUrl .= "&reg_id=" . urlencode($this->RecKey["reg_id"]);
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
			define("EW_TABLE_NAME", 'postal', TRUE);

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
		global $postal;

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
		global $Language, $postal;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["reg_id"] <> "") {
				$postal->reg_id->setQueryStringValue($_GET["reg_id"]);
				$this->RecKey["reg_id"] = $postal->reg_id->QueryStringValue;
			} else {
				$sReturnUrl = "postallist.php"; // Return to list
			}

			// Get action
			$postal->CurrentAction = "I"; // Display form
			switch ($postal->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "postallist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "postallist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$postal->RowType = EW_ROWTYPE_VIEW;
		$postal->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $postal;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$postal->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$postal->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $postal->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$postal->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$postal->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$postal->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $postal;
		$sFilter = $postal->KeyFilter();

		// Call Row Selecting event
		$postal->Row_Selecting($sFilter);

		// Load SQL based on filter
		$postal->CurrentFilter = $sFilter;
		$sSql = $postal->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$postal->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $postal;
		if (!$rs || $rs->EOF) return;
		$postal->reg_id->setDbValue($rs->fields('reg_id'));
		$postal->address1->setDbValue($rs->fields('address1'));
		$postal->address2->setDbValue($rs->fields('address2'));
		$postal->postalcode->setDbValue($rs->fields('postalcode'));
		$postal->state->setDbValue($rs->fields('state'));
		$postal->city->setDbValue($rs->fields('city'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $postal;

		// Initialize URLs
		$this->AddUrl = $postal->AddUrl();
		$this->EditUrl = $postal->EditUrl();
		$this->CopyUrl = $postal->CopyUrl();
		$this->DeleteUrl = $postal->DeleteUrl();
		$this->ListUrl = $postal->ListUrl();

		// Call Row_Rendering event
		$postal->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// address1
		// address2
		// postalcode
		// state
		// city

		if ($postal->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$postal->reg_id->ViewValue = $postal->reg_id->CurrentValue;
			$postal->reg_id->ViewCustomAttributes = "";

			// address1
			$postal->address1->ViewValue = $postal->address1->CurrentValue;
			$postal->address1->ViewCustomAttributes = "";

			// address2
			$postal->address2->ViewValue = $postal->address2->CurrentValue;
			$postal->address2->ViewCustomAttributes = "";

			// postalcode
			$postal->postalcode->ViewValue = $postal->postalcode->CurrentValue;
			$postal->postalcode->ViewCustomAttributes = "";

			// state
			$postal->state->ViewValue = $postal->state->CurrentValue;
			$postal->state->ViewCustomAttributes = "";

			// city
			$postal->city->ViewValue = $postal->city->CurrentValue;
			$postal->city->ViewCustomAttributes = "";

			// reg_id
			$postal->reg_id->LinkCustomAttributes = "";
			$postal->reg_id->HrefValue = "";
			$postal->reg_id->TooltipValue = "";

			// address1
			$postal->address1->LinkCustomAttributes = "";
			$postal->address1->HrefValue = "";
			$postal->address1->TooltipValue = "";

			// address2
			$postal->address2->LinkCustomAttributes = "";
			$postal->address2->HrefValue = "";
			$postal->address2->TooltipValue = "";

			// postalcode
			$postal->postalcode->LinkCustomAttributes = "";
			$postal->postalcode->HrefValue = "";
			$postal->postalcode->TooltipValue = "";

			// state
			$postal->state->LinkCustomAttributes = "";
			$postal->state->HrefValue = "";
			$postal->state->TooltipValue = "";

			// city
			$postal->city->LinkCustomAttributes = "";
			$postal->city->HrefValue = "";
			$postal->city->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($postal->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$postal->Row_Rendered();
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
