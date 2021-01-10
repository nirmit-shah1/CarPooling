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
$comment_edit = new ccomment_edit();
$Page =& $comment_edit;

// Page init
$comment_edit->Page_Init();

// Page main
$comment_edit->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comment_edit = new ew_Page("comment_edit");

// page properties
comment_edit.PageID = "edit"; // page ID
comment_edit.FormID = "fcommentedit"; // form ID
var EW_PAGE_ID = comment_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
comment_edit.ValidateForm = function(fobj) {
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
comment_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comment_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comment_edit.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $comment_edit->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comment->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $comment->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$comment_edit->ShowMessage();
?>
<form name="fcommentedit" id="fcommentedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return comment_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="comment">
<input type="hidden" name="a_edit" id="a_edit" value="U">
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
<div<?php echo $comment->cmid->ViewAttributes() ?>><?php echo $comment->cmid->EditValue ?></div>
<input type="hidden" name="x_cmid" id="x_cmid" value="<?php echo ew_HtmlEncode($comment->cmid->CurrentValue) ?>">
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
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<?php
$comment_edit->ShowPageFooter();
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
$comment_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomment_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'comment';

	// Page object name
	var $PageObjName = 'comment_edit';

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
	function ccomment_edit() {
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
			define("EW_PAGE_ID", 'edit', TRUE);

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
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $comment;

		// Load key from QueryString
		if (@$_GET["cmid"] <> "")
			$comment->cmid->setQueryStringValue($_GET["cmid"]);
		if (@$_POST["a_edit"] <> "") {
			$comment->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$comment->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$comment->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$comment->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($comment->cmid->CurrentValue == "")
			$this->Page_Terminate("commentlist.php"); // Invalid key, return to list
		switch ($comment->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("commentlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$comment->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $comment->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$comment->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$comment->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$comment->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $comment;

		// Get upload data
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
		$this->LoadRow();
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
		} elseif ($comment->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// reg_id
			$comment->reg_id->EditCustomAttributes = "";
			$comment->reg_id->EditValue = ew_HtmlEncode($comment->reg_id->CurrentValue);

			// cmid
			$comment->cmid->EditCustomAttributes = "";
			$comment->cmid->EditValue = $comment->cmid->CurrentValue;
			$comment->cmid->ViewCustomAttributes = "";

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

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $comment;
		$sFilter = $comment->KeyFilter();
		$comment->CurrentFilter = $sFilter;
		$sSql = $comment->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// reg_id
			$comment->reg_id->SetDbValueDef($rsnew, $comment->reg_id->CurrentValue, 0, FALSE);

			// cmid
			// commentofuser

			$comment->commentofuser->SetDbValueDef($rsnew, $comment->commentofuser->CurrentValue, "", FALSE);

			// Call Row Updating event
			$bUpdateRow = $comment->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				if (count($rsnew) > 0)
					$EditRow = $conn->Execute($comment->UpdateSQL($rsnew));
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
			} else {
				if ($comment->CancelMessage <> "") {
					$this->setFailureMessage($comment->CancelMessage);
					$comment->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$comment->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
