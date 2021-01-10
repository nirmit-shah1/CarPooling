<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "areainfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$area_view = new carea_view();
$Page =& $area_view;

// Page init
$area_view->Page_Init();

// Page main
$area_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($area->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var area_view = new ew_Page("area_view");

// page properties
area_view.PageID = "view"; // page ID
area_view.FormID = "fareaview"; // form ID
var EW_PAGE_ID = area_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
area_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
area_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
area_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $area_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $area->TableCaption() ?>
&nbsp;&nbsp;<?php $area_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($area->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $area_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $area_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $area_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $area_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $area_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$area_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($area->aid->Visible) { // aid ?>
	<tr id="r_aid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->aid->FldCaption() ?></td>
		<td<?php echo $area->aid->CellAttributes() ?>>
<div<?php echo $area->aid->ViewAttributes() ?>><?php echo $area->aid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($area->sid->Visible) { // sid ?>
	<tr id="r_sid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->sid->FldCaption() ?></td>
		<td<?php echo $area->sid->CellAttributes() ?>>
<div<?php echo $area->sid->ViewAttributes() ?>><?php echo $area->sid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($area->cid->Visible) { // cid ?>
	<tr id="r_cid"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->cid->FldCaption() ?></td>
		<td<?php echo $area->cid->CellAttributes() ?>>
<div<?php echo $area->cid->ViewAttributes() ?>><?php echo $area->cid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($area->area_name->Visible) { // area_name ?>
	<tr id="r_area_name"<?php echo $area->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $area->area_name->FldCaption() ?></td>
		<td<?php echo $area->area_name->CellAttributes() ?>>
<div<?php echo $area->area_name->ViewAttributes() ?>><?php echo $area->area_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$area_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($area->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$area_view->Page_Terminate();
?>
<?php

//
// Page class
//
class carea_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'area';

	// Page object name
	var $PageObjName = 'area_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $area;
		if ($area->UseTokenInUrl) $PageUrl .= "t=" . $area->TableVar . "&"; // Add page token
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
		global $objForm, $area;
		if ($area->UseTokenInUrl) {
			if ($objForm)
				return ($area->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($area->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function carea_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (area)
		if (!isset($GLOBALS["area"])) {
			$GLOBALS["area"] = new carea();
			$GLOBALS["Table"] =& $GLOBALS["area"];
		}
		$KeyUrl = "";
		if (@$_GET["area_name"] <> "") {
			$this->RecKey["area_name"] = $_GET["area_name"];
			$KeyUrl .= "&area_name=" . urlencode($this->RecKey["area_name"]);
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
			define("EW_TABLE_NAME", 'area', TRUE);

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
		global $area;

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
		global $Language, $area;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["area_name"] <> "") {
				$area->area_name->setQueryStringValue($_GET["area_name"]);
				$this->RecKey["area_name"] = $area->area_name->QueryStringValue;
			} else {
				$sReturnUrl = "arealist.php"; // Return to list
			}

			// Get action
			$area->CurrentAction = "I"; // Display form
			switch ($area->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "arealist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "arealist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$area->RowType = EW_ROWTYPE_VIEW;
		$area->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $area;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$area->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$area->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $area->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$area->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$area->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$area->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $area;
		$sFilter = $area->KeyFilter();

		// Call Row Selecting event
		$area->Row_Selecting($sFilter);

		// Load SQL based on filter
		$area->CurrentFilter = $sFilter;
		$sSql = $area->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$area->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $area;
		if (!$rs || $rs->EOF) return;
		$area->aid->setDbValue($rs->fields('aid'));
		$area->sid->setDbValue($rs->fields('sid'));
		$area->cid->setDbValue($rs->fields('cid'));
		$area->area_name->setDbValue($rs->fields('area_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $area;

		// Initialize URLs
		$this->AddUrl = $area->AddUrl();
		$this->EditUrl = $area->EditUrl();
		$this->CopyUrl = $area->CopyUrl();
		$this->DeleteUrl = $area->DeleteUrl();
		$this->ListUrl = $area->ListUrl();

		// Call Row_Rendering event
		$area->Row_Rendering();

		// Common render codes for all row types
		// aid
		// sid
		// cid
		// area_name

		if ($area->RowType == EW_ROWTYPE_VIEW) { // View row

			// aid
			$area->aid->ViewValue = $area->aid->CurrentValue;
			$area->aid->ViewCustomAttributes = "";

			// sid
			$area->sid->ViewValue = $area->sid->CurrentValue;
			$area->sid->ViewCustomAttributes = "";

			// cid
			$area->cid->ViewValue = $area->cid->CurrentValue;
			$area->cid->ViewCustomAttributes = "";

			// area_name
			$area->area_name->ViewValue = $area->area_name->CurrentValue;
			$area->area_name->ViewCustomAttributes = "";

			// aid
			$area->aid->LinkCustomAttributes = "";
			$area->aid->HrefValue = "";
			$area->aid->TooltipValue = "";

			// sid
			$area->sid->LinkCustomAttributes = "";
			$area->sid->HrefValue = "";
			$area->sid->TooltipValue = "";

			// cid
			$area->cid->LinkCustomAttributes = "";
			$area->cid->HrefValue = "";
			$area->cid->TooltipValue = "";

			// area_name
			$area->area_name->LinkCustomAttributes = "";
			$area->area_name->HrefValue = "";
			$area->area_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($area->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$area->Row_Rendered();
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
