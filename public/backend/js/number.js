///////////////////////////////Seprator/////////////////////////////////////////////////
function Seprator(txt) {
    var iDistance = 3;
    var strChar = ",";
    var strValue = txt.value;
    if (strValue.indexOf(".") <= 0) {
        var str = "";
        for (var i = 0; i < strValue.length; i++) {
            if (strValue.charAt(i) != strChar) {
                if ((strValue.charAt(i) >= 0) && (strValue.charAt(i) <= 9)) {
                    str = str + strValue.charAt(i);
                }
            }
        }

        strValue = str;
        var iPos = strValue.length;
        iPos -= iDistance;
        while (iPos > 0) {
            strValue = strValue.substr(0, iPos) + strChar + strValue.substr(iPos);
            iPos -= iDistance;
        }

        txt.value = strValue;
    }
}

function Seprator_del(namee) {
    var len = $('#' + namee).val().split(",").length - 1;
    var real_val = $('#' + namee).val();

    for (var i = 0; i < parseInt(len); i++) {
        real_val = real_val.replace(",", "");
    }
    return real_val;
}
/***************************************************************************/
function isdigit(entry) {
    key = window.event.keyCode;
    if ((key >= 48 && key <= 57) || key == 46)
        return;
    else {
        alert(". Ù„Ø·ÙØ§ Ø¯Ø± Ø§ÙŠÙ† ÙÙŠÙ„Ø¯ ÙÙ‚Ø· Ø¹Ø¯Ø¯ ÙˆØ§Ø±Ø¯ Ú©Ù†ÛŒØ¯");
        window.event.keyCode = null;
    }
}

function isdigit_marys(id) {
    var txt = document.getElementById(id).value;
    if (txt == "") {
        document.getElementById(id).value = "";
    }

    //typeof value === 'number'
}