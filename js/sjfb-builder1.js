/**
 * Simple Jquery Form Builder (SJFB)
 * Copyright (c) 2015 Brandon Hoover, Hoover Web Development LLC (http://bhoover.com)
 * http://bhoover.com/simple-jquery-form-builder/
 * SJFB may be freely distributed under the included MIT license (license.txt).
 */


$(function(){

    //If loading a saved form from your database, put the ID here. Example id is "1".

    function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var formID = $_GET('id');


    //Adds new field with animation
    $("#add-field a").click(function() {
        event.preventDefault();
        $(addField($(this).data('type'))).appendTo('#form-fields').hide().slideDown('fast');
        $('#form-fields').sortable();
    });

    //Removes fields and choices with animation
    $("#sjfb").on("click", ".delete", function() {
        if (confirm('Are you sure?')) {
            var $this = $(this);
            $this.parent().slideUp( "slow", function() {
                $this.parent().remove()
            });
        }
    });

    //Makes fields required
    $("#sjfb").on("click", ".toggle-required", function() {
        requiredField($(this));
    });

    //Makes choices selected
    $("#sjfb").on("click", ".toggle-selected", function() {
        selectedChoice($(this));
    });

    //Adds new choice to field with animation
    $("#sjfb").on("click", ".add-choice", function() {
        $(addChoice()).appendTo($(this).prev()).hide().slideDown('fast');
        $('.choices ul').sortable();
    });

    //Saving form
    $("#sjfb").submit(function(event) {
        event.preventDefault();

        //Loop through fields and save field data to array
        var fields = [];

        $('.field').each(function() {

            var $this = $(this);

            //field type
            var fieldType = $this.data('type');

            //field label
            var fieldLabel = $this.find('.field-label').val();

            //field required
            var fieldReq = $this.hasClass('required') ? 1 : 0;

            //check if this field has choices
            if($this.find('.choices li').length >= 1) {

                var choices = [];

                $this.find('.choices li').each(function() {

                    var $thisChoice = $(this);

                    //choice label
                    var choiceLabel = $thisChoice.find('.choice-label').val();

                    //choice selected
                    var choiceSel = $thisChoice.hasClass('selected') ? 1 : 0;

                    choices.push({
                        label: choiceLabel,
                        sel: choiceSel
                    });

                });
            }

            fields.push({
                type: fieldType,
                label: fieldLabel,
                req: fieldReq,
                choices: choices
            });

        });

        var frontEndFormHTML = '';

function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}

var formID = $_GET('id');

        //Save form to database
        //Demo doesn't actually save. Download project files for save
        var data = JSON.stringify([{"name":"formID","value":formID},{"name":"formFields","value":fields}]);
        $.ajax({
            method: "POST",
            url: "sjfb-save1.php?id=" + formID,
            data: data, 
            dataType: 'json',
            success: function (msg) {
                console.log(msg);
                $('.alert').removeClass('hide');
                $("html, body").animate({ scrollTop: 0 }, "fast");

                //Demo only
                $('.alert textarea').val(JSON.stringify(fields));
            }
        });
    });

    //load saved form
    loadForm(formID);

});

