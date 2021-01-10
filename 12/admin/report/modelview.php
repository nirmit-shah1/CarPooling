<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "modelinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$model_view = new cmodel_view();
$Page =& $model_view;

// Page init
$model_view->Page_Init();

// Page main
$model_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($model->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var model_view = new ew_Page("model_view");

// page properties
model_view.PageID = "view"; // page ID
model_view.FormID = "fmodelview"; // form ID
var EW_PAGE_ID = model_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
model_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
model_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
model_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $model_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $model->TableCaption() ?>
&nbsp;&nbsp;<?php $model_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($model->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $model_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $model_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $model_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $model_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $model_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$model_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($model->coid->Visible) { // coid ?>
	<tr id="r_coid"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->coid->FldCaption() ?></td>
		<td<?php echo $model->coid->CellAttributes() ?>>
<div<?php echo $model->coid->ViewAttributes() ?>><?php echo $model->coid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($model->moid->Visible) { // moid ?>
	<tr id="r_moid"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->moid->FldCaption() ?></td>
		<td<?php echo $model->moid->CellAttributes() ?>>
<div<?php echo $model->moid->ViewAttributes() ?>><?php echo $model->moid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($model->model_name->Visible) { // model_name ?>
	<tr id="r_model_name"<?php echo $model->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $model->model_name->FldCaption() ?></td>
		<td<?php echo $model->model_name->CellAttributes() ?>>
<div<?php echo $model->model_name->ViewAttributes() ?>><?php echo $model->model_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$model_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($model->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$model_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmodel_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'model';

	// Page object name
	var $PageObjName = 'model_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $model;
		if ($model->UseTokenInUrl) $PageUrl .= "t=" . $model->TableVar . "&"; // Add page token
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
		global $objForm, $model;
		if ($model->UseTokenInUrl) {
			if ($objForm)
				return ($model->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($model->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmodel_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (model)
		if (!isset($GLOBALS["model"])) {
			$GLOBALS["model"] = new cmodel();
			$GLOBALS["Table"] =& $GLOBALS["model"];
		}
		$KeyUrl = "";
		if (@$_GET["model_name"] <> "") {
			$this->RecKey["model_name"] = $_GET["model_name"];
			$KeyUrl .= "&model_name=" . urlencode($this->RecKey["model_name"]);
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
			define("EW_TABLE_NAME", 'model', TRUE);

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
		global $model;

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
		global $Language, $model;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["model_name"] <> "") {
				$model->model_name->setQueryStringValue($_GET["model_name"]);
				$this->RecKey["model_name"] = $model->model_name->QueryStringValue;
			} else {
				$sReturnUrl = "modellist.php"; // Return to list
			}

			// Get action
			$model->CurrentAction = "I"; // Display form
			switch ($model->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "modellist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "modellist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$model->RowType = EW_ROWTYPE_VIEW;
		$model->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $model;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$model->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$model->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $model->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$model->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$model->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$model->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $model;
		$sFilter = $model->KeyFilter();

		// Call Row Selecting event
		$model->Row_Selecting($sFilter);

		// Load SQL based on filter
		$model->CurrentFilter = $sFilter;
		$sSql = $model->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$model->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $model;
		if (!$rs || $rs->EOF) return;
		$model->coid->setDbValue($rs->fields('coid'));
		$model->moid->setDbValue($rs->fields('moid'));
		$model->model_name->setDbValue($rs->fields('model_name'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $model;

		// Initialize URLs
		$this->AddUrl = $model->AddUrl();
		$this->EditUrl = $model->EditUrl();
		$this->CopyUrl = $model->CopyUrl();
		$this->DeleteUrl = $model->DeleteUrl();
		$this->ListUrl = $model->ListUrl();

		// Call Row_Rendering event
		$model->Row_Rendering();

		// Common render codes for all row types
		// coid
		// moid
		// model_name

		if ($model->RowType == EW_ROWTYPE_VIEW) { // View row

			// coid
			$model->coid->ViewValue = $model->coid->CurrentValue;
			$model->coid->ViewCustomAttributes = "";

			// moid
			$model->moid->ViewValue = $model->moid->CurrentValue;
			$model->moid->ViewCustomAttributes = "";

			// model_name
			$model->model_name->ViewValue = $model->model_name->CurrentValue;
			$model->model_name->ViewCustomAttributes = "";

			// coid
			$model->coid->LinkCustomAttributes = "";
			$model->coid->HrefValue = "";
			$model->coid->TooltipValue = "";

			// moid
			$model->moid->LinkCustomAttributes = "";
			$model->moid->HrefValue = "";
			$model->moid->TooltipValue = "";

			// model_name
			$model->model_name->LinkCustomAttributes = "";
			$model->model_name->HrefValue = "";
			$model->model_name->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($model->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$model->Row_Rendered();
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
