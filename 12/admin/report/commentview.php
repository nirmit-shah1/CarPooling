<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg8.php" ?>
<?php include_once "ewmysql8.php" ?>
<?php include_once "phpfn8.php" ?>
<?php include_once "commentinfo.php" ?>
<?php include_once "userfn8.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
$comment_view = new ccomment_view();
$Page =& $comment_view;

// Page init
$comment_view->Page_Init();

// Page main
$comment_view->Page_Main();
?>
<?php include_once "header.php" ?>
<?php if ($comment->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comment_view = new ew_Page("comment_view");

// page properties
comment_view.PageID = "view"; // page ID
comment_view.FormID = "fcommentview"; // form ID
var EW_PAGE_ID = comment_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comment_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comment_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comment_view.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php } ?>
<?php $comment_view->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comment->TableCaption() ?>
&nbsp;&nbsp;<?php $comment_view->ExportOptions->Render("body"); ?>
</p>
<?php if ($comment->Export == "") { ?>
<p class="phpmaker">
<a href="<?php echo $comment_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<a href="<?php echo $comment_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<a href="<?php echo $comment_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<a href="<?php echo $comment_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<a href="<?php echo $comment_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
</p>
<?php
$comment_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comment->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->reg_id->FldCaption() ?></td>
		<td<?php echo $comment->reg_id->CellAttributes() ?>>
<div<?php echo $comment->reg_id->ViewAttributes() ?>><?php echo $comment->reg_id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comment->cmid->Visible) { // cmid ?>
	<tr id="r_cmid"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->cmid->FldCaption() ?></td>
		<td<?php echo $comment->cmid->CellAttributes() ?>>
<div<?php echo $comment->cmid->ViewAttributes() ?>><?php echo $comment->cmid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comment->commentofuser->Visible) { // commentofuser ?>
	<tr id="r_commentofuser"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->commentofuser->FldCaption() ?></td>
		<td<?php echo $comment->commentofuser->CellAttributes() ?>>
<div<?php echo $comment->commentofuser->ViewAttributes() ?>><?php echo $comment->commentofuser->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php
$comment_view->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($comment->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$comment_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomment_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'comment';

	// Page object name
	var $PageObjName = 'comment_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comment;
		if ($comment->UseTokenInUrl) $PageUrl .= "t=" . $comment->TableVar . "&"; // Add page token
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
		global $objForm, $comment;
		if ($comment->UseTokenInUrl) {
			if ($objForm)
				return ($comment->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comment->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomment_view() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comment)
		if (!isset($GLOBALS["comment"])) {
			$GLOBALS["comment"] = new ccomment();
			$GLOBALS["Table"] =& $GLOBALS["comment"];
		}
		$KeyUrl = "";
		if (@$_GET["cmid"] <> "") {
			$this->RecKey["cmid"] = $_GET["cmid"];
			$KeyUrl .= "&cmid=" . urlencode($this->RecKey["cmid"]);
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
			define("EW_TABLE_NAME", 'comment', TRUE);

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
		global $comment;

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
		global $Language, $comment;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["cmid"] <> "") {
				$comment->cmid->setQueryStringValue($_GET["cmid"]);
				$this->RecKey["cmid"] = $comment->cmid->QueryStringValue;
			} else {
				$sReturnUrl = "commentlist.php"; // Return to list
			}

			// Get action
			$comment->CurrentAction = "I"; // Display form
			switch ($comment->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						if ($this->getSuccessMessage() == "" && $this->getFailureMessage() == "")
							$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "commentlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "commentlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$comment->RowType = EW_ROWTYPE_VIEW;
		$comment->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $comment;
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$comment->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$comment->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $comment->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$comment->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$comment->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$comment->setStartRecordNumber($this->StartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comment;
		$sFilter = $comment->KeyFilter();

		// Call Row Selecting event
		$comment->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comment->CurrentFilter = $sFilter;
		$sSql = $comment->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$row = $rs->fields;
			$comment->Row_Selected($row);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $comment;
		if (!$rs || $rs->EOF) return;
		$comment->reg_id->setDbValue($rs->fields('reg_id'));
		$comment->cmid->setDbValue($rs->fields('cmid'));
		$comment->commentofuser->setDbValue($rs->fields('commentofuser'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comment;

		// Initialize URLs
		$this->AddUrl = $comment->AddUrl();
		$this->EditUrl = $comment->EditUrl();
		$this->CopyUrl = $comment->CopyUrl();
		$this->DeleteUrl = $comment->DeleteUrl();
		$this->ListUrl = $comment->ListUrl();

		// Call Row_Rendering event
		$comment->Row_Rendering();

		// Common render codes for all row types
		// reg_id
		// cmid
		// commentofuser

		if ($comment->RowType == EW_ROWTYPE_VIEW) { // View row

			// reg_id
			$comment->reg_id->ViewValue = $comment->reg_id->CurrentValue;
			$comment->reg_id->ViewCustomAttributes = "";

			// cmid
			$comment->cmid->ViewValue = $comment->cmid->CurrentValue;
			$comment->cmid->ViewCustomAttributes = "";

			// commentofuser
			$comment->commentofuser->ViewValue = $comment->commentofuser->CurrentValue;
			$comment->commentofuser->ViewCustomAttributes = "";

			// reg_id
			$comment->reg_id->LinkCustomAttributes = "";
			$comment->reg_id->HrefValue = "";
			$comment->reg_id->TooltipValue = "";

			// cmid
			$comment->cmid->LinkCustomAttributes = "";
			$comment->cmid->HrefValue = "";
			$comment->cmid->TooltipValue = "";

			// commentofuser
			$comment->commentofuser->LinkCustomAttributes = "";
			$comment->commentofuser->HrefValue = "";
			$comment->commentofuser->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comment->Row_Rendered();
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