//Add field to builder
function addField(fieldType, label) {

    var hasRequired, hasChoices, hasDeleted, text2,text3,text4, text5, read;
    var includeRequiredHTML = '';
    var includeChoicesHTML = '';
var includeDeletedHTML = '';
var includetext2 = '';
var includetext3 = '';
var includetext4 = '';
var includetext5 = '';
var readonly = '';

    switch (fieldType) {
            case 'text1':
            hasRequired = false;
            hasChoices = false;
hasDeleted = false;
text2 = false;
text3 = false;
text4 = false;
text5 = false;
read = false;
            break;
case 'text2':
            hasRequired = false;
            hasChoices = false;
hasDeleted = false;
text2 = true;
text3 = false;
text4 = false;
text5 = false;
read = true;
            break;
case 'text3':
            hasRequired = false;
            hasChoices = false;
hasDeleted = false;
text2 = false;
text3 = true;
text4 = false;
text5 = false;
read = true;
            break;
case 'text4':
            hasRequired = false;
            hasChoices = false;
hasDeleted = false;
text2 = false;
text3 = false;
text4 = true;
text5 = false;
read = true;

            break;
        case 'text':
            hasRequired = true;
            hasChoices = false;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'date':
            hasRequired = true;
            hasChoices = false;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'textarea':
            hasRequired = true;
            hasChoices = false;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'select':
            hasRequired = true;
            hasChoices = true;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'radio':
            hasRequired = true;
            hasChoices = true;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'checkbox':
            hasRequired = false;
            hasChoices = true;
hasDeleted = true;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
        case 'agree':
            //required "agree to terms" checkbox
            hasRequired = false;
            hasChoices = false;
text2 = false;
text3 = false;
text4 = false;
text5 = true;
read = false;
            break;
    }


    if (hasRequired) {
        includeRequiredHTML = '' +
            '<label>Required? ' +
            '<input class="toggle-required" type="checkbox">' +
            '</label>'
    }

if(text2) {
includetext2 = 'Raiser'
}

if(text3) {
includetext3 = 'Owner'
}

if(text4) {
includetext4 = 'Date'
}

if(text5) {
includetext5 = '' + fieldType + ''
}

if(read) {
readonly = '' + 'readonly' + ''
}
    if (hasDeleted) {
        includeDeletedHTML = '' +
            '<button type="button"  class="delete">Delete Field</button>'
    }

    if (hasChoices) {
        includeChoicesHTML = '' +
            '<div class="choices">' +
            '<ul></ul>' +
            '<button type="button" class="add-choice">Add Choice</button>' +
            '</div>'
    }

    return '' +
        '<div class="field" data-type="' + fieldType + '">' +
        includeDeletedHTML +
        '<h3>' + includetext2 + includetext3 + includetext4 + includetext5 + '</h3>' +
        '<label>Label:' +
        '<input type="text" class="field-label"' + readonly + '>' +
        '</label>' +
        includeRequiredHTML +
        includeChoicesHTML +
        '</div>'

}

//Make builder field required
function requiredField($this) {
    if (!$this.parents('.field').hasClass('required')) {
        //Field required
        $this.parents('.field').addClass('required');
        $this.attr('checked','checked');
    } else {
        //Field not required
        $this.parents('.field').removeClass('required');
        $this.removeAttr('checked');
    }
}

function selectedChoice($this) {
    if (! $this.parents('li').hasClass('selected')) {

        //Only checkboxes can have more than one item selected at a time
        //If this is not a checkbox group, unselect the choices before selecting
        if ($this.parents('.field').data('type') != 'checkbox') {
            $this.parents('.choices').find('li').removeClass('selected');
            $this.parents('.choices').find('.toggle-selected').not($this).removeAttr('checked');
        }

        //Make selected
        $this.parents('li').addClass('selected');
        $this.attr('checked','checked');

    } else {

        //Unselect
        $this.parents('li').removeClass('selected');
        $this.removeAttr('checked');

    }
}

//Builder HTML for select, radio, and checkbox choices
function addChoice() {
    return '' +
        '<li>' +
        '<label>Choice: ' +
        '<input type="text" class="choice-label">' +
        '</label>' +
        '<label>Selected? ' +
        '<input class="toggle-selected" type="checkbox">' +
        '</label>' +
        '<button type="button" class="delete">Delete Choice</button>' +
        '</li>'
}


formID = 144;
//Loads a saved form from your database into the builder
function loadForm(formID) {
    $.getJSON('sjfb-load.php?form_id=' + formID, function(data) {
        if (data) {
            //go through each saved field object and render the builder
            $.each( data, function( k, v ) {
                //Add the field
                $(addField(v['type'])).appendTo('#form-fields').hide().slideDown('fast');
                var $currentField = $('#form-fields .field').last();

                //Add the label
                $currentField.find('.field-label').val(v['label']);

                //Is it required?
                if (v['req']) {
                    requiredField($currentField.find('.toggle-required'));
                }

                //Any choices?
                if (v['choices']) {
                    $.each( v['choices'], function( k, v ) {
                        //add the choices
                        $currentField.find('.choices ul').append(addChoice());

                        //Add the label
                        $currentField.find('.choice-label').last().val(v['label']);

                        //Is it selected?
                        if (v['sel']) {
                            selectedChoice($currentField.find('.toggle-selected').last());
                        }
                    });
                }

            });

            $('#form-fields').sortable();
            $('.choices ul').sortable();
        }
    });
}