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
$member_signup_add = new cmember_signup_add();
$Page =& $member_signup_add;

// Page init
$member_signup_add->Page_Init();

// Page main
$member_signup_add->Page_Main();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var member_signup_add = new ew_Page("member_signup_add");

// page properties
member_signup_add.PageID = "add"; // page ID
member_signup_add.FormID = "fmember_signupadd"; // form ID
var EW_PAGE_ID = member_signup_add.PageID; // for backward compatibility

// extend page with ValidateForm function
member_signup_add.ValidateForm = function(fobj) {
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
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->reg_id->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_reg_id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($member_signup->reg_id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_category"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->category->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_product"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->product->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_seats"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->seats->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_seats"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($member_signup->seats->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ac"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->ac->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_colour"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($member_signup->colour->FldCaption()) ?>");

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
member_signup_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
member_signup_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
member_signup_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
//-->

</script>
<?php $member_signup_add->ShowPageHeader(); ?>
<p class="phpmaker ewTitle"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $member_signup->TableCaption() ?></p>
<p class="phpmaker"><a href="<?php echo $member_signup->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></p>
<?php
$member_signup_add->ShowMessage();
?>
<form name="fmember_signupadd" id="fmember_signupadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return member_signup_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="member_signup">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($member_signup->reg_id->Visible) { // reg_id ?>
	<tr id="r_reg_id"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->reg_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->reg_id->CellAttributes() ?>><span id="el_reg_id">
<input type="text" name="x_reg_id" id="x_reg_id" size="30" value="<?php echo $member_signup->reg_id->EditValue ?>"<?php echo $member_signup->reg_id->EditAttributes() ?>>
</span><?php echo $member_signup->reg_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($member_signup->category->Visible) { // category ?>
	<tr id="r_category"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->category->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->category->CellAttributes() ?>><span id="el_category">
<input type="text" name="x_category" id="x_category" size="30" maxlength="25" value="<?php echo $member_signup->category->EditValue ?>"<?php echo $member_signup->category->EditAttributes() ?>>
</span><?php echo $member_signup->category->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($member_signup->product->Visible) { // product ?>
	<tr id="r_product"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->product->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->product->CellAttributes() ?>><span id="el_product">
<input type="text" name="x_product" id="x_product" size="30" maxlength="25" value="<?php echo $member_signup->product->EditValue ?>"<?php echo $member_signup->product->EditAttributes() ?>>
</span><?php echo $member_signup->product->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($member_signup->seats->Visible) { // seats ?>
	<tr id="r_seats"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->seats->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->seats->CellAttributes() ?>><span id="el_seats">
<input type="text" name="x_seats" id="x_seats" size="30" value="<?php echo $member_signup->seats->EditValue ?>"<?php echo $member_signup->seats->EditAttributes() ?>>
</span><?php echo $member_signup->seats->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($member_signup->ac->Visible) { // ac ?>
	<tr id="r_ac"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->ac->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->ac->CellAttributes() ?>><span id="el_ac">
<input type="text" name="x_ac" id="x_ac" size="30" maxlength="8" value="<?php echo $member_signup->ac->EditValue ?>"<?php echo $member_signup->ac->EditAttributes() ?>>
</span><?php echo $member_signup->ac->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($member_signup->colour->Visible) { // colour ?>
	<tr id="r_colour"<?php echo $member_signup->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $member_signup->colour->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $member_signup->colour->CellAttributes() ?>><span id="el_colour">
<input type="text" name="x_colour" id="x_colour" size="30" maxlength="7" value="<?php echo $member_signup->colour->EditValue ?>"<?php echo $member_signup->colour->EditAttributes() ?>>
</span><?php echo $member_signup->colour->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<?php
$member_signup_add->ShowPageFooter();
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
$member_signup_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cmember_signup_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'member_signup';

	// Page object name
	var $PageObjName = 'member_signup_add';

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
	function cmember_signup_add() {
		global $conn, $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Table object (member_signup)
		if (!isset($GLOBALS["member_signup"])) {
			$GLOBALS["member_signup"] = new cmember_signup();
			$GLOBALS["Table"] =& $GLOBALS["member_signup"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'member_signup', TRUE);

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
		global $member_signup;

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
		global $objForm, $Language, $gsFormError, $member_signup;

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$member_signup->CurrentAction = $_POST["a_add"]; // Get form action
			$this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$member_signup->CurrentAction = "I"; // Form error, reset action
				$member_signup->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else { // Not post back

			// Load key values from QueryString
			$bCopy = TRUE;
			if (@$_GET["reg_id"] != "") {
				$member_signup->reg_id->setQueryStringValue($_GET["reg_id"]);
				$member_signup->setKey("reg_id", $member_signup->reg_id->CurrentValue); // Set up key
			} else {
				$member_signup->setKey("reg_id", ""); // Clear key
				$bCopy = FALSE;
			}
			if ($bCopy) {
				$member_signup->CurrentAction = "C"; // Copy record
			} else {
				$member_signup->CurrentAction = "I"; // Display blank record
				$this->LoadDefaultValues(); // Load default values
			}
		}

		// Perform action based on action code
		switch ($member_signup->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("member_signuplist.php"); // No matching record, return to list
				}
				break;
			case "A": // ' Add new record
				$member_signup->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $member_signup->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "member_signupview.php")
						$sReturnUrl = $member_signup->ViewUrl(); // View paging, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$member_signup->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$member_signup->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $member_signup;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $member_signup;
		$member_signup->reg_id->CurrentValue = NULL;
		$member_signup->reg_id->OldValue = $member_signup->reg_id->CurrentValue;
		$member_signup->category->CurrentValue = NULL;
		$member_signup->category->OldValue = $member_signup->category->CurrentValue;
		$member_signup->product->CurrentValue = NULL;
		$member_signup->product->OldValue = $member_signup->product->CurrentValue;
		$member_signup->seats->CurrentValue = NULL;
		$member_signup->seats->OldValue = $member_signup->seats->CurrentValue;
		$member_signup->ac->CurrentValue = NULL;
		$member_signup->ac->OldValue = $member_signup->ac->CurrentValue;
		$member_signup->colour->CurrentValue = NULL;
		$member_signup->colour->OldValue = $member_signup->colour->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $member_signup;
		if (!$member_signup->reg_id->FldIsDetailKey) {
			$member_signup->reg_id->setFormValue($objForm->GetValue("x_reg_id"));
		}
		if (!$member_signup->category->FldIsDetailKey) {
			$member_signup->category->setFormValue($objForm->GetValue("x_category"));
		}
		if (!$member_signup->product->FldIsDetailKey) {
			$member_signup->product->setFormValue($objForm->GetValue("x_product"));
		}
		if (!$member_signup->seats->FldIsDetailKey) {
			$member_signup->seats->setFormValue($objForm->GetValue("x_seats"));
		}
		if (!$member_signup->ac->FldIsDetailKey) {
			$member_signup->ac->setFormValue($objForm->GetValue("x_ac"));
		}
		if (!$member_signup->colour->FldIsDetailKey) {
			$member_signup->colour->setFormValue($objForm->GetValue("x_colour"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $member_signup;
		$this->LoadOldRecord();
		$member_signup->reg_id->CurrentValue = $member_signup->reg_id->FormValue;
		$member_signup->category->CurrentValue = $member_signup->category->FormValue;
		$member_signup->product->CurrentValue = $member_signup->product->FormValue;
		$member_signup->seats->CurrentValue = $member_signup->seats->FormValue;
		$member_signup->ac->CurrentValue = $member_signup->ac->FormValue;
		$member_signup->colour->CurrentValue = $member_signup->colour->FormValue;
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

	// Load old record
	function LoadOldRecord() {
		global $member_signup;

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($member_signup->getKey("reg_id")) <> "")
			$member_signup->reg_id->CurrentValue = $member_signup->getKey("reg_id"); // reg_id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$member_signup->CurrentFilter = $member_signup->KeyFilter();
			$sSql = $member_signup->SQL();
			$this->OldRecordset = ew_LoadRecordset($sSql);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		}
		return TRUE;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $member_signup;

		// Initialize URLs
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
		} elseif ($member_signup->RowType == EW_ROWTYPE_ADD) { // Add row

			// reg_id
			$member_signup->reg_id->EditCustomAttributes = "";
			$member_signup->reg_id->EditValue = ew_HtmlEncode($member_signup->reg_id->CurrentValue);

			// category
			$member_signup->category->EditCustomAttributes = "";
			$member_signup->category->EditValue = ew_HtmlEncode($member_signup->category->CurrentValue);

			// product
			$member_signup->product->EditCustomAttributes = "";
			$member_signup->product->EditValue = ew_HtmlEncode($member_signup->product->CurrentValue);

			// seats
			$member_signup->seats->EditCustomAttributes = "";
			$member_signup->seats->EditValue = ew_HtmlEncode($member_signup->seats->CurrentValue);

			// ac
			$member_signup->ac->EditCustomAttributes = "";
			$member_signup->ac->EditValue = ew_HtmlEncode($member_signup->ac->CurrentValue);

			// colour
			$member_signup->colour->EditCustomAttributes = "";
			$member_signup->colour->EditValue = ew_HtmlEncode($member_signup->colour->CurrentValue);

			// Edit refer script
			// reg_id

			$member_signup->reg_id->HrefValue = "";

			// category
			$member_signup->category->HrefValue = "";

			// product
			$member_signup->product->HrefValue = "";

			// seats
			$member_signup->seats->HrefValue = "";

			// ac
			$member_signup->ac->HrefValue = "";

			// colour
			$member_signup->colour->HrefValue = "";
		}
		if ($member_signup->RowType == EW_ROWTYPE_ADD ||
			$member_signup->RowType == EW_ROWTYPE_EDIT ||
			$member_signup->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$member_signup->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($member_signup->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$member_signup->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $member_signup;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($member_signup->reg_id->FormValue) && $member_signup->reg_id->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->reg_id->FldCaption());
		}
		if (!ew_CheckInteger($member_signup->reg_id->FormValue)) {
			ew_AddMessage($gsFormError, $member_signup->reg_id->FldErrMsg());
		}
		if (!is_null($member_signup->category->FormValue) && $member_signup->category->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->category->FldCaption());
		}
		if (!is_null($member_signup->product->FormValue) && $member_signup->product->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->product->FldCaption());
		}
		if (!is_null($member_signup->seats->FormValue) && $member_signup->seats->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->seats->FldCaption());
		}
		if (!ew_CheckInteger($member_signup->seats->FormValue)) {
			ew_AddMessage($gsFormError, $member_signup->seats->FldErrMsg());
		}
		if (!is_null($member_signup->ac->FormValue) && $member_signup->ac->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->ac->FldCaption());
		}
		if (!is_null($member_signup->colour->FormValue) && $member_signup->colour->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterRequiredField") . " - " . $member_signup->colour->FldCaption());
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
		global $conn, $Language, $Security, $member_signup;

		// Check if key value entered
		if ($member_signup->reg_id->CurrentValue == "" && $member_signup->reg_id->getSessionValue() == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			return FALSE;
		}

		// Check for duplicate key
		$bCheckKey = TRUE;
		$sFilter = $member_signup->KeyFilter();
		if ($bCheckKey) {
			$rsChk = $member_signup->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				return FALSE;
			}
		}
		$rsnew = array();

		// reg_id
		$member_signup->reg_id->SetDbValueDef($rsnew, $member_signup->reg_id->CurrentValue, 0, FALSE);

		// category
		$member_signup->category->SetDbValueDef($rsnew, $member_signup->category->CurrentValue, "", FALSE);

		// product
		$member_signup->product->SetDbValueDef($rsnew, $member_signup->product->CurrentValue, "", FALSE);

		// seats
		$member_signup->seats->SetDbValueDef($rsnew, $member_signup->seats->CurrentValue, 0, FALSE);

		// ac
		$member_signup->ac->SetDbValueDef($rsnew, $member_signup->ac->CurrentValue, "", FALSE);

		// colour
		$member_signup->colour->SetDbValueDef($rsnew, $member_signup->colour->CurrentValue, "", FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $member_signup->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($member_signup->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($member_signup->CancelMessage <> "") {
				$this->setFailureMessage($member_signup->CancelMessage);
				$member_signup->CancelMessage = "";
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
			$member_signup->Row_Inserted($rs, $rsnew);
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
