<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "member_signupinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$member_signup_view = new cmember_signup_view();
$Page =& $member_signup_view;

// Page init
$member_signup_view->Page_Init();

// Page main
$member_signup_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($member_signup->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var member_signup_view = new ew_Page("member_signup_view");

// page properties
member_signup_view.PageID = "view"; // page ID
member_signup_view.FormID = "fmember_signupview"; // form ID
var EW_PAGE_ID = member_signup_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
member_signup_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
member_signup_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
member_signup_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $member_signup_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $member_signup->TableCaption() ?>
&nbsp;&nbsp;<?php $member_signup_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($member_signup->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $member_signup_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $member_signup_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $member_signup_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $member_signup_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $member_signup_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$member_signup_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($member_signup->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->reg_id->FldCaption() ?></td>
		<td<?php echo $member_signup->reg_id->CellAttributes() ?>>
<div<?php echo $member_signup->reg_id->ViewAttributes() ?>><?php echo $member_signup->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($member_signup->category->Visible) { // category ?>
	<tr id="r_category"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->category->FldCaption() ?></td>
		<td<?php echo $member_signup->category->CellAttributes() ?>>
<div<?php echo $member_signup->category->ViewAttributes() ?>><?php echo $member_signup->category->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($member_signup->product->Visible) { // product ?>
	<tr id="r_product"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->product->FldCaption() ?></td>
		<td<?php echo $member_signup->product->CellAttributes() ?>>
<div<?php echo $member_signup->product->ViewAttributes() ?>><?php echo $member_signup->product->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($member_signup->seats->Visible) { // seats ?>
	<tr id="r_seats"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->seats->FldCaption() ?></td>
		<td<?php echo $member_signup->seats->CellAttributes() ?>>
<div<?php echo $member_signup->seats->ViewAttributes() ?>><?php echo $member_signup->seats->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($member_signup->ac->Visible) { // ac ?>
	<tr id="r_ac"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->ac->FldCaption() ?></td>
		<td<?php echo $member_signup->ac->CellAttributes() ?>>
<div<?php echo $member_signup->ac->ViewAttributes() ?>><?php echo $member_signup->ac->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($member_signup->colour->Visible) { // colour ?>
	<tr id="r_colour"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->colour->FldCaption() ?></td>
		<td<?php echo $member_signup->colour->CellAttributes() ?>>
<div<?php echo $member_signup->colour->ViewAttributes() ?>><?php echo $member_signup->colour->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$member_signup_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($member_signup->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$member_signup_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmember_signup_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'member_signup';

	// Page object name
	var $PageObjName = 'member_signup_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $member_signup;
		if ($member_signup->UseTokenInUrl) $PageUrl .= "t=" . $member_signup->TableVar . "&"; // Add page token
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
		global $objForm, $member_signup;
		if ($member_signup->UseTokenInUrl) {
			if ($objForm)
				return ($member_signup->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($member_signup->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmember_signup_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (member_signup)
		if (!isset($GLOBALS["member_signup"])) {
			$GLOBALS["member_signup"] = new cmember_signup();
			$GLOBALS["Table"] =& $GLOBALS["member_signup"];
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
			define("EW_TABLE_NAME", 'member_signup', TRUE);

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
		global $member_signup;

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
		global $Language, $member_signup;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["reg_id"] <> "") {
				$member_signup->reg_id->setQueryStringValue($_GET["reg_id"]);
				$this->RecKey["reg_id"] = $member_signup->reg_id->QueryStringValue;
			} else {
				$sReturnUrl = "member_signuplist.php"; // Return to list
			}

			// Get action
			$member_signup->CurrentAction = "I"; // Display form
			switch ($member_signup->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "member_signuplist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "member_signuplist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$member_signup->RowType = EW_ROWTYPE_VIEW;
		$member_signup->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $member_signup;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$member_signup->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$member_signup->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $member_signup->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$member_signup->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$member_signup->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$member_signup->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $member_signup;
		$sFilter = $member_signup->KeyFilter();

		// Call Row Selecting event
		$member_signup->Row_Selecting($sFilter);

		// Load SQL based on filter
		$member_signup->CurrentFilter = $sFilter;
		$sSql = $member_signup->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$member_signup->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $member_signup;
		if (!$rs || $rs->EOF) return;
		$member_signup->reg_id->setDbValue($rs->fields('reg_id'));
		$member_signup->category->setDbValue($rs->fields('category'));
		$member_signup->product->setDbValue($rs->fields('product'));
		$member_signup->seats->setDbValue($rs->fields('seats'));
		$member_signup->ac->setDbValue($rs->fields('ac'));
		$member_signup->colour->setDbValue($rs->fields('colour'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $member_signup;

		// Initialize URLs
		$this->AddUrl = $member_signup->AddUrl();
		$this->EditUrl = $member_signup->EditUrl();
		$this->CopyUrl = $member_signup->CopyUrl();
		$this->DeleteUrl = $member_signup->DeleteUrl();
		$this->ListUrl = $member_signup->ListUrl();

		// Call Row_Rendering event
		$member_signup->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// category
		// product
		// seats
		// ac
		// colour

		if ($member_signup->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$member_signup->reg_id->ViewValue = $member_signup->reg_id->CurrentValue;
			$member_signup->reg_id->ViewCustomAttributes = "";

			// category
			$member_signup->category->ViewValue = $member_signup->category->CurrentValue;
			$member_signup->category->ViewCustomAttributes = "";

			// product
			$member_signup->product->ViewValue = $member_signup->product->CurrentValue;
			$member_signup->product->ViewCustomAttributes = "";

			// seats
			$member_signup->seats->ViewValue = $member_signup->seats->CurrentValue;
			$member_signup->seats->ViewCustomAttributes = "";

			// ac
			$member_signup->ac->ViewValue = $member_signup->ac->CurrentValue;
			$member_signup->ac->ViewCustomAttributes = "";

			// colour
			$member_signup->colour->ViewValue = $member_signup->colour->CurrentValue;
			$member_signup->colour->ViewCustomAttributes = "";

			// reg_id
			$member_signup->reg_id->LinkCustomAttributes = "";
			$member_signup->reg_id->HrefValue = "";
			$member_signup->reg_id->TooltipValue = "";

			// category
			$member_signup->category->LinkCustomAttributes = "";
			$member_signup->category->HrefValue = "";
			$member_signup->category->TooltipValue = "";

			// product
			$member_signup->product->LinkCustomAttributes = "";
			$member_signup->product->HrefValue = "";
			$member_signup->product->TooltipValue = "";

			// seats
			$member_signup->seats->LinkCustomAttributes = "";
			$member_signup->seats->HrefValue = "";
			$member_signup->seats->TooltipValue = "";

			// ac
			$member_signup->ac->LinkCustomAttributes = "";
			$member_signup->ac->HrefValue = "";
			$member_signup->ac->TooltipValue = "";

			// colour
			$member_signup->colour->LinkCustomAttributes = "";
			$member_signup->colour->HrefValue = "";
			$member_signup->colour->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($member_signup->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$member_signup->Row_Rendered();
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
