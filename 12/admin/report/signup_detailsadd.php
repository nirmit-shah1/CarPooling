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
$signup_details_add = new csignup_details_add();
$Page =& $signup_details_add;

// Page init
$signup_details_add->Page_Init();

// Page main
$signup_details_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var signup_details_add = new ew_Page("signup_details_add");

// page properties
signup_details_add.PageID = "add"; // page ID
signup_details_add.FormID = "fsignup_detailsadd"; // form ID
var EW_PAGE_ID = signup_details_add.PageID; // for backward compatibility

// extend page with ValidateForm function
signup_details_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($signup_details->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_firstname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->firstname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_lastname"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->lastname->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_contactno"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->contactno->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_contactno"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($signup_details->contactno->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_gender"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->gender->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($signup_details->date->FldCaption()) ?>");

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
signup_details_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
signup_details_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
signup_details_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $signup_details_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $signup_details->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $signup_details->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$signup_details_add->ShowMessage();
?>
<form name="fsignup_detailsadd" id="fsignup_detailsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return signup_details_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="signup_details">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($signup_details->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $signup_details->reg_id->EditValue ?>"<?php echo $signup_details->reg_id->EditAttributes() ?>>
</span><?php echo $signup_details->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->firstname->Visible) { // firstname ?>
	<tr id="r_firstname"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->firstname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->firstname->CellAttributes() ?>><span id="el_firstname">
<input type="text" name="x_firstname" id="x_firstname" size="30" maxlength="20" value="<?php echo $signup_details->firstname->EditValue ?>"<?php echo $signup_details->firstname->EditAttributes() ?>>
</span><?php echo $signup_details->firstname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->lastname->Visible) { // lastname ?>
	<tr id="r_lastname"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->lastname->CellAttributes() ?>><span id="el_lastname">
<input type="text" name="x_lastname" id="x_lastname" size="30" maxlength="25" value="<?php echo $signup_details->lastname->EditValue ?>"<?php echo $signup_details->lastname->EditAttributes() ?>>
</span><?php echo $signup_details->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->contactno->Visible) { // contactno ?>
	<tr id="r_contactno"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->contactno->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->contactno->CellAttributes() ?>><span id="el_contactno">
<input type="text" name="x_contactno" id="x_contactno" size="30" value="<?php echo $signup_details->contactno->EditValue ?>"<?php echo $signup_details->contactno->EditAttributes() ?>>
</span><?php echo $signup_details->contactno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->gender->Visible) { // gender ?>
	<tr id="r_gender"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->gender->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->gender->CellAttributes() ?>><span id="el_gender">
<input type="text" name="x_gender" id="x_gender" size="30" maxlength="6" value="<?php echo $signup_details->gender->EditValue ?>"<?php echo $signup_details->gender->EditAttributes() ?>>
</span><?php echo $signup_details->gender->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->bio->Visible) { // bio ?>
	<tr id="r_bio"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->bio->FldCaption() ?></td>
		<td<?php echo $signup_details->bio->CellAttributes() ?>><span id="el_bio">
<input type="text" name="x_bio" id="x_bio" size="30" maxlength="100" value="<?php echo $signup_details->bio->EditValue ?>"<?php echo $signup_details->bio->EditAttributes() ?>>
</span><?php echo $signup_details->bio->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($signup_details->date->Visible) { // date ?>
	<tr id="r_date"<?php echo $signup_details->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $signup_details->date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $signup_details->date->CellAttributes() ?>><span id="el_date">
<input type="text" name="x_date" id="x_date" size="30" maxlength="25" value="<?php echo $signup_details->date->EditValue ?>"<?php echo $signup_details->date->EditAttributes() ?>>
</span><?php echo $signup_details->date->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$signup_details_add->ShowPageFooter();
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
$signup_details_add->Page_Terminate();
?>
<?php

//
// Page class
//
class csignup_details_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'signup_details';

	// Page object name
	var $PageObjName = 'signup_details_add';

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
	function csignup_details_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (signup_details)
		if (!isset($GLOBALS["signup_details"])) {
			$GLOBALS["signup_details"] = new csignup_details();
			$GLOBALS["Table"] =& $GLOBALS["signup_details"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'signup_details', TRUE);

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
		global $signup_details;

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
		global $objForm, $Language, $gsFormError, $signup_details;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$signup_details->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$signup_details->CurrentAction = "I"; // Form error, reset action
				$signup_details->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["contactno"] != "") {
				$signup_details->contactno->setQueryStringValue($_GET["contactno"]);
				$signup_details->setKey("contactno", $signup_details->contactno->CurrentValue); // Set up key
			} else {
				$signup_details->setKey("contactno", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$signup_details->CurrentAction = "C"; // Copy record
			} else {
				$signup_details->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($signup_details->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("signup_detailslist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$signup_details->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $signup_details->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "signup_detailsview.php")
						$sReturnUrl = $signup_details->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$signup_details->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$signup_details->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $signup_details;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $signup_details;
		$signup_details->reg_id->CurrentValue = NULL;
		$signup_details->reg_id->OldValue = $signup_details->reg_id->CurrentValue;
		$signup_details->firstname->CurrentValue = NULL;
		$signup_details->firstname->OldValue = $signup_details->firstname->CurrentValue;
		$signup_details->lastname->CurrentValue = NULL;
		$signup_details->lastname->OldValue = $signup_details->lastname->CurrentValue;
		$signup_details->contactno->CurrentValue = NULL;
		$signup_details->contactno->OldValue = $signup_details->contactno->CurrentValue;
		$signup_details->gender->CurrentValue = NULL;
		$signup_details->gender->OldValue = $signup_details->gender->CurrentValue;
		$signup_details->bio->CurrentValue = NULL;
		$signup_details->bio->OldValue = $signup_details->bio->CurrentValue;
		$signup_details->date->CurrentValue = NULL;
		$signup_details->date->OldValue = $signup_details->date->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $signup_details;
		if (!$signup_details->reg_id->FldIsDetailKey) {
			$signup_details->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$signup_details->firstname->FldIsDetailKey) {
			$signup_details->firstname->setFormValue($objForm->GetValue("x_firstname"));
		}
		if (!$signup_details->lastname->FldIsDetailKey) {
			$signup_details->lastname->setFormValue($objForm->GetValue("x_lastname"));
		}
		if (!$signup_details->contactno->FldIsDetailKey) {
			$signup_details->contactno->setFormValue($objForm->GetValue("x_contactno"));
		}
		if (!$signup_details->gender->FldIsDetailKey) {
			$signup_details->gender->setFormValue($objForm->GetValue("x_gender"));
		}
		if (!$signup_details->bio->FldIsDetailKey) {
			$signup_details->bio->setFormValue($objForm->GetValue("x_bio"));
		}
		if (!$signup_details->date->FldIsDetailKey) {
			$signup_details->date->setFormValue($objForm->GetValue("x_date"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $signup_details;
		$this->LoadOldRecord();
		$signup_details->reg_id->CurrentValue = $signup_details->reg_id->FormValue;
		$signup_details->firstname->CurrentValue = $signup_details->firstname->FormValue;
		$signup_details->lastname->CurrentValue = $signup_details->lastname->FormValue;
		$signup_details->contactno->CurrentValue = $signup_details->contactno->FormValue;
		$signup_details->gender->CurrentValue = $signup_details->gender->FormValue;
		$signup_details->bio->CurrentValue = $signup_details->bio->FormValue;
		$signup_details->date->CurrentValue = $signup_details->date->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $signup_details;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($signup_details->getKey("contactno")) <> "")
			$signup_details->contactno->CurrentValue = $signup_details->getKey("contactno"); // contactno
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$signup_details->CurrentFilter = $signup_details->KeyFilter();
			$sSql = $signup_details->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $signup_details;

		// Initialize URLs
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
		} elseif ($signup_details->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$signup_details->reg_id->EditCustomAttributes = "";
			$signup_details->reg_id->EditValue = ew_HtmlEncode($signup_details->reg_id->CurrentValue);

			// firstname
			$signup_details->firstname->EditCustomAttributes = "";
			$signup_details->firstname->EditValue = ew_HtmlEncode($signup_details->firstname->CurrentValue);

			// lastname
			$signup_details->lastname->EditCustomAttributes = "";
			$signup_details->lastname->EditValue = ew_HtmlEncode($signup_details->lastname->CurrentValue);

			// contactno
			$signup_details->contactno->EditCustomAttributes = "";
			$signup_details->contactno->EditValue = ew_HtmlEncode($signup_details->contactno->CurrentValue);

			// gender
			$signup_details->gender->EditCustomAttributes = "";
			$signup_details->gender->EditValue = ew_HtmlEncode($signup_details->gender->CurrentValue);

			// bio
			$signup_details->bio->EditCustomAttributes = "";
			$signup_details->bio->EditValue = ew_HtmlEncode($signup_details->bio->CurrentValue);

			// date
			$signup_details->date->EditCustomAttributes = "";
			$signup_details->date->EditValue = ew_HtmlEncode($signup_details->date->CurrentValue);

			// Edit refer script
			// reg_id

			$signup_details->reg_id->HrefValue = "";

			// firstname
			$signup_details->firstname->HrefValue = "";

			// lastname
			$signup_details->lastname->HrefValue = "";

			// contactno
			$signup_details->contactno->HrefValue = "";

			// gender
			$signup_details->gender->HrefValue = "";

			// bio
			$signup_details->bio->HrefValue = "";

			// date
			$signup_details->date->HrefValue = "";
		}
		if ($signup_details->RowType == EW_ROWTYPE_ADD ||
			$signup_details->RowType == EW_ROWTYPE_EDIT ||
			$signup_details->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$signup_details->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($signup_details->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$signup_details->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $signup_details;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($signup_details->reg_id->FormValue) && $signup_details->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($signup_details->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $signup_details->reg_id->FldErrMsg());
		}
		if (!is_null($signup_details->firstname->FormValue) && $signup_details->firstname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->firstname->FldCaption());
		}
		if (!is_null($signup_details->lastname->FormValue) && $signup_details->lastname->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->lastname->FldCaption());
		}
		if (!is_null($signup_details->contactno->FormValue) && $signup_details->contactno->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->contactno->FldCaption());
		}
		if (!ew_CheckInteger($signup_details->contactno->FormValue)) {
			ew_AddMessage($gsFormError, $signup_details->contactno->FldErrMsg());
		}
		if (!is_null($signup_details->gender->FormValue) && $signup_details->gender->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->gender->FldCaption());
		}
		if (!is_null($signup_details->date->FormValue) && $signup_details->date->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $signup_details->date->FldCaption());
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
		global $conn, $Language, $Security, $signup_details;

		// Check if key value entered
		if ($signup_details->contactno->CurrentValue == "" && $signup_details->contactno->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $signup_details->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $signup_details->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$signup_details->reg_id->SetDbValueDef($rsnew, $signup_details->reg_id->CurrentValue, 0, FALSE);

		// firstname
		$signup_details->firstname->SetDbValueDef($rsnew, $signup_details->firstname->CurrentValue, "", FALSE);

		// lastname
		$signup_details->lastname->SetDbValueDef($rsnew, $signup_details->lastname->CurrentValue, "", FALSE);

		// contactno
		$signup_details->contactno->SetDbValueDef($rsnew, $signup_details->contactno->CurrentValue, 0, FALSE);

		// gender
		$signup_details->gender->SetDbValueDef($rsnew, $signup_details->gender->CurrentValue, "", FALSE);

		// bio
		$signup_details->bio->SetDbValueDef($rsnew, $signup_details->bio->CurrentValue, NULL, FALSE);

		// date
		$signup_details->date->SetDbValueDef($rsnew, $signup_details->date->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $signup_details->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($signup_details->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($signup_details->CancelMessage <> "") {
				$this->setFailureMessage($signup_details->CancelMessage);
				$signup_details->CancelMessage = "";
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
			$signup_details->Row_Inserted($rs, $rsnew);
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
