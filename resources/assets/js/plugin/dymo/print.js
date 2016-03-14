//----------------------------------------------------------------------------
//
//  $Id: PrintMeThatLabel.js 14858 2011-03-25 00:10:21Z vbuzuev $ 
//
// Project -------------------------------------------------------------------
//
//  DYMO Label Framework
//
// Content -------------------------------------------------------------------
//
//  Web SDK print label sample
//
//----------------------------------------------------------------------------
//
//  Copyright (c), 2011, Sanford, L.P. All Rights Reserved.
//
//----------------------------------------------------------------------------
(function () {
    // utility functions from goog.dom
    /**
     * Enumeration for DOM node types (for reference)
     * @enum {number}
     */
    var NodeType = {
        ELEMENT: 1,
        ATTRIBUTE: 2,
        TEXT: 3,
        CDATA_SECTION: 4,
        ENTITY_REFERENCE: 5,
        ENTITY: 6,
        PROCESSING_INSTRUCTION: 7,
        COMMENT: 8,
        DOCUMENT: 9,
        DOCUMENT_TYPE: 10,
        DOCUMENT_FRAGMENT: 11,
        NOTATION: 12
    };
    /**
     * Removes all the child nodes on a DOM node.
     * @param {Node} node Node to remove children from.
     */
    var removeChildren = function (node) {
        // Note: Iterations over live collections can be slow, this is the fastest
        // we could find. The double parenthesis are used to prevent JsCompiler and
        // strict warnings.
        var child;
        while ((child = node.firstChild)) {
            node.removeChild(child);
        }
    };
    /**
     * Returns the owner document for a node.
     * @param {Node|Window} node The node to get the document for.
     * @return {!Document} The document owning the node.
     */
    var getOwnerDocument = function (node) {
        // TODO(user): Remove IE5 code.
        // IE5 uses document instead of ownerDocument
        return /** @type {!Document} */ (
            node.nodeType == NodeType.DOCUMENT ? node :
            node.ownerDocument || node.document);
    };
    /**
     * Cross-browser function for setting the text content of an element.
     * @param {Element} element The element to change the text content of.
     * @param {string} text The string that should replace the current element
     *     content.
     */
    var setTextContent = function (element, text) {
        if ('textContent' in element) {
            element.textContent = text;
        } else if (element.firstChild &&
            element.firstChild.nodeType == NodeType.TEXT) {
            // If the first child is a text node we just change its data and remove the
            // rest of the children.
            while (element.lastChild != element.firstChild) {
                element.removeChild(element.lastChild);
            }
            element.firstChild.data = text;
        } else {
            removeChildren(element);
            var doc = getOwnerDocument(element);
            element.appendChild(doc.createTextNode(text));
        }
    };
    // app settings stored between sessions
    var Settings = function () {
        this.currentPrinterName = "";
        this.printerUris = [];
    }
    // loads settings
    Settings.prototype.load = function () {
        var currentPrinterName = Cookie.get('currentPrinterName');
        var printerUris = Cookie.get('printerUris');
        if (currentPrinterName)
            this.currentPrinterName = currentPrinterName;
        if (printerUris)
            this.printerUris = printerUris.split('|');
    }
    Settings.prototype.save = function () {
        Cookie.set('currentPrinterName', this.currentPrinterName, 24 * 365);
        Cookie.set('printerUris', this.printerUris.join('|'), 24 * 365);
    }
    // called when the document completly loaded
    function onload() {
        var printButton = document.getElementById('printButton');
        var printerSettingsButton = document.getElementById('printerSettingsButton');
        //var labelSettingsDiv = document.getElementById('labelSettingsDiv');
        var printerSettingsDiv = document.getElementById('printerSettingsDiv');
        var printerUriTextBox = document.getElementById('printerUriTextBox');
        var addPrinterUriButton = document.getElementById('addPrinterUriButton');
        var clearPrinterUriButton = document.getElementById('clearPrinterUriButton');
        var printersComboBox = document.getElementById('printersComboBox');
        var jobStatusMessageSpan = document.getElementById('jobStatusMessageSpan');
        var settings = new Settings();
        // save settings to cookies
        function saveSettings() {
            settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
            //settings.save();
        }

        // caches a list of printers
        var printers = [];
        // loads all supported printers into a combo box
        function updatePrinters() {
            // clear first
            //removeChildren(printersComboBox);
            //while (printersComboBox.firstChild) 
            //    printersComboBox.removeChild(printersComboBox.firstChild);
            printers = dymo.label.framework.getPrinters();
            //if (printers.length == 0)
            //{
            //    alert("No DYMO printers are installed. Install DYMO printers.");
            //    return;
            //}
            //for (var i = 0; i < printers.length; i++)
            //{
            //    var printerName = printers[i].name;
            //
            //    var option = document.createElement('option');
            //    option.value = printerName;
            //    option.appendChild(document.createTextNode(printerName));
            //    printersComboBox.appendChild(option);
            //
            //    if (printerName == settings.currentPrinterName)
            //        printersComboBox.selectedIndex = i;
            //}
            //printerSettingsDiv.style.display= printers.length == 0 ? 'block' : 'none';
        }

        var addressLabel = null;
        var tapeLabel = null;
        // load labels from the server
        function loadLabels() {
            $.get("../Address.label", function (labelXml) {
                addressLabel = dymo.label.framework.openLabelXml(labelXml);
            }, "text");
        }

        // load settings from cookies
        function loadSettings() {
            settings.load();
            // update printer uris
            for (var i = 0; i < settings.printerUris.length; ++i) {
                var printerUri = settings.printerUris[i];
                dymo.label.framework.addPrinterUri(printerUri, '',
                    updatePrinters,
                    function () {
                        alert('Unable to contact "' + printerUri + '"');
                    });
            }
            //fixedLabelLengthCheckBox.checked = settings.isFixedLabelLength;
            //fixedLabelLengthTextBox.value = settings.fixedLabelLength;
            //fixedLabelLengthTextBox.disabled = !settings.isFixedLabelLength;
            //printerIpAddressTextBox.value = settings.printerIpAddress;
        }

        /*
         fixedLabelLengthCheckBox.onclick = function()
         {
         fixedLabelLengthTextBox.disabled = !fixedLabelLengthCheckBox.checked;
         }

         labelSettingsButton.onclick = function()
         {
         if (labelSettingsDiv.style.display == 'none')
         labelSettingsDiv.style.display = 'block';
         else
         labelSettingsDiv.style.display = 'none';
         }
         */
        //printerSettingsButton.onclick = function()
        //{
        //    if (printerSettingsDiv.style.display == 'none')
        //        printerSettingsDiv.style.display = 'block';
        //    else
        //        printerSettingsDiv.style.display = 'none';
        //}
        printButton.onclick = function () {
            try {
                printButton.disabled = true;
                //settings.currentPrinterName = printersComboBox.value;
                //settings.currentPrinterName = "\\\\terminal\\DYMO LabelWriter 450 Twin Turbo";
                settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
                var text = document.getElementById('labelTextArea').value;
                var printer = printers[settings.currentPrinterName];
                if (!printer)
                    throw new Error("Select printer");
                // determine what label to print based on printer type
                var label = null;
                var objName = "";
                if (printer.printerType == "LabelWriterPrinter") {
                    label = addressLabel;
                    objName = "Address";
                }
                else {
                    label = tapeLabel;
                    objName = "Text";
                }
                if (!label)
                    throw new Error("Label is not loaded. Wait until is loaded or reload the page");
                // set data
                // Because Android does not support XPath (that is needed for setObjectText)
                // we will use LabelSet instead
                //label.setObjectText(objName, text);
                var labelSet = new dymo.label.framework.LabelSetBuilder();
                labelSet.addRecord().setText(objName, text);
                var printparams;
                printparams = dymo.label.framework.createLabelWriterPrintParamsXml({twinTurboRoll: dymo.label.framework.TwinTurboRoll.Left});
                // print
                //label.print(printer.name, null, labelSet.toString());
                // print and get status
                var printJob = label.printAndPollStatus(printer.name, printparams, labelSet.toString(), function (printJob, printJobStatus) {
                    // output status
                    var statusStr = 'Job Status: ' + printJobStatus.statusMessage;
                    var result = (printJobStatus.status != dymo.label.framework.PrintJobStatus.ProcessingError
                    && printJobStatus.status != dymo.label.framework.PrintJobStatus.Finished);
                    // reenable when the job is done (either success or fail)
                    printButton.disabled = result;
                    //if (!result)
                    //    statusStr = '';
                    setTextContent(jobStatusMessageSpan, statusStr);
                    return result;
                }, 1000);
                saveSettings();
            }
            catch (e) {
                printButton.disabled = false;
                alert(e.message || e);
            }
        };
        var printerUri = 'http://terminal.adventsys.com:8631';
        if (!printerUri)
            throw new Error("Specify printer Url");
        dymo.label.framework.addPrinterUri(printerUri, '',
            function () {
                settings.printerUris.push(printerUri);
                settings.currentPrinterName = "DYMO LabelWriter 450 Twin Turbo @ terminal.adventsys.com";
                printers = dymo.label.framework.getPrinters();
                if(printers[settings.currentPrinterName].isConnected == true)
                    setTextContent(jobStatusMessageSpan, "Dymo Status: Ready");
                else
                    setTextContent(jobStatusMessageSpan, "Dymo Status: Not connected");
                //console.log(printers);
            },
            function () {
                setTextContent(jobStatusMessageSpan, "Dymo Status: Unable to connect to " + printerUri);
            }
        );
        //clearPrinterUriButton.onclick = function()
        //{
        //    dymo.label.framework.removeAllPrinterUri();
        //    settings.printerUris = [];
        //    saveSettings();
        //    updatePrinters();
        //}
        // setup controls
        loadLabels();
        //loadSettings();
        //updatePrinters();  // for local printers
        //fixedLabelLengthCheckBox.isChecked = false;
        //fixedLabelLengthTextBox.disabled = true;
        //labelSettingsDiv.style.display='none';
        //printerSettingsDiv.style.display= !settings.printerIpAddress ? 'block' : 'none';
    };
    // register onload event
    if (window.addEventListener)
        window.addEventListener("load", onload, false);
    else if (window.attachEvent)
        window.attachEvent("onload", onload);
    else
        window.onload = onload;
}());
