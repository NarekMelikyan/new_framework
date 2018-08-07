function validateForm(form_id, rules) {
    form_id.find('p').remove();
    errors = [];

    form_id.find('input').each(function (key, value) {

        if (rules[key][1].includes('|')) {
            input_value = $(this).val();
            input_name = this.name;

            ruleArray = rules[key][1].split("|");
            ruleArray.forEach(function (elem) {
                if (elem == 'required') {
                    if (!checkRequired(input_value)) {
                        errors[input_name] = 'The ' + input_name + ' field is required !';
                    }
                }

                if (elem == 'email') {
                    if (!validateEmail(input_value) && !checkRequired(input_value)) {
                        errors[input_name] = 'Your ' + input_name + ' is not valid!';
                    } else if (checkRequired(input_value) == false) {
                        errors[input_name] = 'The ' + input_name + ' field is required !';
                    }
                }

                if (elem.substr(0, 3) == 'min') {
                    minArray = elem.split(':');
                    if (checkMinSymbols(input_value, minArray[1]) == false && checkRequired(input_value)) {
                        errors[input_name] = input_name + " field's minimum length is " + minArray[1];
                    } else if (checkMinSymbols(input_value, minArray[1]) == true && !checkRequired(input_value)) {
                        errors[input_name] = 'The ' + input_name + ' field is required !';
                    }
                }

                if (elem.substr(0, 5) == 'equal') {
                    equalArray = rules[input_name].split(':');
                    if (input_value !== form_id.find('#' + equalArray[1]).val()) {
                        errors[input_name] = input_name + " and " + equalArray[1] + ' fields are not match !';
                    }
                }

            })


        } else {
            if (rules[key][1] == 'required') {
                if (!checkRequired($(this).val())) {
                    errors[this.name] = 'The ' + this.name + ' field is required !';
                }
            }

            if (rules[key][1] == 'email') {
                if (!validateEmail($(this).val()) && checkRequired($(this).val())) {
                    errors[this.name] = 'Your ' + this.name + ' is not valid!';
                } else if (checkRequired($(this).val()) == false) {
                    errors[this.name] = 'The ' + this.name + ' field is required !';
                }
            }

            if (rules[key][1].substr(0, 3) == 'min') {
                minArray = rules[this.name].split(':');
                if (checkMinSymbols($(this).val(), minArray[1]) == false && checkRequired($(this).val())) {
                    errors[this.name] = this.name + " field's minimum length is " + minArray[1];
                } else if (checkMinSymbols($(this).val(), minArray[1]) == false && !checkRequired($(this).val())) {
                    errors[this.name] = 'The ' + this.name + ' field is required !';
                }
            }

            if (rules[key][1].substr(0, 5) == 'equal') {
                equalArray = rules[key][1].split(':');
                if ($(this).val() !== form_id.find('#' + equalArray[1]).val() && $(this).val() !== '') {
                    errors[this.name] = this.name + " and " + equalArray[1] + ' fields are not match !';
                }
            }
        }
    });

    errors = Object.entries(errors);

    if (errors.length !== 0) {
        errors.forEach(function (elem) {
            form_id.find('input').each(function () {
                if (this.name == elem[0]) {
                    $(this).parent().append('<p style="color: red" class="js_error">' + elem[1] + '</p>');
                }
            })
        })
    } else {
        form_id.find('button').attr('type', 'submit');
    }

}

function checkRequired(str) {
    if (str.length >= 1) {
        return true;
    } else {
        return false;
    }
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function checkMinSymbols(string, minNumber) {
    if (string.length >= minNumber) {
        return true;
    } else {
        return false;
    }
}

