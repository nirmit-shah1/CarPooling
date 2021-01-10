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
$comment_add = new ccomment_add();
$Page =& $comment_add;

// Page init
$comment_add->Page_Init();

// Page main
$comment_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comment_add = new ew_Page("comment_add");

// page properties
comment_add.PageID = "add"; // page ID
comment_add.FormID = "fcommentadd"; // form ID
var EW_PAGE_ID = comment_add.PageID; // for backward compatibility

// extend page with ValidateForm function
comment_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = 1;
	for (i=0; i<rowcnt; i++) {
		infix = "";
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comment->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($comment->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_cmid"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comment->cmid->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_cmid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($comment->cmid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_commentofuser"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comment->commentofuser->FldCaption()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}

	// Process detail page
	var detailpage = (fobj.detailpage) ? fobj.detailpage.value : "";
	if (detailpage != "") {
		return eval(detailpage+".ValidateForm(fobj)");
	}
	return true;
}

// extend page with Form_CustomValidate function
comment_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comment_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comment_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $comment_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $comment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$comment_add->ShowMessage();
?>
<form name="fcommentadd" id="fcommentadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return comment_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="comment">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comment->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comment->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $comment->reg_id->EditValue ?>"<?php echo $comment->reg_id->EditAttributes() ?>>
</span><?php echo $comment->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comment->cmid->Visible) { // cmid ?>
	<tr id="r_cmid"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->cmid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comment->cmid->CellAttributes() ?>><span id="el_cmid">
<input type="text" name="x_cmid" id="x_cmid" size="30" value="<?php echo $comment->cmid->EditValue ?>"<?php echo $comment->cmid->EditAttributes() ?>>
</span><?php echo $comment->cmid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comment->commentofuser->Visible) { // commentofuser ?>
	<tr id="r_commentofuser"<?php echo $comment->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comment->commentofuser->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comment->commentofuser->CellAttributes() ?>><span id="el_commentofuser">
<textarea name="x_commentofuser" id="x_commentofuser" cols="35" rows="4"<?php echo $comment->commentofuser->EditAttributes() ?>><?php echo $comment->commentofuser->EditValue ?></textarea>
</span><?php echo $comment->commentofuser->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$comment_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include_once "footer.php" ?>
<?php
$comment_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomment_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'comment';

	// Page object name
	var $PageObjName = 'comment_add';

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
	function ccomment_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (comment)
		if (!isset($GLOBALS["comment"])) {
			$GLOBALS["comment"] = new ccomment();
			$GLOBALS["Table"] =& $GLOBALS["comment"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comment', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $comment;

		// Create form object
		$objForm = new cFormObj();

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
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $Priv = 0;
	var $OldRecordset;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $comment;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$comment->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$comment->CurrentAction = "I"; // Form error, reset action
				$comment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["cmid"] != "") {
				$comment->cmid->setQueryStringValue($_GET["cmid"]);
				$comment->setKey("cmid", $comment->cmid->CurrentValue); // Set up key
			} else {
				$comment->setKey("cmid", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$comment->CurrentAction = "C"; // Copy record
			} else {
				$comment->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($comment->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("commentlist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$comment->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $comment->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "commentview.php")
						$sReturnUrl = $comment->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$comment->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$comment->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $comment;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $comment;
		$comment->reg_id->CurrentValue = NULL;
		$comment->reg_id->OldValue = $comment->reg_id->CurrentValue;
		$comment->cmid->CurrentValue = NULL;
		$comment->cmid->OldValue = $comment->cmid->CurrentValue;
		$comment->commentofuser->CurrentValue = NULL;
		$comment->commentofuser->OldValue = $comment->commentofuser->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $comment;
		if (!$comment->reg_id->FldIsDetailKey) {
			$comment->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$comment->cmid->FldIsDetailKey) {
			$comment->cmid->setFormValue($objForm->GetValue("x_cmid"));
		}
		if (!$comment->commentofuser->FldIsDetailKey) {
			$comment->commentofuser->setFormValue($objForm->GetValue("x_commentofuser"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $comment;
		$this->LoadOldRecord();
		$comment->reg_id->CurrentValue = $comment->reg_id->FormValue;
		$comment->cmid->CurrentValue = $comment->cmid->FormValue;
		$comment->commentofuser->CurrentValue = $comment->commentofuser->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $comment;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($comment->getKey("cmid")) <> "")
			$comment->cmid->CurrentValue = $comment->getKey("cmid"); // cmid
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$comment->CurrentFilter = $comment->KeyFilter();
			$sSql = $comment->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comment;

		// Initialize URLs
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
		} elseif ($comment->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$comment->reg_id->EditCustomAttributes = "";
			$comment->reg_id->EditValue = ew_HtmlEncode($comment->reg_id->CurrentValue);

			// cmid
			$comment->cmid->EditCustomAttributes = "";
			$comment->cmid->EditValue = ew_HtmlEncode($comment->cmid->CurrentValue);

			// commentofuser
			$comment->commentofuser->EditCustomAttributes = "";
			$comment->commentofuser->EditValue = ew_HtmlEncode($comment->commentofuser->CurrentValue);

			// Edit refer script
			// reg_id

			$comment->reg_id->HrefValue = "";

			// cmid
			$comment->cmid->HrefValue = "";

			// commentofuser
			$comment->commentofuser->HrefValue = "";
		}
		if ($comment->RowType == EW_ROWTYPE_ADD ||
			$comment->RowType == EW_ROWTYPE_EDIT ||
			$comment->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$comment->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($comment->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comment->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $comment;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($comment->reg_id->FormValue) && $comment->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $comment->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($comment->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $comment->reg_id->FldErrMsg());
		}
		if (!is_null($comment->cmid->FormValue) && $comment->cmid->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $comment->cmid->FldCaption());
		}
		if (!ew_CheckInteger($comment->cmid->FormValue)) {
			ew_AddMessage($gsFormError, $comment->cmid->FldErrMsg());
		}
		if (!is_null($comment->commentofuser->FormValue) && $comment->commentofuser->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $comment->commentofuser->FldCaption());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $conn, $Language, $Security, $comment;

		// Check if key value entered
		if ($comment->cmid->CurrentValue == "" && $comment->cmid->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $comment->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $comment->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$comment->reg_id->SetDbValueDef($rsnew, $comment->reg_id->CurrentValue, 0, FALSE);

		// cmid
		$comment->cmid->SetDbValueDef($rsnew, $comment->cmid->CurrentValue, 0, FALSE);

		// commentofuser
		$comment->commentofuser->SetDbValueDef($rsnew, $comment->commentofuser->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $comment->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($comment->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($comment->CancelMessage <> "") {
				$this->setFailureMessage($comment->CancelMessage);
				$comment->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}

		// Get insert id if necessary
		if ($AddRow) {
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$comment->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
